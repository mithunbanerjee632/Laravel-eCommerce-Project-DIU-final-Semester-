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

            <div class=" main-content-area">
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
                                   <a href="/ProductDetails/{{$cart->product->slug}}">{{$cart->product->title}}</a>
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
                               <strong>{{$total_price}}</strong>.
                           </td>
                       </tr>


                    </tbody>
                </table>

              {{--  <div class="pull-right mt-5">
                    <a href="{{url('/ShopPage')}}" class="btn btn-info btn-lg ">Continue Shopping...</a>
                    <a href="{{route('checkouts')}}" class="btn btn-danger btn-lg ">Checkout</a>
                </div>--}}
            </div>
     {{--       <div class=" main-content-area">

                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">Products Name</h3>
                    <ul class="products-cart">
                        <li class="pr-cart-item">
                            <div class="product-image">
                                <figure><img src="assets/images/products/digital_18.jpg" alt=""></figure>
                            </div>
                            <div class="product-name">
                                <a class="link-to-product" href="#">Radiant-360 R6 Wireless Omnidirectional Speaker [White]</a>
                            </div>
                            <div class="price-field produtc-price"><p class="price">$256.00</p></div>
                            <div class="quantity">
                                <div class="quantity-input">
                                    <input type="text" name="product-quatity" value="1" data-max="120" pattern="[0-9]*" >
                                    <a class="btn btn-increase" href="#"></a>
                                    <a class="btn btn-reduce" href="#"></a>
                                </div>
                            </div>
                            <div class="price-field sub-total"><p class="price">$256.00</p></div>
                            <div class="delete">
                                <a href="#" class="btn btn-delete" title="">
                                    <span>Delete from your cart</span>
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                        <li class="pr-cart-item">
                            <div class="product-image">
                                <figure><img src="assets/images/products/digital_20.jpg" alt=""></figure>
                            </div>
                            <div class="product-name">
                                <a class="link-to-product" href="#">Radiant-360 R6 Wireless Omnidirectional Speaker [White]</a>
                            </div>
                            <div class="price-field produtc-price"><p class="price">$256.00</p></div>
                            <div class="quantity">
                                <div class="quantity-input">
                                    <input type="text" name="product-quatity" value="1" data-max="120" pattern="[0-9]*">
                                    <a class="btn btn-increase" href="#"></a>
                                    <a class="btn btn-reduce" href="#"></a>
                                </div>
                            </div>
                            <div class="price-field sub-total"><p class="price">$256.00</p></div>
                            <div class="delete">
                                <a href="#" class="btn btn-delete" title="">
                                    <span>Delete from your cart</span>
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
--}}
                <div class="summary">
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
                        <a class="btn btn-clear" href="{{--/carts/update/{{$cart->id}}--}}">Clear Shopping Cart</a>
                        <a class="btn btn-update" href="{{--{{url('/carts/delete/{id}',$cart->id)}}--}}">Update Shopping Cart</a>
                    </div>
                </div>

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
