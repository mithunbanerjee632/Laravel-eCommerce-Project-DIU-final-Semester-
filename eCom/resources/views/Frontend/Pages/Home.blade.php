@extends('Frontend.Layout.app')
@section('title','Home')
@section('content')


    @include('Frontend.Component.HomeSlider')

    @include('Frontend.Component.HomeBanner')


    @include('Frontend.Component.HomeSale')

    @include('Frontend.Component.CategoriesTopBanner')

    @include('Frontend.Component.HomeCategories')




@endsection

