@extends('layouts.layout')



@section('content')
 <div class="page-wrapper">
    <div class="content">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="row">

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="dash-widget">
                    <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>{{$patient_count}}</h3>
                        <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="dash-widget">
                    <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>{{$pending_count}}</h3>
                        <span class="widget-title4">Pending <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-title">
                            <h4>Sessions Total</h4>
                        </div>
                        <canvas id="linegraph"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-title">
                            <h4>Patients In</h4>
                        </div>
                        <canvas id="bargraph"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-title">
                            <h4>Profit</h4>
                        </div>
                        <canvas id="bargraph2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">Upcoming Appointments</h4> <a href="/appointments" class="btn btn-primary float-right">View all</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="d-none">
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Timing</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($upcoming as $appointment)
                                <tr>
                                    <td style="min-width: 200px;">
                                        <a class="avatar" href="/view-patient/{{$appointment->status->patient->id}}">B</a>
                                        <h2><a href="/view-patient/{{$appointment->status->patient->id}}">{{$appointment->status->patient->fname .' '.$appointment->status->patient->lname }}<span>{{$appointment->status->patient->address }}</span></a></h2>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Title</h5>
                                        <p>{{$appointment->title}}</p>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Date</h5>
                                        <p>{{$appointment->date}}</p>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Timing</h5>
                                        <p>{{$appointment->time}}</p>
                                    </td>

                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

{{--            <div class="col-12 col-md-6 col-lg-4 col-xl-4">--}}
{{--                <div class="card member-panel">--}}
{{--                    <div class="card-header bg-white">--}}
{{--                        <h4 class="card-title mb-0">Doctors</h4>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <ul class="contact-list">--}}
{{--                            <li>--}}
{{--                                <div class="contact-cont">--}}
{{--                                    <div class="float-left user-img m-r-10">--}}
{{--                                        <a href="profile.html" title="John Doe"><img src="/images/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="contact-info">--}}
{{--                                        <span class="contact-name text-ellipsis">John Doe</span>--}}
{{--                                        <span class="contact-date">MBBS, MD</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="contact-cont">--}}
{{--                                    <div class="float-left user-img m-r-10">--}}
{{--                                        <a href="profile.html" title="Richard Miles"><img src="/images/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="contact-info">--}}
{{--                                        <span class="contact-name text-ellipsis">Richard Miles</span>--}}
{{--                                        <span class="contact-date">MD</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="contact-cont">--}}
{{--                                    <div class="float-left user-img m-r-10">--}}
{{--                                        <a href="profile.html" title="John Doe"><img src="images/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="contact-info">--}}
{{--                                        <span class="contact-name text-ellipsis">John Doe</span>--}}
{{--                                        <span class="contact-date">BMBS</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="contact-cont">--}}
{{--                                    <div class="float-left user-img m-r-10">--}}
{{--                                        <a href="profile.html" title="Richard Miles"><img src="images/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="contact-info">--}}
{{--                                        <span class="contact-name text-ellipsis">Richard Miles</span>--}}
{{--                                        <span class="contact-date">MS, MD</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="contact-cont">--}}
{{--                                    <div class="float-left user-img m-r-10">--}}
{{--                                        <a href="profile.html" title="John Doe"><img src="images/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="contact-info">--}}
{{--                                        <span class="contact-name text-ellipsis">John Doe</span>--}}
{{--                                        <span class="contact-date">MBBS</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="contact-cont">--}}
{{--                                    <div class="float-left user-img m-r-10">--}}
{{--                                        <a href="profile.html" title="Richard Miles"><img src="images/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="contact-info">--}}
{{--                                        <span class="contact-name text-ellipsis">Richard Miles</span>--}}
{{--                                        <span class="contact-date">MBBS, MD</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer text-center bg-white">--}}
{{--                        <a href="doctors.html" class="text-muted">View all Doctors</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">New Patients </h4> <a href="/patients" class="btn btn-primary float-right">View all</a>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table mb-0 new-patient-table">
                                <tbody>
                                @foreach($new_patients as $patient)
                                <tr>
                                    <td>

                                        <a  href="/view-patient/{{$patient->id}}"><img width="28" height="28" class="rounded-circle" src="images/user.jpg" alt=""></a>
                                        <h2><a  href="/view-patient/{{$patient->id}}">{{$patient->fname .' '. $patient->lname}}</a></h2>


                                    </td>
                                    <td>{{$patient->email}}</td>
                                    <td>{{$patient->phone}}</td>
                                    <td>{{$patient->gender =='M' ? 'Male': 'Female'}}</td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="col-12 col-md-6 col-lg-4 col-xl-4">--}}
{{--                <div class="hospital-barchart">--}}
{{--                    <h4 class="card-title d-inline-block">Hospital Management</h4>--}}
{{--                </div>--}}
{{--                <div class="bar-chart">--}}
{{--                    <div class="legend">--}}
{{--                        <div class="item">--}}
{{--                            <h4>Level1</h4>--}}
{{--                        </div>--}}

{{--                        <div class="item">--}}
{{--                            <h4>Level2</h4>--}}
{{--                        </div>--}}
{{--                        <div class="item text-right">--}}
{{--                            <h4>Level3</h4>--}}
{{--                        </div>--}}
{{--                        <div class="item text-right">--}}
{{--                            <h4>Level4</h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="chart clearfix">--}}
{{--                        <div class="item">--}}
{{--                            <div class="bar">--}}
{{--                                <span class="percent">16%</span>--}}
{{--                                <div class="item-progress" data-percent="16">--}}
{{--                                    <span class="title">OPD Patient</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="item">--}}
{{--                            <div class="bar">--}}
{{--                                <span class="percent">71%</span>--}}
{{--                                <div class="item-progress" data-percent="71">--}}
{{--                                    <span class="title">New Patient</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="item">--}}
{{--                            <div class="bar">--}}
{{--                                <span class="percent">82%</span>--}}
{{--                                <div class="item-progress" data-percent="82">--}}
{{--                                    <span class="title">Laboratory Test</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="item">--}}
{{--                            <div class="bar">--}}
{{--                                <span class="percent">67%</span>--}}
{{--                                <div class="item-progress" data-percent="67">--}}
{{--                                    <span class="title">Treatment</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="item">--}}
{{--                            <div class="bar">--}}
{{--                                <span class="percent">30%</span>--}}
{{--                                <div class="item-progress" data-percent="30">--}}
{{--                                    <span class="title">Discharge</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>

 </div>
@endsection


@push('custom_scripts')

    <script src="/js/Chart.bundle.js"></script>
{{--    <script src="/js/chart.js"></script>--}}
    <script>

        $(document).ready(function() {




            getPatientsNumber();
            getSessionsNumber();
            profit();

            function profit(){
                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });
                $.ajax({
                    type: 'POST',
                    url: "/profit",
                    success: function (response) {
                        if (response.status === 1) {

                            var profit = response['profit'];

                            var barChartData2 = {
                                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                datasets: [{
                                    label: "profit",
                                    backgroundColor: 'rgba(0, 158, 251, 0.5)',
                                    borderColor: 'rgba(0, 158, 251, 1)',
                                    borderWidth: 1,
                                    data: [profit[1], profit[2],profit[3],profit[4],profit[5],profit[6], profit[7], profit[8], profit[9], profit[10], profit[11], profit[12]]
                                }]
                            };

                            var ctx = document.getElementById('bargraph2').getContext('2d');
                            window.myBar = new Chart(ctx, {
                                type: 'bar',
                                data: barChartData2,
                                options: {
                                    responsive: true,
                                    legend: {
                                        display: false,
                                    }
                                }
                            });
                            console.log(profit[1], profit[2],profit[3],profit[4],profit[5],profit[6], profit[7], profit[8], profit[9], profit[10], profit[11], profit[12])

                        } else {
                            alert("something went wrong");
                        }


                    },
                    error: function (jqXHR) {

                        alert(jQuery.parseJSON(jqXHR.responseText).message);

                    }
                });
            }


            function getSessionsNumber() {
                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });
                $.ajax({
                    type: 'POST',
                    url: "/SessionsNumber",
                    success: function (response) {
                        if (response.status === 1) {

                            var sessions = response['sessionsNumber'];
                            var appointments = response['appointmentsNumber'];

                            var lineChartData = {
                                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                datasets: [{
                                    label: "Sessions",
                                    backgroundColor: "rgba(0, 158, 251, 0.5)",
                                    data: [sessions[1], sessions[2],sessions[3],sessions[4],sessions[5],sessions[6], sessions[7], sessions[8], sessions[9], sessions[10], sessions[11], sessions[12]]
                                }, {
                                    label: "Appointments",
                                    backgroundColor: "rgba(255, 188, 53, 0.5)",
                                    fill: true,
                                    data: [appointments[1], appointments[2],appointments[3],appointments[4],appointments[5],appointments[6], appointments[7], appointments[8], appointments[9], appointments[10], appointments[11], appointments[12]]

                                }]
                            };

                            var linectx = document.getElementById('linegraph').getContext('2d');
                            window.myLine = new Chart(linectx, {
                                type: 'line',
                                data: lineChartData,
                                options: {
                                    responsive: true,
                                    legend: {
                                        display: false,
                                    },
                                    tooltips: {
                                        mode: 'index',
                                        intersect: false,
                                    }
                                }
                            });
                            // console.log(previousYearArr[7])

                        } else {
                            alert("something went wrong");
                        }


                    },
                    error: function (jqXHR) {

                        alert(jQuery.parseJSON(jqXHR.responseText).message);

                    }
                });
            }

            function getPatientsNumber(i) {
                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });
                $.ajax({
                    type: 'POST',
                    url: "/patientsNumber",
                    success: function (response) {
                        if (response.status === 1) {

                            var thisYearArr = response['patientNumber'];
                            var thisYear = response['thisYear'];
                            var previousYearArr = response['previousNumber'];
                            var previousYear = response['previousYear'];

                            var barChartData = {
                                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                datasets: [{
                                    label: thisYear,
                                    backgroundColor: 'rgba(0, 158, 251, 0.5)',
                                    borderColor: 'rgba(0, 158, 251, 1)',
                                    borderWidth: 1,
                                    data: [thisYearArr[1], thisYearArr[2],thisYearArr[3],thisYearArr[4],thisYearArr[5],thisYearArr[6], thisYearArr[7], thisYearArr[8], thisYearArr[9], thisYearArr[10], thisYearArr[11], thisYearArr[12]]
                                }, {
                                    label: previousYear,
                                    backgroundColor: 'rgba(255, 188, 53, 0.5)',
                                    borderColor: 'rgba(255, 188, 53, 1)',
                                    borderWidth: 1,
                                    data: [previousYearArr[1], previousYearArr[2],previousYearArr[3],previousYearArr[4],previousYearArr[5],previousYearArr[6], previousYearArr[7], previousYearArr[8], previousYearArr[9], previousYearArr[10], previousYearArr[11], previousYearArr[12]]
                                }]
                            };

                            var ctx = document.getElementById('bargraph').getContext('2d');
                            window.myBar = new Chart(ctx, {
                                type: 'bar',
                                data: barChartData,
                                options: {
                                    responsive: true,
                                    legend: {
                                        display: false,
                                    }
                                }
                            });




                            // var lineChartData = {
                            //     labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                            //     datasets: [{
                            //         label: thisYear,
                            //         backgroundColor: "rgba(0, 158, 251, 0.5)",
                            //         data: [thisYearArr[1], thisYearArr[2],thisYearArr[3],thisYearArr[4],thisYearArr[5],thisYearArr[6], thisYearArr[7], thisYearArr[8], thisYearArr[9], thisYearArr[10], thisYearArr[11], thisYearArr[12]]
                            //     }, {
                            //         label: previousYear,
                            //         backgroundColor: "rgba(255, 188, 53, 0.5)",
                            //         fill: true,
                            //         data: [previousYearArr[1], previousYearArr[2],previousYearArr[3],previousYearArr[4],previousYearArr[5],previousYearArr[6], previousYearArr[7], previousYearArr[8], previousYearArr[9], previousYearArr[10], previousYearArr[11], previousYearArr[12]]
                            //
                            //     }]
                            // };
                            //
                            // var linectx = document.getElementById('linegraph').getContext('2d');
                            // window.myLine = new Chart(linectx, {
                            //     type: 'line',
                            //     data: lineChartData,
                            //     options: {
                            //         responsive: true,
                            //         legend: {
                            //             display: false,
                            //         },
                            //         tooltips: {
                            //             mode: 'index',
                            //             intersect: false,
                            //         }
                            //     }
                            // });
                            // console.log(previousYearArr[7])

                        } else {
                            alert("something went wrong");
                        }


                    },
                    error: function (jqXHR) {

                        alert(jQuery.parseJSON(jqXHR.responseText).message);

                    }
                });
            }

        });

    </script>
@endpush
