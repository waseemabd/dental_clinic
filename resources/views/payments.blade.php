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
                <div class="col-sm-12">
                    <h4 class="page-title">Payments</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable mb-0">
                            <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Patient</th>
                                <th>Payment Type</th>
                                <th>Paid Date</th>
                                <th>Paid Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="invoice-view.html">#INV-0001</a></td>
                                <td>
                                    <h2><a href="#">Charles Ortega</a></h2>
                                </td>
                                <td>Paypal</td>
                                <td>8 Aug 2017</td>
                                <td>$500</td>
                            </tr>
                            <tr>
                                <td><a href="invoice-view.html">#INV-0002</a></td>
                                <td>
                                    <h2><a href="#">Denise Stevens</a></h2>
                                </td>
                                <td>Paypal</td>
                                <td>8 Aug 2017</td>
                                <td>$500</td>
                            </tr>
                            <tr>
                                <td><a href="invoice-view.html">#INV-0003</a></td>
                                <td>
                                    <h2><a href="#">Dennis Salazar</a></h2>
                                </td>
                                <td>Paypal</td>
                                <td>8 Aug 2017</td>
                                <td>$500</td>
                            </tr>
                            </tbody>
                        </table>
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

@endpush
