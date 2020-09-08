<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Must Suggestion Box</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('css')
  </head>
  <body>

    @php
        $segment_1 = Request::segment(1);
        $segment_2 = Request::segment(2);
    @endphp

  @auth
  <div id="colorlib-page">
    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
    <aside id="colorlib-aside" role="complementary" class="js-fullheight">
        <center>
        <img src="{{ asset('images/logo.svg') }}" width="130px" alt="logo">
        </center>
        <h1 id="" class="mb-1"><a href="{{ url('/') }}">MUST <span>OSB </span></a></h1>
  <div class="" style="background-color: darkgrey; padding: 10px 20px; border-radius:5px;">
    <strong>Login as: </strong> {{  auth()->user()->name }}<br>
    <strong>Role: </strong> {{ title_case(auth()->user()->getRoleNames()->first()) }}
  </div>

  <nav id="colorlib-main-menu" class="mt-1" role="navigation">
    <ul>
      <li class="{{ $segment_1??'colorlib-active' }}"><a href="{{ url('/') }}">Home</a></li>

      @if (auth()->user()->hasAnyRole(['super-admin', 'admin']))
      <li class="{{ $segment_1 == 'user'? 'colorlib-active':'' }}"><a href="{{ route('user.index') }}">Users</a></li>
      <li class="{{ $segment_1 == 'category'? 'colorlib-active':'' }}"><a href="{{ route('category.index') }}">Category</a></li>
      @endif

      <li class="{{ $segment_1 == 'post'? 'colorlib-active':'' }}"><a href="{{ route('post.index') }}">Post</a></li>
      {{-- <li class="{{ $segment_1 == 'about'? 'colorlib-active':'' }}"><a href="#">About</a></li> --}}
      <li><a href="javascript:void(0)" onclick="$('#logout').submit()">Logout</a></li>
    </ul>
    <form action="{{ route('logout') }}" method="post" id="logout" hidden>
      @csrf
    </form>
  </nav>

  <div class="colorlib-footer">
      <hr>
    <p class="pfooter pl-2"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Mbeya University of Science and Technology <a href="https://must.ac.tz">(MUST)</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
  </div>
    </aside> <!-- END COLORLIB-ASIDE -->
  @endauth

		@yield('content')
	</div><!-- END COLORLIB-PAGE -->

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('js/aos.js') }}"></script>
  <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
  <script src="{{ asset('js/scrollax.min.js') }}"></script>
  {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> --}}
  <script src="{{ asset('js/main.js') }}"></script>

  @yield('js')

  </body>
</html>
