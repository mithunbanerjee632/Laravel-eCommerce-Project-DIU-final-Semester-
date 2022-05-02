{{-- Include Master Layout --}}

@extends('Vendor.layout.app')

{{-- Browser Title --}}

@section('title','Product')


{{-- Main Content --}}

@section('content')
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



        //Products Page Table

        function getProductsData(){
            axios.get('/getProductsData')
                .then(function(response){
                    if(response.status == 200){
                        $('#mainDivProduct').removeClass('d-none')
                        $('#loaderDivProducts').addClass('d-none')

                        $('#ProductsDataTable').DataTable().destroy();
                        $('#products_table').empty();

                        var jsonData = response.data;

                        $.each(jsonData,function (i,item){
                            $('<tr>').html(
                                "<td>"+ jsonData[i].title +"</td>"+
                                "<td>"+ jsonData[i].price +"</td>"+
                                "<td>"+ jsonData[i].quantity +"</td>"+

                                "<td><a class='productEditBtn' data-id="+jsonData[i].id+"><i class='fas fa-edit'></i></a></td>"+
                                "<td><a class='productDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                            ).appendTo('#products_table')
                        });

                        //product table edit icon click

                        $('.productEditBtn').click(function(){
                            var id =$(this).data('id');
                            $('#ProductEditId').html(id);
                            ProductDetails(id)
                            $('#UpdateProductModal').modal('show');
                        });

                        //product table delete icon click

                        $('.productDeleteBtn').click(function(){
                            var id =$(this).data('id');
                            $('#ProductDeleteId').html(id);

                            $('#deleteProductModal').modal('show');
                        });

                        //Data table

                        $('#ProductsDataTable').dataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');



                    }else{
                        $('#wrongDivProducts').removeClass('d-none');
                        $('#loaderDivProducts').addClass('d-none');
                    }
                })
                .catch(function(error){
                    $('#wrongDivProducts').removeClass('d-none');
                    $('#loaderDivProducts').addClass('d-none');
                });
        }

        //Add Product Button Click

        $('#addNewProductBtnId').click(function(){
            $('#addProductModal').modal('show');
        })


        //Modal Add Product Confirm btn

        $('#ProductAddConfirmBtn').click(function(){
            var ProductName = $('#ProductNameId').val();
            var ProductDes = $('#ProductDesId').val();
            var ProductCategory = $('#ProductCatId').val();
            var ProductBrand = $('#ProductBrandId').val();
            var ProductAdmin = $('#ProductAdminId').val();
            var ProductSlug = $('#ProductSlugId').val();
            var ProductQty = $('#ProductQtyId').val();
            var ProductPrice = $('#ProductPriceId').val();
            var ProductOfferPrice = $('#ProductOfferPriceId').val();
            var ProductStatus = $('#ProductStatusId').val();

            AddProduct(ProductName,ProductDes,ProductCategory,ProductBrand,ProductAdmin,ProductSlug,ProductQty,ProductPrice,ProductOfferPrice,ProductStatus);


        });
        //Add Product

        function AddProduct(ProductName,ProductDes,ProductCategory,ProductBrand,ProductAdmin,ProductSlug,ProductQty,ProductPrice,ProductOfferPrice,ProductStatus){
            if(ProductName.length == 0){
                toastr.error('Product Name Is Empty!');
            }else if(ProductDes.length == 0){
                toastr.error('Product Description Is Empty!');
            }else if(ProductCategory.length == 0){
                toastr.error('Product Category Is Empty!');
            }else if(ProductBrand.length == 0){
                toastr.error('Product Brand Is Empty!');
            }else if(ProductAdmin.length == 0){
                toastr.error('Product Admin Is Empty!');
            }else if(ProductSlug.length == 0){
                toastr.error('Product Slug Is Empty!');
            }else if(ProductQty.length == 0){
                toastr.error('Product Quantity Is Empty!');
            }else if(ProductPrice.length == 0){
                toastr.error('Product Price Is Empty!');
            }else if(ProductOfferPrice.length == 0){
                toastr.error('Product Offer Price Is Empty!');
            }else if(ProductStatus.length == 0){
                toastr.error('Product  Status Is Empty!');
            }else{
                $('#ProductAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

                axios.post('/ProductAdd', {
                    Product_cat: ProductCategory,
                    Product_brand: ProductBrand,
                    Product_name: ProductName,
                    Product_des: ProductDes,
                    Product_slug: ProductSlug,
                    Product_Qty: ProductQty,
                    Product_price: ProductPrice,
                    Product_Status: ProductStatus,
                    Product_Offer: ProductOfferPrice,
                    Product_admin: ProductAdmin

                }).then(function(response){

                    if(response.status == 200){
                        $('#ProductAddConfirmBtn').html('Add');
                        if(response.data == 1){
                            $('#addProductModal').modal('hide');
                            toastr.success('Product Inserted Successfully!');
                            getProductsData();

                        }else{
                            $('#addProductModal').modal('hide');
                            toastr.error('Product Not Inserted!');
                            getProductsData();
                        }
                    }else{
                        $('#addProductModal').modal('hide');
                        toastr.error('Something Went Wrong! ');
                    }

                }).catch(function(error){
                    $('#addProductModal').modal('hide');
                    toastr.error('Something Went Wrong! ');
                });


            }
        }

        //Each Product Update Details

        function ProductDetails(EditId){
            axios.post('/PorductDetails',{
                id:EditId
            }).then(function (response){
                if(response.status == 200){
                    $('#ProductUpdateForm').removeClass('d-none');
                    $('#ProductEditLoader').addClass('d-none');

                    var jsonData = response.data;

                    $('#ProductUpdateNameId').val(jsonData[0].title);
                    $('#ProductUpdateDesId').val(jsonData[0].description);
                    $('#ProductUpdateCatId').val(jsonData[0].category_id);
                    $('#ProductUpdateBrandId').val(jsonData[0].brand_id);
                    $('#ProductUpdateAdminId').val(jsonData[0].admin_id);
                    $('#ProductUpdateSlugId').val(jsonData[0].slug);
                    $('#ProductUpdateQtyId').val(jsonData[0].quantity);
                    $('#ProductUpdatePriceId').val(jsonData[0].price);
                    $('#ProductUpdateOfferPriceId').val(jsonData[0].offer_price);
                    $('#ProductUpdateStatusId').val(jsonData[0].status);

                }else{
                    $('#ProductEditLoader').addClass('d-none');
                    $('#ProductEditWrong').removeClass('d-none');
                }
            }).catch(function (error){
                $('#ProductEditLoader').addClass('d-none');
                $('#ProductEditWrong').removeClass('d-none');
            });


        }

        //Update Button click
        $('#ProductUpdateConfirmBtn').click(function(){
            var productId = $('#ProductEditId').html();
            var catId = $('#ProductUpdateCatId').val();
            var brandId = $('#ProductUpdateBrandId').val();
            var title = $('#ProductUpdateNameId').val();
            var description = $('#ProductUpdateDesId').val();
            var slug = $('#ProductUpdateSlugId').val();
            var quantity = $('#ProductUpdateQtyId').val();
            var price = $('#ProductUpdatePriceId').val();
            var status = $('#ProductUpdateOfferPriceId').val();
            var offerPrice = $('#ProductUpdateStatusId').val();
            var adminId = $('#ProductUpdateAdminId').val();

            ProductUpdate(productId,catId,brandId,title,description,slug,quantity,price,status,offerPrice,adminId);

        });

        //Update Product

        function ProductUpdate(productId,catId,brandId,title,description,slug,quantity,price,status,offerPrice,adminId){
            if(catId.length == 0){
                toastr.error("Category Id Must Not be Empty !");
            }else if(brandId.length == 0){
                toastr.error("Brand Id Must Not be Empty !");
            }else if(title.length == 0){
                toastr.error("Title Must Not be Empty !");
            }else if(description.length == 0){
                toastr.error("Description Must Not be Empty !");
            }else if(slug.length == 0){
                toastr.error("Slug Must Not be Empty !");
            }else if(quantity.length == 0){
                toastr.error("Quantity Must Not be Empty !");
            }else if(price.length == 0) {
                toastr.error("Price Must Not be Empty !");
            }else if(status.length == 0){
                toastr.error("Status Must Not be Empty !");
            }else if(offerPrice.length == 0){
                toastr.error("Offer Price Must Not be Empty !");
            }else if(adminId.length == 0){
                toastr.error("Admin Id Must Not be Empty !");
            }else{
                $('#ProductUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

                axios.post('/UpdateProductDetails',{
                    id:productId,
                    cat_id:catId,
                    brand_id:brandId,
                    title:title,
                    description:description,
                    slug:slug,
                    quantity:quantity,
                    price:price,
                    status:status,
                    offer_price:offerPrice,
                    admin_id:adminId
                }).then(function (response){
                    if(response.status == 200){
                        $('#ProductUpdateConfirmBtn').html('Update');

                        if(response.data ==1){
                            $('#UpdateProductModal').modal('hide');
                            toastr.success('Updated Successfully !')
                            getProductsData();
                        }else{
                            $('#UpdateProductModal').modal('hide');
                            toastr.error('Product Not Updated!')
                            getProductsData();
                        }
                    }else{
                        $('#UpdateProductModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }
                }).catch(function(error){
                    $('#UpdateProductModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                });

            }
        }

        //Delete button click
        $('#ProductDeleteConfirmBtn').click(function(){
            var id = $('#ProductDeleteId').html();
            ProductDelete(id);
        });

        //Delete Product
        function  ProductDelete(DeleteId){
            $('#ProductDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>");  //animation(response pawar aage)
            axios.post('/ProductDelete',{id:DeleteId})
                .then(function (response){
                    if(response.status == 200){
                        $('#ProductDeleteConfirmBtn').html("Delete");
                        if(response.data == 1){
                            $('#deleteProductModal').modal('hide')
                            toastr.success('Product Deleted Successfully !');
                            getProductsData();
                        }else{
                            $('#deleteProductModal').modal('hide')
                            toastr.Error('Product Not Deleted !');
                            getProductsData();
                        }
                    }else{
                        $('#deleteProductModal').modal('hide')
                        toastr.Error('Something Went Wrong !');
                    }
                })
                .catch(function (error){
                    $('#deleteProductModal').modal('hide')
                    toastr.Error('Something Went Wrong !');
                });
        }

    </script>
@endsection
