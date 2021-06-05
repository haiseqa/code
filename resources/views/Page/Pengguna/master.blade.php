<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Villa Nusa Penida</title>
  <!--favicon-->
  <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

  {{-- Css --}}
  <link href="{{ asset('Mix/css/user.css') }}" rel="stylesheet" type="text/css">

  {{-- Js --}}
  <script src="{{ asset('Mix/js/user_head.js') }}"></script>
  @include('komponen.icon')

  <script>
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('conten')
          }
      });

      function error_message(err)  {
          $(".error_message").html('');
          if (err.status === 422){
              $.each(err.responseJSON.errors, (index, value) => {
                  $.each(value, (key, item) => {
                      $('.error_message').append('<li>${item}</li>')
                  })
              });
          }else{
              alert_error("Koneksi Ke Server Bermasalah");
          }
      }
      </script>

<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .modal-dialog-full-width {
        width: 100% !important;
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        max-width: none !important;

    }

    .modal-content-full-width {
        height: auto !important;
        min-height: 100% !important;
        border-radius: 0 !important;
    }

    .modal-header-full-width {
        border-bottom: 1px solid !important;
    }

    .modal-footer-full-width {
        border-top: 1px solid !important;
    }

</style>
</head>

<body>

<!-- Start wrapper-->
 <div id="wrapper">

    @if (App\Utils\authUser::isadmin())
        @include('komponen.navigasi_admin');
    @elseif (App\Utils\authUser::ispemilik())
        @include('komponen.navigasi_pemilik');
    @elseif (App\Utils\authUser::iswisatawan())
        @include('komponen.nagivasi_wisatawan');

    @endif
    <!--Start sidebar-wrapper-->
  <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">

 <nav class="navbar navbar-expand fixed-top bg-white">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       {{-- <i class="icon-menu menu-icon"></i> --}}
     </a>
    </li>
        <div class="brand-logo">
            <a href="index.html">
            <img src="{{ asset ('dashboard/images/logo1-icon.png') }}" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">Villa Nusa Penida</h5>
        </a>
        </div>
    </ul>

  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item">
        <a href="{{route('login')}}" type="button" class="btn btn-success  waves-effect waves-light m-1">Login</a>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->
<div style="margin-top: 100px; margin-left: 15px; margin-right: -8px">
    @section('content')
    @show
</div>
<div class="clearfix"></div>

  {{-- <div class="content-wrapper">

    <!-- End container-fluid-->

    </div><!--End content-wrapper--> --}}

   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

	<!--Start footer-->
	<footer class="footer">
        <div class="container">
          <div class="text-center">
            Copyright © 2021 Villa Nusa Penida
          </div>
        </div>
      </footer>
	<!--End footer-->

  </div><!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('Mix/js/user_footer.js')}}"></script>
  <script src="{{asset('dashboard/plugins/alerts-boxes/js/sweetalert.min.js')}}"></script>
  <script src="{{asset('dashboard/plugins/alerts-boxes/js/sweet-alert-script.js')}}"></script>

    @if (Session::has('message'))
    <script>
        alert_info('{{Session::get("message")}}')
    </script>
    @endif
    @if ($errors->any())
    <script>
        alert_error("{{ $errors->first() }});
    </script>
    @endif

</body>

</html>
