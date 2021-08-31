    <aside class="left-sidebar">
            <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li>
                        <a class="waves-effect waves-dark" href="" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu"></span>سيشيش</a>
                    </li>

                    <li>
                       <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-account-location"></i><span class="hide-menu">{{trans('admin.nav_users')}}</span></a>
                        <ul aria-expanded="false" class="collapse">

                                <li><a href="{{url('users')}}">{{trans('admin.view_users')}}</a></li>

{{--                                <li><a href="{{url('roles')}} ">{{trans('admin.nav_permissions')}}</a></li>--}}

                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <div class="page-wrapper">
        @include('layouts.errors')
        @include('layouts.messages')
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
