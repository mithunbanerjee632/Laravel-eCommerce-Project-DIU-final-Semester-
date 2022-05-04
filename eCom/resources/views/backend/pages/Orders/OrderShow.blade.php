{{-- Include Master Layout --}}

@extends('Backend.layout.app')

{{-- Browser Title --}}

@section('title','orders')


{{-- Page Title --}}

@section('page-heading')

@endsection
@section('main-content')
    <div id="" class="container">
        <div class="row">
            <div class="col-9">
                <h2>View Order <span class="text-black-50">#MVS{{$order->id}}</span></h2>
            </div>

            @if(Session::has('success'))
                <p class="text-success">{{Session::get('success')}}</p>
            @endif


            <div class="col-12">
                <hr class="mt-4 mb-4">
            </div>

            <div class="card card-body">
                <h3>Order Information</h3>


           <div class="row">
            <div class="col-md-6 p-5 border-right">
                <p><strong>Orderer Name:</strong>{{$order->name}}</p>
                <p><strong>Orderer Phone:</strong>{{$order->phone_no}}</p>
                <p><strong>Orderer Email:</strong>{{$order->email}}</p>
                <p><strong>Orderer Shipping Address:</strong>{{$order->shipping_address}}</p>

            </div>
            <div class="col-md-6 p-5">
                <p><strong>Order Payment Method:</strong>{{$order->payment->name}}</p>
                <p><strong>Order Transaction Id:</strong>{{$order->transaction_id}}</p>

            </div>
           </div>
                <hr>
                <div class=" main-content-area mb-20">
                <h3 class="text-center">Ordered Items</h3>

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

                        <tr >
                            <td colspan="4"></td>
                            <td>Total Amount:</td>
                            <td colspan="2">
                                <strong>{{$total_price}}</strong>.
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    @endif

                    <hr>
                    <form action="{{route('admin.orders.complete',$order->id)}}" class="form-inline" style="display: inline-block!important;" method="POST">
                        @csrf

                        @if($order->is_completed)
                        <input type="submit" class="btn btn-danger" value="Cancel Order">
                        @else
                            <input type="submit" class="btn btn-success" value="Complete Order">
                        @endif
                    </form>
                    <form action="{{route('admin.orders.paid',$order->id)}}" class="form-inline" style="display: inline-block!important;" method="POST">
                        @csrf

                        @if($order->is_paid)
                            <input type="submit" class="btn btn-danger" value="Cancel Payment">
                        @else
                            <input type="submit" class="btn btn-success" value="Paid Order">
                        @endif

                    </form>
                </div>

            </div>
        </div>

    </div>
    </div>
@endsection



@section('script')
    <script type="text/javascript">
        /*  $(document).ready(function() {
          $('#dataTable').DataTable();
          } );*/
        $(document).ready(function(){

            $('#OrderPagedataTable').dataTable({"order":false});
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endsection

