{{-- Include Master Layout --}}

@extends('Backend.layout.app')

{{-- Browser Title --}}

@section('title','District')


{{-- Page Title --}}

@section('page-heading')

@endsection

{{-- Main Content --}}

@section('main-content')
    <div id="mainDivDistrict" class="container d-none">
        <div class="row">
            <div class="col-9">
                <h2>District <span class="text-black-50">0</span></h2>
            </div>

            <div class="col-3 text-end">
                <button id="addNewDistrictBtnId" class="btn btn-primary mb-4" ><i class="bi bi-plus"></i> Add Division</button>
            </div>

            <div class="col-12">
                <hr class="mt-4 mb-4">
            </div>

            <div class="col-md-12 p-5">

                <table id="DistrictDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">District Name</th>
                        <th class="th-sm">Division Id</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="district_table">


                    </tbody>
                </table>

            </div>
        </div>

        {{-- <div class="mb-5"></div>--}}
    </div>

    {{--loader div--}}

    <div id="loaderDivDistrict" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <img class="loading-icon " src="{{asset('assets/images/loader.svg')}}">

            </div>
        </div>
    </div>

    {{--wrong div--}}

    <div id="wrongDivDistrict" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>


    <!-- Add new  Modal -->
    <div class="modal fade" id="addDistrictModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="form-outline mb-4">

                        <div id="brandAddForm" class="w-100">
                            <h6 class="mb-4">Add New District</h6>
                            <input type="text" id="districtNameAddId" class="form-control mb-4" placeholder="District Name" />
                            <input type="text" id="divisionAddId" class="form-control mb-4" placeholder="Division Id"/>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="districtAddConfirmBtn" type="button" class="btn btn-danger">Add</button>

                </div>
            </div>
        </div>
    </div>




    <!-- Edit and Update Modal -->
    <div class="modal fade" id="editDistrictModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Update District</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center p-5">
                    <div class="form-outline mb-4">

                        <h6 id="districtEditId" class="mt-4"> </h6>

                        <div id="districtUpdateForm" class="d-none w-100">
                            <input type="text" id="districtNameId" class="form-control mb-4" placeholder="Division Name" />
                            <input type="text" id="divisionId" class="form-control mb-4" placeholder="Division Id"/>

                        </div>

                        <img id="districtEditLoader" class="loading-icon " src="{{asset('assets/images/loader.svg')}}">
                        <h3 id="districtEditWrong" class="d-none">Something Went Wrong!</h3>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button  id="districtUpdateConfirmBtn" type="button" class="btn btn-danger">Save</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteDistrictModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-3">
                    <h5 class="mt-4">Are you sure to Delete?</h5>
                    <h6 id="DistrictDeleteId" class="mt-4"> </h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <button  id="DistrictDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>

                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript">
        getDistrictData();


        //Category Page table
        function getDistrictData(){
            axios.get('/getDistrictData')
                .then(function (response){
                    if(response.status == 200){
                        $('#loaderDivDistrict').addClass('d-none');
                        $('#mainDivDistrict').removeClass('d-none');

                        $('#DistrictDataTable').DataTable().destroy();
                        $('#district_table').empty();

                        var jsonData = response.data;

                        $.each(jsonData,function (i,item){
                            $('<tr>').html(
                                "<td>"+ jsonData[i].name +"</td>"+
                                "<td>"+ jsonData[i].division_id +"</td>"+


                                "<td><a class='districtEditBtn' data-id="+jsonData[i].id+"><i class='fas fa-edit'></i></a></td>"+
                                "<td><a class='districtDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                            ).appendTo('#district_table')
                        });

                        //District table Edit Icon click

                        $('.districtEditBtn').click(function(){
                            var id = $(this).data('id');
                            $('#districtEditId').html(id);
                            GetDistrictDetails(id);
                            $('#editDistrictModal').modal('show');

                        });

                        //District Table Delete Icon click

                        $('.districtDeleteBtn').click(function(){
                            var id = $(this).data('id');
                            $('#DistrictDeleteId').html(id);
                            $('#deleteDistrictModal').modal('show');
                        });


                        //Data table

                        $('#DistrictDataTable').dataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');

                    }else{
                        $('#loaderDivDistrict').addClass('d-none');
                        $('#wrongDivDistrict').removeClass('d-none');
                    }
                })
                .catch(function (error){
                    $('#loaderDivDistrict').addClass('d-none');
                    $('#wrongDivDistrict').removeClass('d-none');
                });
        }

        //Category Add button click
        $('#addNewDistrictBtnId').click(function(){
            $('#addDistrictModal').modal('show');
        });

        //Modal Add button click

        $('#districtAddConfirmBtn').click(function(){
            var DistrictName = $('#divisionNameAddId').val();
            var DivisionId = $('#divisionAddId').val();

            DivisionAdd(DistrictName,DivisionId);
        });


        //Add District

        function DivisionAdd(DistrictName,DivisionId){
            if(DistrictName.length == 0){
                toastr.error("District Name Must Not be Empty!");
            }else if(DivisionId.length == 0){
                toastr.error("Division Id Must Not be Empty!");
            }else{
                $('#districtAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

                axios.post('/DistrictAdd',{
                    district_name:DistrictName,
                    division_id:DivisionId
                }).then(function(response){
                    if(response.status == 200){
                        $('#districtAddConfirmBtn').html('Add');
                        if(response.data == 1){
                            $('#addDistrictModal').modal('hide');
                            toastr.success('District Inserted Successfully');
                            getDistrictData();
                        }else{
                            $('#addDistrictModal').modal('hide');
                            toastr.success('District Not Inserted !');
                            getDistrictData();
                        }
                    }else{
                        $('#addDistrictModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }
                }).catch(function(error){
                    $('#addDistrictModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                });
            }
        }

        //Each Division Details

        function GetDistrictDetails(editId){
            axios.post('/getDistrictDetails',{id:editId}).then(function(response){

                if(response.status == 200){
                    $('#districtUpdateForm').removeClass('d-none');
                    $('#districtEditLoader').addClass('d-none');

                    var jsonData = response.data;

                    $('#districtNameId').val(jsonData[0].name);
                    $('#divisionId').val(jsonData[0].division_id);
                }else{
                    $('#districtEditLoader').addClass('d-none');
                    $('#districtEditWrong').removeClass('d-none');
                }
            }).catch(function(error){
                $('#districtEditLoader').addClass('d-none');
                $('#districtEditWrong').removeClass('d-none');
            });
        }

        //Modal Update button click

        $('#districtUpdateConfirmBtn').click(function(){
            var districtId = $('#districtEditId').html();
            var districtName = $('#districtNameId').val();
            var divisionId = $('#divisionId').val();

            DistrictUpdate(districtId,districtName,divisionId);
        });


        //District Update

        function  DistrictUpdate(districtId,districtName,divisionId){
            if(districtName.length == 0){
                toastr.error('Division Name Must Not be Empty!');
            }else if(divisionId.length == 0){
                toastr.error('Priority Must Not be Empty!');
            }else{
                $('#districtUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

                axios.post('/UpdateDistrict',{
                    dis_id:districtId,
                    district_name:districtName,
                    div_id:divisionId

                }).then(function(response){
                    if(response.status == 200){
                        $('#districtUpdateConfirmBtn').html('Update');

                        if(response.data == 1){
                            $('#editDistrictModal').modal('hide');
                            toastr.success('District Updated Successfully');
                            getDistrictData();

                        }else{
                            $('#editDistrictModal').modal('hide');
                            toastr.error('District Not Updated !');
                            getDistrictData();
                        }
                    }else{
                        $('#editDistrictModal').modal('hide');
                        toastr.error('Something Went Wrong !');
                    }
                }).catch(function (error){
                    $('#editDistrictModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                });
            }

        }

        //Modal Delete Icon click

        $('#DistrictDeleteConfirmBtn').click(function(){
            var id = $('#DistrictDeleteId').html();

            DistrictDelete(id);
        });

        //Category Delete

        function DistrictDelete(deleteId){
            $('#DistrictDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>");  //animation(response pawar aage)

            axios.post('/DeleteDistrict',{id:deleteId})
                .then(function(response){
                    if(response.status == 200){
                        $('#DistrictDeleteConfirmBtn').html('Yes');
                        if(response.data == 1){
                            $('#deleteDistrictModal').modal('hide');
                            toastr.success('District Deleted Successfully');
                            getDistrictData();
                        }else{
                            $('#deleteDistrictModal').modal('hide');
                            toastr.error('District Not Deleted !');
                            getDistrictData();
                        }
                    }else{
                        $('#deleteDistrictModal').modal('hide');
                        toastr.error('Something Went Wrong !');
                    }
                })
                .catch(function(error){
                    $('#deleteDistrictModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                });
        }

    </script>
@endsection

