<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a class="waves-effect waves-dark" href="{{route('home')}}" aria-expanded="false"><i
                            class="mdi mdi-home"></i><span class="hide-menu"></span>الصفحة الرئيسية</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('users.index')}}" aria-expanded="false"><i
                            class="mdi mdi-account-location"></i><span class="hide-menu"></span>المستخدمين</a>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">الموظفين</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('employer.create')}}">{{trans('admin.add_new_employer')}}</a></li>
                        <li><a href="{{route('employer.index')}}">عرض الموظفين</a></li>
                        <li><a href="{{route('employer.view.logs')}}">تحركات الموظفين</a></li>
                    </ul>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('banks.index')}}" aria-expanded="false"><i
                            class="mdi mdi-bank"></i><span class="hide-menu"></span>البنوك</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('fund')}}" aria-expanded="false"><i
                            class="mdi mdi-cash-multiple"></i><span class="hide-menu"></span>التمويلات</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('userfunds')}}" aria-expanded="false"><i
                            class="mdi mdi-cash-multiple"></i><span class="hide-menu"></span>التمويلات المطلوبه</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('categories')}}" aria-expanded="false"><i
                            class="mdi mdi-briefcase"></i><span class="hide-menu"></span>الاقسام</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('sliders')}}" aria-expanded="false"><i
                            class="mdi mdi-image"></i><span class="hide-menu"></span>الاعلانات</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('question')}}" aria-expanded="false"><i
                            class="mdi mdi-comment-question-outline"></i><span class="hide-menu"></span>اساله شائعه</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('services')}}" aria-expanded="false"><i
                            class="mdi mdi-format-align-justify"></i><span class="hide-menu"></span>الخدمات</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('notifications.index')}}" aria-expanded="false"><i
                            class=" ti-world"></i><span class="hide-menu"></span>الاشعارت</a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="{{route('inbox')}}" aria-expanded="false"><i
                            class="mdi mdi-inbox-arrow-down"></i><span class="hide-menu"></span>التواصل</a>
                </li>  <li>
                    <a class="waves-effect waves-dark" href="{{route('Setting.edit')}}" aria-expanded="false"><i
                            class="mdi mdi-settings"></i><span class="hide-menu"></span>الاعدادات</a>
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
