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

                $('#brandNameId').val(jsonData[i].brand_name);
                $('#brandDesId').val(jsonData[i].description);

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
