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

    @if(session()->has('message'))

    <b class="alert-success"> {{session()->get('message')}}</b>
    
    <div class="layout_padding contact_section">
        <div class="container">
            <h1 class="new_text"><strong>Contact Now</strong></h1>
        </div>
        <div class="container-fluid ram">
            <div class="row">
                <div class="col-md-6">
                    <div class="email_box">
                    <div class="input_main">
                       <div class="container">
                          <form action="{{route('contactus')}}" method="post">
                            @csrf
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="Name" name="name" required>
                            </div>
                            <div class="form-group">
                              <input type="number" class="email-bt" placeholder="Phone Numbar" name="phone" required>
                            </div>
                            <div class="form-group">
                              <input type="email" class="email-bt" placeholder="Email" name="email" required>
                            </div>
                            
                            <div class="form-group">
                                <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="message"></textarea>
                            </div>

                            <div class="send_btn">
                                <button  class="main_bt">Send</button>
                               </div>                   
                            </div>

                          </form>   
                       </div>
                       




        @endif
                       
            </div>
                </div>
                <div class="col-md-6">
                    <div class="shop_banner">
                        <div class="our_shop">
                            <button class="out_shop_bt">Our Shop</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   	<!-- contact section end -->
	<!-- section footer start -->
    @include('user.footer')
	<!-- section footer end -->
	<div class="copyright">2023 All Rights Reserved. <a href="https://html.design">SAHU ROSHAN</a></div>


      <!-- Javascript files-->
      @include('user.script')
   </body>
</html>




