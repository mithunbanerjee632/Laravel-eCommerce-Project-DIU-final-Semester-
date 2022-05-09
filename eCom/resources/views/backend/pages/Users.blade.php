{{-- Include Master Layout --}}

@extends('Backend.layout.app')

{{-- Browser Title --}}

@section('title','Users')


{{-- Page Title --}}

@section('page-heading')
    User
@endsection

{{-- Main Content --}}

@section('main-content')
    <div id="mainDivUser" class="container d-none">
        <div class="row">
            <div class="col-9">
                <h2>User <span class="text-black-50">0</span></h2>
            </div>


            <div class="col-12">
                <hr class="mt-4 mb-4">
            </div>

            <div class="col-md-12 p-5">

                <table id="UsersDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">User Id</th>
                        <th class="th-sm">Username</th>
                        <th class="th-sm">Email</th>
                        <th class="th-sm">Phone Number</th>
                        <th class="th-sm">View Details</th>
                        <th class="th-sm">Delete</th>

                    </tr>
                    </thead>
                    <tbody id="users_table">


                    </tbody>
                </table>

            </div>
        </div>

        {{-- <div class="mb-5"></div>--}}
    </div>

    {{--loader div--}}

    <div id="loaderDivUsers" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <img class="loading-icon " src="{{asset('assets/images/loader.svg')}}">

            </div>
        </div>
    </div>

    {{--wrong div--}}

    <div id="wrongDivUsers" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>


     <!-- View User Details -->
      <div class="modal fade" id="viewUserDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">

                  <div class="modal-header">
                      <h5 class="modal-title">View User Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <div class="modal-body text-center p-5">
                      <div class="form-outline mb-4">

                          <h6 id="viewUserId" class="mt-4"> </h6>

                          <div id="viewUserForm" class="d-none w-100">
                              <input type="text" id="userFirstNameId" class="form-control mb-4" placeholder="User First Name" />
                              <input type="text" id="userLastNameId" class="form-control mb-4" placeholder="User Second Name" />
                              <input type="text" id="userNameId" class="form-control mb-4" placeholder="Username" />
                              <input type="text" id="usePhoneId" class="form-control mb-4" placeholder="Phone Number"/>
                              <input type="text" id="useEmailId" class="form-control mb-4" placeholder="Email"/>

                          </div>

                          <img id="userViewLoader" class="loading-icon " src="{{asset('assets/images/loader.svg')}}">
                          <h3 id="userViewWrong" class="d-none">Something Went Wrong!</h3>
                      </div>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                  </div>
              </div>
          </div>
      </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-3">
                    <h5 class="mt-4">Are you sure to Delete?</h5>
                    <h6 id="UserDeleteId" class="mt-4"> </h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <button  id="UserDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>

                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript">
        getUserData()

    </script>
@endsection


