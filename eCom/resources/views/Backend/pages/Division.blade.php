{{-- Include Master Layout --}}

@extends('Backend.layout.app')

{{-- Browser Title --}}

@section('title','Division')


{{-- Page Title --}}

@section('page-heading')

@endsection

{{-- Main Content --}}

@section('main-content')
    <div id="mainDivDivision" class="container d-none">
        <div class="row">
            <div class="col-9">
                <h2>Division <span class="text-black-50">0</span></h2>
            </div>

            <div class="col-3 text-end">
                <button id="addNewDivisionBtnId" class="btn btn-primary mb-4" ><i class="bi bi-plus"></i> Add Division</button>
            </div>

            <div class="col-12">
                <hr class="mt-4 mb-4">
            </div>

            <div class="col-md-12 p-5">

                <table id="DivisionDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Division Name</th>
                        <th class="th-sm">Priority</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="division_table">


                    </tbody>
                </table>

            </div>
        </div>

        {{-- <div class="mb-5"></div>--}}
    </div>

    {{--loader div--}}

    <div id="loaderDivDivisions" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <img class="loading-icon " src="{{asset('assets/images/loader.svg')}}">

            </div>
        </div>
    </div>

    {{--wrong div--}}

    <div id="wrongDivDivision" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>


    <!-- Add new  Modal -->
    <div class="modal fade" id="addDivisionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="form-outline mb-4">

                        <div id="brandAddForm" class="w-100">
                            <h6 class="mb-4">Add New Division</h6>
                            <input type="text" id="divisionNameAddId" class="form-control mb-4" placeholder="Division Name" />
                            <input type="text" id="divisionPriorityAddId" class="form-control mb-4" placeholder="Division Priority"/>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="divisionAddConfirmBtn" type="button" class="btn btn-danger">Add</button>

                </div>
            </div>
        </div>
    </div>




    <!-- Edit and Update Modal -->
    <div class="modal fade" id="editDivisionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Update Division</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center p-5">
                    <div class="form-outline mb-4">

                        <h6 id="divisionEditId" class="mt-4"> </h6>

                        <div id="divisionUpdateForm" class="d-none w-100">
                            <input type="text" id="divisionNameId" class="form-control mb-4" placeholder="Division Name" />
                            <input type="text" id="divisionPriorityId" class="form-control mb-4" placeholder="Division Priority"/>

                        </div>

                        <img id="divisionEditLoader" class="loading-icon " src="{{asset('assets/images/loader.svg')}}">
                        <h3 id="divisionEditWrong" class="d-none">Something Went Wrong!</h3>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button  id="divisionUpdateConfirmBtn" type="button" class="btn btn-danger">Save</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteDivisionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-3">
                    <h5 class="mt-4">Are you sure to Delete?</h5>
                    <h6 id="DivisionDeleteId" class="mt-4"> </h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <button  id="DivisionDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>

                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript">
        getDivisionData();


        //Category Page table
        function getDivisionData(){
            axios.get('/getDivisionsData')
                .then(function (response){
                    if(response.status == 200){
                        $('#loaderDivDivisions').addClass('d-none');
                        $('#mainDivDivision').removeClass('d-none');

                        $('#DivisionDataTable').DataTable().destroy();
                        $('#division_table').empty();

                        var jsonData = response.data;

                        $.each(jsonData,function (i,item){
                            $('<tr>').html(
                                "<td>"+ jsonData[i].name +"</td>"+
                                "<td>"+ jsonData[i].priority +"</td>"+


                                "<td><a class='divisionEditBtn' data-id="+jsonData[i].id+"><i class='fas fa-edit'></i></a></td>"+
                                "<td><a class='divisionDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                            ).appendTo('#division_table')
                        });

                        //Category table Edit Icon click

                        $('.divisionEditBtn').click(function(){
                            var id = $(this).data('id');
                            $('#divisionEditId').html(id);
                            GetDivisionDetails(id);
                            $('#editDivisionModal').modal('show');

                        });

                        //Category Table Delete Icon click

                        $('.divisionDeleteBtn').click(function(){
                            var id = $(this).data('id');
                            $('#DivisionDeleteId').html(id);
                            $('#deleteDivisionModal').modal('show');
                        });


                        //Data table

                        $('#DivisionDataTable').dataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');

                    }else{
                        $('#loaderDivDivisions').addClass('d-none');
                        $('#wrongDivDivision').removeClass('d-none');
                    }
                })
                .catch(function (error){
                    $('#loaderDivDivisions').addClass('d-none');
                    $('#wrongDivDivision').removeClass('d-none');
                });
        }

        //Category Add button click
        $('#addNewDivisionBtnId').click(function(){
            $('#addDivisionModal').modal('show');
        });

        //Modal Add button click

        $('#divisionAddConfirmBtn').click(function(){
            var DivisionName = $('#divisionNameAddId').val();
            var priority = $('#divisionPriorityAddId').val();

            DivisionAdd(DivisionName,priority);
        });


        //Add Category

        function DivisionAdd(DivisionName,priority){
            if(DivisionName.length == 0){
                toastr.error("Division Name Must Not be Empty!");
            }else if(priority.length == 0){
                toastr.error("Priority Must Not be Empty!");
            }else{
                $('#divisionAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

                axios.post('/DivisionsAdd',{
                    division_name:DivisionName,
                    priority:priority
                }).then(function(response){
                    if(response.status == 200){
                        $('#divisionAddConfirmBtn').html('Add');
                        if(response.data == 1){
                            $('#addDivisionModal').modal('hide');
                            toastr.success('Division Inserted Successfully');
                            getDivisionData();
                        }else{
                            $('#addDivisionModal').modal('hide');
                            toastr.success('Division Not Inserted !');
                            getDivisionData();
                        }
                    }else{
                        $('#addDivisionModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }
                }).catch(function(error){
                    $('#addDivisionModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                });
            }
        }

        //Each Division Details

        function GetDivisionDetails(editId){
            axios.post('/getDivisionsDetails',{id:editId}).then(function(response){

                if(response.status == 200){
                    $('#divisionUpdateForm').removeClass('d-none');
                    $('#divisionEditLoader').addClass('d-none');

                    var jsonData = response.data;

                    $('#divisionNameId').val(jsonData[0].name);
                    $('#divisionPriorityId').val(jsonData[0].priority);
                }else{
                    $('#divisionEditLoader').addClass('d-none');
                    $('#divisionEditWrong').removeClass('d-none');
                }
            }).catch(function(error){
                $('#divisionEditLoader').addClass('d-none');
                $('#divisionEditWrong').removeClass('d-none');
            });
        }

        //Modal Update button click

        $('#divisionUpdateConfirmBtn').click(function(){
            var divisionId = $('#divisionEditId').html();
            var divisionName = $('#divisionNameId').val();
            var priority = $('#divisionPriorityId').val();

            DivisionUpdate(divisionId,divisionName,priority);
        });


        //Division Update

        function  DivisionUpdate(divisionId,divisionName,priority){
            if(divisionName.length == 0){
                toastr.error('Division Name Must Not be Empty!');
            }else if(priority.length == 0){
                toastr.error('Priority Must Not be Empty!');
            }else{
                $('#divisionUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

                axios.post('/UpdateDivisions',{
                    div_id:divisionId,
                    division_name:divisionName,
                    priority:priority

                }).then(function(response){
                    if(response.status == 200){
                        $('#divisionUpdateConfirmBtn').html('Update');

                        if(response.data == 1){
                            $('#editDivisionModal').modal('hide');
                            toastr.success('Division Updated Successfully');
                            getDivisionData();

                        }else{
                            $('#editDivisionModal').modal('hide');
                            toastr.error('Division Not Updated !');
                            getDivisionData();
                        }
                    }else{
                        $('#editDivisionModal').modal('hide');
                        toastr.error('Something Went Wrong !');
                    }
                }).catch(function (error){
                    $('#editDivisionModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                });
            }

        }

        //Modal Delete Icon click

        $('#DivisionDeleteConfirmBtn').click(function(){
            var id = $('#DivisionDeleteId').html();

            DivisionDelete(id);
        });

        //Category Delete

        function DivisionDelete(deleteId){
            $('#DivisionDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>");  //animation(response pawar aage)

            axios.post('/DeleteDivisions',{id:deleteId})
                .then(function(response){
                    if(response.status == 200){
                        $('#DivisionDeleteConfirmBtn').html('Yes');
                        if(response.data == 1){
                            $('#deleteDivisionModal').modal('hide');
                            toastr.success('Division Deleted Successfully');
                            getDivisionData();
                        }else{
                            $('#deleteDivisionModal').modal('hide');
                            toastr.error('Division Not Deleted !');
                            getDivisionData();
                        }
                    }else{
                        $('#deleteDivisionModal').modal('hide');
                        toastr.error('Something Went Wrong !');
                    }
                })
                .catch(function(error){
                    $('#deleteDivisionModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                });
        }

    </script>
@endsection

