
<!DOCTYPE html>
<html>
@include('pages.head')

<style>
.boxcourrier{

    width: 15%;
    height: 50%;
    border-radius: 100%;
    font-size: 7px;
      border: 1px solid #FFFFFF;
      background: #FFFFFF;
      font-weight: bolder;
      font-size: 70%;
      color: black;
      text-align: center;
      /*background: #fbcb0d;*/
}
.box{
    width: 12%;
    height: 40%;
    border-radius: 100%;
    font-size: 5px;
      border: 1px solid #FFFFFF;
      background: #F5FFFA;
      font-weight: bolder;
      font-size: 90%;
      color: black;
      text-align: center;
}


	.blink {
		animation: blinker 0.6s linear infinite;
		color:#FFFAFA;
		font-size: 30px;
		font-weight: bold;
		font-family: sans-serif;
	}
	@keyframes blinker {
		50%{
			opacity: 0;
		}
	}

.fieldset {
  background-color: #eeeeee;
}

.legend {
  background-color: gray;
  color: white;
  padding: 5px 10px;
}

input {
  margin: 5px;
}




</style>	

<body>
@include('pages.topbar')
 <div class="sh-mainpanel">

@include('pages.menu')
   
  @yield('content')
  <!--  <img src="{{asset('images/armoirie.png')}}" style=" text-align:center;
margin:auto;

display:flex;  transform: translate(30%, -80%); background-size: cover; height:auto; width: 700px; position:fixed;   padding-top : 2%; z-index : -1; -webkit-filter:opacity(50%) ;

 "> -->


    

       
    @include('pages.footer')
  </body>

  
  </html>


<!-- style="background-image: url('images/armoirie.png'); background-size: cover;
background-repeat: no-repeat; background-height: 100%; background-width: 10%;" -->
