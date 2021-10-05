    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">{{getlogoimage()->title_ar}}</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header" style="display: none">
                    <a class="navbar-brand" href="{{route('home')}}">
                        <span>
                            <img src="{{getlogoimage()->logo}}" href="{{route('home')}}" alt="homepage" class="dark-logo" style="width: 165px; height: 70px;"/>
                        </span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                       <!-- Language -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(app()->getLocale() == 'en')
                            <i class="flag-icon flag-icon-us"></i>
                            @else
                            <i class="flag-icon flag-icon-kw"></i>
                            @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated bounceInDown">
                                @if(app()->getLocale() == 'en')
                                <a class="dropdown-item" href="{{url('change_lang/ar')}}">
                                    <i class="flag-icon flag-icon-kw"></i>
                                    العربيه
                                </a>
                                @else
                                <a class="dropdown-item" href="{{url('change_lang/en')}}">
                                    <i class="flag-icon flag-icon-us"></i>
                                    English
                                </a>
                                @endif
                             </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{Auth::user()->image}}" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                            <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img
                                              src="{{Auth::user()->image}}" alt="user"></div>
                                            <div class="u-text">
                                                <h4>{{Auth::user()->name}}</h4>
                                                <p class="text-muted">{{Auth::user()->email}}</p></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ route('viewprofile',Auth::user()->id)}}"><i class="ti-user"></i>{{trans('admin.my_profile')}}</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li> <a class="fa fa-power-off" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{trans('admin.logout')}}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form></li>
                                </ul>

                            </div>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
