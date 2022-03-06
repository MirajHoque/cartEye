@extends('admin.master')

@section('cdn')
    <!-- csrf token meta for ajax-->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

   <!-- Jquery -->
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

   <!-- SweetAlert2-->
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection

@section('admin')


<div class="container-full">

    <section class="content">

        <!-- Basic Forms -->
         <div class="box">
           <div class="box-header with-border">
             <h4 class="box-title">Change Password</h4>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form>
                     <div class="row">
                       <div class="col-12">		
                           <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Current Password</h5>
                                        <div class="controls">
                                        <input type="password" id="current_password" name="current_password" class="form-control" >
                                        <span class="text-danger" id="current_password_Error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                      <h5>New Password</h5>
                                      <div class="controls">
                                      <input type="password" id="new_password" name="new_password" class="form-control" >
                                      <span class="text-danger" id="new_password_Error"></span>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <h5>Confirm Password</h5>
                                    <div class="controls">
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" >
                                    <span class="text-danger" id="confirm_password_Error"></span>
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                  <button type="button" onclick="changePassword()" class="btn btn-rounded btn-primary md-5">Change Password</button>
                              </div>

                               </div>

                               </div>
                       </div>
                    </div>
                     
                   </form>
                </div>
            </div>
        </div>
        

               </div>
               <!-- /.col -->
         <!-- /.box -->

       </section>
  </div>

    <script type="text/javascript">
       /*
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
*/
       function changePassword(){
         let currentPassword = $('#current_password').val();
         let newPassword = $('#new_password').val();
         let confirmPassword = $('#confirm_password').val();

         $.ajax({
           type: "post",
           url: "/admin/update/password",
           data: {currentPassword: currentPassword, newPassword: newPassword, confirmPassword: confirmPassword},
           dataType: "JSON",
           success: function (response) {
             
           },
           error: function(err){
             console.log(err);
           }
         });
       }
    </script>

@endsection
 

 