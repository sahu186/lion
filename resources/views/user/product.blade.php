<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<!-- new collection section start -->
<div class="layout_padding collection_section">
    <div class="container">
        <h1 class="new_text"><strong>New  Collection</strong></h1>
        <p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
        @foreach ($data as $data)
            
        
        <div class="collection_section_2">
            <div class="row">
                <div class="col-md-6">
                    <div class="about-img" style="height:450px;width:450px">
                        <button class="new_bt">New</button>
                        <div class="shoes-img"><img src="/productimages/{{$data->image}}" style="height:300px;width:300px;  margin-left: 70px;" ></div>
                       
                    </div>
                    <button class="seemore_bt"><a href="#newarrival">See More</a></button>
                </div>
                <div class="col-md-6" >
                    <div class="about-img2" style="height:450px;width:450px">
                        <div class="shoes-img2" style="font-size: 20px">{{$data->description}}</div>
                        <p class="sport_text" style="font-weight: 600">{{$data->productname}}</p>
                        <div class="dolar_text mt-2">₹<strong style="color: #f12a47;">{{$data->price}}</strong> </div>
                        <div class="star_icon  " style="margin-left: 180px">
                            <ul>
                                <li><a href="#"><img src="user/images/star-icon.png"></a></li>
                                <li><a href="#"><img src="user/images/star-icon.png"></a></li>
                                <li><a href="#"><img src="user/images/star-icon.png"></a></li>
                                <li><a href="#"><img src="user/images/star-icon.png"></a></li>
                                
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>



<div class="collection_section layout_padding">
    <div class="container">
        <h1 class="new_text" id="newarrival"><strong>New Arrivals Products</strong></h1>
        <p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>

        <form action="">
            @csrf

            <div class="form-group">
              
              <input type="search" name="search" id="" class=" text-center" placeholder="Search Product"  style="width: 200px; " value="{{$search}}">
              <button class="btn btn-primary">Search</button>
              
            </div>
    
        </form>
    </div>
</div>
<!-- New Arrivals Products -->
<!-- New Arrivals section start -->

<div class="layout_padding gallery_section">
    <div class="container">
        <div class="row">
            @foreach($product as $item)
            <div class="col-sm-4">
                <div class="best_shoes">
                    <p style="margin-bottom: 15px" class="best_text">{{$item->name}} </p>
                    <div class="shoes_icon" style="text-align:center; display:flex; justify-content:center;"><img src="productimages/{{$item->image}}" alt="" style="width:150px%;
                        height:200px;"></div>

                        <p  style="margin-bottom: 15px; text-align:center;" class="best_text">{{$item->description}} </p>
   
                    <div class="star_text">
                        <div class="left_part">
                            <ul>
                                <form action="{{route('addcart',$item->id)}}" method="post">
                                    @csrf
                                    <div class="input-group mb-3" style="width: 130px">
                                        <span class="input-group-text decrement-btn" data-product-id="{{$item->id}}">-</span>
                                        <input type="text" class="form-control bg-white text-center" name="quantity" min="1" value="1" data-product-id="{{$item->id}}">
                                        <span class="input-group-text increment-btn" data-product-id="{{$item->id}}">+</span>
                                    </div>
                                    <button class="btn btn-danger" style="color:white; padding:10px 20px; border:none; border-radius:5px; font-size:16px; cursor:pointer;">
                                        <i class="fas fa-shopping-cart"></i> Cart
                                    </button>
                                </form>
                            </ul>
                        </div>
                        <div class="right_part">
                            <div class="shoes_price">₹ <span style="color: #ff4e5b;">{{$item->price}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
            <script>
            $(document).ready(function() {
              // Handle the increment button click event
              $('.increment-btn').click(function() {
                var productId = $(this).data('product-id');
                var quantityInput = $('input[data-product-id="' + productId + '"]');
                var currentValue = parseInt(quantityInput.val());
                quantityInput.val(currentValue + 1);
              });
            
              // Handle the decrement button click event
              $('.decrement-btn').click(function() {
                var productId = $(this).data('product-id');
                var quantityInput = $('input[data-product-id="' + productId + '"]');
                var currentValue = parseInt(quantityInput.val());
                // Check if the current value is already at the minimum value
                if (currentValue > 1) {
                  quantityInput.val(currentValue - 1);
                }
              });
            });
            </script>
            
            
            
            
            
            
            
        <p style="margin-left: 45%">{{$product->links()}}</p>
        </div>
    </div>
</div>
