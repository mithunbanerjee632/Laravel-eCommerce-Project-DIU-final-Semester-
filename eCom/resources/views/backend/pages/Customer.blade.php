{{-- Include Master Layout --}}

@extends('Backend.layout.app')

{{-- Browser Title --}}

@section('title','Customer')


{{-- Page Title --}}

@section('page-heading')
Customers
@endsection

{{-- Main Content --}}

@section('main-content')
    <div id="mainDivCustomer" class="container d-none">
        <div class="row">
            <div class="col-9">
                <h2>Customer <span class="text-black-50">0</span></h2>
            </div>


            <div class="col-12">
                <hr class="mt-4 mb-4">
            </div>

            <div class="col-md-12 p-5">

                <table id="CustomersDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">User Id</th>
                        <th class="th-sm">customer Name</th>
                        <th class="th-sm">Phone Number</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="customers_table">


                    </tbody>
                </table>

            </div>
        </div>

        {{-- <div class="mb-5"></div>--}}
    </div>

    {{--loader div--}}

    <div id="loaderDivCustomers" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <img class="loading-icon " src="{{asset('assets/images/loader.svg')}}">

            </div>
        </div>
    </div>

    {{--wrong div--}}

    <div id="wrongDivCustomers" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-3">
                    <h5 class="mt-4">Are you sure to Delete?</h5>
                    <h6 id="CustomerDeleteId" class="mt-4"> </h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <button  id="CustomerDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>

                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript">
        getCustomerData()


        //Customers Page

        function getCustomerData(){
            axios.get('/getCustomerData')
                .then(function(response){
                    if(response.status == 200){
                        $('#mainDivCustomer').removeClass('d-none');
                        $('#loaderDivCustomers').addClass('d-none');


                        $('#CustomersDataTable').DataTable().destroy();
                        $('#customers_table').empty();


                        var jsonData = response.data;

                        $.each(jsonData,function(i){
                            $('<tr>').html(

                                "<td>"+jsonData[i].user_id+"</td>"+
                                "<td>"+jsonData[i].name+"</td>"+
                                "<td>"+jsonData[i].phone_no+"</td>"+

                                "<td><a class='customerDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i> </a></td>"
                            ).appendTo('#customers_table');
                        });

                        //Table Delete Icon Click
                        $('.customerDeleteBtn').click(function(){
                            var id = $(this).data('id');
                            $('#CustomerDeleteId').html(id);

                            $('#deleteCustomerModal').modal('show');
                        });

                        //Data table

                        $('#CustomersDataTable').dataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');

                    }else{
                        $('#loaderDivCustomers').addClass('d-none');
                        $('#wrongDivCustomers').removeClass('d-none');
                    }
                })
                .catch(function(error){
                    $('#loaderDivCustomers').addClass('d-none');
                    $('#wrongDivCustomers').removeClass('d-none');
                });
        }

        $('#CustomerDeleteConfirmBtn').click(function(){
            var id = $('#CustomerDeleteId').html();
            CustomerDelete(id);
        });

        function CustomerDelete(deletedId){
            $('#CustomerDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>");

            axios.post('/deleteCustomer',{id:deletedId})
                .then(function(response){
                    if(response.status == 200){
                        $('#CustomerDeleteConfirmBtn').html("Yes");
                        if(response.data == 1){
                            $('#deleteCustomerModal').modal('hide');
                            toastr.success('Deleted Successfully!');
                            getCustomerData();
                        }else{
                            $('#deleteCustomerModal').modal('hide');
                            toastr.error('Deleted Failed!');
                            getCustomerData();
                        }
                    }else{
                        $('#deleteCustomerModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }
                }).catch(function(error){
                $('#deleteCustomerModal').modal('hide');
                toastr.error('Something Went Wrong!');
            });
        }


    </script>
@endsection

