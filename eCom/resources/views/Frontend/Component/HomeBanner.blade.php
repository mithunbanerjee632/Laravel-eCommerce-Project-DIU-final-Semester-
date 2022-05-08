<div class="wrap-banner style-twin-default">

        @foreach($banners as $banner)
            <div class="banner-item">
                <a href="{{$banner->link}}" class="link-banner banner-effect-1">
                    <figure><img src="{{asset('assets/images/'.$banner->image)}}" alt="" width="580" height="190"></figure>
                </a>
            </div>
        @endforeach

</div>

