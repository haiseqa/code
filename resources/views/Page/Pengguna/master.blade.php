<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Rukada - Esport</title>
  <!--favicon-->
  <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

  {{-- Css --}}
  <link href="{{ asset('Mix/css/user.css') }}" rel="stylesheet" type="text/css">

  {{-- Js --}}
  <script src="{{ asset('Mix/js/user_head.js') }}"></script>

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
            <img src="{{ asset ('dashboard/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">Rukada</h5>
        </a>
        </div>
    </ul>

  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="{{ !Session::has('foto_profile') ? asset('dashboard/images/avatars/avatar-13.png') : asset(Session::get('foto_profile')) }}" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="{{route('pemilik.profile_pemilik')}}">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="{{ !Session::has('foto_profile') ? asset('dashboard/images/avatars/avatar-13.png') : asset(Session::get('foto_profile')) }}" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title">{{Session::has('nama') ? Session::get('nama') : "Administrator"}}</h6>
            <p class="user-subtitle">{{Session::has('email') ? Session::get('email') : "Administrator@admin.com"}}</p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <a href="{{route('logout')}}">
            <li class="dropdown-item">

                <i class="icon-power mr-2"></i> Logout</li>
        </a>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->
<div style="margin-top: 100px; margin-left: 15px">
    @section('content')
    @show
</div>
<div class="clearfix"></div>

  <div class="content-wrapper">

    <!-- End container-fluid-->

    </div><!--End content-wrapper-->

   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2021 Desa Paraili
        </div>
      </div>
    </footer>
	<!--End footer-->

  </div><!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('Mix/js/user_footer.js')}}"></script>
    @if (Session::has('message'))
    <script>
        alert_info('{{Session::get("message")}}')
    </script>
    @endif
    @if ($errors->any())
    <script>
        alert_info("{{ $errors->first() }});
    </script>



    @endif





</body>

</html>
