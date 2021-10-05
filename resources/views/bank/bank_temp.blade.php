
@include('layouts.admin_header')
@include('bank.layouts.admin_head')
@include('sweetalert::alert')
@include('bank.layouts.admin_sidebar')

@yield('content')
{{--@include('layouts.messages')--}}
{{--@include('layouts.errors')--}}

@include('bank.layouts.admin_footer')
