function getUserData(){
    axios.get('/getUserData')
        .then(function(response){
          if(response.status == 200){
              $('#mainDivUser').removeClass('d-none');
              $('#loaderDivUsers').addClass('d-none');


              $('#UsersDataTable').DataTable().destroy();
              $('#users_table').empty();

              var jsonData = response.data;
              $.each(jsonData,function(i){
                  $('<tr>').html(
                      "<td>"+jsonData[i].id+"</td>"+
                      "<td>"+jsonData[i].username+"</td>"+
                      "<td>"+jsonData[i].email+"</td>"+
                      "<td>"+jsonData[i].phone_no+"</td>"+

                      "<td><a class='userViewBtn' data-id="+jsonData[i].id+"><i class='fas fa-edit'></i></a></td>"+
                      "<td><a class='userDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                  ).appendTo('#users_table');
              });

              $('.userViewBtn').click(function(){
                  var id = $(this).data('id');
                  $('#viewUserId').html(id);
                  getUserDetails(id);
                  $('#viewUserDetail').modal('show');

              });

              $('.userDeleteBtn').click(function(){
                  var id = $(this).data('id');
                  $('#UserDeleteId').html(id);
                  $('#deleteUserModal').modal('show');
              });

              //Data table

              $('#UsersDataTable').dataTable({"order":false});
              $('.dataTables_length').addClass('bs-select');
          }else{
              $('#wrongDivUsers').removeClass('d-none')
              $('#loaderDivUsers').addClass('d-none')
          }
    }).catch(function(error){
        $('#wrongDivUsers').removeClass('d-none')
        $('#loaderDivUsers').addClass('d-none')
    });
}

function  getUserDetails(viewId){
    axios.post('/getUserDetails',{id:viewId})
        .then(function(response){
           if(response.status == 200){
               $('#viewUserForm').removeClass('d-none');
               $('#userViewLoader').addClass('d-none');


               var jsonData = response.data;


                  $('#userFirstNameId').val(jsonData[0].first_name);
                  $('#userLastNameId').val(jsonData[0].last_name);
                  $('#userNameId').val(jsonData[0].username);
                  $('#useEmailId').val(jsonData[0].email);
                  $('#usePhoneId').val(jsonData[0].phone_no);

           }else{
               $('#userViewWrong').removeClass('d-none')
               $('#userViewLoader').addClass('d-none');
           }
    }).catch(function(error){
        $('#userViewWrong').removeClass('d-none')
        $('#userViewLoader').addClass('d-none');
    });


}

$('#UserDeleteConfirmBtn').click(function(){
   var id =  $('#UserDeleteId').html();

   DeleteUser(id);
});

function  DeleteUser(deletedId){
    $('#UserDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>");

    axios.post('/deleteUser',{id:deletedId}).then(function(response){
        if(response.status == 200){
            $('#deleteUserModal').modal('hide');
            toastr.success('User Deleted Successfully!');
            getUserData();
        }else{
            $('#deleteUserModal').modal('hide');
            toastr.error('User not Deleted !');
            getUserData();
        }
    }).catch(function(error){
        $('#deleteUserModal').modal('hide');
        toastr.error('Something Went Wrong !');
    });

}
