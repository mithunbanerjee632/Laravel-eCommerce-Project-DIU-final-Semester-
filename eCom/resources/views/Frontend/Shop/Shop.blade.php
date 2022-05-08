@extends('Frontend.Layout.app')
@section('title','Shop')
@section('content')


    <main id="main" class="main-site left-sidebar">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="#" class="link">home</a></li>
                    <li class="item-link"><span>Digital & Electronics</span></li>
                </ul>
            </div>
            <div class="row">

                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                    @foreach($banners as $banner)
                    <div class="banner-shop">
                        <a href="#" class="banner-link">
                            <figure><img src="{{asset('assets/images/'.$banner->image)}}" alt=""></figure>
                        </a>
                    </div>
                    @endforeach

                    <div class="wrap-shop-control">

                        <h1 class="shop-title">Digital & Electronics</h1>

                        <div class="wrap-right">

                            <div class="sort-item orderby ">
                                <select name="orderby" class="use-chosen" >
                                    <option value="menu_order" selected="selected">Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </div>

                            <div class="sort-item product-per-page">
                                <select name="post-per-page" class="use-chosen" >
                                    <option value="12" selected="selected">12 per page</option>
                                    <option value="16">16 per page</option>
                                    <option value="18">18 per page</option>
                                    <option value="21">21 per page</option>
                                    <option value="24">24 per page</option>
                                    <option value="30">30 per page</option>
                                    <option value="32">32 per page</option>
                                </select>
                            </div>

                            <div class="change-display-mode">
                                <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                                <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                            </div>

                        </div>

                    </div><!--end wrap shop control-->

                    <div class="row">

                        <ul class="product-list grid-products equal-container">
                            @foreach($products as $product)
                            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                <div class="product product-style-3 equal-elem ">
                                    @foreach($product->images as $image )
                                    <div class="product-thumnail">
                                        <a href="/ProductDetails/{{$product->slug}}/{{$product->title}}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                            <figure><img src="{{asset($image->image)}}" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                        </a>
                                    </div>
                                    @endforeach
                                    <div class="product-info">
                                        <a href="/ProductDetails/{{$product->slug}}/{{$product->title}}" class="product-name"><span>{{ $product->title }}</span></a>
                                        <div class="wrap-price"><span class="product-price">{{ $product->price }} Taka</span></div>


                                      <div class="wrap-butons">
                                            <form action="{{route('carts.store')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <button class="btn btn-block add-to-cart">Add to Cart</button>
                                              {{--  <a href="/carts/store/{{$product->id}}" class="btn add-to-cart">Add To Cart</a>--}}

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                    </div>

                    <div class="wrap-pagination-info">
                        <ul class="page-numbers">
                            <li><span class="page-number-item current" >1</span></li>
                            <li><a class="page-number-item" href="#" >2</a></li>
                            <li><a class="page-number-item" href="#" >3</a></li>
                            <li><a class="page-number-item next-link" href="#" >Next</a></li>
                        </ul>
                        <p class="result-count">Showing 1-8 of 12 result</p>
                    </div>
                </div><!--end main products area-->

                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                    <div class="widget mercado-widget categories-widget">
                        <h2 class="widget-title">All Categories</h2>
                        <div class="widget-content">
                            <ul class="list-category">
                                <li class="category-item has-child-cate">
                                    <a href="#" class="cate-link">Fashion & Accessories</a>
                                    <span class="toggle-control">+</span>
                                    <ul class="sub-cate">
                                        <li class="category-item"><a href="#" class="cate-link">Batteries (22)</a></li>
                                        <li class="category-item"><a href="#" class="cate-link">Headsets (16)</a></li>
                                        <li class="category-item"><a href="#" class="cate-link">Screen (28)</a></li>
                                    </ul>
                                </li>
                                <li class="category-item has-child-cate">
                                    <a href="#" class="cate-link">Computer Accessories</a>
                                    <span class="toggle-control">+</span>
                                    <ul class="sub-cate">
                                        <li class="category-item"><a href="#" class="cate-link">Batteries (22)</a></li>
                                        <li class="category-item"><a href="#" class="cate-link">Headsets (16)</a></li>
                                        <li class="category-item"><a href="#" class="cate-link">Screen (28)</a></li>
                                    </ul>
                                </li>
                                <li class="category-item has-child-cate">
                                    <a href="#" class="cate-link">Digital & Electronics</a>
                                    <span class="toggle-control">+</span>
                                    <ul class="sub-cate">
                                        <li class="category-item"><a href="#" class="cate-link">Laptop</a></li>
                                        <li class="category-item"><a href="#" class="cate-link">Desktop</a></li>
                                        <li class="category-item"><a href="#" class="cate-link">Smart TV</a></li>
                                        <li class="category-item"><a href="#" class="cate-link">Sound & Speaker</a></li>
                                        <li class="category-item"><a href="#" class="cate-link">Smart TV</a></li>
                                    </ul>
                                </li>
                                @foreach(App\Models\CategoryModel::orderby('id','asc')->get() as $category)
                                <li class="category-item">
                                    <a href="#" class="cate-link">{{$category->category_name}}</a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div><!-- Categories widget-->

                    <div class="widget mercado-widget filter-widget brand-widget">
                        <h2 class="widget-title">Brand</h2>
                        <div class="widget-content">
                            <ul class="list-style vertical-list list-limited" data-show="6">


                                @foreach(App\Models\BrandModel::orderby('id','asc')->get() as $brand)
                                <li class="list-item"><a class="filter-link " href="#">{{$brand->brand_name}}</a></li>
                                @endforeach

                                <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div><!-- brand widget-->

                    <div class="widget mercado-widget filter-widget price-filter">
                        <h2 class="widget-title">Price</h2>
                        <div class="widget-content">
                            <div id="slider-range"></div>
                            <p>
                                <label for="amount">Price:</label>
                                <input type="text" id="amount" readonly>
                                <button class="filter-submit">Filter</button>
                            </p>
                        </div>
                    </div><!-- Price-->

                    <div class="widget mercado-widget filter-widget">
                        <h2 class="widget-title">Color</h2>
                        <div class="widget-content">
                            <ul class="list-style vertical-list has-count-index">
                                <li class="list-item"><a class="filter-link " href="#">Red <span>(217)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="#">Yellow <span>(179)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="#">Black <span>(79)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="#">Blue <span>(283)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="#">Grey <span>(116)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="#">Pink <span>(29)</span></a></li>
                            </ul>
                        </div>
                    </div><!-- Color -->

                    <div class="widget mercado-widget filter-widget">
                        <h2 class="widget-title">Size</h2>
                        <div class="widget-content">
                            <ul class="list-style inline-round ">
                                <li class="list-item"><a class="filter-link active" href="#">s</a></li>
                                <li class="list-item"><a class="filter-link " href="#">M</a></li>
                                <li class="list-item"><a class="filter-link " href="#">l</a></li>
                                <li class="list-item"><a class="filter-link " href="#">xl</a></li>
                            </ul>
                            @foreach($BotBanners as $banners)
                            <div class="widget-banner">
                                <figure><img src="{{asset('assets/images/'.$banners->image)}}" width="270" height="331" alt=""></figure>
                            </div>
                            @endforeach
                        </div>
                    </div><!-- Size -->

              @include('Frontend.Shop.popular')

                </div><!--end sitebar-->

            </div><!--end row-->

        </div><!--end container-->

    </main>

@endsection
