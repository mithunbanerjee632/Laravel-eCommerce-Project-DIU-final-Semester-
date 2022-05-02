<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">


    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sidenav.css')}}">
    {{--<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/css/mdb.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/datatables-select.min.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <{{--link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">--}}
</head>

<body>



@include('Backend.layout.menu')


<div class="page-heading">
    <h3> @yield('page-heading') </h3>
</div>






@yield('main-content')

</div>
{{--@include('layout.footer')--}}


    {{-- All JS Here --}}
    <script type="text/javascript" src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/mdb.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/sidebarmenu.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/sticky-kit.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom.min-2.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/datatables-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/axios.min.js')}}"></script>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

   {{-- <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>--}}

    <script src="{{ asset('assets/js/main.js') }}"></script>

@yield('script')
</body>

</html>
