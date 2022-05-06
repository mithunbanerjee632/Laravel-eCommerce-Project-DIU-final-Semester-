<html>
<head>
    <title>Invoice - {{ $order->id }}</title>

    <link rel="stylesheet" href="{{asset('assets/css/admin_style.css')}}">
    <style>
        .content-wrapper{
            background: #FFF;
        }
        .invoice-header {
            background: #f7f7f7;
            padding: 10px 20px 10px 20px;
            border-bottom: 1px solid gray;
        }
        .invoice-right-top h3 {
            padding-right: 20px;
            margin-top: 20px;
            color: #ec5d01;
            font-size: 55px!important;
            font-family: serif;
        }
        .invoice-left-top {
            border-left: 4px solid #ec5d00;
            padding-left: 20px;
            padding-top: 20px;
        }
        thead {
            background: #ec5d01;
            color: #FFF;
        }

        .authority h5 {
            margin-top: -10px;
            color: #ec5d01;
            /*text-align: center;*/
        }
        .thanks h4 {
            color: #ec5d01;
            font-size: 25px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
        .site-address p {
            line-height: 6px;
            font-weight: 300;
        }
    </style>
</head>
<body>

<div class="content-wrapper">

    <div class="invoice-header">
        <div class="float-left site-logo">
            <img src="{{ asset('images/favicon.png') }}" alt="brandlogo">
        </div>
        <div class="float-right site-address">
            <h4>Multi Vendor Store</h4>
            <p>West Dholairpar, Jatrabari, Dhaka-1204</p>
            <p>Phone: <a href="">01713574869</a></p>
            <p>Email: <a href="mailto:info@laraecommerce.com">info@multivendorstore.com</a></p>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="invoice-description">
        <div class="invoice-left-top float-left">
            <h6>Invoice to</h6>
            <h3>{{ $order->name }}</h3>
            <div class="address">
                <p>
                    <strong>Address: </strong>
                    {{ $order->shipping_address }}
                </p>
                <p>Phone: {{ $order->phone_no }}</p>
                <p>Email: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
            </div>
        </div>
        <div class="invoice-right-top float-right">
            <h3>Invoice #{{ $order->id }}</h3>
            <p>
                {{ $order->created_at }}
            </p>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="">

        <h3>Products</h3>

        @if($order->carts->count() >0)

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
                @foreach($order->carts as $cart)
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
                <tr>
                    <td colspan="3"></td>
                    <td>
                        Discount:
                    </td>
                    <td colspan="2">
                        <strong>  {{ $order->custom_discount }} Taka</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>
                        Shipping Cost:
                    </td>
                    <td colspan="2">
                        <strong>  {{ $order->shipping_charge }} Taka</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>
                        Total Amount:
                    </td>
                    <td colspan="2">
                        <strong>  {{ $total_price + $order->shipping_charge - $order->custom_discount }} Taka</strong>
                    </td>
                </tr>
                </tbody>
            </table>
        @endif

        <div class="thanks mt-3">
            <h4>Thank You for Order and Stay With Us !!</h4>
        </div>

        <div class="authority float-right mt-5">
            <p>-----------------------------------</p>
            <h5>Authority Signature:</h5>
        </div>
        <div class="clearfix"></div>

    </div>

</body>
</html>
