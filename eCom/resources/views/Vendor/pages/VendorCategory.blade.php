{{-- Include Master Layout --}}

@extends('Vendor.layout.app')

{{-- Browser Title --}}

@section('title','Category')


{{-- Main Content --}}

@section('content')

<div id="mainDivCategory" class="container d-none">
        <div class="row">
            <div class="col-9">
                <h2>Category <span class="text-black-50">0</span></h2>
            </div>

            <div class="col-3 text-end">
                <button id="addNewCategoryBtnId" class="btn btn-primary mb-4" ><i class="bi bi-plus"></i> Add Category</button>
            </div>

            <div class="col-12">
                <hr class="mt-4 mb-4">
            </div>

            <div class="col-md-12 p-5">

                <table id="CategoryDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Category Name</th>
                        <th class="th-sm">Description</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="categories_table">


                    </tbody>
                </table>

            </div>
        </div>

        {{-- <div class="mb-5"></div>--}}
    </div>

    {{--loader div--}}

    <div id="loaderDivCategories" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <img class="loading-icon " src="{{asset('assets/images/loader.svg')}}">

            </div>
        </div>
    </div>

    {{--wrong div--}}

    <div id="wrongDivCategories" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>


    <!-- Add new  Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="form-outline mb-4">

                        <div id="categoryAddForm" class="w-100">
                            <h6 class="mb-4">Add New Category</h6>
                            <input type="text" id="categoryNameAddId" class="form-control mb-4" placeholder="Category Name" />
                            <input type="text" id="categoryDesAddId" class="form-control mb-4" placeholder="Category Description"/>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="categoryAddConfirmBtn" type="button" class="btn btn-danger">Add</button>

                </div>
            </div>
        </div>
    </div>




    <!-- Edit and Update Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                        <h6 id="categoryEditId" class="mt-4"> </h6>

                        <div id="categoryUpdateForm" class="d-none w-100">
                            <input type="text" id="categoryNameId" class="form-control mb-4" placeholder="Category Name" />
                            <input type="text" id="categoryDesId" class="form-control mb-4" placeholder="Category Description"/>

                        </div>

                        <img id="categoryEditLoader" class="loading-icon " src="{{asset('assets/images/loader.svg')}}">
                        <h3 id="categoryEditWrong" class="d-none">Something Went Wrong!</h3>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button  id="categoryUpdateConfirmBtn" type="button" class="btn btn-danger">Save</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-3">
                    <h5 class="mt-4">Are you sure to Delete?</h5>
                    <h6 id="CategoryDeleteId" class="mt-4"> </h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <button  id="CategoryDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>

                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript">
        getCategoriesData();

        //Category Page table
        function getCategoriesData(){
            axios.get('/getCategoryData')
                .then(function (response){
                    if(response.status == 200){
                        $('#loaderDivCategories').addClass('d-none');
                        $('#mainDivCategory').removeClass('d-none');

                        $('#CategoryDataTable').DataTable().destroy();
                        $('#categories_table').empty();

                        var jsonData = response.data;

                        $.each(jsonData,function (i,item){
                            $('<tr>').html(
                                "<td>"+ jsonData[i].category_name +"</td>"+
                                "<td>"+ jsonData[i].description +"</td>"+


                                "<td><a class='categoryEditBtn' data-id="+jsonData[i].id+"><i class='fas fa-edit'></i></a></td>"+
                                "<td><a class='categoryDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                            ).appendTo('#categories_table')
                        });

                        //Category table Edit Icon click

                        $('.categoryEditBtn').click(function(){
                            var id = $(this).data('id');
                            $('#categoryEditId').html(id);
                            GetCategoryDetails(id);
                            $('#editCategoryModal').modal('show');

                        });

                        //Category Table Delete Icon click

                        $('.categoryDeleteBtn').click(function(){
                            var id = $(this).data('id');
                            $('#CategoryDeleteId').html(id);
                            $('#deleteCategoryModal').modal('show');
                        });


                        //Data table

                        $('#CategoryDataTable').dataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');

                    }else{
                        $('#loaderDivCategories').addClass('d-none');
                        $('#wrongDivCategories').removeClass('d-none');
                    }
                })
                .catch(function (error){
                    $('#loaderDivCategories').addClass('d-none');
                    $('#wrongDivCategories').removeClass('d-none');
                });
        }

        //Category Add button click
        $('#addNewCategoryBtnId').click(function(){
            $('#addCategoryModal').modal('show');
        });

        //Modal Add button click

        $('#categoryAddConfirmBtn').click(function(){
            var CategoryName = $('#categoryNameAddId').val();
            var CategoryDes = $('#categoryDesAddId').val();

            CategoryAdd(CategoryName,CategoryDes);
        });


        //Add Category

        function CategoryAdd(CategoryName,CategoryDes){
            if(CategoryAdd.length == 0){
                toastr.error("Category Name Must Not be Empty!");
            }else if(CategoryDes.length == 0){
                toastr.error("Category Description Must Not be Empty!");
            }else{
                $('#categoryAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

                axios.post('/AddCategory',{
                    category_name:CategoryName,
                    category_des:CategoryDes
                }).then(function(response){
                    if(response.status == 200){
                        $('#categoryAddConfirmBtn').html('Add');
                        if(response.data == 1){
                            $('#addCategoryModal').modal('hide');
                            toastr.success('Category Inserted Successfully');
                            getCategoriesData();
                        }else{
                            $('#addCategoryModal').modal('hide');
                            toastr.success('Category Not Inserted !');
                            getCategoriesData();
                        }
                    }else{
                        $('#addCategoryModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }
                }).catch(function(error){
                    $('#addCategoryModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                });
            }
        }

        //Each Category Details

        function GetCategoryDetails(editId){
            axios.post('/getCategoryDetails',{id:editId}).then(function(response){

                if(response.status == 200){
                    $('#categoryUpdateForm').removeClass('d-none');
                    $('#categoryEditLoader').addClass('d-none');

                    var jsonData = response.data;

                    $('#categoryNameId').val(jsonData[0].category_name);
                    $('#categoryDesId').val(jsonData[0].description);
                }else{
                    $('#categoryEditLoader').addClass('d-none');
                    $('#categoryEditWrong').removeClass('d-none');
                }
            }).catch(function(error){
                $('#categoryEditLoader').addClass('d-none');
                $('#categoryEditWrong').removeClass('d-none');
            });
        }

        //Modal Update button click

        $('#categoryUpdateConfirmBtn').click(function(){
            var catId = $('#categoryEditId').html();
            var catName = $('#categoryNameId').val();
            var catDes = $('#categoryDesId').val();

            CategoryUpdate(catId,catName,catDes);
        });


        //Category Update

        function  CategoryUpdate(catId,catName,catDes){
            if(catName.length == 0){
                toastr.error('Category Name Must Not be Empty!');
            }else if(catDes.length == 0){
                toastr.error('Category Description Must Not be Empty!');
            }else{
                $('#categoryUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

                axios.post('/CategoryUpdate',{
                    cat_id:catId,
                    cat_name:catName,
                    cat_des:catDes

                }).then(function(response){
                    if(response.status == 200){
                        $('#categoryUpdateConfirmBtn').html('Update');

                        if(response.data == 1){
                            $('#editCategoryModal').modal('hide');
                            toastr.success('Category Updated Successfully');
                            getCategoriesData();

                        }else{
                            $('#editCategoryModal').modal('hide');
                            toastr.error('Category Not Updated !');
                            getCategoriesData();
                        }
                    }else{
                        $('#editCategoryModal').modal('hide');
                        toastr.error('Something Went Wrong !');
                    }
                }).catch(function (error){
                    $('#editCategoryModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                });
            }

        }

        //Modal Delete Icon click

        $('#CategoryDeleteConfirmBtn').click(function(){
            var id = $('#CategoryDeleteId').html();

            CategoryDelete(id);
        });

        //Category Delete

        function CategoryDelete(deleteId){
            $('#CategoryDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>");  //animation(response pawar aage)

            axios.post('/DeleteCategory',{id:deleteId})
                .then(function(response){
                    if(response.status == 200){
                        $('#CategoryDeleteConfirmBtn').html('Yes');
                        if(response.data == 1){
                            $('#deleteCategoryModal').modal('hide');
                            toastr.success('Category Deleted Successfully');
                            getCategoriesData();
                        }else{
                            $('#deleteCategoryModal').modal('hide');
                            toastr.error('Category Not Deleted !');
                            getCategoriesData();
                        }
                    }else{
                        $('#deleteCategoryModal').modal('hide');
                        toastr.error('Something Went Wrong !');
                    }
                })
                .catch(function(error){
                    $('#deleteCategoryModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                });
        }

    </script>
@endsection
