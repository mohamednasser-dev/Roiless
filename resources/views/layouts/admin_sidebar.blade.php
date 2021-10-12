<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                @can('home')
                    <li>
                        <a class="waves-effect waves-dark" href="{{route('home')}}" aria-expanded="false"><i
                                class="mdi mdi-home"></i><span class="hide-menu"></span>{{trans('admin.home_page')}}</a>
                    </li>
                @endcan

                @can('roles')
                    <li>
                        <a class="waves-effect waves-dark" href="{{route('roles.index')}}" aria-expanded="false"><i
                                class="mdi mdi-home"></i><span class="hide-menu"></span>الصلاحيات</a>
                    </li>
                @endcan

                @can('Users')
                    <li>
                        <a class="waves-effect waves-dark" href="{{route('users.index')}}" aria-expanded="false"><i
                                class="mdi mdi-account-location"></i><span
                                class="hide-menu"></span>{{trans('admin.users')}}</a>
                    </li>
                @endcan

                @can('Employers')
                    <li><a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-email"></i><span
                                class="hide-menu">الموظفين</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('employer.create')}}">{{trans('admin.add_new_employer')}}</a></li>
                            <li><a href="{{route('employer.index')}}">{{trans('admin.show_employers')}}</a></li>
                            <li><a href="{{route('employer.view.logs')}}">{{trans('admin.employers_moves')}}</a></li>
                        </ul>
                    </li>
                @endcan
                @can('Banks')
                    <li>
                        <a class="waves-effect waves-dark" href="{{route('banks.index')}}" aria-expanded="false"><i
                                class="mdi mdi-bank"></i><span class="hide-menu"></span>{{trans('admin.banks')}}</a>
                    </li>
                @endcan
                @can('funds')
                    <li>
                        <a class="waves-effect waves-dark" href="{{route('fund')}}" aria-expanded="false"><i
                                class="mdi mdi-cash-multiple"></i><span
                                class="hide-menu"></span>{{trans('admin.funds')}}</a>
                    </li>
                @endcan
                @can('Client Funds')
                    <li>
                        <a class="waves-effect waves-dark" href="{{route('userfunds')}}" aria-expanded="false"><i
                                class="mdi mdi-cash-multiple"></i><span
                                class="hide-menu"></span>{{trans('admin.Required_funds')}}</a>
                    </li>
                @endcan
                @can('categories')
                    <li>
                        <a class="waves-effect waves-dark" href="{{route('categories')}}" aria-expanded="false"><i
                                class="mdi mdi-briefcase"></i><span
                                class="hide-menu"></span>{{trans('admin.fund_category')}}</a>
                    </li>
                @endcan

                @can('Common questions')
                    <li>
                        <a class="waves-effect waves-dark" href="{{route('question')}}" aria-expanded="false"><i
                                class="mdi mdi-comment-question-outline"></i><span
                                class="hide-menu"></span>{{trans('admin.common_question')}}</a>
                    </li>
                @endcan
                @can('Services')
                    <li>
                        <a class="waves-effect waves-dark" href="{{route('services')}}" aria-expanded="false"><i
                                class="mdi mdi-format-align-justify"></i><span
                                class="hide-menu"></span>{{trans('admin.services')}}</a>
                    </li>
                @endcan

                @can('consolutions')
                    <li>
                        <a class="waves-effect waves-dark" href="{{route('consolutions')}}" aria-expanded="false"><i
                                class="mdi mdi-format-align-justify"></i><span class="hide-menu">
                                @php
                                    $unseenreply = \App\Models\reply::where('seen','0')->where('user_id','!=',null)->get()->count();
                                    $consolutions = \App\Models\Consolution::where('seen','0')->get()->count();
                                    $allconsolution=$unseenreply+$consolutions
                                @endphp
                                @if( $allconsolution) <span
                                    class="label label-rouded label-danger pull-right">{{$allconsolution}}</span>@endif
                            </span>{{trans('admin.consolutions')}}</a>
                    </li>
                @endcan
            <!--
                <li>
                    <a class="waves-effect waves-dark" href="{{route('services')}}" aria-expanded="false"><i
                            class="mdi mdi-format-align-justify"></i><span class="hide-menu"></span>{{trans('admin.slider')}}</a>
                </li> -->
                @can('notifications')
                    <li>
                        <a class="waves-effect waves-dark" href="{{route('notifications.index')}}"
                           aria-expanded="false"><i
                                class=" ti-world"></i><span class="hide-menu"></span>{{trans('admin.notification')}}</a>
                    </li>
                @endcan

                @can('communication')
                    <li>
                        <a class="waves-effect waves-dark" href="{{route('inbox')}}" aria-expanded="false"><i
                                class="mdi mdi-inbox-arrow-down"></i><span
                                class="hide-menu"></span>{{trans('admin.communication')}}</a>
                    </li>
                @endcan
                @can('Setting')
                    <li>
                        <a class="waves-effect waves-dark" href="{{route('Setting.edit')}}" aria-expanded="false"><i
                                class="mdi mdi-settings"></i><span class="hide-menu"></span>{{trans('admin.setting')}}
                        </a>
                    </li>
                @endcan
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
