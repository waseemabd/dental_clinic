@extends('layouts.layout')

@push('custom_css')
    <link rel="stylesheet" type="text/css" href="/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-toggle.min.css">

@endpush

@section('content')


    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title float-left">Add Appointment</h4>
                    <a href="/add-patient" class="btn btn btn-primary btn-rounded float-right"><i
                            class="fa fa-plus"></i>Add New Patient</a>
                    <a href="/#"
                       data-toggle="modal" data-target="#add_status"
                       class="btn btn btn-primary btn-rounded float-right mr-2"><i
                            class="fa fa-plus"></i> Add New Status</a>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="post" action="/add-appointment">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input class="form-control" name="title" type="text" value="{{old('title')}}">
                                    <small class="error">{{$errors->first('title')}}</small>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Patient Name <span class="text-danger">*</span></label>
                                    <select class="select" id="patient_select" name="patient"
                                            value="{{old('patient')}}">
                                        <option value="">Select</option>
                                        @foreach($patients as $patient)
                                            <option
                                                value="{{$patient->id}}">{{$patient->fname}} {{$patient->lname}}</option>
                                        @endforeach
                                    </select>
                                    <small class="error">{{$errors->first('patient')}}</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input class="form-control" id="userName" name="userName" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Patient Status <span class="text-danger">*</span></label>
                                    <select class="select" name="patient_status" id="Pstatus"
                                            value="{{old('patient_status')}}">
                                        <option value="">Select</option>

                                    </select>
                                    <small class="error">{{$errors->first('patient_status')}}</small>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input type="text" name="date" class="form-control datetimepicker"
                                               value="{{old('date')}}">
                                        <small class="error">{{$errors->first('date')}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Time <span class="text-danger">*</span></label>
                                    <div class="time-icon">
                                        <input type="text" name="time" class="form-control" id="datetimepicker3"
                                               value="{{old('time')}}">
                                        <small class="error">{{$errors->first('time')}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input class="form-control" name="cost" type="text" value="{{old('cost') ?old('cost') : 0}}">
                                    <small class="error">{{$errors->first('cost')}}</small>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="form-control" name="price" type="text" value="{{old('price') ?old('price') : 0}}">
                                    <small class="error">{{$errors->first('price')}}</small>

                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment</label>
                                    <select class="select" name="payment" value="{{old('payment')}}">
                                        <option value="">Select</option>
                                        @foreach($payments as $payment)
                                            <option value="{{$payment->id}}">{{$payment->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="display-block">Appointment Status</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status"
                                               id="product_active" value="1"
                                               checked>
                                        <label class="form-check-label" for="product_active">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status"
                                               id="product_inactive"
                                               value="0">
                                        <label class="form-check-label" for="product_inactive">
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea cols="30" rows="4" name="description" class="form-control"
                                      value="{{old('description')}}"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea cols="30" rows="4" name="note" class="form-control"
                                      value="{{old('note')}}"></textarea>
                        </div>

                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Create Appointment</button>
                        </div>
                    </form>
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
                            <label for="patient">Patient:</label>
                            <select class="select" class="form-control" name="patient" id="patient">
                                <option value="">Select</option>
                                @foreach($patients as $patient)
                                    <option
                                        value="{{$patient->id}}">{{$patient->fname}} {{$patient->lname}}</option>
                                @endforeach
                            </select>

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
                            <button id="store_status" type="submit"  class="btn btn-primary">Add
                            </button>
                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        </div>
                    </form>

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

            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'

                });
            });


            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $('#patient_select').on('change', function () {

                let patient_id = $('#patient_select').val();


                if (patient_id) {
                    $.ajax({
                        type: 'GET',
                        url: "/get-patient/" + patient_id,
                        success: function (response) {
                            if (response.status === 1) {
                                $('#userName').val(response.data.userName);
                                $('#Pstatus').empty();
                                $('#Pstatus').append('<option value="" >Select</option>');
                                $.each(response.patient_status, function (k, v) {

                                    $('#Pstatus').append('<option value="' + v.id + '" >' + v.title + '</option>');
                                    console.log(v.title);
                                });
                            } else {
                                alert("couldn't find Patient data");

                            }


                        },
                        error: function (jqXHR) {
                            console.log(jQuery.parseJSON(jqXHR.responseText).message);
                            alert(jQuery.parseJSON(jqXHR.responseText).message);

                        }
                    });
                } else {
                    $('#userName').val("");
                    $('#Pstatus').empty();
                    $('#Pstatus').append('<option value="" >Select</option>');
                }


            });


            $('#add_status').on('show.bs.modal', function (e) {
                $(this).find('form').trigger('reset');

            });

            $("#store_status").on('click', function (e) {

                e.preventDefault();
                let noteSelector = $('#add_status').find('textarea[name="note"]');
                let session_numberSelector = $('#add_status').find('input[name="session_num"]');
                let add_statusSelector = $('#add_status').find('input[name="is_active"]:checked');
                let descriptionSelector = $('#add_status').find('textarea[name="description"]');
                let titleSelector = $('#add_status').find('input[name="title"]');

                let patient_id = $('#add_status').find('select[name="patient"]');


                $.ajax({
                    type: 'POST',
                    url: "/add-status",
                    data: {
                        patient_id: patient_id.val(),
                        title: titleSelector.val(),
                        description: descriptionSelector.val(),
                        note: noteSelector.val(),
                        session_num: session_numberSelector.val(),
                        is_active: add_statusSelector.length > 0,
                    },
                    success: function (response) {
                        if (response.status === 1) {
                            $('#add_status').modal('hide');
                            console.log("addedd fine");
                            let status = response.last_added;
                            $('#Pstatus').append('<option value="' + status.id + '" >' + status.title + '</option>');



                        } else {
                            console.log("addedd faild");
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
