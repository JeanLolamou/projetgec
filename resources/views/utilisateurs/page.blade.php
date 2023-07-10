<!DOCTYPE html>
<html lang="fr">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Gestion de Courrier</title>
  <!-- base:css -->
<link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{asset('template/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('template/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('images/logo.png') }}" />
</head>

<body style=" ">
  <div class="container-scroller" >
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper " style="">
       
                
          @if(session()->has('successMail'))
                  <h1 style="width: 100%; background: green;color: white"> {{session()->get('successMail')}}</h1>
                             
                @endif
             
          
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="{{asset('template/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{asset('template/js/off-canvas.js') }}"></script>
  <script src="{{asset('template/js/hoverable-collapse.js') }}"></script>
  <script src="{{asset('template/js/template.js') }}"></script>
  <script src="{{asset('template/js/settings.js') }}"></script>
  <script src="{{asset('template/js/todolist.js') }}"></script>
  <!-- endinject -->
</body>


<!-- Mirrored from www.bootstrapdash.com/demo/wagondash/template/demo/vertical-default-light/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Feb 2021 09:44:04 GMT -->
</html>
