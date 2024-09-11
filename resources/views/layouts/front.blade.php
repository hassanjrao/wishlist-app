<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('page-title') - {{ config('app.name') }}</title>


    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('media/bdaylogo.webp') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('media/bdaylogo.webp') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/bdaylogo.webp') }}">
    <!-- END Icons -->

    <link rel="stylesheet" href="{{  asset('js/plugins/slick-carousel/slick.css')}}">
    <link rel="stylesheet" href="{{  asset('js/plugins/slick-carousel/slick-theme.css')}}">


    <!-- Stylesheets -->
    <!-- Fonts and OneUI framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/oneui.css') }}">


    @yield('styles')

    @livewireStyles

</head>

<body>
    <!-- Page Container -->
    <!--
        Available classes for #page-container:

    GENERIC

        'remember-theme'                            Remembers active color theme between pages using localStorage (when set through color theme helper Template._uiHandleTheme())

    SIDEBAR & SIDE OVERLAY

        'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
        'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
        'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
        'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
        'sidebar-dark'                              Dark themed sidebar

        'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
        'side-overlay-o'                            Visible Side Overlay by default

        'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

        'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

    HEADER

        ''                                          Static Header if no class is added
        'page-header-fixed'                         Fixed Header

    HEADER STYLE

        ''                                          Light themed Header
        'page-header-dark'                          Dark themed Header

    MAIN CONTENT LAYOUT

        ''                                          Full width Main Content if no class is added
        'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
        'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)

    DARK MODE

        'sidebar-dark page-header-dark dark-mode'   Enable dark mode (light sidebar/header is not supported with dark mode)
    -->
    <div id="page-container" class="page-header-dark main-content-boxed">

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header" style="height: 5.5rem">
                <!-- Left Section -->
                <div class="d-flex align-items-center">
                    <!-- Logo -->
                    <a class="fw-semibold " href="/">
                        <img src="{{ asset('media/bdaylogo.webp') }}" alt="" style="width: 80px;">
                    </a>
                    <!-- END Logo -->


                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="d-flex align-items-center">
                    <!-- Open Search Section (visible on smaller screens) -->

                    <a href="{{ route('home') }}" class="btn btn-lg btn-alt-secondary" style="margin-right: 20px !important">
                        <i class="fa fa-fw fa-home"></i>
                        <span class="d-none d-sm-inline-block ms-1">Home</span>
                    </a>

                    <a href="{{ route('wishlists') }}" class="btn btn-lg btn-alt-secondary" style="margin-right: 20px !important">
                        <i class="fa fa-fw fa-heart"></i>
                        <span class="d-none d-sm-inline-block ms-1">WishLists</span>
                    </a>

                    <a href="{{ request()->is('/') ? '#faqs' : route('home') . '#faqs' }}" class="btn btn-lg btn-alt-secondary" style="margin-right: 20px !important">
                        <i class="fa fa-fw fa-question-circle"></i>
                        <span class="d-none d-sm-inline-block ms-1">FAQs</span>
                    </a>

                    @guest

                        <a href="{{ route('login') }}" class="btn btn-lg btn-alt-secondary" style="margin-right: 20px !important">
                            <i class="fa fa-fw fa-sign-in-alt"></i>
                            <span class="d-none d-sm-inline-block ms-1">Login</span>
                        </a>

                        <a href="{{ route('register') }}" class="btn btn-lg btn-alt-secondary" style="margin-right: 20px !important">
                            <i class="fa fa-fw fa-user-plus"></i>
                            <span class="d-none d-sm-inline-block ms-1">Register</span>
                        </a>

                    @endguest
                    @auth



                        <!-- User Dropdown -->
                        <div class="dropdown d-inline-block ms-2">
                            <button type="button" class="btn btn-lg btn-alt-secondary" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{-- <i class="fa fa-fw fa-user"></i> --}}
                                {{-- add verified user icon --}}
                                @if (auth()->user()->is_approved && auth()->user()->is_verified_low_income)
                                    <i class="fa fa-fw fa-user-check text-success"></i>
                                    @else
                                    <i class="fa fa-fw fa-user"></i>
                                @endif

                                <span class="d-none d-sm-inline-block ms-1">{{ auth()->user()->name }}</span>
                                <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0"
                                aria-labelledby="page-header-user-dropdown">

                                <div class="p-2">

                                    @role('admin')
                                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                                            href="{{ route('admin.dashboard.index') }}">
                                            <span class="fs-sm fw-medium">Admin Panel</span>

                                        </a>
                                    @endrole

                                    @role('user')
                                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                                            href="{{ route('user.profile.index') }}">
                                            <span class="fs-sm fw-medium">Profile</span>

                                        </a>
                                    @endrole

                                </div>
                                <div role="separator" class="dropdown-divider m-0"></div>
                                <div class="p-2">

                                    <form action="{{ route('logout') }}" id="logout-form" method="POST">
                                        @csrf

                                    </form>


                                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                                        onclick="document.getElementById('logout-form').submit()">
                                        <span class="fs-sm fw-medium">Log Out</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    @endauth
                    <!-- END User Dropdown -->
                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->

            <!-- END Header Search -->

            <!-- Header Loader -->
            <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-primary-lighter">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-circle-notch fa-spin text-primary"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">

            @auth

                @role('user')
                    <div class="bg-primary-darker">
                        <div class="content py-3">
                            <!-- Toggle Main Navigation -->
                            <div class="d-lg-none">
                                <!-- Class Toggle, functionality initialized in Helpers.oneToggleClass() -->
                                <button type="button"
                                    class="btn w-100 btn-alt-secondary d-flex justify-content-between align-items-center"
                                    data-toggle="class-toggle" data-target="#main-navigation" data-class="d-none">
                                    Menu
                                    <i class="fa fa-bars"></i>
                                </button>
                            </div>
                            <!-- END Toggle Main Navigation -->

                            <!-- Main Navigation -->
                            <div id="main-navigation" class="d-none d-lg-block mt-2 mt-lg-0">
                                <ul class="nav-main nav-main-dark nav-main-horizontal nav-main-hover">

                                    <li class="nav-main-item">
                                        <a class="nav-main-link {{ request()->is('/') ? 'active' : '' }}"
                                            href="{{ route('home') }}">
                                            <i class="nav-main-link-icon si si-home"></i>
                                            <span class="nav-main-link-name">Home</span>
                                        </a>
                                    </li>

                                    <li class="nav-main-item">
                                        <a class="nav-main-link {{ request()->is('user/wishlist/create') ? 'active' : '' }}"
                                            href="{{ route('user.wishlist.create') }}">
                                            <i class="nav-main-link-icon si si-heart"></i>
                                            <span class="nav-main-link-name">Your WishLists</span>
                                        </a>
                                    </li>

                                    <li class="nav-main-item">
                                        <a class="nav-main-link {{ request()->is('user/profile') ? 'active' : '' }}"
                                            href="{{ route('user.profile.index') }}">
                                            <i class="nav-main-link-icon si si-user"></i>
                                            <span class="nav-main-link-name">Profile</span>
                                        </a>
                                    </li>
                                    {{-- <li class="nav-main-item">
                                <a class="nav-main-link" href="bd_dashboard.html">
                                    <i class="nav-main-link-icon si si-compass"></i>
                                    <span class="nav-main-link-name"></span>
                                </a>
                            </li> --}}
                                </ul>
                            </div>
                            <!-- END Main Navigation -->
                        </div>
                    </div>
                @endrole

            @endauth

            <div class="bg-image"
                style="background-image: url('{{ asset('media/photos/cover.jpg') }}'); height: 400px; background-position: 0% 80%;">
                <div class="bg-primary-dark-op d-flex align-items-center"
                    style='height:inherit; background-color: rgba(96, 85, 99, 0.5) !important'>
                    <div class="content content-full">
                        <div class="py-3 text-center">

                            <h2 class="h3 fw-medium text-white mb-0">
                                No child should go without a birthday gift here at <span class="text-capitalize"><strong>birthday bonanza</strong></span> you can browse wish
                                lists for verified low income children and buy a gift their family is wishing for.
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- END Navigation -->
            <!-- Page Content -->
            <div id="app-vue">
                @yield('content')
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="bg-body-light">
            <div class="content py-3">
                <div class="row fs-sm justify-content-between">

                    <div class="col-sm-4 py-1 text-center text-sm-start">
                        <a class="fw-semibold" href="/">{{ config('app.name') }}</a>
                        &copy; <span data-toggle="year-copy"></span>
                    </div>

                    <div class="col-sm-4 py-1 text-center text-sm-end">

                        <a class="fw-semibold">contact@birthdaybonanza.org</a>
                    </div>

                    <div class="col-sm-4 py-1 text-center text-sm-end">

                        <a class="fw-semibold" href="{{ route('privacy-policy') }}">Privacy Policy</a>

                    </div>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <!--
        OneUI JS

        Core libraries and functionality
        webpack is putting everything together at -->



    <script src="{{ asset('js/oneui.app.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>


    <script src="{{  asset('js/lib/jquery.min.js')}}"></script>
    <script src="{{  asset('js/plugins/slick-carousel/slick.min.js')}}"></script>


    <script>One.helpersOnLoad(['jq-slick']);</script>

    <!-- Page JS Plugins -->
    {{-- <script src="{{ asset('js/plugins/chart.js/Chart.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/be_pages_dashboard_v1.js') }}"></script> --}}

    @livewireScripts

    @include('sweetalert::alert')

</body>

</html>
