<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="/storage/favicon.png"/>
@yield('head')

    <!-- Styles -->
    <link href="{{ asset('css/user-css/user.css') }}" rel="stylesheet">
</head>
<body>

<div id="fb-root"></div>
<script>(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0]
    if (d.getElementById(id)) return
    js = d.createElement(s)
    js.id = id
    js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12'
    fjs.parentNode.insertBefore(js, fjs)
  }(document, 'script', 'facebook-jssdk'))</script>

<section>
    <nav id="header-menu" class="mobile-menu-toggle">
        <div class="container wrap-header-menu">
            <ul class="list-unstyled mb-0 clearfix xd-menu">
                <li class="float-md-left xd-menu-li">
                    <a class="d-block" href="{{env('APP_URL')}}">Trang Chủ</a>
                </li>
                <li class="float-md-left xd-menu-li">
                    <a class="d-block" href="">Danh Mục
                        <span class="arrow"></span>
                    </a>
                    <ul class="list-unstyled mb-0 xd-submenu">
                        <li>
                            <a class="d-block" href="">hi hi</a>
                        </li>
                        <li>
                            <a class="d-block" href="">hi</a>
                        </li>
                        <li>
                            <a class="d-block" href="">hi</a>
                        </li>
                        <li>
                            <a class="d-block" href="">hi</a>
                        </li>
                        <li>
                            <a class="d-block" href="">hi</a>
                        </li>
                    </ul>
                </li>
                <li class="float-md-left xd-menu-li">
                    <a class="d-block" href="">Giới Thiệu</a>
                </li>
                <li class="float-md-left xd-menu-li">
                    <a class="d-block" href="">Liên Hệ</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="btn-toggle-menu" class="d-none cursor-pointer">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div id="header-content">
        <div class="container clearfix inner-header-content">
            <div id="main-logo">
                <a href="{{env('APP_URL')}}" class="d-block">
                    <img src="/storage/logo_270x90.png" alt="">
                </a>
            </div>
        </div>
    </div>
</section>
<section style="background-color: rgb(227, 227, 227)">
    <div id="content">
        <div class="container">
            <ul class="list-unstyled mb-0 list-icon-utility clearfix">
                <li>
                    <a href="{{env('APP_URL')}}">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fa fa-music" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fa fa-book" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
            <div class="row">
                {{--start content--}}
                <div class="col-lg-8 col-12 pr-lg-0">
                    <div class="content-inner-content col-12">
                        <div class="search-form row">
                            <label for="input-search"
                                   class="col-lg-3 col-md-4 col-sm-5 d-none d-sm-inline-block text-uppercase h6 mb-0"
                                   style="color: #aaa;">what's
                                new?</label>
                            <input type="text" id="input-search" class="col-lg-9 col-md-8 col-sm-7 col-12"
                                   placeholder="Search">
                        </div>
                        @yield('content')
                    </div>
                </div>
                {{--end content--}}
                {{--start sidebar--}}
                <div class="col-lg-4 col-12 pl-lg-0">

                    <aside class="sidebar-inner-content">
                        <div class="sidebar-head">
                            <ul class="list-unstyled mb-0 clearfix list-icon-social-network">
                                <li class="float-right">
                                    <a href="">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li class="float-right">
                                    <a href="">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="float-right">
                                    <a href="">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="float-left">
                                    <span class="text-uppercase">follow</span>
                                </li>
                                <li class="float-right">
                                    <a href="">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="sidebar-body">
                            <div class="row">
                                <div class="col-lg-12 col-12 col-md-6 pb-4 ">
                                    <div class="border-bottom pb-4">
                                        <p class="sidebar-child-title text-capitalize h5 text-secondary mb-4">
                                            Popular Posts
                                        </p>
                                        {{--item sidebar--}}
                                        <div class="sidebar-item mb-2 clearfix">
                                            <div class="item-thumb float-left mr-2 mb-2">
                                                <a href="" class="d-block">
                                                    <img src="http://4.bp.blogspot.com/-MjxwCavHi5s/VOojws5mB5I/AAAAAAAAECs/03HutqLw-bM/s72-c/stacks.jpg"
                                                         alt="">
                                                </a>
                                            </div>
                                            <div class="item-title">
                                                <a href="" class="text-gray">One Page Free HTML CSS Website Template</a>
                                            </div>
                                        </div>
                                        <div class="sidebar-item mb-2 clearfix">
                                            <div class="item-thumb float-left mr-2 mb-2">
                                                <a href="" class="d-block">
                                                    <img src="http://4.bp.blogspot.com/-MjxwCavHi5s/VOojws5mB5I/AAAAAAAAECs/03HutqLw-bM/s72-c/stacks.jpg"
                                                         alt="">
                                                </a>
                                            </div>
                                            <div class="item-title">
                                                <a href="" class="text-gray">One Page Free HTML CSS Website Template</a>
                                            </div>
                                        </div>
                                        <div class="sidebar-item mb-2 clearfix">
                                            <div class="item-thumb float-left mr-2 mb-2">
                                                <a href="" class="d-block">
                                                    <img src="http://4.bp.blogspot.com/-MjxwCavHi5s/VOojws5mB5I/AAAAAAAAECs/03HutqLw-bM/s72-c/stacks.jpg"
                                                         alt="">
                                                </a>
                                            </div>
                                            <div class="item-title">
                                                <a href="" class="text-gray">One Page Free HTML CSS Website Template</a>
                                            </div>
                                        </div>
                                        {{--end item sidebar--}}
                                    </div>
                                </div>
                                {{----}}
                                <div class="col-lg-12 col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12 pb-4">
                                            <div class="border-bottom pb-4">
                                                <p class="sidebar-child-title text-capitalize h5 text-secondary mb-4">
                                                    Facebook
                                                </p>
                                                <div class="fb-page"
                                                     data-width="500"
                                                     data-href="https://www.facebook.com/hatgiongtamhon.2509/"
                                                     data-tabs="" data-small-header="false"
                                                     data-adapt-container-width="true" data-hide-cover="false"
                                                     data-show-facepile="true">
                                                    <blockquote cite="https://www.facebook.com/hatgiongtamhon.2509/"
                                                                class="fb-xfbml-parse-ignore"><a
                                                                href="https://www.facebook.com/hatgiongtamhon.2509/">Hạt
                                                            giống tâm hồn</a></blockquote>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 pb-4 ">
                                            <div class="border-bottom pb-4">
                                                <p class="sidebar-child-title text-capitalize h5 text-secondary mb-4">
                                                    Labels
                                                </p>
                                                <div>
                                                    <a href="" class="badge badge-success">Success</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>

                </div>
                {{--end sidebar--}}
            </div>
        </div>
    </div>
</section>

<section>
    <div id="footer" style="background-color: rgba(0,0,0,.9);">
        <div class="container">
            <p class="text-center mb-0 text-white" style="height: 50px; line-height: 50px; font-size: 13px;">COPYRIGHT
                &copy;
                2018 by XD</p>
        </div>
    </div>
</section>
</body>
<!-- Scripts -->
<script src="{{ asset('js/user-js/user.js') }}" ></script>
@yield('js')
</html>

