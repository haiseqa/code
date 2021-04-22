<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
     <a href="index.html">
      <img src="{{ asset('dashboard/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
      <h5 class="logo-text">ADMINISTRATOR</h5>
    </a>
  </div>
  <ul class="sidebar-menu do-nicescrol">

     <li class="sidebar-header">MAIN NAVIGATION</li>
     <li>
       <a href="{{route('admin')}}" class="waves-effect">
         <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
       </a>
     </li>

     <li>
        <a href="{{route('admin.pemilik')}}" class="waves-effect">
         <i class="zmdi zmdi-view-dashboard"></i> <span>Pemilik</span>
       </a>
      </li>

      <li>
        <a href="{{route('admin.daftarvilla')}}" class="waves-effect">
         <i class="zmdi zmdi-view-dashboard"></i> <span>Daftar Villa</span>
       </a>
      </li>

      <li>
        <a href="{{route('admin.fasilitas')}}" class="waves-effect">
         <i class="zmdi zmdi-view-dashboard"></i> <span>Fasilitas</span>
       </a>
      </li>

   </ul>

  </div>
  <!--End sidebar-wrapper-->
