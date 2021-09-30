<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
        <style>
            body {
                font-family: 'Droid Arabic Kufi', serif !important;
                font-size: 48px;
            }
        </style>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/favicon.png') }}">
        <title>{{getlogoimage()->title_ar}}</title>
        <!-- Bootstrap Core CSS -->
        
        <link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
        <!-- This page CSS -->

        <!--c3 CSS -->
        <link href="{{ asset('/assets/plugins/c3-master/c3.min.css') }}" rel="stylesheet">
        <!--Toaster Popup message CSS -->
        <link href="{{ asset('/assets/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href= "{{asset('/assets/plugins/html5-editor/bootstrap-wysihtml5.css')}}" rel="stylesheet" />
        <link href="{{ asset('/assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
     
        <!-- Dashboard 1 Page CSS -->
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/myStyles.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/pages/dashboard1.css') }}" rel="stylesheet">
        <!-- You can change the theme colors from here -->
        <link href="{{ asset('/css/colors/default-dark.css') }}" id="theme" rel="stylesheet">
        <link href="{{ asset('/css/pages/card-page.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/owl.theme.default.min.css') }}" rel="stylesheet">

        <!-- Dashboard 1 Page CSS -->
        <link href="{{ asset('/ltr/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('ltr/css/myStyles.css') }}" rel="stylesheet">
        <link href="{{ asset('/ltr/css/pages/dashboard1.css') }}" rel="stylesheet">
        <!-- You can change the theme colors from here -->
        <link href="{{ asset('/ltr/css/colors/default-dark.css') }}" id="theme" rel="stylesheet">
        <link href="{{ asset('/ltr/css/pages/card-page.css') }}" rel="stylesheet">
     
        <!-- ar -->
        

        <link href="{{ asset('/assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/pages/card-page.css') }}" rel="stylesheet">

        <!-- you can change style in en from here-->
        <!-- en -->
        @if(app()->getLocale() == 'en')
        <link href="{{ asset('/css/colors/default-dark_en.css') }}" id="theme" rel="stylesheet">
        <link href="{{ asset('/css/style_en.css') }}" rel="stylesheet">
        @else
          <link href="{{ asset('/css/style.css') }}" rel="stylesheet"> 
        <link href="{{ asset('/css/colors/default-dark.css') }}" id="theme" rel="stylesheet"> 
        @endif

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!--font awsom -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        @yield('styles')
    </head>

    <body class="fix-header fix-sidebar card-no-border">
