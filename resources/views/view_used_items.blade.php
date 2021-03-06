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
                    <h4 class="page-title">Details For Used Item: {{$item->name}} ({{$item->id}})</h4>
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
                                <th>In Session</th>
                                <th>For Status</th>
                                <th>For Patient</th>
                                <th>Used Quantity</th>
                                <th>Session Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($item->patient_sessions as $usedItem)
                                <tr>
                                    <td>
                                        <strong>{{$usedItem->title}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{$usedItem->status->title}}</strong>
                                    </td>
                                    <td><a target="_blank" href="/view-patient/{{$usedItem->status->patient->id}}">{{$usedItem->status->patient->fname}} {{$usedItem->status->patient->lname}}</a></td>
                                    <td>{{$usedItem->pivot->quantity}}</td>
                                    <td>{{$usedItem->pivot->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
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

            let table = $('.datatable').DataTable();




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



            // /** filter in table **/
            //
            // $('#filter_select').on('change', function () {
            //
            //     let val = '\\b' + this.value + '\\b';
            //     table.columns(7).search(val , true, false ).draw();
            //
            // });




            // $('#delete_asset').on('show.bs.modal', function (e) {
            //
            //     let asset_id = $(e.relatedTarget).data('id');
            //
            //     $('#delete_btn').data('id', asset_id);
            //
            //
            //
            // });
            //
            //
            // $.ajaxSetup({
            //
            //     headers: {
            //
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //
            //     }
            //
            // });
            //
            // $("#delete_btn").on('click', function (e) {
            //
            //     e.preventDefault();
            //
            //     let asset_id = $("#delete_btn").data('id');
            //
            //     $.ajax({
            //         type: 'delete',
            //         url: "/delete-asset/" + asset_id,
            //
            //
            //         success: function (response) {
            //             if (response.status === 1) {
            //                 console.log(response.status + " | " + response.message);
            //                 $('#delete_asset').modal('hide');
            //                 $('#row-'+asset_id).hide();
            //             } else {
            //                 alert("something went wrong");
            //             }
            //
            //
            //         },
            //         error: function (jqXHR) {
            //             console.log(jQuery.parseJSON(jqXHR.responseText).message);
            //             alert(jQuery.parseJSON(jqXHR.responseText).message);
            //
            //         }
            //     });
            // });


        });


    </script>

@endpush




