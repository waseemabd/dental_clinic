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
                    <h4 class="page-title">Invoice Reports</h4>
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
                                <th>Session Id</th>
                                <th>Session Title</th>
                                <th>Date</th>
                                <th>Price (SP) </th>
                                <th>Status </th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sessions as $session)
                                <tr id="row-{{$session->id}}">
                                    <td>{{$session->id}}</td>
                                    <td>{{$session->title}}</td>
                                    <td>{{$session->date}}</td>
                                    <td>{{$session->price}}</td>
                                    <td><span
                                            class="custom-badge status-green">
                                            Paid</span>
                                    </td>
                                    <td class="text-right">
                                        <a class="dropdown-item" href="/reports/invoice/{{$session->id}}"><i
                                                class="fa fa-eye m-r-5"></i> View</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="4" style="text-align:right">Total:</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
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
                    $( api.column( 4 ).footer() ).html(
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




