<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.0.0-alpha.1
* @link https://coreui.io
* Copyright (c) 2019 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(Auth::user())
      <meta name="user-id" content="{{ Auth::user()->id }}">
          
         @else
          
              <meta name="user-id" content="null">
      
          
          @endif
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>test</title>
    <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
 
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Icons-->
    {{-- <link href="{{ asset('css/free.min.css') }}" rel="stylesheet"> <!-- icons --> --}}
    {{-- <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet"> <!-- icons --> --}}
    <!-- Main styles for this application-->
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css"> --}}

    <link href="{{ asset('dashboard/style.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/changes.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/44a3513bac.js" crossorigin="anonymous"></script>
    @yield('css')

    <!-- Global site tag (gtag.js) - Google Analytics-->
  

    {{-- <link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet"> --}}
 
  </head>



  <body class=" c-dark-theme " >
    <div  id="app">



      @include('dashboard.shared.sidebar')

      @include('dashboard.shared.header')
   

      <div class="c-body">

        <main class="c-main">
          @yield('content') 

        </main>
        @include('dashboard.shared.footer')
      </div>
   
  </div>
    </div>
   


    <!-- CoreUI and necessary plugins-->

    <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('javascript')




  </body>
</html>
