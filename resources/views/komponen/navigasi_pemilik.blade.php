<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
     <a href="index.html">
      <img src="{{ asset('dashboard/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
      <h5 class="logo-text">PEMILIK VILLA</h5>
    </a>
  </div>
  <ul class="sidebar-menu do-nicescrol">

    <li class="sidebar-header">MAIN NAVIGATION</li>
    <li>
      <a href="{{route('pemilik')}}" class="waves-effect">
        <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>

    <li>
        <a href="{{route('pemilik.daftarvilla')}}" class="waves-effect">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Daftar Villa</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
            <li><a href="{{route('pemilik.daftarvilla')}}"><i class="zmdi zmdi-star-outline"></i> Data Villa</a></li>
            <li><a href="index3.html"><i class="zmdi zmdi-star-outline"></i> Dashboard v3</a></li>
            <li><a href="index4.html"><i class="zmdi zmdi-star-outline"></i> Dashboard v4</a></li>
          </ul>
      </li>

      <li>
        <a href="{{route('pemilik.detail_villa')}}" class="waves-effect">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Data Villa</span>
        </a>
      </li>

     <li>
      <a href="#" class="waves-effect">
        <i class="zmdi zmdi-view-dashboard"></i> <span>Booking</span>
      </a>
    </li>

    {{-- <li>
        <a href="{{route('pemilik.detail_villa')}}" class="waves-effect">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Detail Villa</span>
        </a>
      </li> --}}

   </ul>

  </div>
  <!--End sidebar-wrapper-->
