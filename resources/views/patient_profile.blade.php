@extends('layouts.layout')

@push('custom_css')
    <link rel="stylesheet" type="text/css" href="/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-toggle.min.css">
    <style>
        .toggle.ios, .toggle-on.ios, .toggle-off.ios {
            border-radius: 20px;
        }

        .toggle.ios .toggle-handle {
            border-radius: 20px;
        }
    </style>


@endpush



@section('content')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-7 col-6">
                    <h4 class="page-title">My Profile</h4>
                </div>

                <div class="col-sm-5 col-6 text-right m-b-30">
                    <a href="/edit-patient/{{$id}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Edit
                        Profile</a>
                </div>
            </div>
            <div class="card-box profile-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#"><img class="avatar" src="{{$details->image ? $details->image : '/images/user.jpg'}}" alt=""></a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0 mb-0">{{$details->fname}} {{$details->lname}}</h3>
                                            <div class="staff-id"><p
                                                    class="text-{{$details->is_active ==1?"success":"red"}}">{{$details->is_active ==1?"Active":"Inactive"}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                <span class="title">Phone:</span>
                                                <span class="text"><a href="#">{{$details->phone}}</a></span>
                                            </li>
                                            <li>
                                                <span class="title">Email:</span>
                                                <span class="text"><a href="#">{{$details->email}}</a></span>
                                            </li>
                                            <li>
                                                <span class="title">Birthday:</span>
                                                <span class="text">{{$details->dateOfBirth}}</span>
                                            </li>
                                            <li>
                                                <span class="title">Address:</span>
                                                <span class="text">{{$details->address}}</span>
                                            </li>
                                            <li>
                                                <span class="title">Gender:</span>
                                                <span class="text">{{$details->gender=='M'?'Male':'Female'}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-tabs">
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="nav-item"><a class="nav-link active" href="#Status" data-toggle="tab">Status</a></li>
                    <li class="nav-item"><a class="nav-link" href="#appointments" data-toggle="tab">Appointments</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab">Sessions history</a></li>

                </ul>

                <div class="tab-content">
                    <div class="tab-pane show active" id="Status">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box" id="status_box">
                                    <h3 class="card-title">Status Informations</h3>
                                    <div class="experience-box">
                                        <ul class="experience-list" id="status_list">

                                                @foreach($statuses as $status)
                                                    <li id="li-{{$status->id}}">
                                                        <div class="experience-user">
                                                            <div class="before-circle" id="circle_{{$status->id}}"
                                                                 style="background-color: {{$status->is_active==1? '#10e617' : '#e61010'}}"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <h3 class="name"
                                                                    id="title_{{$status->id}}">{{$status->title}}</h3>
                                                                <div class="float-right ml-2"><a
                                                                        class="btn btn-outline-danger"
                                                                        href="/#" data-toggle="modal"
                                                                        data-target="#delete_status"
                                                                        data-id="{{$status->id}}">Delete
                                                                        Status</a></div>

                                                                <div class="float-right"><a
                                                                        class="btn btn-outline-primary"
                                                                        href="/#" data-toggle="modal"
                                                                        data-target="#edit_status"
                                                                        data-status="{{$status}}">Edit
                                                                        Status</a></div>

                                                                <h3 class="name"
                                                                    id="Desc_{{$status->id}}">{{$status->description}}</h3>


                                                                @if($status->notes != "" || $status->notes != null)
                                                                    <div style="display: grid">
                                                                        <label>Note: </label>
                                                                        <h3 id="note_{{$status->id}}">{{$status->notes}}</h3>
                                                                    </div>
                                                                @endif
                                                                <div><label>Expected Sessions</label>
                                                                    <h3 id="session_num_{{$status->id}}">{{$status->expected_sessions_number}}</h3>

                                                                </div>


                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach



                                        </ul>
                                    </div>
                                </div>
                                <div class="align-items-center"><a class="btn btn-outline-success" href="/#"
                                                                   data-toggle="modal" data-target="#add_status"
                                                                   style="margin-left: 50%">Add Status</a></div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="appointments">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h3 class="card-title">Upcoming Appointments</h3>
                                    <div class="experience-box">
                                        <ul class="experience-list">


                                                @foreach($uncompleted as $session)
                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"
                                                                 style="background-color: {{$session->is_active==1? '#10e617' : '#e61010'}}"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <h2 class="name">{{$session->title}}</h2>
                                                                <h3 class="name">{{$session->description}}</h3>
                                                                <div class="float-right"><a
                                                                        class="btn btn-outline-primary"
                                                                        href="/#" data-toggle="modal"
                                                                        data-target="#edit_status"
                                                                        data-status="{{$session}}">Edit
                                                                        Appointment</a></div>

                                                                @if($session->note != "" || $session->note != null)
                                                                    <div style="display: grid">
                                                                        <label>Note: </label>
                                                                        {{$session->note}}
                                                                    </div>
                                                                @endif
                                                                <div><span class="time">{{$session->date}}</span>

                                                                </div>


                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach

                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="history">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h3 class="card-title">Sessions History</h3>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            @foreach($sessions as $session)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"
                                                             style="background-color: {{$session->is_done==1? '#10e617' : '#e61010'}}"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <h2 class="name">{{$session->title}}</h2>
                                                            <h3 class="name">{{$session->description}}</h3>

                                                            @if($session->note != "" || $session->note != null)
                                                                <div style="display: grid">
                                                                    <label>Note: </label>
                                                                    {{$session->note}}
                                                                </div>
                                                            @endif
                                                            <div><span class="time">{{$session->date}}</span>

                                                            </div>


                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="add_status" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post">
                        <div>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" class="form-control" id="status_id" name="status_id">
                            <label for="title">title:</label>
                            <input type="text" class="form-control" name="title">
                            <small class="error">{{$errors->first('title')}}</small>
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description"></textarea>
                            <small class="error">{{$errors->first('description')}}</small>

                            <label for="note">Note:</label>
                            <textarea class="form-control" id="note" name="note"></textarea>
                            <small class="error">{{$errors->first('note')}}</small>

                            <label for="session_num">Expected Session Number: </label>
                            <input type="number" class="form-control" id="session_num" name="session_num">
                            <small class="error">{{$errors->first('session_num')}}</small>

                            <label for="is_active" style="display: block">Status: </label>
                            <input type="checkbox" class="form-control" id="is_active" name="is_active"
                                   data-toggle="toggle" data-onstyle="success"
                                   data-style="ios" data-offstyle="danger" data-on="Active" data-off="Inactive" checked>
                        </div>
                        <div class="m-t-20">
                            <button id="store_status" type="submit" data-id="{{$id}}" class="btn btn-primary">Add
                            </button>
                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="edit_status" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <form method="post">
                        <div>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" class="form-control" id="status_id" name="status_id">
                            <label for="title">title:</label>
                            <input type="text" class="form-control" name="title">
                            <small class="error">{{$errors->first('title')}}</small>
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description"></textarea>
                            <small class="error">{{$errors->first('description')}}</small>
                            <label for="note">Note:</label>
                            <textarea class="form-control" id="note" name="note"></textarea>
                            <small class="error">{{$errors->first('note')}}</small>

                            <label for="session_num">Expected Session Number: </label>
                            <input type="number" class="form-control" id="session_num" name="session_num">
                            <small class="error">{{$errors->first('session_num')}}</small>
                            <label for="is_active" style="display: block">Status: </label>
                            <input type="checkbox" class="form-control" id="is_active" name="is_active"
                                   data-toggle="toggle" data-onstyle="success"
                                   data-style="ios" data-offstyle="danger" data-on="Active" data-off="Inactive">
                        </div>
                        <div class="m-t-20">
                            <button id="submit" type="submit" data-id="{{$id}}" class="btn btn-primary">Save</button>
                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="delete_status" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="/images/sent.png" alt="" width="50" height="46">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <h3>Are you sure want to delete this Patient?</h3>
                    <div class="m-t-20"><a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" id="delete_btn"  class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('custom_scripts')
    <script src="/js/select2.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/bootstrap-toggle.min.js"></script>
    <script>


        $(document).ready(function () {
            $('#edit_status').on('show.bs.modal', function (e) {

                let status = $(e.relatedTarget).data('status');

                $(e.currentTarget).find('input[name="status_id"]').val(status.id);
                $(e.currentTarget).find('input[name="title"]').val(status.title);
                $(e.currentTarget).find('textarea[name="description"]').val(status.description);
                $(e.currentTarget).find('textarea[name="note"]').val(status.notes);
                $(e.currentTarget).find('input[name="session_num"]').val(status.expected_sessions_number);
                if (status.is_active == '1') {
                    $(e.currentTarget).find('input[name="is_active"]').bootstrapToggle('on')
                } else {
                    $(e.currentTarget).find('input[name="is_active"]').bootstrapToggle('off')
                }


            });

            $('#add_status').on('show.bs.modal', function (e) {

                $(this).find('form').trigger('reset');

            });


            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $("#submit").on('click', function (e) {

                e.preventDefault();
                let noteSelector = $('#edit_status').find('textarea[name="note"]');
                let titleSelector = $('#edit_status').find('input[name="title"]');
                let session_numberSelector = $('#edit_status').find('input[name="session_num"]');
                let edit_statusSelector = $('#edit_status').find('input[name="is_active"]:checked');
                let descriptionSelector = $('#edit_status').find('textarea[name="description"]');
                let status_id = $('#edit_status').find('input[name="status_id"]').val();
                let patient_id = $("#submit").data('id');

                $.ajax({
                    type: 'POST',
                    url: "/update-status/" + status_id,
                    data: {
                        patient_id : patient_id,
                        title: titleSelector.val(),
                        description: descriptionSelector.val(),
                        note: noteSelector.val(),
                        session_num: session_numberSelector.val(),
                        is_active: edit_statusSelector.length > 0,
                    },

                    success: function (response) {
                        if (response.status === 1) {
                            $('#edit_status').modal('hide');
                            console.log(response.status + " | " + response.message);
                            $('#title_' + status_id).html(titleSelector.val());
                            $('#Desc_' + status_id).html(descriptionSelector.val());
                            $('#note_' + status_id).html(noteSelector.val());

                            $('#session_num_' + status_id).html(session_numberSelector.val());
                            if (edit_statusSelector.length > 0) {
                                $('#circle_' + status_id).css('background-color', '#10e617');
                            } else {
                                $('#circle_' + status_id).css('background-color', '#e61010');
                            }

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

            $("#store_status").on('click', function (e) {

                e.preventDefault();
                let noteSelector = $('#add_status').find('textarea[name="note"]');
                let session_numberSelector = $('#add_status').find('input[name="session_num"]');
                let add_statusSelector = $('#add_status').find('input[name="is_active"]:checked');
                let descriptionSelector = $('#add_status').find('textarea[name="description"]');
                let titleSelector = $('#add_status').find('input[name="title"]');

                let patient_id = $("#store_status").data('id');

                $.ajax({
                    type: 'POST',
                    url: "/add-status",
                    data: {
                        patient_id: patient_id,
                        title: titleSelector.val(),
                        description: descriptionSelector.val(),
                        note: noteSelector.val(),
                        session_num: session_numberSelector.val(),
                        is_active: add_statusSelector.length > 0,
                    },
                    success: function (response) {
                        if (response.status === 1) {
                            $('#add_status').modal('hide');
                            // console.log(response.last_added.id);
                            let status = response.last_added;

                            let data = {
                                title: status.title,
                                description: status.description,
                                notes: status.notes,
                                expected_sessions_number: status.expected_sessions_number,
                                is_active: status.is_active,
                                id:status.id
                            }

                            $("#status_list").append('<li id="li-'+status.id+'">' +
                            '                                                    <div class="experience-user">' +
                            '                                                        <div class="before-circle" id="circle_'+status.id+'" ></div>' +
                                '                                                    </div>' +
                                '                                                    <div class="experience-content">' +
                                '                                                        <div class="timeline-content">' +
                                '' +                                '                        <h3 class="name" id="title_'+status.id+'">' + titleSelector.val() + '</h3>' +
                                '                                                            <div class="float-right ml-2"><a' +
                                '                                                                        class="btn btn-outline-danger"' +
                                '                                                                        href="/#" data-toggle="modal"' +
                                '                                                                        data-target="#delete_status"' +
                                '                                                                        data-id="'+status.id+'">Delete' +
                                '                                                                        Status</a></div>'+
                                '                                                            <div class="float-right"><a class="btn btn-outline-primary" id="btnedit" href="/#" data-toggle="modal" data-target="#edit_status" >Edit Status</a></div>' +
                                '' +                                '                        <h3 class="name" id="Desc_'+status.id+'">' + descriptionSelector.val() + '</h3>' +

                                '                                                           <div style="display: grid">' +
                                '                                                                <label>Note: </label>' +
                                '                                                                <h3 id="note_'+status.id+'">' + noteSelector.val() + '</h3>' +
                                '                                                            </div>' +
                                '                                                            <div><label>Expected Sessions</label>' +
                                '                                                                <h3 id="session_num_'+status.id+'">' + session_numberSelector.val() + '</h3>' +
                                '' +
                                '                                                            </div>' +
                                '' +
                                '' +
                                '                                                        </div>' +
                                '                                                    </div>' +
                                '                                                </li>');

                            $('#btnedit').attr('data-status',  JSON.stringify(data));

                            if (add_statusSelector.length > 0) {
                                $('#circle_' + status.id).css('background-color', '#10e617');
                            } else {
                                $('#circle_' + status.id).css('background-color', '#e61010');
                            }

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

            $('#delete_status').on('show.bs.modal', function (e) {

                let supplier_id = $(e.relatedTarget).data('id');

                $('#delete_btn').data('id', supplier_id);



            });

            $("#delete_btn").on('click', function (e) {

                e.preventDefault();

                let status_id = $("#delete_btn").data('id');
                console.log();

                $.ajax({
                    type: 'delete',
                    url: "/delete-status/" + status_id,


                    success: function (response) {
                        if (response.status === 1) {
                            console.log(response.status + " | " + response.message);
                            $('#delete_status').modal('hide');
                            $('#li-'+status_id).hide();
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

        });


    </script>
@endpush





