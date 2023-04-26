<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
    integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
</script>

<style>
    .container {
        max-width: 960px;
    }

    .lh-condensed {
        line-height: 1.25;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="container">

    <div class="py-5 text-center">
        <a href="{{ route('showcart') }}" class="btn btn-info" style="margin-right: 1000px "><i class="fa fa-arrow-left"
                aria-hidden="true"></i> Back</a>
        {{-- <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> --}}
        <h2>CONFIRM ORDER</h2>
        @if (session()->has('message'))
            <p class="alert-success"> {{ session()->get('message') }}
            <p>
        @endif

        @if (session()->has('alert'))
            <p class="alert-danger"> {{ session()->get('alert') }}
            <p>
        @endif

    </div>
    <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">MY BALANCE</span>

        </h4>
        <ul class="list-group mb-3 sticky-top">







            <li class="list-group-item d-flex justify-content-between">
                <span>Total Balance</span>

                <strong>₹{{ $showwallet }}
                </strong>

            </li>
        </ul>

    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>

            </h4>
            <ul class="list-group mb-3 sticky-top">
                @php
                    $price = 0;
                @endphp
                @foreach ($cart as $carts)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>

                            <h6 class="my-0">{{ $carts->productname }}</h6>
                            <small style="margin-right: 15px" class="text-muted">{{ $carts->description }}</small>

                            <small class="text-muted"><img src="/productimages/{{ $carts->image }}" height="120px"
                                    width="100px" alt="">
                            </small>
                            <p class="text-muted" style="font-size: 13px">Quantity: {{ $carts->quantity }} pcs</p>

                            @php
                                $price = $carts->price * $carts->quantity;
                            @endphp
                            <span class="text-muted">₹{{ $price }}</span>
                        </div>

                    </li>
                @endforeach


                @php
                    $sum = 0;
                @endphp

                @foreach ($cart as $carts)
                    @php
                        $sum += $carts->price * $carts->quantity;
                        // $total=$sum*$carts->quantity
                    @endphp
                @endforeach


                <li class="list-group-item d-flex justify-content-between">
                    <span>Total Price</span>
                    <strong>₹
                        {{ $sum }}</strong>
                </li>
            </ul>

        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form method="post" enctype="multipart/form-data" action="{{ route('placeorder') }}">
                @csrf

                <div class="mb-3">
                    <label for="email">Name</label>
                    <input type="text" class="form-control" id="email" value="" name="name" required>

                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="" name="email" required>

                </div>



                <div class="mb-3">
                    <label for="email">Phone No.</label>
                    <input type="number" class="form-control" id="email" value="" name="phone" required>

                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter Your Address"
                        required="" name="address">

                </div>

                <div class="row">


                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip Code</label>
                        <input type="text" class="form-control" id="zip" placeholder="" required=""
                            name="zipcode" onblur="getCityStateCountry(this.value)">

                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="zip">City</label>
                        <input type="text" class="form-control" id="city" required="" name="city"
                            placeholder="city">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="zip">State</label>
                        <input type="text" class="form-control" id="state" required="" name="state"
                            placeholder="state">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="zip">Country</label>
                        <input type="text" class="form-control" id="country" required="" name="country"
                            placeholder="country">
                    </div>


                  


                </div>












                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Place Order</button>
            </form>
        </div>
    </div>

</div>


{{-- zipcode ajax --}}
<script>
    function getCityStateCountry(zipcode) {
        fetch(`https://api.postalpincode.in/pincode/${zipcode}`)
            .then(response => response.json())
            .then(data => {
                const address = data[0].PostOffice[0];
                document.getElementById('city').value = address.Block;
                document.getElementById('state').value = address.State;
                document.getElementById('country').value = 'India';
            })
            .catch(error => console.error(error));
    }
</script>
