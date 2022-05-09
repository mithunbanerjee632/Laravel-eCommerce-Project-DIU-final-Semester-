@extends('Frontend.Layout.app')
@section('title','Cart')
@section('content')


    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">
           {{-- @if(Session::has('success'))
                <p class="text-success ">{{Session::get('success')}}</p>
            @endif--}}

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="#" class="link">home</a></li>
                    <li class="item-link"><span>login</span></li>
                </ul>
                <h2 class="text-center ">My Wishlist Items</h2>
            </div>

            <div class=" main-content-area mb-20">


                @if($wishlist->count() >0)


                  {{--  @if(App\Models\Cart::totalItems() >0)--}}

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Product Title</th>
                                <th scope="col">Product Image</th>

                                <th scope="col">Price</th>
                                <th scope="col"></th>

                                <th scope="col"> Delete</th>

                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total_price =0;
                            @endphp
                            @foreach($wishlist as $wish)
                                <tr >
                                    <th scope="row">{{$loop->index +1}}</th>
                                    <td>
                                        <a href="/ProductDetails/{{$wish->product->slug}}/{{$wish->product->title}}">{{$wish->product->title}}</a>
                                    </td>
                                    <td>
                                        @if($wish->product->images->count()>0)
                                            <img src="{{asset($wish->product->images->first()->image)}}" width="60px">
                                        @endif
                                    </td>


                                    <td>
                                        {{$wish->product->price}} Taka
                                    </td>

                                      <td>
                                        <form action="{{route('carts.store')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$wish->product->id}}">
                                            <button class="btn btn-danger" >Add to Cart</button>
                                            {{--  <a href="/carts/store/{{$product->id}}" class="btn add-to-cart">Add To Cart</a>--}}

                                        </form>
                                      </td>




                                    <td>
                                        <form class="form-inline" action="{{route('wishlist.delete',$wish->id)}}" method="post">
                                            @csrf
                                            <input type="hidden" name="cart_id" class="form-control">
                                            <button type="submit" class="btn btn-delete">  <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>

                @else
                    <h3 class="text-center"> There is No Item In Your Wishlist</h3>
                @endif

                    </div>


        </div><!--end container-->

    </main>

@endsection



