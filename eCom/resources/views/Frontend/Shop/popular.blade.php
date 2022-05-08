<div class="widget mercado-widget widget-product">
    <h2 class="widget-title">Popular Products</h2>
    <div class="widget-content">
        <ul class="products">
            @foreach($populars as $product)
            <li class="product-item">
                <div class="product product-widget-style">
                    @foreach($product->images as $image )
                    <div class="thumbnnail">
                        <a href="/ProductDetails/{{$product->slug}}" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                            <figure><img src="{{asset($image->image)}}" alt=""></figure>
                        </a>
                    </div>
                    @endforeach
                    <div class="product-info">
                        <a href="#" class="product-name"><span>{{$product->title}}</span></a>
                        <div class="wrap-price"><span class="product-price">{{$product->price}}</span></div>
                    </div>
                </div>
            </li>
            @endforeach

          {{--  <li class="product-item">
                <div class="product product-widget-style">
                    <div class="thumbnnail">
                        <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                            <figure><img src="assets/images/products/digital_17.jpg" alt=""></figure>
                        </a>
                    </div>
                    <div class="product-info">
                        <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                        <div class="wrap-price"><span class="product-price">$168.00</span></div>
                    </div>
                </div>
            </li>

            <li class="product-item">
                <div class="product product-widget-style">
                    <div class="thumbnnail">
                        <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                            <figure><img src="assets/images/products/digital_18.jpg" alt=""></figure>
                        </a>
                    </div>
                    <div class="product-info">
                        <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                        <div class="wrap-price"><span class="product-price">$168.00</span></div>
                    </div>
                </div>
            </li>

            <li class="product-item">
                <div class="product product-widget-style">
                    <div class="thumbnnail">
                        <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                            <figure><img src="assets/images/products/digital_20.jpg" alt=""></figure>
                        </a>
                    </div>
                    <div class="product-info">
                        <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                        <div class="wrap-price"><span class="product-price">$168.00</span></div>
                    </div>
                </div>
            </li>--}}

        </ul>
    </div>
</div><!-- brand widget-->
