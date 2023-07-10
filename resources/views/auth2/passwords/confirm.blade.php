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

<body>
  <div class="container-scroller" >
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper ">
        <div class="row" >
       
            
              
             <div   class="col-md-6 card" style=" width: 600px; background: #0272bb;border: solid;border-style: 1px;border-radius: 1px">
              <div class="card-header"> <h1 style="font-size: 100px ; margin-left: 120PX; color: white"> GEC</h1>
              <h4 class="font-weight-light" style="font-size: 30px;color: white">Gestion Electronique des Courriers</h4>
              </div>
                <div class="card-body" >

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                   </div>
             </div>
             <div class="col-md-6">
                <img src="{{ asset('images/logo.png') }}"  style="width: 500px;position: absolute;height: 550px;    margin-left: 15%;">
             </div>
              
               
            </div>
          
          
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
