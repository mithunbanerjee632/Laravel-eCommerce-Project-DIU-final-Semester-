@extends('Frontend.Layout.app')
@section('title','Product Details')

@section('content')

    <main id="main" class="main-site">

        <div class="container product_data">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{'/'}}" class="link">home</a></li>
                    <li class="item-link"><span>detail</span></li>
                </ul>
            </div>
            <div class="row">
            @foreach($products as $product)
                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                    <div class="wrap-product-detail">
                        <div class="detail-media">

                            @foreach($product->images as $image)

                            <div class="product-gallery">

                                <ul class="slides ">
                                    <li data-thumb="{{asset($image->image)}}">
                                        <img src="{{asset($image->image)}}" alt="product thumbnail" />
                                    </li>

                                </ul>

                            </div>


                            @endforeach
                        </div>

                        <div class="detail-info">
                            <div class="product-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <a href="#" class="count-review">(05 review)</a>
                            </div>
                            <h2 class="product-name">{{$product->title}}</h2>
                            <div class="short-desc">
                                <ul>
                                    <li>{{$product->description}}</li>
                                    <li>Dual-core A7 with quad-core graphics</li>
                                    <li>FaceTime HD Camera 7.0 MP Photos</li>
                                </ul>
                            </div>
                            <div class="wrap-social">
                                <a class="link-socail" href="#"><img src="{{asset('assets/images/social-list.png')}}" alt=""></a>
                            </div>
                            <div class="wrap-price"><span class="product-price">{{$product->price}}</span></div>
                            <div class="stock-info in-stock">
                                <p class="availability">Availability: <b>{{$product->quantity > 0 ?'Item in stock ': $product->quantity.'No Item is available '}}</b></p>
                            </div>

                            <div class="quantity">
                                <span>Quantity:</span>
                                <form action="{{route('carts.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                <div class="quantity-input">
                                    <input type="text" name="product_quatity" value="1" data-max="120" pattern="[0-9]*" >

                                    <a class="btn btn-reduce" href="#"></a>
                                    <a class="btn btn-increase" href="#"></a>
                                </div>
                            </div>

                            <div class="wrap-butons">


                                    <input type="hidden" class="prod_id" name="product_id" value="{{$product->id}}">
                                    <button class="btn btn-block add-to-cart">Add to Cart</button>
                                </form>
                               {{-- <a href="{{route('carts.store')}}" class="btn add-to-cart">Add to Cart</a>--}}
                                <div class="wrap-btn">
                                    <input type="hidden" id="prod_id" class="prod_id" name="product_id" value="{{$product->id}}">
                                    <a href="#" class="btn btn-compare">Add Compare</a>
                                    <a href="{{--{{url('/')}}--}}" class="btn btn-wishlist addToWishlist">Add Wishlist</a>
                                </div>
                            </div>
                        </div>
                        <div class="advance-info">
                            <div class="tab-control normal">
                                <a href="#description" class="tab-control-item active">description</a>
                                <a href="#add_infomation" class="tab-control-item">Addtional Infomation</a>
                                <a href="#review" class="tab-control-item">Reviews</a>
                            </div>
                            <div class="tab-contents">
                                <div class="tab-content-item active" id="description">
                                    <p>{{$product->description}}</p>

                                </div>
                                <div class="tab-content-item " id="add_infomation">
                                    <table class="shop_attributes">
                                        <tbody>
                                        <tr>
                                            <th>Weight</th><td class="product_weight">1 kg</td>
                                        </tr>
                                        <tr>
                                            <th>Dimensions</th><td class="product_dimensions">12 x 15 x 23 cm</td>
                                        </tr>
                                        <tr>
                                            <th>Color</th><td><p>Black, Blue, Grey, Violet, Yellow</p></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-content-item " id="review">

                                    <div class="wrap-review-form">

                                        <div id="comments">
                                            <h2 class="woocommerce-Reviews-title">01 review for <span>Radiant-360 R6 Chainsaw Omnidirectional [Orage]</span></h2>
                                            <ol class="commentlist">
                                                <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
                                                    <div id="comment-20" class="comment_container">
                                                        <img alt="" src="{{asset('assets/images/author-avata.jpg')}}" height="80" width="80">
                                                        <div class="comment-text">
                                                            <div class="star-rating">
                                                                <span class="width-80-percent">Rated <strong class="rating">5</strong> out of 5</span>
                                                            </div>
                                                            <p class="meta">
                                                                <strong class="woocommerce-review__author">admin</strong>
                                                                <span class="woocommerce-review__dash">???</span>
                                                                <time class="woocommerce-review__published-date" datetime="2008-02-14 20:00" >Tue, Aug 15,  2017</time>
                                                            </p>
                                                            <div class="description">
                                                                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ol>
                                        </div><!-- #comments -->

                                        <div id="review_form_wrapper">
                                            <div id="review_form">
                                                <div id="respond" class="comment-respond">

                                                    <form action="#" method="post" id="commentform" class="comment-form" novalidate="">
                                                        <p class="comment-notes">
                                                            <span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>
                                                        </p>
                                                        <div class="comment-form-rating">
                                                            <span>Your rating</span>
                                                            <p class="stars">

                                                                <label for="rated-1"></label>
                                                                <input type="radio" id="rated-1" name="rating" value="1">
                                                                <label for="rated-2"></label>
                                                                <input type="radio" id="rated-2" name="rating" value="2">
                                                                <label for="rated-3"></label>
                                                                <input type="radio" id="rated-3" name="rating" value="3">
                                                                <label for="rated-4"></label>
                                                                <input type="radio" id="rated-4" name="rating" value="4">
                                                                <label for="rated-5"></label>
                                                                <input type="radio" id="rated-5" name="rating" value="5" checked="checked">
                                                            </p>
                                                        </div>
                                                        <p class="comment-form-author">
                                                            <label for="author">Name <span class="required">*</span></label>
                                                            <input id="author" name="author" type="text" value="">
                                                        </p>
                                                        <p class="comment-form-email">
                                                            <label for="email">Email <span class="required">*</span></label>
                                                            <input id="email" name="email" type="email" value="" >
                                                        </p>
                                                        <p class="comment-form-comment">
                                                            <label for="comment">Your review <span class="required">*</span>
                                                            </label>
                                                            <textarea id="comment" name="comment" cols="45" rows="8"></textarea>
                                                        </p>
                                                        <p class="form-submit">
                                                            <input name="submit" type="submit" id="submit" class="submit" value="Submit">
                                                        </p>
                                                    </form>

                                                </div><!-- .comment-respond-->
                                            </div><!-- #review_form -->
                                        </div><!-- #review_form_wrapper -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end main products area-->
                @endforeach


                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                    <div class="widget widget-our-services ">
                        <div class="widget-content">
                            <ul class="our-services">

                                <li class="service">
                                    <a class="link-to-service" href="#">
                                        <i class="fa fa-truck" aria-hidden="true"></i>
                                        <div class="right-content">
                                            <b class="title">Free Shipping</b>
                                            <span class="subtitle">On Oder Over $99</span>
                                            <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                        </div>
                                    </a>
                                </li>

                                <li class="service">
                                    <a class="link-to-service" href="#">
                                        <i class="fa fa-gift" aria-hidden="true"></i>
                                        <div class="right-content">
                                            <b class="title">Special Offer</b>
                                            <span class="subtitle">Get a gift!</span>
                                            <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                        </div>
                                    </a>
                                </li>

                                <li class="service">
                                    <a class="link-to-service" href="#">
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                        <div class="right-content">
                                            <b class="title">Order Return</b>
                                            <span class="subtitle">Return within 7 days</span>
                                            <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- Categories widget-->
               {{--     @include('Frontend.Shop.popular')--}}

                    <div class="widget mercado-widget widget-product">
                        <h2 class="widget-title">Popular Products</h2>
                        <div class="widget-content">
                            <ul class="products">
                             @foreach($populars as $products)
                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        @foreach($products->images as $image)
                                        <div class="thumbnnail">
                                            <a href="/ProductDetails/{{$product->slug}}/{{$product->title}}" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="{{asset($image->image)}}" alt=""></figure>
                                            </a>
                                        </div>
                                        @endforeach
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>{{$products->title}}</span></a>
                                            <div class="wrap-price"><span class="product-price">{{$products->price}}</span></div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                </div><!--end sitebar-->



                <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wrap-show-advance-info-box style-1 box-in-site">
                        <h3 class="title-box">Related Products</h3>
                        <div class="wrap-products">
                            <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
                              @foreach($relatedPro as $product)
                                <div class="product product-style-2 equal-elem ">
                                    @foreach($product->images as $image)
                                    <div class="product-thumnail">
                                        <a href="" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                            <figure><img src="{{asset($image->image)}}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item new-label">new</span>
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="#" class="function-link">quick view</a>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="product-info">
                                        <a href="#" class="product-name"><span>{{$product->title}}</span></a>
                                        <div class="wrap-price"><span class="product-price">{{$product->price}}</span></div>
                                    </div>
                                </div>
                                @endforeach

                               {{-- <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
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
                                        <a href="" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
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
                                        <a href="" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
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
                                        <a href="" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
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
                                        <a href="" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
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
                                        <a href="" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
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
                                        <a href="" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
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

                            </div>--}}
                        </div><!--End wrap-products-->
                    </div>
                </div>

            </div><!--end row-->

        </div><!--end container-->

    </main>


@endsection
@section('script')
    <script type="text/javascript">
        $('.addToWishlist').click(function(e){
            e.preventDefault();
            var product_id = $('#prod_id').val();

           /* var product_id = $(this).closest('.product_data').find('prod_id').val();*/
         /*   var product_id = $('prod_id').val();*/

            /* $.ajax({
                 method: 'POST',
                 url:'/AddToWishlist',
                 data:{
                     'product_id':product_id,
                 },
                 success:function(response){
                    swal(response.status);
                 },

             });*/
            WishlistAdd(product_id)
        });


        function WishlistAdd(product_id){
            $('.addToWishlist').html('Add to Wishlist');
            axios.post('/AddToWishlist',{
                product_id:product_id
            }).then(function(response){
                if(response.status ==200){
                    if(response.data ==1){
                        $('.addToWishlist').html('Product Added to Wishlist');
                    }else{
                        $('.addToWishlist').html('Product Not Added to Wishlist');
                    }


                }else{
                    $('.addToWishlist').html('Somethingn Went Wrong');

                }
            }).catch(function(error){
                $('.addToWishlist').html('Somethingn Went Wrong');

            });
        }
    </script>
@endsection
