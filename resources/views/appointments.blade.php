@extends('layouts.layout')

@push('custom_css')
    <link rel="stylesheet" type="text/css" href="/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css">

@endpush

@section('content')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Appointments</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="/add-appointment" class="btn btn btn-primary btn-rounded float-right"><i
                            class="fa fa-plus"></i> Add Appointment</a>
                </div>
            </div>
            <div class="row filter-row">
                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-12">
                    <div class="form-group form-focus select-focus">
                        <label class="focus-label">Status Filter</label>
                        <select class="select floating" id="filter_select">
                            <option value=""> -- Select -- </option>
                            <option value="Upcoming"> Upcoming </option>
                            <option value="Delayed"> Delayed </option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-8 col-12">
                    <div class="input-group input-daterange">

                        <input type="text" id="min-date" class="form-control date-range-filter datetimepicker"  placeholder="From:">

                        <div class="input-group-addon">...</div>

                        <input type="text" id="max-date" class="form-control date-range-filter datetimepicker"  placeholder="To:">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                            <tr>
                                <th>Appointment ID</th>
                                <th>Tilte</th>
                                <th>Patient Name</th>
                                <th>User Name</th>
                                <th>Date Of Birth</th>
                                <th>Gender</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                                <th>Status</th>
                                <th>Assign</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($appointments as $appointment)
                                <tr id="row-{{$appointment->id}}">
                                    <td>{{$appointment->id}}</td>
                                    <td>{{$appointment->title}}</td>
                                    <td><img width="28" height="28" src="{{$appointment->status->patient->image ? $appointment->status->patient->image : '/images/user.jpg'}}"
                                             class="rounded-circle m-r-5"
                                             alt="">{{$appointment->status->patient->fname}} {{$appointment->status->patient->lname}}
                                    </td>
                                    <td><a href="/view-patient/{{$appointment->status->patient->id}}" target="_blank">{{$appointment->status->patient->userName}}</a></td>
                                    <td>{{$appointment->status->patient->dateOfBirth}}</td>
                                    <td>{{$appointment->status->patient->gender =='M'?'Male':'Female'}}</td>
                                    <td id="date-{{$appointment->id}}">{{$appointment->date}}</td>
                                    <td id="time-{{$appointment->id}}">{{$appointment->time}}</td>
                                    <td id="status-{{$appointment->id}}"><span
                                            class="custom-badge status-{{$appointment->is_delayed==1?'red':'green'}}">
                                            {{$appointment->is_delayed==1?'Delayed':'Upcoming'}}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown action-label" id="assign">
                                            <a class="custom-badge status-red dropdown-toggle" href="#"
                                               data-toggle="dropdown" aria-expanded="false">
                                                Pending
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" id="done_btn"
                                                   data-id="{{$appointment->id}}">Done</a>
                                                <a class="dropdown-item" href="#" id="delay_btn"
                                                   data-id="{{$appointment->id}}"
                                                   data-date="{{$appointment->date}}"
                                                   data-time="{{$appointment->time}}">
                                                    Delay
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" id="view_btn" href="/#"
                                                   data-toggle="modal" data-target="#view_appointment"
                                                   data-id="{{$appointment->id}}"
                                                   data-appointment="{{$appointment}}"
                                                ><i
                                                        class="fa fa-eye m-r-5"></i>Quick View</a>
                                                <a class="dropdown-item"
                                                   href="/edit-appointment/{{$appointment->id}}"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete_appointment" data-id="{{$appointment->id}}"><i
                                                        class="fa fa-trash-o m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <div id="view_appointment" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="before-circle mr-2">
                    </div>
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Patient Name: <span id="pnameId"></span></p>
                    <p>Patient Status: <span id="statusId"></span></p>
                    <p>Description: <span id="descId"></span></p>
                    <p>Note: <span id="noteId"></span></p>
                    <p>Date: <span id="dateId"></span></p>
                    <p>Time: <span id="timeId"></span></p>
                    <p>Cost: <span id="costId"></span></p>
                    <p>Price: <span id="priceId"></span></p>
                    <p>Delayed: <span id="delayedId"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div id="done_modal" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 50%">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <form method="post" id="done_form">
                        <div>
                            <table class="table table-bordered table-hover" id="tab_logic">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th class="text-center">
                                        Name
                                    </th>
                                    <th class="text-center">
                                        Quantity
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr id='addr0'>
                                    <td>
                                        1
                                    </td>
                                    <td class="col-md-6">
                                        {{--                                        <input type="text" name='name0'  placeholder='Name' class="form-control"/>--}}
                                        <select id="item_select0" name="item_select0" class="form-control select">
                                            <option value=''>Select</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name='quantity0'  class="form-control"/>
                                    </td>
                                </tr>
                                <tr id='addr1'></tr>
                                </tbody>
                            </table>
                            <a id="add_row" class="btn btn-default pull-left">Add Row</a><a id='delete_row'
                                                                                            class="pull-right btn btn-default">Delete
                                Row</a>
                        </div>
                        <div class="m-t-20">
                            <button id="done_action_btn" type="submit" class="btn btn-primary">Done</button>
                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="delay_modal" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <form method="post">
                        <div>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <label for="date">New Date:</label>
                            <input type="text" class="form-control datetimepicker" id="delay_date" name="date">
                            <small class="error">{{$errors->first('date')}}</small>
                            <label for="time">New Time:</label>
                            <input class="form-control datetimepicker3" id="delay_time" name="time">
                            <small class="error">{{$errors->first('time')}}</small>

                        </div>
                        <div class="m-t-20">
                            <button id="delay_action_btn" type="submit" class="btn btn-primary">Delay</button>
                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div id="delete_appointment" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="/images/sent.png" alt="" width="50" height="46">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <h3>Are you sure want to delete this Appointment?</h3>
                    <div class="m-t-20"><a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-danger" id="delete_btn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('custom_scripts')
    <script src="/js/select2.min.js"></script>

    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>

    <script>



        $(document).ready(function () {




            let table = $('.datatable').DataTable();




/** start time range filter **/
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = $('#min-date').val();
                    var max = $('#max-date').val();
                    var createdAt = data[6] || 0; // Our date column in the table

                    if (
                        (min == "" || max == "") ||
                        (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
                    ) {
                        return true;
                    }
                    return false;
                }
            );

            $('.date-range-filter').on('dp.change',function() {
                table.draw();
            });
/**     end time range filter        **/



/** filter in table **/

            $('#filter_select').on('change', function () {

                let val = '\\b' + this.value + '\\b';
                table.columns(8).search(val , true, false ).draw();

            });




            var i = 1;
            $("#add_row").on('click',function () {
                $('#addr' + i).html("<td>" + (i + 1) + "</td>" +
                    "<td>" +
                    "<select id='item_select" + i + "' name='item_select" + i + "' class='form-control select'>" +
                    "      <option value=''>Select</option>" +
                    "</select>" +
                    "</td>" +
                    "<td><input  name='quantity" + i + "' type='text'  class='form-control input-md'></td>"
                );

                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                $('#item_select' + i).select2();
                getAssets(i);


                i++;



            });
            $("#delete_row").click(function () {
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
            });

            $('#view_appointment').on('show.bs.modal', function (e) {


                let appointment_id = $(e.relatedTarget).data('id');
                if (appointment_id) {
                    $.ajax({
                        type: 'GET',
                        url: "/get-appointment/" + appointment_id,
                        success: function (response) {
                            if (response.status === 1) {
                                console.log(response.appointment)
                                $('#modal-title').html(response.appointment.title);
                                $('#pnameId').html(response.appointment.status.patient.fname + ' ' + response.appointment.status.patient.lname);

                                $('#statusId').html(response.appointment.status.title);
                                $('#descId').html(response.appointment.description);
                                $('#noteId').html(response.appointment.note);
                                $('#costId').html(response.appointment.cost);
                                $('#priceId').html(response.appointment.price);
                                $('#dateId').html(response.appointment.date);
                                $('#timeId').html(response.appointment.time);
                                if (response.appointment.is_active) {
                                    $('.before-circle').css('background-color', '#10e617');
                                } else {
                                    $('.before-circle').css('background-color', '#e61010');
                                }
                                if (response.appointment.is_delayed) {
                                    $('#delayedId').html('<span class="custom-badge status-red">delayed</span>');
                                } else {
                                    $('#delayedId').html('<span class="custom-badge status-green">Upcoming</span>');
                                }


                            } else {
                                alert("couldn't find Patient data");

                            }


                        },
                        error: function (jqXHR) {

                            alert(jQuery.parseJSON(jqXHR.responseText).message);

                        }
                    });
                } else {

                }

            });

            $('#delete_appointment').on('show.bs.modal', function (e) {

                let appointment_id = $(e.relatedTarget).data('id');

                $('#delete_btn').data('id', appointment_id);


            });


            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $("#delete_btn").on('click', function (e) {

                e.preventDefault();

                let appointment_id = $("#delete_btn").data('id');
                console.log();

                $.ajax({
                    type: 'delete',
                    url: "/delete-appointment/" + appointment_id,


                    success: function (response) {
                        if (response.status === 1) {
                            console.log(response.status + " | " + response.message);
                            $('#delete_appointment').modal('hide');
                            $('#row-' + appointment_id).hide();
                        } else {
                            alert("something went wrong");
                        }


                    },
                    error: function (jqXHR) {
                        console.log(jQuery.parseJSON(jqXHR.responseText).message);
                        alert(jQuery.parseJSON(jqXHR.responseText).message);

                    }
                });
            });

            $(".table").on('click', '.action-label #done_btn', function (e) {

                e.preventDefault();
                let appointment_id = $(this).data('id');
                let patient_id = $(this).data('patient');
                $('#done_modal').modal('show');
                $('#done_action_btn').data('id', appointment_id);

                getAssets(0);


            });

            $("#done_action_btn").on('click', function (e) {

                e.preventDefault();
                let k =0;
                let arr = [];
                let appointment_id = $(this).data('id');
                let inputs = $("#done_form").serializeArray();
                console.log(inputs[0]['value'])
                for(k=0;k<=inputs.length;k+=2){
                    arr.push({id: inputs[k], quantity: inputs[k+1]})

                }

                $.ajax({
                    type: 'POST',
                    url: "/appointment-done/" + appointment_id,
                    data:{
                      assets:  arr,
                    },

                    success: function (response) {
                        if (response.status === 1) {
                            console.log(response.status + " | " + response.message);
                            $('#row-' + appointment_id).hide();
                            $('#done_modal').modal('hide');

                        } else {
                            alert("something went wrong");
                        }


                    },
                    error: function (jqXHR) {
                        console.log(jQuery.parseJSON(jqXHR.responseText).message);
                        alert(jQuery.parseJSON(jqXHR.responseText).message);

                    }
                });
            });


            $(".table").on('click', '.action-label #delay_btn', function (e) {

                e.preventDefault();

                let appointment_id = $(this).data('id');

                let appointment_date = $(this).data('date');
                let appointment_time = $(this).data('time');

                $('#delay_modal').modal('show');

                $('#delay_action_btn').data('id', appointment_id);
                $('#delay_date').val(appointment_date);
                $('#delay_time').val(appointment_time);

            });

            $("#delay_action_btn").on('click', function (e) {

                e.preventDefault();

                let appointment_id = $(this).data('id');
                let new_date = $("#delay_date").val();
                let new_time = $("#delay_time").val();
                console.log();

                $.ajax({
                    type: 'POST',
                    url: "/delay-appointment/" + appointment_id,
                    data: {
                        date: new_date,
                        time: new_time,
                    },

                    success: function (response) {
                        if (response.status === 1) {
                            console.log(response.status + " | " + response.message);
                            $('#delay_modal').modal('hide');
                            $('#date-' + appointment_id).html(new_date);
                            $('#time-' + appointment_id).html(new_time);
                            $('#status-' + appointment_id).html('<span class="custom-badge status-red">delayed</span>');


                        } else {
                            alert("something went wrong");
                        }


                    },
                    error: function (jqXHR) {
                        console.log(jQuery.parseJSON(jqXHR.responseText).message);
                        alert(jQuery.parseJSON(jqXHR.responseText).message);

                    }
                });
            });

            function getAssets(i) {
                $.ajax({
                    type: 'POST',
                    url: "/assets/",
                    success: function (response) {
                        if (response.status === 1) {
                            console.log(response.assets);
                            $.each(response.assets, function (k, v) {

                                $('#item_select'+i ).append('<option value="' + v.id + '" >' + v.name + '</option>');
                                console.log(v.title);
                            });
                            // $('#row-' + appointment_id).hide();
                            // $('#done_modal').modal('hide');

                        } else {
                            alert("something went wrong");
                        }


                    },
                    error: function (jqXHR) {
                        console.log(jQuery.parseJSON(jqXHR.responseText).message);
                        alert(jQuery.parseJSON(jqXHR.responseText).message);

                    }
                });
            }


        });
    </script>
@endpush
