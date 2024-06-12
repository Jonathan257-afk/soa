@extends("layouts/app")

@section("head")
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <style data-styled="active" data-styled-version="5.3.5"></style>
    <link rel="stylesheet" media="screen" href="{{ asset('assets/css/asso.css') }}">
    @yield("header")

@endsection

@section("body")
    <div id="root">
        <div class="d-flex flex-column flex-root">
            <div class="d-flex flex-row flex-column-fluid">
                <div class="pro-sidebar hide-menu aside-menu-container" id="container-slidbar">
                    <div class="pro-sidebar-inner">
                        <div class="pro-sidebar-layout pro-active-sub">
                            <div class="pro-sidebar-header aside-menu-container__aside-logo flex-column-auto pb-2 pt-3"><a href="{{ route('user-dashboard') }}"
                                    class="text-decoration-none sidebar-logo text-gray-900 fs-4">
                                    <div class="image image-mini me-3"><img src="{{asset(config('path.logo.green'))}}"
                                            class="img-fluid object-fit-contain" alt="logo"></div>
                                </a><button type="button"  id="btn-collapse-slidbar-desktop"
                                    class="btn p-0 fs-1 aside-menu-container__aside-menubar d-lg-block d-none sidebar-btn border-0"><svg
                                        aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars"
                                        class="svg-inline--fa fa-bars text-gray-600" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="currentColor"
                                            d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z">
                                        </path>
                                    </svg></button>
                                    <button id="btn-close-collapse-slidbar-mobile" type="button"
                                        class="btn p-0 fs-1 aside-menu-container__aside-menubar d-lg-block d-none sidebar-btn border-0">
                                            <i class="fas fa-times"></i>
                                    </button>
                            </div>
                            <div class="pro-sidebar-content sidebar-scrolling openMenu">
                                @include("layouts/user/slider")
                            </div>
                        </div>
                    </div>

                    <div class="overlay" role="button" tabindex="0" aria-label="overlay"></div>
                </div>
                <div id="container-class-false" class="false"></div>
                <div id="container-main" class="wrapper d-flex flex-column flex-row-fluid">
                    <div class="d-flex align-items-stretch justify-content-between header">
                        <div class="container-fluid d-flex align-items-stretch justify-content-xxl-between flex-grow-1"><button
                                type="button" id="btn-collapse-slidbar-mobile" class="btn d-flex align-items-center d-xl-none px-0" title="Show aside menu"><svg
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars"
                                    class="svg-inline--fa fa-bars fs-1" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512">
                                    <path fill="currentColor"
                                        d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z">
                                    </path>
                                </svg></button>
                            <nav
                                class="navbar navbar-expand-xl top-nav-heding navbar-light d-xl-flex align-items-stretch d-block px-3 px-xl-0 py-4 py-xl-0">
                                <div class="navbar-collapse">
                                    <div class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <div class="d-flex align-items-center">
                                            <div class="nav-item  position-relative mx-xl-3 mb-3 mb-xl-0 mx-1"><a
                                                    class="nav-link p-0  active"><span>{{ getCurrentRoute() }}</span></a></div>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                            <nav class="align-items-stretch ms-auto py-1 navbar navbar-expand-lg navbar-light">
                                <div class="d-flex align-items-stretch justify-content-center">
                                    <div class="align-items-stretch justify-content-between flex-row navbar-nav">
                                        <ul class="nav align-items-center">
                                            <li><a class="px-sm-3 px-2 d-flex text-decoration-none">{{ auth()->user()->name . " ". auth()->user()->first_name }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>

                    <div class="content d-flex flex-column flex-column-fluid pt-7">
                        <div class="d-flex flex-column-fluid">
                            <div class="container-fluid">
                                @yield("main")
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <footer class="border-top w-100 pt-4 mt-7 d-flex justify-content-between">
                            <p class="fs-6 text-gray-600">All Rights Reserved (C) 2024<a href="#" class="text-decoration-none">
                                    </a></p>
                            <div class="fs-6 text-gray-600">v3.0.0</div>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

@endsection
    

@section("script")
    @yield("footer")
@endsection