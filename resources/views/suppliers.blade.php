@extends('layouts.layout')

@push('custom_css')

    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-toggle.min.css">

@endpush



@section('content')


    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-8 col-6">
                    <h4 class="page-title">Suppliers</h4>
                </div>
                <div class="col-sm-4 col-6 text-right m-b-30">
                    <a href="/add-supplier" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add
                        supplier</a>
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
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                            <tr>
                                <th>supplier Id</th>
                                <th>supplier Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th class="text-center">Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($suppliers as $supplier)
                                <tr id="row-{{$supplier->id}}">
                                    <td>{{$supplier->id}}</td>
                                    <td>{{$supplier->name}}</td>

                                    <td>{{$supplier->company}}</td>
                                    <td>{{$supplier->email}}</td>
                                    <td>{{$supplier->phone}}</td>
                                    <td>
                                        <span class="custom-badge status-{{$supplier->is_active==1? 'green' : 'red'}}">
                                            {{$supplier->is_active==1? 'Active' : 'Inactive'}}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="/edit-supplier/{{$supplier->id}}"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete_supplier" data-id="{{$supplier->id}}"><i class="fa fa-trash-o m-r-5"></i>
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
    <div id="delete_supplier" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="/images/sent.png" alt="" width="50" height="46">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <h3>Are you sure want to delete this Supplier?</h3>
                    <div class="m-t-20"><a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-danger" id="delete_btn" >Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom_scripts')
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/bootstrap-toggle.min.js"></script>
    <script>

        $(document).ready(function () {

            let table = $('.datatable').DataTable();


            /** filter in table **/

            $('#filter_select').on('change', function () {

                let val = '\\b' + this.value + '\\b';
                table.columns(5).search(val , true, false ).draw();

            });



            $('#delete_supplier').on('show.bs.modal', function (e) {

                let supplier_id = $(e.relatedTarget).data('id');

                $('#delete_btn').data('id', supplier_id);



            });


            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $("#delete_btn").on('click', function (e) {

                e.preventDefault();

                let supplier_id = $("#delete_btn").data('id');
                console.log();

                $.ajax({
                    type: 'delete',
                    url: "/delete-supplier/" + supplier_id,


                    success: function (response) {
                        if (response.status === 1) {
                            console.log(response.status + " | " + response.message);
                            $('#delete_supplier').modal('hide');
                            $('#row-'+supplier_id).hide();
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




