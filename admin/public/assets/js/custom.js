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
