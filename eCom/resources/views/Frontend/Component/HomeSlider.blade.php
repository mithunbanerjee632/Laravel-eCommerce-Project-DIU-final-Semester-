<main id="main">
    <div class="container">

        <!--MAIN SLIDE-->
        <div class="wrap-main-slide">
            <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
                @foreach($sliders as $slider)
                <div class="item-slide">
                    <img src="{{asset('assets/images/'.$slider->image)}}" alt="" class="img-slide">
                    <div class="slide-info slide-1">
                        <h2 class="f-title">{{$slider->title}} <b>{{$slider->sub_title}}</b></h2>
                        <span class="subtitle mt-2">{{$slider->description}}</span>
                        <p class="sale-info">Only price: <span class="price">{{$slider->price}} Taka</span></p>
                        <a href="{{$slider->button_link}}" class="btn-link">{{$slider->button_text}}</a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
