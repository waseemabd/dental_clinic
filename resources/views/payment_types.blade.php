@extends('layouts.layout')

@push('custom_css')
    <link rel="stylesheet" type="text/css" href="/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-toggle.min.css">

@endpush

@section('content')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-8 col-6">
                    <h4 class="page-title">Payment Types</h4>

                </div>
                <div class="col-sm-4 col-6 text-right m-b-30">
                    <a href="#" data-toggle="modal"
                       data-target="#add_type" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add
                        Payment Type</a>
                </div>

            </div>
            <div class="row filter-row">
                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-12">
                    <div class="form-group form-focus select-focus">
                        <label class="focus-label">Status Filter</label>
                        <select class="select floating" id="filter_select">
                            <option value="">--Select--</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable mb-0" id="types_tbl">
                            <thead>
                            <tr>
                                <th>Payment Type</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paymentTypes as $payment)
                                <tr id="row-{{$payment->id}}">

                                    <td>{{$payment->name}}</td>
                                    <td>
                                        <span class="custom-badge status-{{$payment->is_active==1? 'green' : 'red'}}">
                                            {{$payment->is_active==1? 'Active' : 'Inactive'}}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#edit_type" data-type="{{$payment}}"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete_type" data-id="{{$payment->id}}"><i
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

    <div id="add_type" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="/add-payment-type">
                        @csrf
                        <div>

                            <input type="hidden" class="form-control" id="type_id" name="type_id">
                            <label for="name">title:</label>
                            <input type="text" class="form-control" name="name">
                            <small class="error">{{$errors->first('name')}}</small>

                            <label for="is_active" style="display: block">Status: </label>
                            <input type="checkbox" class="form-control" id="is_active" name="is_active"
                                   data-toggle="toggle" data-onstyle="success"
                                   data-style="ios" data-offstyle="danger" data-on="Active" data-off="Inactive" checked>
                        </div>
                        <div class="m-t-20">
                            <button id="add_btn" type="submit"  class="btn btn-primary">Add
                            </button>
                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="edit_type" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" >
                        @csrf
                        <div>
                            <input type="hidden" class="form-control" id="type_id" name="type_id">
                            <label for="name">title:</label>
                            <input type="text" class="form-control" name="name">
                            <small class="error">{{$errors->first('name')}}</small>

                            <label for="is_active" style="display: block">Status: </label>
                            <input type="checkbox" class="form-control" id="is_active" name="is_active"
                                   data-toggle="toggle" data-onstyle="success"
                                   data-style="ios" data-offstyle="danger" data-on="Active" data-off="Inactive" checked>
                        </div>
                        <div class="m-t-20">
                            <button id="edit_btn" type="submit"  class="btn btn-primary">Edit
                            </button>
                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="delete_type" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="/images/sent.png" alt="" width="50" height="46">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <h3>Are you sure want to delete this Asset?</h3>
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
    <script src="/js/bootstrap-toggle.min.js"></script>
    <script>


        $(document).ready(function () {


            let table = $('.datatable').DataTable();


            /** filter in table **/

            $('#filter_select').on('change', function () {

                let val = '\\b' + this.value + '\\b';
                table.columns(1).search(val , true, false ).draw();

            });



            $('#edit_type').on('show.bs.modal', function (e) {

                let type = $(e.relatedTarget).data('type');

                $('#edit_type').find('input[name="name"]').val(type.name);
                $('#edit_btn').data('id',type.id);

                if (type.is_active == '1') {
                    $('#edit_type').find('input[name="is_active"]').bootstrapToggle('on')
                } else {
                    $('#edit_type').find('input[name="is_active"]').bootstrapToggle('off')
                }


            });

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $("#edit_btn").on('click', function (e) {

                e.preventDefault();
                let nameSelector = $('#edit_type').find('input[name="name"]');
                let edit_typeSelector = $('#edit_type').find('input[name="is_active"]:checked');
                let type_id = $("#edit_btn").data('id');
                $.ajax({
                    type: 'POST',
                    url: "/edit-payment-type/" + type_id,
                    data: {
                        name: nameSelector.val(),
                        is_active: edit_typeSelector.length > 0,
                    },

                    success: function (response) {
                        if (response.status === 1) {
                            $('#edit_type').modal('hide');
                            window.location.reload();

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


            $('#delete_type').on('show.bs.modal', function (e) {

                let type_id = $(e.relatedTarget).data('id');

                $('#delete_btn').data('id', type_id);



            });

            $("#delete_btn").on('click', function (e) {

                e.preventDefault();

                let type_id = $("#delete_btn").data('id');
                console.log();

                $.ajax({
                    type: 'delete',
                    url: "/delete-payment-type/" + type_id,


                    success: function (response) {
                        if (response.status === 1) {
                            console.log(response.status + " | " + response.message);
                            $('#delete_type').modal('hide');
                            $('#row-'+type_id).hide();
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
