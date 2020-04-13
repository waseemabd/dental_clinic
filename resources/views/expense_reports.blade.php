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
                    <h4 class="page-title">Used Items</h4>
                </div>
                <div class="col-sm-4 col-6 text-right m-b-30">
                    <a href="/add-asset" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add
                        Asset</a>
                </div>
            </div>
            <div class="row filter-row">
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
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                            <tr>
                                <th>Item Id</th>
                                <th>Item Name</th>
                                <th>Used</th>
                                <th>Price (SP) </th>
                                <th>Purchase Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $asset)
                                <tr id="row-{{$asset->id}}">
                                    <td>{{$asset->id}}</td>
                                    <td>{{$asset->name}}</td>


                                    <td>
                                        @foreach($used_Array as $used)
                                            @if($used['id'] == $asset->id)
                                                {{ $used['amount'] }}
                                            @endif
                                        @endforeach

                                    </td>
                                    <td>
                                        @foreach($used_Array as $used)
                                            @if($used['id'] == $asset->id)
                                                {{ $asset->price * $used['amount']  }}
                                            @endif
                                        @endforeach</td>
                                    <td>{{$asset->movement_date}}</td>

                                    <td class="text-right">
                                        <a class="dropdown-item" href="/view-used-item/{{$asset->id}}"><i
                                                class="fa fa-eye m-r-5"></i> View</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="5" style="text-align:right">Total:</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="delete_asset" class="modal fade delete-modal" role="dialog">
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
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/bootstrap-toggle.min.js"></script>
    <script>

        $(document).ready(function () {

            let table = $('.datatable').dataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( 3 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 3, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    // Update footer
                    $( api.column( 5 ).footer() ).html(
                        pageTotal +'SP ('+ total +'SP total)'
                    );
                }
            });




            /** start time range filter **/
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = $('#min-date').val();
                    var max = $('#max-date').val();
                    var createdAt = data[4] || 0; // Our date column in the table

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



        });


    </script>

@endpush




