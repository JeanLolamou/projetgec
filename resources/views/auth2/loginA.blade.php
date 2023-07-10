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
                   <form method="POST" class="pt-3" action="{{ route('login') }}" >
                        @csrf
                <div class="form-group"> 
                  <label for="exampleInputEmail" style="font-size: 20px; color: white">E-mail</label>
                  <div class="input-group" style="">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0" style="color: #e9ecef !important;">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert" style="background: red">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <input  type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg border-left-0" id="exampleInputEmail" placeholder="Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword" style="font-size: 20px;color: white">Mot de Passe</label>
                  <div class="input-group" style="color: white;">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0" style="color: #e9ecef !important;">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                       @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert" style="background: red">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <input  type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-lg border-left-0" id="exampleInputPassword" placeholder="Password">                        
                  </div>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                 
                  <a href="{{ route('password.request') }}" class="auth-link text-black" style="color: white;font-size: 20px">Mot de passe oublié?</a>
                </div>
                <div class="my-3">
                    <button type="submit" name="connexion" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" style="background: black;color: white;
    font-weight: bolder; font-size: 20px"> CONNEXION </button>
                    
                 
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
