{{-- Include Master Layout --}}

@extends('layout.app')

{{-- Browser Title --}}

@section('title','Product')


{{-- Page Title --}}

@section('page-heading')

@endsection

{{-- Main Content --}}

@section('main-content')
    <div id="mainDivProduct" class="container d-none">
    <div class="row">
        <div class="col-9">
            <h2>Products <span class="text-black-50">0</span></h2>
        </div>

        <div class="col-3 text-end">
            <button id="addNewProductBtnId" class="btn btn-primary mb-4" ><i class="bi bi-plus"></i> Add Product</button>
        </div>

        <div class="col-12">
            <hr class="mt-4 mb-4">
        </div>

                <div class="col-md-12 p-5">

                    <table id="ProductsDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="th-sm">Product Name</th>
                            <th class="th-sm">Price</th>
                            <th class="th-sm">Quantity</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                        </thead>
                        <tbody id="products_table">


                        </tbody>
                    </table>

                </div>
            </div>

       {{-- <div class="mb-5"></div>--}}
    </div>

{{--loader div--}}

    <div id="loaderDivProducts" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <img class="loading-icon " src="{{asset('assets/images/loader.svg')}}">

            </div>
        </div>
    </div>

{{--wrong div--}}

    <div id="wrongDivProducts" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>

{{--    Add Product Section--}}
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="ProductNameId" type="text"  class="form-control mb-3" placeholder="Product Name">
                                <input id="ProductDesId" type="text"  class="form-control mb-3" placeholder="Product Description">
                                <input id="ProductCatId" type="text" class="form-control mb-3" placeholder="Product Category Id">
                                <input id="ProductBrandId" type="text"  class="form-control mb-3" placeholder="Product Brand Id">
                                <input id="ProductAdminId" type="text"  class="form-control mb-3" placeholder="Product Admin Id">
                            </div>
                            <div class="col-md-6">
                                <input id="ProductSlugId" type="text"  class="form-control mb-3" placeholder="Product Slug">
                                <input id="ProductQtyId" type="text"  class="form-control mb-3" placeholder="Quantity(default 1)">
                                <input id="ProductPriceId" type="text"  class="form-control mb-3" placeholder="Product Price">
                                <input id="ProductOfferPriceId" type="text"  class="form-control mb-3" placeholder="Product Offer Price(Nullable)">
                                <input id="ProductStatusId" type="text"  class="form-control mb-3" placeholder="Product Status(default 0)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="ProductAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Add</button>
                </div>
            </div>
        </div>
    </div>


    {{--Edit and Update Modal--}}

    <div class="modal fade" id="UpdateProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Product Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body  text-center">

                    <h6 id="ProductEditId" class="mt-4"> </h6>

                    <div id="ProductUpdateForm" class="container d-none">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="ProductUpdateNameId" type="text"  class="form-control mb-3" placeholder="Product Name">
                                <input id="ProductUpdateDesId" type="text"  class="form-control mb-3" placeholder="Product Description">
                                <input id="ProductUpdateCatId" type="text" class="form-control mb-3" placeholder="Product Category Id">
                                <input id="ProductUpdateBrandId" type="text"  class="form-control mb-3" placeholder="Product Brand Id">
                                <input id="ProductUpdateAdminId" type="text"  class="form-control mb-3" placeholder="Product Admin Id">
                            </div>
                            <div class="col-md-6">
                                <input id="ProductUpdateSlugId" type="text"  class="form-control mb-3" placeholder="Product Slug">
                                <input id="ProductUpdateQtyId" type="text"  class="form-control mb-3" placeholder="Quantity(default 1)">
                                <input id="ProductUpdatePriceId" type="text"  class="form-control mb-3" placeholder="Product Price">
                                <input id="ProductUpdateOfferPriceId" type="text"  class="form-control mb-3" placeholder="Product Offer Price(Nullable)">
                                <input id="ProductUpdateStatusId" type="text"  class="form-control mb-3" placeholder="Product Status(default 0)">
                            </div>
                        </div>
                    </div>


                    <img id="ProductEditLoader" class="loading-icon " src="{{asset('assets/images/loader.svg')}}">
                    <h3 id="ProductEditWrong" class="d-none">Something Went Wrong!</h3>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="ProductUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Modal -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-3">
                    <h5 class="mt-4">Are you sure to Delete?</h5>
                    <h6 id="ProductDeleteId" class="mt-4"> </h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <button  id="ProductDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>

                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript">
        getProductsData();
    </script>
@endsection
