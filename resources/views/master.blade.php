<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codervent.com/rukada/light-admin/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Dec 2019 05:47:21 GMT -->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Rukada - Responsive Bootstrap4  Admin Dashboard Template</title>
  <!--favicon-->
  <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

  {{-- Mix Css --}}
  <link href="{{ asset('Mix/css/auth.css') }}" rel="stylesheet" />

  {{-- Mix Js --}}
  <script src="{{ asset('Mix/js/auth.js') }}"></script>
  @include('komponen.icon')

    <script>
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
    </script>


<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number]{
        -moz-appearance: textfield;
    }
</style>

</head>

<body class="bg-dark">
 <!-- Start wrapper-->
 <div id="wrapper">
     @if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
             <li>{{$errors}}</li>
             @endforeach
         </ul>
     </div>
     @endif
    @section('konten')

    @show
     <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
    </div><!--wrapper-->

    @if (Session::has('message'))
        <script>alert_info('{{Session::get('message')}}')</script>
    @endif



</body>

<!-- Mirrored from codervent.com/rukada/light-admin/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Dec 2019 05:47:21 GMT -->
</html>
