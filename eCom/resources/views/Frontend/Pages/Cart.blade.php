@extends('Frontend.Layout.app')
@section('title','Cart')
@section('content')


    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="#" class="link">home</a></li>
                    <li class="item-link"><span>login</span></li>
                </ul>
            </div>

            <div class=" main-content-area mb-20">
                <h2 class="text-center ">My Cart Items</h2>

                @if(App\Models\Cart::totalItems() >0)

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Product Title</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product Quantity</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Sub Total Price</th>
                            <th scope="col"> Delete</th>

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
                                    <a href="/ProductDetails/{{$cart->product->slug}}/{{$cart->product->title}}">{{$cart->product->title}}</a>
                                </td>
                                <td>
                                    @if($cart->product->images->count()>0)
                                        <img src="{{asset($cart->product->images->first()->image)}}" width="60px">
                                    @endif
                                </td>
                                <td>
                                    <form class="form-inline" action="{{ route('carts.update',$cart->id) }}" method="post">
                                        @csrf
                                        <input type="number" name="product_quantity" class="form-control" value="{{$cart->product_quantity}}">
                                        <button type="submit" class="btn btn-success ml-2">Update</button>
                                    </form>
                                </td>

                                <td>
                                    {{$cart->product->price}} Taka
                                </td>

                                <td>
                                    @php
                                        $total_price +=  $cart->product->price * $cart->product_quantity;
                                    @endphp
                                    {{$cart->product->price * $cart->product_quantity}} Taka
                                </td>

                                <td>
                                    <form class="form-inline" action="{{route('carts.delete',$cart->id)}}" method="post">
                                        @csrf
                                        <input type="hidden" name="cart_id" class="form-control">
                                        <button type="submit" class="btn btn-delete">  <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach

                        <tr >
                            <td colspan="4"></td>
                            <td>Total Amount:</td>
                            <td colspan="2">
                                <strong>{{$total_price}} Taka</strong>.
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    <div class="summary">
                        <div class="order-summary">
                            <h4 class="title-box">Order Summary</h4>
                            <p class="summary-info"><span class="title">Subtotal</span><b class="index">{{$total_price}} Taka</b> </p>
                            <p class="summary-info"><span class="title">Shipping Cost</span><b class="index">{{App\Models\Setting::first()->shipping_caust}} Taka</b> </p>
                            <p class="summary-info total-info "><span class="title">Total</span><b class="index">{{ $total_price +App\Models\Setting::first()->shipping_caust}} Taka</b> </p>
                        </div>
                        <div class="checkout-info">
                            <label class="checkbox-field">
                                <input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
                            </label>
                            <a class="btn btn-checkout" href="{{route('checkouts')}}">Check out</a>
                            <a class="link-to-shop btn btn-lg btn-info" href="{{url('/ShopPage')}}">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>



                    @else
                    <div class="alert alert-warning mt-5">
                        <h2><strong>There is No cart In Your Items</strong></h2>

                        <br>

                        <div class="checkout-info text-center">
                            <a class="link-to-shop btn btn-lg btn-info " href="{{url('/ShopPage')}}">Shop Now<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    @endif




            </div>

          {{--      <div class="summary">
                    <div class="order-summary">
                        <h4 class="title-box">Order Summary</h4>
                        <p class="summary-info"><span class="title">Subtotal</span><b class="index">{{$total_price}}</b></p>
                        <p class="summary-info"><span class="title">Shipping Cost</span><b class="index">{{App\Models\Setting::first()->shipping_caust}}</b></p>
                        <p class="summary-info total-info "><span class="title">Total</span><b class="index">{{ $total_price +App\Models\Setting::first()->shipping_caust}}</b></p>
                    </div>
                    <div class="checkout-info">
                        <label class="checkbox-field">
                            <input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
                        </label>
                        <a class="btn btn-checkout" href="{{route('checkouts')}}">Check out</a>
                        <a class="link-to-shop btn btn-lg btn-info" href="{{url('/ShopPage')}}">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                    </div>
                    <div class="update-clear">
                        <a class="btn btn-clear" href="--}}{{--/carts/update/{{$cart->id}}--}}{{--">Clear Shopping Cart</a>
                        <a class="btn btn-update" href="--}}{{--{{url('/carts/delete/{id}',$cart->id)}}--}}{{--">Update Shopping Cart</a>
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
