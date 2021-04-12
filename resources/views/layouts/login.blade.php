<!DOCTYPE html>
<html lang="en">

<head>

<style>
#logo-speed{
  background-color:red;
}

</style>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistema - Speed Service</title>
  <!-- plugins:css -->
  {!! Html::style('melody/vendors/iconfonts/font-awesome/css/all.min.css') !!}
  {!! Html::style('melody/vendors/css/vendor.bundle.base.css') !!}
  {!! Html::style('melody/vendors/css/vendor.bundle.addons.css') !!}
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  {!! Html::style('melody/css/style.css') !!}
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('melody/images/wheel.ico')}}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="">
                <img src="{{asset('melody/images/auth/logo1.png')}}"  height="325px" width="450px" alt="logo image">
              </div>
              <h4>Sistema Taller Automotriz</h4>
              <h6 class="font-weight-light">Speed Service - El Salvador</h6>


              @yield('content')


            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2021 Todos los derechos reservados</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  {!! Html::script('melody/vendors/js/vendor.bundle.base.js') !!}
  {!! Html::script('melody/vendors/js/vendor.bundle.addons.js') !!}
  <!-- endinject -->
  <!-- inject:js -->
  {!! Html::script('melody/js/off-canvas.js') !!}
  {!! Html::script('melody/js/hoverable-collapse.js') !!}
  {!! Html::script('melody/js/misc.js') !!}
  {!! Html::script('melody/js/settings.js') !!}
  {!! Html::script('melody/js/todolist.js') !!}
  <!-- endinject -->
</body>
</html>