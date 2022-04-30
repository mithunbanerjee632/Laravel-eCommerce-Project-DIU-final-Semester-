@extends('Frontend.Layout.app')
@section('title','Checkout')
@section('content')

    <div class="container margin-top-10">
        <div class="row">
            <div class="col-md-6">
                <div class="card-header text-center">
                    <h4>Shipping Address</h4><hr><hr>
                </div>
                <div class="card card-body">

                    <form method="POST" name="frm-billing" action="{{ route('checkouts.store') }}" >
                        @csrf

                        <div class="form-group">
                            <label for="name" :value="__('Full Name')">Full Name</label>
                            <input id="name" class="form-control" type="text" name="name" value="{{Auth::check()?Auth::user()->first_name.' '.Auth::user()->last_name:''}}" required autofocus>

                        </div>



                            <input id="user_id" class="form-control hidden" type="text" name="user_id" value="{{Auth::check()?Auth::user()->id:''}}" required autofocus>




                    {{--    <div class="form-group">
                            <label for="last_name" :value="__('last Name')">Last Name</label>
                            <input id="last_name" class="form-control" type="text" name="last_name" value="{{Auth::check()?Auth::user()->last_name:''}}">

                        </div>--}}



                        <div class="form-group">
                            <label  for="email" :value="__('Email')">Email Address</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{Auth::check()?Auth::user()->email:''}}" required>
                        </div>

                        <div class="form-group">
                            <label  for="phone_no" :value="__('Phone Number')">Phone Number<span>*</span></label>
                            <input id="phone_no" class="form-control" type="text" name="phone_no" value="{{Auth::check()?Auth::user()->phone_no:''}}" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="shipping_address">Street Address<span>*</span></label>
                            <textarea class="form-control" name = "shipping_address" id="shipping_address" rows="3" required autofocus></textarea>
                        </div>
{{-- <div class="form-group">
                            <label for="username" :value="__('Username')">Username</label>
                            <input id="username" class="form-control" type="text" name="username" value="{{Auth::check()?Auth::user()->username:''}}" >
                        </div>--}}


                        <div class="form-group mt-2">
                            <label for="division_id" >Division<span>*</span></label>
                            <select class="form-control" name="division_id" required>

                                <option value="">please select your division</option>
                                @foreach($divisions as $division)
                                    <option value="{{$division->id}}" {{$user->division_id == $division->id ? 'selected':''}}>{{$division->name}}</option>
                                @endforeach

                            </select>
                        </div>



                        <div class="form-group mt-2">
                            <label for="district_id" >District<span>*</span></label>
                            <select class="form-control" name="district_id" required>

                                <option value="">please select your District</option>
                                @foreach($districts as $district)
                                    <option value="{{$district->id}}" {{$user->$district == $district->id ? 'selected':''}}>{{$district->name}}</option>
                                @endforeach


                            </select>
                        </div>


                        <div class="form-group">
                            <label for="zipcode">ZIPcode /Post:<span>*</span></label>
                            <input id="zipcode" type="number" class="form-control" name="zipcode" value="" placeholder="Your postal code" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message(Optional)</label>
                            <textarea class="form-control" name="message" id="message" rows="3" ></textarea>
                        </div>


{{--    <div class="form-group">

                            <label for="country">Country:</label>
                            <input id="country" type="text" class="form-control" name="country" value="" placeholder="Bangladesh">
                        </div>
--}}

                        <hr/>
                        <div class="form-group">

{{--<h2 class="text-center">Payment</h2>--}}


                            <label class="" for="district_id" >Please Select a Payment Method:</label>
                            <select class="form-control mt-3" name="payment_method_id" id="payments"  required>
                                <option value="">Please Select a Payment Method</option>
                               @foreach($payments as $payment)
                                <option value="{{$payment->short_name}}">{{$payment->name}}</option>
                                @endforeach
                            </select>

                            @foreach($payments as $payment)

                                <div class=" alert-success text-center m-3" >


                                    @if($payment->short_name == 'cash_in')
                                        <div class="hidden alert alert-success p-2"   id="payment_{{$payment->short_name}}">
                                            <h4> For Cash In there is nothing necessary.Just click Order Now and  Finish the order.</h4><hr>

                                        <br>
                                        <p>You Will get your product into three or five business days</p>

                                    </div>
                                    @else
                                        <div class="hidden alert alert-success p-2"   id="payment_{{$payment->short_name}}">
                                            <h3 class="mt-2">{{$payment->name}} Payment</h3>
                                            <p>
                                                <strong>{{$payment->name}} No: {{$payment->no}}</strong>
                                                <br>
                                                <strong>Account Type: {{$payment->type}}</strong>
                                            </p>
                                            <hr>
                                            <div class="text-center alert aler-success mb-2">
                                                <p>Please Send the above money to the bkash number and write your transaction id</p>
                                            </div>


                                        </div>

                                        @endif
                                </div>
                                @endforeach
                            <input type="text" class="form-control hidden alert alert-success" id="transaction_id" name="transaction_id" placeholder="Enter Transaction Id"/>
                        </div>


                        <div class="form-group row mb-0 text-center ml-5 mt-3">
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
                    <hr/><hr/>
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
        $('#payments').change(function() {
            $payment_method = $('#payments').val();

            if ($payment_method == 'cash_in') {
                $('#payment_cash_in').removeClass('hidden')
                $('#payment_bkash').addClass('hidden')
                $('#payment_rocket').addClass('hidden')

            } else if ($payment_method == 'bkash') {
                $('#payment_bkash').removeClass('hidden')
                $('#payment_cash_in').addClass('hidden')
                $('#payment_rocket').addClass('hidden')
                $('#transaction_id').removeClass('hidden')
            } else if ($payment_method == 'rocket') {
                $('#payment_rocket').removeClass('hidden')
                $('#payment_bkash').addClass('hidden')
                $('#transaction_id').removeClass('hidden')
                $('#payment_cash_in').addClass('hidden')
            }
        });
    </script>

    @endsection
