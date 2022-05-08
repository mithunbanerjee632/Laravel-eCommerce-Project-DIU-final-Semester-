<div class="wrap-show-advance-info-box style-1">
    <h3 class="title-box">Product Categories</h3>
    @foreach($CatBanners as $banner)
    <div class="wrap-top-banner">
        <a href="{{$banner->link}}" class="link-banner banner-effect-2">
            <figure><img src="{{asset('assets/images/'.$banner->image)}}" width="1170" height="240" alt=""></figure>
        </a>
    </div>
@endforeach
</div>
