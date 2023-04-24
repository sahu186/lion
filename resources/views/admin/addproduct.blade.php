<!DOCTYPE html>
<html lang="en">
  <head>
    {{-- css --}}
    @include('admin.css')

    <style>
      input[type="text"],input[type="number"],textarea[type="text"]{
  color: #ffffff; /* Set the default text color to white */
  background-color: transparent; /* Set the default background color to transparent */
}

input[type=text]:focus,input[type="number"]:focus,textarea[type="text"]:focus {
  background-color: #ffffff; /* Set the background color to white when the input is in focus */
  color: #000000; /* Set the text color to black when the input is in focus */
}


    </style>
   
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
                      <div class="col-md-6">
                          <div class="card" >
                              <div class="card-header" style="text-align: center;">Add Product</div>

                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
              
                              <div class="card-body">
                                  <form action="{{route('addproduct.store')}}" method="POST" enctype="multipart/form-data">
                                      @csrf
              
                                      <div class="form-group">
                                          <label for="name">Name</label>
                                          <input  type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Enter Product Name">
                                          @error('name')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
              
                                      <div class="form-group">
                                          <label for="description">Description</label>
                                          <textarea  type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" required placeholder="Enter Product Descripton" style="height: 160px; ">{{ old('description') }}</textarea>
                                          @error('description')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
              
                                      <div class="form-group">
                                          <label for="price">Price</label>
                                          <input  type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required placeholder="Enter Product Price">
                                          @error('price')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>

                                      <div class="form-group">
                                        <label for="price">Quantity</label>
                                        <input  type="number" name="quantity" id="price" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" required placeholder="Enter Product Quantity">
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
              
                                      <div class="form-group">
                                        <label for="image" style="font-weight: bold;">Image</label>
                                        <div class="custom-file">
                                          <input type="file" name="image" id="image" class="custom-file-input @error('image') is-invalid @enderror" required>
                                          
                                          @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                      </div>
                                      
              
                                      <button type="submit" class="btn btn-primary">Add Product</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  
              
              
              </div>
            
            </div>

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