<!DOCTYPE html>
<html lang="en">
  <head>
    {{-- css --}}
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
     {{-- end sidebar --}}
      <!-- partial -->
     {{-- navbar --}}
     @include('admin.navbar')
        <!-- partial -->
      {{-- content --}}
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="container">
              <div class="row justify-content-center">
                  <div class="col-md-15">
                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                      <div class="card" style="background-color: #2630bb">
                          <div class="card-header" style="text-align: center;">Show Product</div>
                          <table class="table" >
                            <thead style="background-color: #ffffff;
                            color: #000000;">
                                <tr>
                                    <th>Id</th>
                                    <th>PRODUCT NAME</th>
                                    <th>PRICE</th>
                                    <th>DESCRIPTION</th>
                                    <th>QUANTITY</th>
                                    <th>IMAGE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            @foreach ($product as $item)
                            
                            <tbody style=" background-color: #444;
                            color: #fff;">
                            <tr>
                                <td >{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>₹{{$item->price}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>
                                    <img src="productimages/{{$item->image}}" alt="" style="width:80px;
                                    height:100px;border-radius: 0%">
                                  </td>
                                  <td>
                                    <a class="btn btn-success"href="{{route('editproduct.edit',$item->id)}}" style="border-radius:20px" >Update</a>
                                    <a class="btn btn-danger"href="{{route('delete', $item->id)}}" style="border-radius:20px" >Delete</a>
                                  </td>
                            </tr>

                            </tbody>  
                            @endforeach
                           
                          </table>
                          
             

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    {{-- script --}}
    @include('admin.script')
  </body>
</html>