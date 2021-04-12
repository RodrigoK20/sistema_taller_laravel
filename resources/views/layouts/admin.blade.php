<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
    <!-- plugins:css -->
    {!! Html::style('/melody/vendors/iconfonts/font-awesome/css/all.min.css') !!}
    {!! Html::style('/melody/vendors/css/vendor.bundle.base.css') !!}
    {!! Html::style('/melody/vendors/css/vendor.bundle.addons.css') !!}
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    {!! Html::style('/melody/css/style.css') !!}
    {!! Html::style('/melody/css/sweetalert2.css') !!}
    @yield('styles')
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('melody/images/wheel.ico')}}" />
</head>
<body>
  <div class="container-scroller sidebar-dark">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="" href=""><img src="{{asset('melody/images/auth/logo1.png')}}" height="90px" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href=""><img src="/melody/images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fas fa-bars"></span>
        </button>
        <ul class="navbar-nav">
          <li class="nav-item nav-search d-none d-md-flex">
            <div class="nav-link">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                   
                  </span>
                </div>
              
              </div>
            </div>
          </li>
        </ul>

        <ul class="navbar-nav navbar-nav-right">
        @yield('create')
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        {{ Auth::user()->name }} <img src="{{asset('melody/images/faces/user2.png')}}" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            {{--  <a class="dropdown-item">
                                <i class="fas fa-cog text-primary"></i>
                                Settings
                            </a>  --}}
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('logout')}}" method="POST"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Logout">
                                <i class="fas fa-power-off text-primary"></i>
                                Logout
                            </a>

                              
                      
                        </div>
                    </li>
                    @yield('options')
                </ul>

       
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="fas fa-bars"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <!-- <div id="settings-trigger"><i class="fas fa-fill-drip"></i></div> -->
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close fa fa-times"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_sidebar.html -->
  
     
      @include('layouts.nav')


      <!-- partial -->
      <div class="main-panel">
          @yield('content')
        <div class="content-wrapper">
          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
          
        @include('layouts.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

<!-- plugins:js -->
    {!! Html::script('melody/vendors/js/vendor.bundle.base.js') !!}
    {!! Html::script('melody/vendors/js/vendor.bundle.addons.js') !!}
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    {!! Html::script('melody/js/off-canvas.js') !!}
    {!! Html::script('melody/js/hoverable-collapse.js') !!}
    {!! Html::script('melody/js/misc.js') !!}
    {!! Html::script('melody/js/settings.js') !!}
    {!! Html::script('melody/js/todolist.js') !!}
    <!-- endinject -->
    <!-- Custom js for this page-->
    {!! Html::script('melody/js/dashboard.js') !!}
   
    <!-- End custom js for this page-->
    @yield('scripts')
</body>


</html>
