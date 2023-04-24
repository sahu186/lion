<!DOCTYPE html>
<html lang="en">
   <head>
      {{-- css --}}
      @include('user.css')
   </head>
   <!-- body -->
   <body class="main-layout">
	<!-- header section start -->
    @include('user.header')
	<!-- header section end -->
	<!-- New Arrivals Products -->
    @include('user.product')
   	<!-- New Arrivals section end -->
   	<!-- contact section start -->
 
   	<!-- contact section end -->
	<!-- section footer start -->
    @include('user.footer')
	<!-- section footer end -->
	<div class="copyright">2023 All Rights Reserved. <a href="https://html.design">SAHU ROSHAN</a></div>


      <!-- Javascript files-->
      @include('user.script')
   </body>
</html>