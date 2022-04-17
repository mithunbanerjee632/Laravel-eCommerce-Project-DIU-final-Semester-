{{-- Include Master Layout --}}

@extends('layout.app')

{{-- Browser Title --}}

@section('title','Category')


{{-- Page Title --}}

@section('page-heading')

@stop

{{-- Main Content --}}

@section('main-content')
    <div class="row">
        <div class="col-9">
            <h2>Category</h2>
        </div>

        <div class="col-3 text-end">
            <a class="btn btn-primary mb-4" href="{{--{{ route('category.create') }}--}}"><i class="bi bi-plus"></i> Add Category</a>
        </div>

        <div class="col-12">
            <hr class="mt-4 mb-4">
        </div>

        <div class="col-6">
            <form action="" method="post">
                <input class="form-control" type="search" placeholder="Search Category" name="search">
            </form>
        </div>

        <div class="col-6 d-flex justify-content-end">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="showallcategories" data-bs-toggle="dropdown" aria-expanded="false">
                Show all categories
                </button>
                <ul class="dropdown-menu" aria-labelledby="showallcategories">
                <li><a class="dropdown-item" href="#">All categories</a></li>
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

        <table class="table">
            <thead>
            <tr>
                <th>Category Name</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Demo</td>
                    <td>Published</td>
                </tr>
            </tbody>
        </table>

        </div>

        <div class="mb-5"></div>
    </div>
@stop
