<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
  <title>Gestion de Courrier</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<!--Coded with love by Mutiullah Samim-->
<body >
  <div class="container h-100">
    <div class="d-flex justify-content-center h-100">
      <div class="user_card">
        <div class="d-flex justify-content-center">
          <div class="brand_logo_container brand_logo">
            <img src="{{ asset('images/bd_logo.png') }}" class="" alt="Logo" style="width: 80%;height: 100%">
          </div>
        </div>
        <div class="d-flex justify-content-center form_container">
          <form method="POST"  action="{{ route('login') }}">
              @csrf
              <h1 style="text-align: center;color: white;font-weight: bolder; font-size: 350% ">GEC-PAO</h1>
              <p style="text-align: center;color: white;font-size: 120%">Plateforme Unifiée de l'APIP</p>
              <hr style="color: black;background: white">                   @if(session()->has('success'))<p style="font-weight: bolder; text-align: center; color: red">{{session()->get('success')}}</p>@endif            <div class="input-group mb-3">              <div class="input-group-append">                <span class="input-group-text"><i class="fas fa-user"></i></span>              </div>              <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} input_user" value="" placeholder="Adresse Email">                @if ($errors->has('email'))                                    <span class="invalid-feedback" role="alert" style="background: red; color: white">                                        <strong>Adresse Email ou Mot de Passe Invalide.</strong>                                    </span>                                @endif            </div>            <div class="input-group mb-2">              <div class="input-group-append">                <span class="input-group-text"><i class="fas fa-key"></i></span>              </div>              <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} input_pass" value="" placeholder="Mot de Passe">               @if ($errors->has('password'))                                    <span class="invalid-feedback" role="alert" style="background: red; color: white">                                        <strong>Adresse Email ou Mot de Passe Invalide.</strong>                                    </span>                                @endif            </div>
           <!--  <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customControlInline">
                <label class="custom-control-label" for="customControlInline">Remember me</label>
              </div>
            </div> -->
              <div class="d-flex justify-content-center mt-3 login_container">
          <button type="submit" name="button" class="btn login_btn">Connexion</button>
           </div>
          </form>
        </div>
    
        <div class="mt-4">
          
          <div class="d-flex justify-content-center links">
            <a  href="{{ route('motdepassoublier') }}"  style="color: white">Mot de Passe Oublié?</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<style type="text/css">
    /* Coded with love by Mutiullah Samim */
    body,
    html {
      margin: 0;
      padding: 0;
      height: 100%;

      background-image: url('images/apip_fond.jpeg');
      background-repeat: no-repeat;
      background-size: cover;
      /*background: #F0F8FF !important;*/
       
/*#034a13*/ /*#fbcb0d*/ 
    }
    .user_card {
      height: 450px;
      width: 350px;
      margin-top: auto;
      margin-bottom: auto;
      background:#007bff;
      opacity: 0.8;
      position: relative;
      display: flex;
      justify-content: center;
      flex-direction: column;
      padding: 10px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      border-radius: 5px;

    }
    .brand_logo_container {
      position: absolute;
      height: 170px;
      width: 170px;
      top: -75px;
      border-radius: 50%;
      background: #f8f9fa;
      opacity: 1.5;
      padding: 18px;
      text-align: center;
    }
    .brand_logo {
      
      border-radius: 50%;
      border: 2px solid #707070;
    }
    .form_container {
      margin-top: 100px;
    }
    .login_btn {
      width: 100%;
      background: black!important;
      color: white !important;
    }
    .login_btn:focus {
      box-shadow: none !important;
      outline: 0px !important;
    }
    .login_container {
      padding: 0 2rem;
    }
    .input-group-text {
      background:black !important;
      color: white !important;
      border: 0 !important;
      border-radius: 0.25rem 0 0 0.25rem !important;
    }
    .input_user,
    .input_pass:focus {
      box-shadow: none !important;
      outline: 0px !important;
    }
    .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
      background-color: #c0392b !important;
    }
</style>