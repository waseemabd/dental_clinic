@extends('layouts.layout')

@push('custom_css')
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="/css/print.min.css">
@endpush



@section('content')


    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-5 col-4">
                    <h4 class="page-title">Invoice</h4>
                </div>
                <div class="col-sm-7 col-8 text-right m-b-30">
                    <div class="btn-group btn-group-sm">
{{--                        <button class="btn btn-white"><a href="/reports/invoice/{{$session->id}}/download">PDF</a></button>--}}
                        <button type="button" class="btn btn-white" id="print"><i class="fa fa-print fa-lg"></i> Print</button>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" >
                            <div class="row custom-invoice">
                                <div class="col-6 col-sm-6 m-b-20">
                                    <img src="/images/logo-dark.png" class="inv-logo" alt="">
                                    <ul class="list-unstyled">
                                        <li>{{isset($clinic->title) ? $clinic->title : ""}}</li>
                                        <li>{{isset($clinic->address) ? $clinic->address: ""}}</li>
                                        <li>{{isset($clinic->phone) ? $clinic->phone:""}}</li>
                                    </ul>
                                </div>
                                <div class="col-6 col-sm-6 m-b-20">
                                    <div class="invoice-details">
                                        <h3 class="text-uppercase">Invoice For Session {{$session->id}}</h3>
                                        <ul class="list-unstyled">
                                            <li>Session Date: <span>{{date('Y-m-d',strtotime($session->date))}}</span></li>
                                            <li>Due date: <span>{{date('Y-m-d')}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 m-b-20">

                                    <h5>Invoice to:</h5>
                                    <ul class="list-unstyled">
                                        <li>
                                            <h5><strong>{{$patient->fname .' '. $patient->lname}}</strong></h5>
                                        </li>
                                        <li>{{$patient->address}}</li>
                                        <li>{{$patient->phone}}</li>
                                        <li><a href="#">{{$patient->email}}</a></li>
                                    </ul>

                                </div>
                                <div class="col-sm-6 col-lg-6 m-b-20">
                                    <div class="invoices-view">
                                        <span class="text-muted">Payment Details:</span>
                                        <ul class="list-unstyled invoice-payment-details">
                                            <li>
                                                <h5>Total Due: <span class="text-right">{{$session->price}} SP</span></h5>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="printedRow">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ITEM</th>
                                        <th>DESCRIPTION</th>
                                        <th>TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$session->id}}</td>
                                        <td>{{$session->title}}</td>
                                        <td>{{$session->description}}</td>
                                        <td>{{$session->price}} SP</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <div class="row invoice-payment">
                                    <div class="col-sm-7">
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="m-b-20">
                                            <h6>Total due</h6>
                                            <div class="table-responsive no-border">
                                                <table class="table mb-0">
                                                    <tbody>

                                                    <tr>
                                                        <th>Total:</th>
                                                        <td class="text-right text-primary">
                                                            <h5>{{$session->price}} SP</h5>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($session->note))
                                <div class="invoice-info">
                                    <h5>Other information</h5>
                                    <p class="text-muted">{{$session->note}}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('custom_scripts')


    <script src="/js/select2.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script
    <script src="/js/print.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#print").on('click', function () {
                // window.printJS('printedRow','html');
                window.print();
                // console.log('hsfjak');
            });
        });
    </script>
@endpush




