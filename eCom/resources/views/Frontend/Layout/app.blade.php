<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.ico')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/owl.carousel.min.css')}}">
  {{--  <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}" rel="stylesheet" >
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}" rel="stylesheet">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/chosen.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/color-01.css')}}">
  {{--  <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}" rel="stylesheet">--}}
</head>

<body class="home-page home-01 ">
@include('Frontend.Layout.menu')

@yield('content')





@include('Frontend.Layout.footer')










<script src="{{asset('js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
<script src="{{asset('js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
{{--<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>--}}
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.flexslider.js')}}"></script>
<script src="{{asset('js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('js/jquery.sticky.js')}}"></script>
<script src="{{asset('js/functions.js')}}"></script>
@yield('script')
<script type="text/javascript" src="{{asset('js/axios.min.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>--}}
</body>
