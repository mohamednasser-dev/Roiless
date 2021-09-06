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
                            class="mdi mdi-account-location"></i><span class="hide-menu"></span>الموظفين</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('categories')}}" aria-expanded="false"><i
                            class="mdi mdi-account-location"></i><span class="hide-menu"></span>الاقسام</a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('sliders')}}" aria-expanded="false"><i
                            class="mdi mdi-account-location"></i><span class="hide-menu"></span>Slider</a>
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

