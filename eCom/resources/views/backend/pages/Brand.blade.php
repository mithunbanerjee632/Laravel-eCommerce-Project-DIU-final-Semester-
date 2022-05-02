{{-- Include Master Layout --}}

@extends('Backend.layout.app')

{{-- Browser Title --}}

@section('title','Brand')


{{-- Page Title --}}

@section('page-heading')

@endsection

{{-- Main Content --}}

@section('main-content')
    <div id="mainDivCategory" class="container d-none">
        <div class="row">
            <div class="col-9">
                <h2>Brand <span class="text-black-50">0</span></h2>
            </div>

            <div class="col-3 text-end">
                <button id="addNewBrandBtnId" class="btn btn-primary mb-4" ><i class="bi bi-plus"></i> Add Brand</button>
            </div>

            <div class="col-12">
                <hr class="mt-4 mb-4">
            </div>

            <div class="col-md-12 p-5">

                <table id="BrandsDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Brand Name</th>
                        <th class="th-sm">Description</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="brands_table">


                    </tbody>
                </table>

            </div>
        </div>

        {{-- <div class="mb-5"></div>--}}
    </div>

    {{--loader div--}}

    <div id="loaderDivBrands" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <img class="loading-icon " src="{{asset('assets/images/loader.svg')}}">

            </div>
        </div>
    </div>

    {{--wrong div--}}

    <div id="wrongDivBrands" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>


    <!-- Add new  Modal -->
    <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="form-outline mb-4">

                        <div id="brandAddForm" class="w-100">
                            <h6 class="mb-4">Add New Brand</h6>
                            <input type="text" id="brandNameAddId" class="form-control mb-4" placeholder="Brand Name" />
                            <input type="text" id="brandDesAddId" class="form-control mb-4" placeholder="Brand Description"/>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="brandAddConfirmBtn" type="button" class="btn btn-danger">Add</button>

                </div>
            </div>
        </div>
    </div>




    <!-- Edit and Update Modal -->
    <div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center p-5">
                    <div class="form-outline mb-4">

                        <h6 id="brandEditId" class="mt-4"> </h6>

                        <div id="brandUpdateForm" class="d-none w-100">
                            <input type="text" id="brandNameId" class="form-control mb-4" placeholder="Brand Name" />
                            <input type="text" id="brandDesId" class="form-control mb-4" placeholder="Brand Description"/>

                        </div>

                        <img id="brandEditLoader" class="loading-icon " src="{{asset('assets/images/loader.svg')}}">
                        <h3 id="brandEditWrong" class="d-none">Something Went Wrong!</h3>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button  id="brandUpdateConfirmBtn" type="button" class="btn btn-danger">Save</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-3">
                    <h5 class="mt-4">Are you sure to Delete?</h5>
                    <h6 id="BrandDeleteId" class="mt-4"> </h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <button  id="BrandDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>

                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript">
        getBrandsData()

        function getBrandsData(){
            axios.get('/getBrandsData').then(function(response){
                if(response.status == 200){
                    $('#mainDivCategory').removeClass('d-none');
                    $('#loaderDivBrands').addClass('d-none');

                    $('#BrandsDataTable').DataTable().destroy();
                    $('#brands_table').empty();

                    var jsonData = response.data;

                    $.each(jsonData,function(i,item){
                        $('<tr>').html(
                            "<td>"+jsonData[i].brand_name+"</td>"+
                            "<td>"+jsonData[i].description+"</td>"+

                            "<td><a class='brandEditBtnId' data-id="+jsonData[i].id+"><i class='fas fa-edit'></i></a></td>"+
                            "<td><a class='brandDeleteBtnId' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                        ).appendTo('#brands_table');
                    });

                    //Edit icon Click
                    $('.brandEditBtnId').click(function(){
                        var id = $(this).data('id');
                        $('#brandEditId').html(id);
                        getBrandUpdateDetails(id);
                        $('#editBrandModal').modal('show');
                    });

                    //Delete icon click

                    $('.brandDeleteBtnId').click(function(){
                        var id = $(this).data('id');
                        $('#BrandDeleteId').html(id);
                        $('#deleteBrandModal').modal('show');
                    });

                    //Data table

                    $('#BrandsDataTable').dataTable({"order":false});
                    $('.dataTables_length').addClass('bs-select');

                }
            }).catch(function(error){

            });
        }

        //Brand Add button click
        $('#addNewBrandBtnId').click(function(){
            $('#addBrandModal').modal('show');
        });

        //Modal Add button click
        $('#brandAddConfirmBtn').click(function(){
            var BrandName =  $('#brandNameAddId').val();
            var BrandDes =  $('#brandDesAddId').val();

            BrandAdd(BrandName,BrandDes);
        });

        //Add Brand

        function BrandAdd(BrandName,BrandDes){
            if(BrandName.length == 0){
                toastr.error("Brand Name Must not Be Empty!");
            }else if(BrandDes.length == 0){
                toastr.error("Brand Description Must not Be Empty!");
            }else{
                $('#brandAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

                axios.post('/BrandAdd',{
                    brand_name:BrandName,
                    brand_des:BrandDes
                })
                    .then(function(response){
                        if(response.status == 200){
                            $('#brandAddConfirmBtn').html('Add');

                            if(response.data == 1){
                                $('#addBrandModal').modal('hide');
                                toastr.success('Brand Inserted Successfully!');
                                getBrandsData();
                            }else{
                                $('#addBrandModal').modal('hide');
                                toastr.error('Brand Not Inserted !');
                                getBrandsData();
                            }
                        }else{
                            $('#addBrandModal').modal('hide');
                            toastr.error('Something Went Wrong !');
                        }
                    })
                    .catch(function(error){
                        $('#addBrandModal').modal('hide');
                        toastr.error('Something Went Wrong !');
                    });
            }
        }
        //Each Brand details
        function getBrandUpdateDetails(editedId){
            axios.post('/getBrandDetails',{id:editedId})
                .then(function(response){
                    if(response.status == 200){
                        $('#brandUpdateForm').removeClass('d-none');
                        $('#brandEditLoader').addClass('d-none');

                        var jsonData = response.data;

                        $('#brandNameId').val(jsonData[0].brand_name);
                        $('#brandDesId').val(jsonData[0].description);

                    }else{
                        $('#brandEditWrong').removeClass('d-none');
                        $('#brandEditLoader').addClass('d-none');

                    }
                }).catch(function(error){
                $('#brandEditWrong').removeClass('d-none');
                $('#brandEditLoader').addClass('d-none');
            });
        }

        //Modal Update Icon click
        $('#brandUpdateConfirmBtn').click(function(){
            var brandId = $('#brandEditId').html();
            var brandName = $('#brandNameId').val();
            var brandDes = $('#brandDesId').val();

            BrandUpdate(brandId,brandName,brandDes);
        });

        //Brand Update

        function BrandUpdate(brandId,brandName,brandDes){
            if(brandName.length == 0){
                toastr.error('Brand Name Must Not be Empty!');
            }else if(brandDes.length == 0){
                toastr.error('Brand Description Must Not be Empty!');
            }else{
                $('#brandUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

                axios.post('/UpdateBrand',{
                    brand_id:brandId,
                    brand_name:brandName,
                    brand_des:brandDes
                })
                    .then(function(response){
                        if(response.status == 200){
                            $('#brandUpdateConfirmBtn').html('Update');

                            if(response.data == 1){
                                $('#editBrandModal').modal('hide');
                                toastr.success('Brand Update Successfully');
                                getBrandsData();
                            }else{
                                $('#editBrandModal').modal('hide');
                                toastr.error('Brand Not Updated !');
                                getBrandsData();
                            }
                        }else{
                            $('#editBrandModal').modal('hide');
                            toastr.error('Something Went Wrong !');
                        }
                    })
                    .catch(function(error){
                        $('#editBrandModal').modal('hide');
                        toastr.error('Something Went Wrong !');
                    });
            }

        }

        //Modal Delete Button click
        $('#BrandDeleteConfirmBtn').click(function(){
            var id = $('#BrandDeleteId').html();

            BrandDelete(id);
        });

        //Delete Brand

        function BrandDelete(deletedId){
            $('#CategoryDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>");  //animation(response pawar aage)

            axios.post('/DeleteBrand',{id:deletedId})
                .then(function(response){
                    if(response.status == 200){
                        $('#CategoryDeleteConfirmBtn').html("Yes");

                        if(response.data == 1){
                            $('#deleteBrandModal').modal('hide');
                            toastr.success('Brand Deleted Successfully');
                            getBrandsData();
                        }else{
                            $('#deleteBrandModal').modal('hide');
                            toastr.error('Brand Not Deleted !');
                            getBrandsData();
                        }
                    }else{
                        $('#deleteBrandModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }
                }).catch(function(error){
                $('#deleteBrandModal').modal('hide');
                toastr.error('Something Went Wrong!');
            });
        }

    </script>
@endsection
