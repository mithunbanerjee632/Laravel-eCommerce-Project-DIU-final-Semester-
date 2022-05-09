{{-- Include Master Layout --}}

@extends('Backend.layout.app')

{{-- Browser Title --}}

@section('title','Slider')


{{-- Page Title --}}

@section('page-heading')

@endsection

{{-- Main Content --}}

@section('main-content')
    <div id="mainDivSlider" class="container d-none">
        <div class="row">
            <div class="col-9">
                <h2>Slider <span class="text-black-50">0</span></h2>
            </div>

            <div class="col-3 text-end">
                <button id="addNewSliderBtnId" class="btn btn-primary mb-4" ><i class="bi bi-plus"></i> Add Slider</button>
            </div>

            <div class="col-12">
                <hr class="mt-4 mb-4">
            </div>

            <div class="col-md-12 p-5">

                <table id="SliderDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Slider Title</th>
                        <th class="th-sm">Slider Description</th>
                        <th class="th-sm">Slider Price</th>
                        <th class="th-sm">Slider Image</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="sliders_table">


                    </tbody>
                </table>

            </div>
        </div>

        {{-- <div class="mb-5"></div>--}}
    </div>

    {{--loader div--}}

    <div id="loaderDivSliders" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <img class="loading-icon " src="{{asset('assets/images/loader.svg')}}">

            </div>
        </div>
    </div>

    {{--wrong div--}}

    <div id="wrongDivSliders" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>


    <!-- Add new  Modal -->
    <div class="modal fade" id="addSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="form-outline mb-4">

                        <div id="brandSliderForm" class="w-100">
                            <h6 class="mb-4">Add New Slider</h6>
                            <input type="text" id="sliderNameAddId" class="form-control mb-4" placeholder="Slider Title" />
                            <input type="text" id="sliderDesAddId" class="form-control mb-4" placeholder="Slider Description"/>
                            <input type="text" id="sliderPriceAddId" class="form-control mb-4" placeholder="Slider Price"/>
                            <input type="text" id="SliderBtnTextAddId" class="form-control mb-4" placeholder="Slider Button Text"/>
                            <input type="text" id="SliderBtnLinkAddId" class="form-control mb-4" placeholder="Slider Button Link"/>
                            <input type="file" class="form-control mb-4" id="SliderImgAddId" placeholder="Slider Image"/>
                            <input type="text" class="form-control mb-4" id="SliderPriorityAddId" placeholder="Slider Priority"/>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button   id="sliderAddConfirmBtn" type="button" class="btn btn-danger">Add</button>

                </div>
            </div>
        </div>
    </div>




    <!-- Edit and Update Modal -->
    <div class="modal fade" id="editSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Update Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center p-5">
                    <div class="form-outline mb-4">

                        <h6 id="sliderEditId" class="mt-4"> </h6>

                        <div id="sliderUpdateForm" class="d-none w-100">
                            <input type="text" id="sliderNameId" class="form-control mb-4" placeholder="Slider Title" />
                            <input type="text" id="sliderDesId" class="form-control mb-4" placeholder="Slider Description"/>
                            <input type="text" id="sliderPriceId" class="form-control mb-4" placeholder="Slider Price"/>
                            <input type="text" id="SliderBtnTextId" class="form-control mb-4" placeholder="Slider Button Text"/>
                            <input type="text" id="SliderBtnLinkId" class="form-control mb-4" placeholder="Slider Button Link"/>
                            <input type="file" id="SliderImgId" class="form-control mb-4"  placeholder="Slider Image"/>
                            <input type="text" id="SliderPriorityId" class="form-control mb-4"  placeholder="Slider Priority"/>

                        </div>

                        <img id="sliderEditLoader" class="loading-icon " src="{{asset('assets/images/loader.svg')}}">
                        <h3 id="sliderEditWrong" class="d-none">Something Went Wrong!</h3>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button  id="sliderUpdateConfirmBtn" type="button" class="btn btn-danger">Save</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-3">
                    <h5 class="mt-4">Are you sure to Delete?</h5>
                    <h6 id="SliderDeleteId" class="mt-4"> </h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <button  id="SliderDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>

                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript">
        getSlidersData();


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




    </script>
@endsection

