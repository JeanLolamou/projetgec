     @include('templates/page/header')  
       @include('templates/page/topbar') 
       <body>
  <div class="container-scroller">

     
@include('templates/page/menu')
 

 
         @yield('contenu')
          
          
         


<!-- <span id="themesBtn"></span> -->
</div>
@include('templates/page/footer')
</body>
</html>