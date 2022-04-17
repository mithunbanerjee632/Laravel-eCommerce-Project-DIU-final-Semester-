@extends('Layout.app')
@section('title','Home')
@section('content')


    @include('Component.HomeSlider')

    @include('Component.HomeBanner')


    @include('Component.HomeSale')

    @include('Component.CategoriesTopBanner')

    @include('Component.HomeCategories')




@endsection

