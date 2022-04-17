{{-- Include Master Layout --}}

@extends('layout.app')

{{-- Browser Title --}}

@section('title')
    Products
@stop

{{-- Page Title --}}

@section('page-heading')

@stop

{{-- Main Content --}}

@section('main-content')
    <div class="row">
        <div class="col-9">
            <h2>Products <span class="text-black-50">0</span></h2>
        </div>

        <div class="col-3 text-end">
            <a class="btn btn-primary mb-4" href="{{--{{ route('products.create') }}--}}"><i class="bi bi-plus"></i> Add Product</a>
        </div>

        <div class="col-12">
            <hr class="mt-4 mb-4">
        </div>

        <div class="col-6">
            <form action="" method="post">
                <input class="form-control" type="search" placeholder="Search products" name="search">
            </form>
        </div>

        <div class="col-6 d-flex justify-content-end">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="showallproducts" data-bs-toggle="dropdown" aria-expanded="false">
                  Show all products
                </button>
                <ul class="dropdown-menu" aria-labelledby="showallproducts">
                  <li><a class="dropdown-item" href="#">All products</a></li>
                  <li><a class="dropdown-item" href="#">Draft</a></li>
                  <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
            <div class="dropdown ms-4">
                <button class="btn btn-primary dropdown-toggle" type="button" id="sortbynewestfirst" data-bs-toggle="dropdown" aria-expanded="false">
                  Sort by newest first
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortbynewestfirst">
                  <li><a class="dropdown-item" href="#">Newest first</a></li>
                  <li><a class="dropdown-item" href="#">Name</a></li>
                  <li><a class="dropdown-item" href="#">Date</a></li>
                </ul>
            </div>
        </div>

        <div class="col-12 mt-5">

          @isset($products)

          <table class="table">
            <thead>
              <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($products as $product)
                <tr>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->price }}</td>
                  <td>{{ $product->product_status }}</td>
                  <td>
                    <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-primary me-2">Edit</a>
                    <a href="{{ route('products.destroy', ['product' => $product->id]) }}" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
              @endforeach

            </tbody>
          </table>

          @endisset

        </div>

        <div class="mb-5"></div>
    </div>
@stop
