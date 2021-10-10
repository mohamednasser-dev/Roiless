<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a class="waves-effect waves-dark" href="{{route('home')}}" aria-expanded="false"><i
                            class="mdi mdi-home"></i><span class="hide-menu"></span>{{trans('admin.home_page')}}</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('users.index')}}" aria-expanded="false"><i
                            class="mdi mdi-account-location"></i><span class="hide-menu"></span>{{trans('admin.users')}}</a>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">الموظفين</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('employer.create')}}">{{trans('admin.add_new_employer')}}</a></li>
                        <li><a href="{{route('employer.index')}}">{{trans('admin.show_employers')}}</a></li>
                        <li><a href="{{route('employer.view.logs')}}">{{trans('admin.employers_moves')}}</a></li>
                    </ul>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('banks.index')}}" aria-expanded="false"><i
                            class="mdi mdi-bank"></i><span class="hide-menu"></span>{{trans('admin.banks')}}</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('fund')}}" aria-expanded="false"><i
                            class="mdi mdi-cash-multiple"></i><span class="hide-menu"></span>{{trans('admin.funds')}}</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('userfunds')}}" aria-expanded="false"><i
                            class="mdi mdi-cash-multiple"></i><span class="hide-menu"></span>{{trans('admin.Required_funds')}}</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('categories')}}" aria-expanded="false"><i
                            class="mdi mdi-briefcase"></i><span class="hide-menu"></span>{{trans('admin.fund_category')}}</a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="{{route('question')}}" aria-expanded="false"><i
                            class="mdi mdi-comment-question-outline"></i><span class="hide-menu"></span>{{trans('admin.common_question')}}</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('services')}}" aria-expanded="false"><i
                            class="mdi mdi-format-align-justify"></i><span class="hide-menu"></span>{{trans('admin.services')}}</a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="{{route('consolutions')}}" aria-expanded="false"><i
                            class="mdi mdi-format-align-justify"></i><span class="hide-menu">
                                @php 
                                $unseenreply = \App\Models\Reply::where('seen','0')->where('user_id','!=',null)->get()->count();
                                $consolutions = \App\Models\Consolution::where('seen','0')->get()->count();
                                $allconsolution=$unseenreply+$consolutions
                                @endphp
                            <span class="label label-rouded label-danger pull-right">{{$allconsolution}}</span>
                            </span>{{trans('admin.consolutions')}}</a>
                </li>
                <!-- <li>
                    <a class="waves-effect waves-dark" href="{{route('services')}}" aria-expanded="false"><i
                            class="mdi mdi-format-align-justify"></i><span class="hide-menu"></span>{{trans('admin.slider')}}</a>
                </li> -->
                <li>
                    <a class="waves-effect waves-dark" href="{{route('notifications.index')}}" aria-expanded="false"><i
                            class=" ti-world"></i><span class="hide-menu"></span>{{trans('admin.notification')}}</a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="{{route('inbox')}}" aria-expanded="false"><i
                            class="mdi mdi-inbox-arrow-down"></i><span class="hide-menu"></span>{{trans('admin.communication')}}</a>
                </li>  <li>
                    <a class="waves-effect waves-dark" href="{{route('Setting.edit')}}" aria-expanded="false"><i
                            class="mdi mdi-settings"></i><span class="hide-menu"></span>{{trans('admin.setting')}}</a>
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
