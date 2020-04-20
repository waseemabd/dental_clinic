<!DOCTYPE html>
<html lang="en">


<!-- index22:59-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
    <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
    @stack('custom_css')
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.min.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">
    <div class="header">
        <div class="header-left">
            <a href="/" class="logo">
                <img src="/images/logo.png" width="35" height="35" alt=""> <span>Preclinic</span>
            </a>
        </div>
        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
        <ul class="nav user-menu float-right">
            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="/images/user.jpg" width="24" alt="Admin">
							<span class="status online"></span>
						</span>
                    <span>Admin</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/myProfile">My Profile</a>
                    <a class="dropdown-item" href="/edit-profile">Edit Profile</a>
                    <a class="dropdown-item" href="/changePassword">Change Password</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"

                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <div class="dropdown mobile-user-menu float-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="/myProfile">My Profile</a>
                <a class="dropdown-item" href="/edit-profile">Edit Profile</a>
                <a class="dropdown-item" href="/changePassword">Change Password</a>
                <a class="dropdown-item" href="{{ route('logout') }}"

                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">Main</li>
                    <li class="active">
                        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="/patients"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-calendar"></i> <span> Appointments </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="/appointments">Manage Appointments</a></li>
                            <li><a href="/delay-requests">Delay Requests</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-book"></i> <span> Assets </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="/assets"> All Assets </a></li>
                            <li><a href="/used_items"> Used items </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-commenting-o"></i> <span> Blog</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="/blogs">Blog</a></li>
                            <li><a href="/add-blog">Add Blog</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="/suppliers"><i class="fa fa-bell-o"></i> <span>Suppliers</span></a>
                    </li>
                    <li>
                        <a href="/assets"><i class="fa fa-cube"></i> <span>Assets</span></a>
                    </li>
                    <li>
                        <a href="/payment-types"><i class="fa fa-bell-o"></i> <span>Payment Types</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-flag-o"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="/reports/expense"> Expense Report </a></li>
                            <li><a href="/reports/invoice"> Invoice Report </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/about-us"><i class="fa fa-cog"></i> <span>About Us</span></a>
                    </li>

                </ul>
            </div>
        </div>
    </div>


        @yield('content')


</div>


<div class="sidebar-overlay" data-reff=""></div>
<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.slimscroll.js"></script>
@stack('custom_scripts')
<script src="/js/template.js"></script>

</body>


<!-- index22:59-->
</html>
