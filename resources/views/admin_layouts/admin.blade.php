<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 3/19/18
 * Time: 16:42
 */
?>
        <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="/storage/favicon.png">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <!-- top bar navigation -->
    <div class="headerbar">

        <!-- LOGO -->
        <div class="headerbar-left">
            <a href="#" class="logo"><img alt="logo" src="{{url('/storage/logo_227x76.png')}}"/></a>
        </div>

        <nav class="navbar-custom">

            <ul class="list-inline float-right mb-0">

                <li class="list-inline-item dropdown notif">
                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="fa fa-fw fa-question-circle"></i>
                    </a>
                    <div class="dropdown-menu rounded-0 p-0 m-0 dropdown-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5>
                                <small>Help and Support</small>
                            </h5>
                        </div>

                        <!-- item-->
                        <a target="_blank" href="https://www.facebook.com" class="dropdown-item notify-item">
                            <p class="notify-details ml-0">
                                <b>Do you want custom development to integrate this theme?</b>
                                <span>Contact Us</span>
                            </p>
                        </a>

                        <!-- item-->
                        <a target="_blank" href="https://www.youtube.com"
                           class="dropdown-item notify-item">
                            <p class="notify-details ml-0">
                                <b>Do you want PHP version of the theme that save dozens of hours of work?</b>
                                <span>Try Pike Admin PRO</span>
                            </p>
                        </a>

                        <!-- All-->
                        <a title="Clcik to visit Pike Admin Website" target="_blank" href="https://www.facebook.com"
                           class="dropdown-item notify-item notify-all">
                            <i class="fa fa-link"></i> Visit Pike Admin Website
                        </a>

                    </div>
                </li>

                <li class="list-inline-item dropdown notif">
                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="fa fa-fw fa-envelope-o"></i><span class="notif-bullet"></span>
                    </a>
                    <div class="dropdown-menu rounded-0 p-0 m-0 dropdown-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5>
                                <small>Help and Support</small>
                            </h5>
                        </div>

                        <!-- item-->
                        <a target="_blank" href="https://www.facebook.com" class="dropdown-item notify-item">
                            <p class="notify-details ml-0">
                                <b>Do you want custom development to integrate this theme?</b>
                                <span>Contact Us</span>
                            </p>
                        </a>

                        <!-- item-->
                        <a target="_blank" href="https://www.youtube.com"
                           class="dropdown-item notify-item">
                            <p class="notify-details ml-0">
                                <b>Do you want PHP version of the theme that save dozens of hours of work?</b>
                                <span>Try Pike Admin PRO</span>
                            </p>
                        </a>

                        <!-- All-->
                        <a title="Clcik to visit Pike Admin Website" target="_blank" href="https://www.facebook.com"
                           class="dropdown-item notify-item notify-all">
                            <i class="fa fa-link"></i> Visit Pike Admin Website
                        </a>

                    </div>
                </li>

                <li class="list-inline-item dropdown notif">
                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="fa fa-fw fa-bell-o"></i><span class="notif-bullet"></span>
                    </a>
                    <div class="dropdown-menu rounded-0 p-0 m-0 dropdown-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5>
                                <small>Help and Support</small>
                            </h5>
                        </div>

                        <!-- item-->
                        <a target="_blank" href="https://www.facebook.com" class="dropdown-item notify-item">
                            <p class="notify-details ml-0">
                                <b>Do you want custom development to integrate this theme?</b>
                                <span>Contact Us</span>
                            </p>
                        </a>

                        <!-- item-->
                        <a target="_blank" href="https://www.youtube.com"
                           class="dropdown-item notify-item">
                            <p class="notify-details ml-0">
                                <b>Do you want PHP version of the theme that save dozens of hours of work?</b>
                                <span>Try Pike Admin PRO</span>
                            </p>
                        </a>

                        <!-- All-->
                        <a title="Clcik to visit Pike Admin Website" target="_blank" href="https://www.facebook.com"
                           class="dropdown-item notify-item notify-all">
                            <i class="fa fa-link"></i> Visit Pike Admin Website
                        </a>

                    </div>
                </li>

                <li class="list-inline-item dropdown notif">
                    <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        @if(Auth::check() && Auth::user()->feature_image)
                            <img src="{{url('/storage/')+Auth::user()->feature_image}}" alt="Profile image"
                                 class="avatar-rounded">
                        @else
                            <img src="{{url('/storage/default_avatar.png')}}" alt="Profile image"
                                 class="avatar-rounded">
                        @endif
                    </a>
                    <div class="dropdown-menu p-0 rounded-0 m-0">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="text-overflow">
                                <small>Hello, admin</small>
                            </h5>
                        </div>

                        <!-- item-->
                        <a href="#" class="dropdown-item notify-item">
                            <i class="fa fa-user"></i> <span>Profile</span>
                        </a>

                        <!-- item-->
                        <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> <span>{{ __('Logout') }}</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>

                    </div>
                </li>

            </ul>

        </nav>

    </div>
    <!-- End Navigation -->


    <!-- Left Sidebar -->
    <div class="left main-sidebar">

        <div class="sidebar-inner">

            <div id="sidebar-menu">

                <ul>

                    <li class="submenu">
                        <a href=""><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
                    </li>

                    <li class="submenu">
                        <a href="charts.html"><i class="fa fa-fw fa-area-chart"></i><span> Charts </span> </a>
                    </li>

                    <li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-table"></i> <span> Bài viết </span> <span
                                    class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{route('admin.blog.index')}}">Tất cả bài</a></li>
                            <li><a href="{{route('admin.blog.create')}}">Thêm mới</a></li>
                            <li><a href="{{route('admin.taxonomy.categories')}}">Categories</a></li>
                            <li><a href="{{route('admin.taxonomy.tags')}}">Tags</a></li>
                        </ul>
                    </li>

                    <li class="submenu">
                        <a href="{{route('admin.media.index')}}"><i class="fa fa-fw fa-image"></i> <span> Media </span> <span
                                    class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{route('admin.media.index')}}">Thư viện</a></li>
                        </ul>
                    </li>

                    <li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-file-text-o"></i> <span> Users </span> <span
                                    class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="">All Users</a></li>
                            <li><a href="">Add New</a></li>
                            <li><a href="">Your Profile</a></li>
                        </ul>
                    </li>

                    {{--if have submenu within submenu or notification a side right, use it--}}

                    {{--<li class="submenu">--}}
                        {{--<a href="#" class="active"><span class="label radius-circle bg-danger float-right">20</span><i--}}
                                    {{--class="fa fa-fw fa-copy"></i><span> Example Pages </span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="page-pricing-tables.html">Pricing Tables</a></li>--}}
                            {{--<li><a target="_blank" href="page-coming-soon.html">Countdown</a></li>--}}
                            {{--<li><a href="page-invoice.html">Invoice</a></li>--}}
                            {{--<li><a href="page-login.html">Login / Register</a></li>--}}
                            {{--<li class="active"><a href="page-blank.html">Blank Page</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}

                    {{--<li class="submenu">--}}
                        {{--<a href="#"><span class="label radius-circle bg-primary float-right">9</span><i--}}
                                    {{--class="fa fa-fw fa-indent"></i><span> Menu Levels </span></a>--}}
                        {{--<ul>--}}
                            {{--<li>--}}
                                {{--<a href="#"><span>Second Level</span></a>--}}
                            {{--</li>--}}
                            {{--<li class="submenu">--}}
                                {{--<a href="#"><span>Third Level</span> <span class="menu-arrow"></span> </a>--}}
                                {{--<ul style="">--}}
                                    {{--<li><a href="#"><span>Third Level Item</span></a></li>--}}
                                    {{--<li><a href="#"><span>Third Level Item</span></a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}

                </ul>

                <div class="clearfix"></div>

            </div>

            <div class="clearfix"></div>

        </div>

    </div>
    <!-- End Sidebar -->


    <div class="content-page">

        <!-- Start content -->
        <div class="content">
            @yield('content')
        </div>
        <!-- END content -->

    </div>
    <!-- END content-page -->

    <footer class="footer">
		<span class="text-right">
		 Iwtrays:<a target="_blank" href="#">DP</a>
		</span>
        <span class="float-right">
		Youme <a target="_blank" href="javascript:void(0)"><b>Lifetime</b></a>
		</span>
    </footer>


</div>

</body>
</html>

