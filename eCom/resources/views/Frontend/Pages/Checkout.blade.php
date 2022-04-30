@extends('Frontend.Layout.app')
@section('title','Checkout')
@section('content')

    <div class="container margin-top-10">
        <div class="row">
            <div class="col-md-6">
                <div class="card-header text-center">
                    <h4>Shipping Address</h4>
                </div>
                <div class="card card-body">

                    <form method="POST" name="frm-billing" action="{{--{{ route('users.profile.update') }}--}}" >
                        @csrf

                        <div class="form-group">
                            <label for="first_name" :value="__('First Name')">First Name</label>
                            <input id="first_name" class="form-control" type="text" name="first_name" value="{{Auth::check()?Auth::user()->first_name:''}}" required autofocus>

                        </div>


                        <div class="form-group">
                            <label for="last_name" :value="__('last Name')">Last Name</label>
                            <input id="last_name" class="form-control" type="text" name="last_name" value="{{Auth::check()?Auth::user()->last_name:''}}" required autofocus>

                        </div>

                        <div class="form-group">
                            <label for="username" :value="__('Username')">Username</label>
                            <input id="username" class="form-control" type="text" name="username" value="{{Auth::check()?Auth::user()->username:''}}" required>
                        </div>

                        <div class="form-group">
                            <label  for="email" :value="__('Email')">Email Address</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{Auth::check()?Auth::user()->email:''}}" required>
                        </div>

                        <div class="form-group">
                            <label  for="phone_no" :value="__('Phone Number')">Phone Number</label>
                            <input id="phone_no" class="form-control" type="text" name="phone_no" value="{{Auth::check()?Auth::user()->phone_no:''}}" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="street_address">Street Address</label>
                            <textarea class="form-control" id="street_address" rows="3"></textarea>
                        </div>

                        <div class="form-group mt-2">
                            <label for="division_id" >Division</label>
                            <select class="form-control" name="division_id">

                                <option value="">please select your division</option>
                                @foreach($divisions as $division)
                                    <option value="{{$division->id}}" {{$user->division_id == $division->id ? 'selected':''}}>{{$division->name}}</option>
                                @endforeach

                            </select>
                        </div>



                        <div class="form-group mt-2">
                            <label for="district_id" >District</label>
                            <select class="form-control" name="district_id">

                                <option value="">please select your District</option>
                                @foreach($districts as $district)
                                    <option value="{{$district->id}}" {{$user->$district == $district->id ? 'selected':''}}>{{$district->name}}</option>
                                @endforeach


                            </select>
                        </div>


                        <div class="form-group">
                            <label for="zipcode">ZIPcode /Post:</label>
                            <input id="zipcode" type="number" class="form-control" name="zipcode" value="" placeholder="Your postal code" required>
                        </div>

                        <div class="form-group">

                            <label for="country">Country:</label>
                            <input id="country" type="text" class="form-control" name="country" value="" placeholder="Bangladesh">
                        </div>

                        <hr/>
                        <div class="form-group">
                            {{--<h2 class="text-center">Payment</h2>--}}

                            <label class="" for="district_id" >Please Select a Payment Method:</label>
                            <select class="form-control mt-3" name="payment_method_id required">
                                <option value="">Please Select a Payment Method</option>
                               @foreach($payments as $payment)
                                <option value="{{$payment->id}}">{{$payment->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group row mb-0 text-center ml-5">
                            <div class=" offset-md-4 ">
                                <button type="submit" class="btn btn-danger">
                                    Order Now
                                </button>
                            </div>
                        </div>

                        <hr/>


                    </form>

                    </div>

            </div>
            <div class="col-md-1"></div>

            <div class="col-md-5">
                <div class="card card-body text-center">
                    <h4>Confirm Items</h4>
                    <hr/>
                   {{-- @foreach(App\Models\Cart::totalCarts() as $cart)
                        <p>
                            {{$cart->product->title}}-
                            <strong> {{$cart->product->price}} Taka</strong> -

                            {{$cart->product_quantity}} item
                        </p>
                    @endforeach--}}




                   <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Product Title</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Sub Total Price</th>

                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total_price =0;
                        @endphp
                        @foreach(App\Models\Cart::totalCarts() as $cart)
                            <tr >
                                <th scope="row">{{$loop->index +1}}</th>
                                <td>
                                    <a href="/ProductDetails/{{$cart->product->slug}}">{{$cart->product->title}}</a>
                                </td>

                                <td>
                                    {{$cart->product->price}} Taka
                                </td>
                                <td> {{$cart->product_quantity}} item</td>

                                <td>
                                    @php
                                        $total_price +=  $cart->product->price * $cart->product_quantity;
                                    @endphp
                                    {{$cart->product->price * $cart->product_quantity}} Taka
                                </td>


                            </tr>

                        @endforeach
                        <tr >
                            <td colspan="3"></td>
                            <td>Total :</td>
                            <td colspan="2">
                                <strong>{{ $total_price}} </strong> Taka
                            </td>
                        </tr>
                        <tr >
                            <td colspan="3"></td>
                            <td>Shipping Cost :</td>
                            <td colspan="2">
                                <strong>{{App\Models\Setting::first()->shipping_caust}} </strong> Taka
                            </td>
                        </tr>

                        <tr >
                            <td colspan="3"></td>
                            <td>Total Amount :</td>
                            <td colspan="2">
                                <strong>{{ $total_price +App\Models\Setting::first()->shipping_caust}} </strong>Taka
                            </td>
                        </tr>


                        </tbody>

                    </table>

                  <div class="form-group row mb-0 text-center ml-5">
                        <div class=" offset-md-4 ">

                            <a href="{{url('CartPage')}}" class="btn btn-danger">Change Cart Items</a>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    {{--<main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{url('/')}}" class="link">home</a></li>
                    <li class="item-link"><a href="{{ route('login') }}" class="link">login</a></li>
                </ul>
            </div>
            <div class=" main-content-area">
                <div class="wrap-address-billing">
                    <h3 class="box-title">Shipping Address</h3>
                    <form action="#" method="post" name="frm-billing">
                        @csrf
                        <p class="row-in-form">
                            <label for="fname">First Name<span>*</span></label>
                            <input id="fast_name" type="text" name="first_name" value="" placeholder="Your name">
                        </p>
                        <p class="row-in-form">
                            <label for="lname">Last Name<span>*</span></label>
                            <input id="last_name" type="text" name="last_name" value="" placeholder="Your last name">
                        </p>
                        <p class="row-in-form">
                            <label for="email">Email Addreess:</label>
                            <input id="email" type="email" name="email" value="" placeholder="Type your email">
                        </p>
                        <p class="row-in-form">
                            <label for="phone">Phone number<span>*</span></label>
                            <input id="phone_no" type="number" name="phone_no" value="" placeholder="11 digits format">
                        </p>
                        <p class="row-in-form">
                            <label for="add">Address:</label>
                            <input id="adddress" type="text" name="address" value="" placeholder="Street at apartment number">
                        </p>
                        <p class="row-in-form">
                            <label for="city">Town / City<span>*</span></label>
                            <input id="city" type="text" name="city" value="" placeholder="City name">
                        </p>

                            <div class="form-group">
                                <label for="division_id" class="col-md-4 col-form-label text-md-right">
                                    <select class="form-control" name="division_id">
                                        <option value="please select your division"></option>
                                      --}}{{--  @foreach($divisions as $division)
                                        <option value="{{$division->id}}">{{$division->name}}</option>
                                        @endforeach--}}{{--

                                    </select>
                                </label>
                            </div>
                         --}}{{--<p class="row-in-form">
                            <label for="city">Division<span>*</span></label>
                            <input id="city" type="text" name="division" value="" placeholder="Division name">
                        </p>--}}{{--


                        <p class="row-in-form">
                            <label for="zip-code">Postcode / ZIP:</label>
                            <input id="zip-code" type="number" name="zip-code" value="" placeholder="Your postal code">
                        </p>


                        <p class="row-in-form">
                            <label for="country">Country<span>*</span></label>
                            <input id="country" type="text" name="country" value="" placeholder="Bangladesh">
                        </p>

                        <p class="row-in-form fill-wife">
                            <label class="checkbox-field">
                                <input name="create-account" id="create-account" value="forever" type="checkbox">
                                <span>Create an account?</span>
                            </label>
                            <label class="checkbox-field">
                                <input name="different-add" id="different-add" value="forever" type="checkbox">
                                <span>Ship to a different address?</span>
                            </label>
                        </p>
                    </form>
                </div>--}}
              {{--  <div class="summary summary-checkout">
                    <div class="summary-item payment-method">
                        <h4 class="title-box">Payment Method</h4>
                        <p class="summary-info"><span class="title">Check / Money order</span></p>
                        <p class="summary-info"><span class="title">Credit Cart (saved)</span></p>
                        <div class="choose-payment-methods">
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-bank" value="bank" type="radio">
                                <span>Direct Bank Transder</span>
                                <span class="payment-desc">But the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</span>
                            </label>
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-visa" value="visa" type="radio">
                                <span>visa</span>
                                <span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
                            </label>
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio">
                                <span>Paypal</span>
                                <span class="payment-desc">You can pay with your credit</span>
                                <span class="payment-desc">card if you don't have a paypal account</span>
                            </label>
                        </div>
                        <p class="summary-info grand-total"><span>Grand Total</span> <span class="grand-total-price">$100.00</span></p>
                        <a href="thankyou.html" class="btn btn-medium">Place order now</a>
                    </div>
                    <div class="summary-item shipping-method">
                        <h4 class="title-box f-title">Shipping method</h4>
                        <p class="summary-info"><span class="title">Flat Rate</span></p>
                        <p class="summary-info"><span class="title">Fixed $50.00</span></p>
                        <h4 class="title-box">Discount Codes</h4>
                        <p class="row-in-form">
                            <label for="coupon-code">Enter Your Coupon code:</label>
                            <input id="coupon-code" type="text" name="coupon-code" value="" placeholder="">
                        </p>
                        <a href="#" class="btn btn-small">Apply</a>
                    </div>
                </div>--}}

                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Most Viewed Products</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_17.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item sale-label">sale</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_15.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                        <span class="flash-item sale-label">sale</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_01.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item bestseller-label">Bestseller</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_21.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_03.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item sale-label">sale</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_05.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item bestseller-label">Bestseller</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>
                        </div>
                    </div><!--End wrap-products-->
                </div>

            </div><!--end main content area-->
        </div><!--end container-->

    </main>

@endsection

@section('script')
    <script type="text/javascript">
        $().change(function(){

        });
    </script>

    @endsection
