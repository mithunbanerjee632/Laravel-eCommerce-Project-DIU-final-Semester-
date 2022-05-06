//slider page

function getSlidersData(){
    axios.get('/getSliderData').then(function(response){
        if(response.status == 200){
            $('#mainDivSlider').removeClass('d-none');
            $('#loaderDivSliders').addClass('d-none');

             $('#sliders_table').empty();
            var jsonData = response.data;

            $.each(jsonData,function(i,item){
                $('<tr>').html(
                    "<td>"+jsonData[i].title+"</td>"+
                    "<td>"+jsonData[i].description+"</td>"+
                    "<td>"+jsonData[i].price+"</td>"+
                    "<td>"+jsonData[i].image+"</td>"+

                    "<td><a class='sliderEditBtnId' data-id="+jsonData[i].id+"><i class='fas fa-edit'></i></a></td>"+
                    "<td><a class='sliderDeleteBtnId' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#sliders_table');
            });

            $('.sliderEditBtnId').click(function(){
                var id = $(this).data('id');
                $('#sliderEditId').html(id);
                SldierDetails(id);
                $('#editSliderModal').modal('show');
            });

            $('.sliderDeleteBtnId').click(function(){
                var id = $(this).data('id');
                $('#SliderDeleteId').html(id);
                $('#deleteSliderModal').modal('show');
            });


        }
    }).catch(function(error){

    });
}

$('#addNewSliderBtnId').click(function(){
   $('#addSliderModal').modal('show');
});

$('#sliderAddConfirmBtn').click(function(){
   var title = $('#sliderNameAddId').val();
   var des = $('#sliderDesAddId').val();
   var price = $('#sliderPriceAddId').val();
   var btnText = $('#SliderBtnTextAddId').val();
   var link = $('#SliderBtnLinkAddId').val();
   var priority = $('#SliderPriorityAddId').val();



/*    var img = $('#SliderImgAddId').val();*/
    let myFile = document.getElementById('SliderImgAddId').files[0];
    let myFileName = myFile.name;

   SliderAdd(title,des,price,btnText,link,myFileName,priority);

});

function SliderAdd(title,des,price,btnText,link,myFileName,priority){
/*
    let FileData = new FormData(); //form data er madhhome file ta axios er jonno ready korbo
    FileData.append('FileKey',myFile); //file k form data er modhhe append korlam
    let config = {headers:{'content-type': 'multipart/form-data'}}*/

    if(title.length == 0){
        toastr.error('Title Is Empty!');
    }else if(des.length == 0){
        toastr.error('Description Is Empty!');
    }else if(price.length == 0){
        toastr.error('Product Price Is Empty!');
    }else if(btnText.length == 0){
        toastr.error('Product Button Text Is Empty!');
    }else if(link.length == 0){
        toastr.error('Product Link Is Empty!');
    }else if(myFileName.length == 0){
        toastr.error('Image Is Empty!');
    }else if(priority.length == 0){
        toastr.error('priority Is Empty!');
    }
    else{
        $('#ProductAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>");

        axios.post('/SliderAdd',{
            'title':title,
            'des':des,
            'price':price,
            'btnText':btnText,
            'link':link,
            'img':myFileName,
            'priority':priority


        })
            .then(function(response){
                if(response.status == 200){
                    $('#sliderAddConfirmBtn').html('Add');
                    if(response.data ==1){
                        $('#addSliderModal').modal('hide');
                        toastr.success('Sider Inserted Successfully!');
                        getSlidersData();
                    }else{
                        $('#addSliderModal').modal('hide');
                        toastr.error('Sider Not Inserted !');
                        getSlidersData();
                    }

                }else{
                    $('#addSliderModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }
            })
            .catch(function(error){
                $('#addSliderModal').modal('hide');
                toastr.error('Something Went Wrong !');
            });
    }

}

function  SldierDetails(editedId){
    axios.post('/SliderDetails', {id:editedId})
        .then(function(response){
            if(response.status ==200){
                $('#sliderUpdateForm').removeClass('d-none');
                $('#sliderEditLoader').addClass('none');

                var jsonData = response.data;

                $('#sliderNameId').val(jsonData[0].title);
                $('#sliderDesId').val(jsonData[0].description);
                $('#sliderPriceId').val(jsonData[0].price);
                $('#SliderBtnTextId').val(jsonData[0].button_text);
                $('#SliderBtnLinkId').val(jsonData[0].button_link);
                $('#SliderPriorityId').val(jsonData[0].priority);
                $('#SliderImgId').val(jsonData[0].image);


            }else{
                $('#sliderEditWrong').removeClass('d-none');
                $('#sliderEditLoader').addClass('d-none');
            }
        })
        .catch(function(error){
            $('#sliderEditWrong').removeClass('d-none');
            $('#sliderEditLoader').addClass('d-none');
        });
}

$('#sliderUpdateConfirmBtn').click(function(){
    var sliderId = $('#sliderEditId').html();
    var title = $('#sliderNameId').val();
    var des = $('#sliderDesId').val();
    var price = $('#sliderPriceId').val();
    var btnTxt = $('#SliderBtnTextId').val();
    var btnLink = $('#SliderBtnLinkId').val();
    var priority = $('#SliderPriorityId').val();
    let myFile = document.getElementById('SliderImgId').files[0];
    let myFileName = myFile.name;


    UpdateSliderDetails(sliderId,title,des,price,btnTxt,btnLink,myFileName,priority)
});

function UpdateSliderDetails(sliderId,title,des,price,btnTxt,btnLink,myFileName,priority) {
    if (title.length == 0) {
        toastr.error('Title Is Empty!');
    } else if (des.length == 0) {
        toastr.error('Description Is Empty!');
    } else if (price.length == 0) {
        toastr.error('Product Price Is Empty!');
    } else if (btnTxt.length == 0) {
        toastr.error('Product Button Text Is Empty!');
    } else if (btnLink.length == 0) {
        toastr.error('Product Link Is Empty!');
    } else if (myFileName.length == 0) {
        toastr.error('Image Is Empty!');
    } else if (priority.length == 0) {
        toastr.error('priority Is Empty!');
    } else {
        $('#ProductAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>");
        axios.post('/UpdateDetails',{
            id:sliderId,
            title:title,
            description:des,
            price:price,
            txt:btnTxt,
            link:btnLink,
            img:myFileName,
            priority:priority,
        })
            .then(function(response){
                if(response.status == 200){
                    $('#ProductAddConfirmBtn').html('Update');
                    if(response.data == 1){
                         $('#editSliderModal').modal('hide')
                        toastr.success('Slider Data Updated Successfully!');
                         getSlidersData();
                    }else{
                        $('#editSliderModal').modal('hide')
                        toastr.error('Slider Data Not Updated !');
                        getSlidersData();
                    }
                }else{
                    $('#editSliderModal').modal('hide')
                    toastr.error('Something Went Wrong!');

                }
            })
            .catch(function(error){
                $('#editSliderModal').modal('hide')
                toastr.error('Something Went Wrong!');
        });
    }
}

$('#SliderDeleteConfirmBtn').click(function(){
    var id = $('#SliderDeleteId').html();
    DeleteSlider(id)

});

function DeleteSlider(deletedId){
    $('#ProductDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>");
    axios.post('/DeleteSlider',{id:deletedId})
        .then(function(response){
            if(response.status == 200){
                $('#ProductDeleteConfirmBtn').html('Delete');
                if(response.data == 1){
                    $('#deleteSliderModal').modal('hide');
                    toastr.success('Slider Deleted Successfully!');
                    getSlidersData();
                }else{
                    $('#deleteSliderModal').modal('hide');
                    toastr.error('Slider Not Deleted !');
                    getSlidersData();
                }

            }else{
               $('#deleteSliderModal').modal('hide');
               toastr.error('Something Went Wrong!');
            }


        })
        .catch(function(error){
            $('#deleteSliderModal').modal('hide');
            toastr.error('Something Went Wrong!');
        });
}

