@extends('frontend.layout')

@section('cdn')

<!-- csrf token meta for ajax-->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<!-- SweetAlert2-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection

@section('content')

   <div class="body-content">
       <div class="container">
           <!-- start row-->
           <div class="row">
               <div class="col-md-2"> <br>
                   <img class="card-img-top" src="{{ !empty($user->profile_photo_path) ? 
                    url('upload/userImages/'.$user->profile_photo_path) : url('upload/default.png') }}"
                     alt="" style="border-radius: 50%;" height="200px" width="200px"> <br> <br>
                     <ul class="list-group list-group-flush">
                         <a class="btn btn-primary btn-sm btn-block" href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i> Home</a>
                         <a class="btn btn-primary btn-sm btn-block" href="{{ route('user.profile') }}">Update Info</a>
                         <a class="btn btn-primary btn-sm btn-block disabled">Change Password</a>
                         <a class="btn btn-danger btn-sm btn-block" href="{{ route('user.logout') }}">Logout</a>
                     </ul>

               </div>

               <div class="col-md-2 pb-2"></div>

            <div class="col-md-6 pt-2">
                <div class="card">
                    <h3 class="text-center">
                        <span class="text-danger">Change Password</span>
                        <strong></strong>
                       
                    </h3>
                    <div class="card-body">
                         <form>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Current Password <span></span></label>
                                <input type="password" id="current_password" name="current_password" class="form-control unicase-form-control text-input">
                                <span id="current_password_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">New Password<span></span></label>
                                <input type="password" id="password" name="password" class="form-control unicase-form-control text-input">
                                <span id="password_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm Password<span></span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control unicase-form-control text-input">
                                <span id="password_confirmation_error" class="text-danger"></span>
                            </div>


                            <div class="form-group">
                                <button id="passwordButton" type="button" onclick ="changePassword()" class="btn btn-primary">Update</button>
                            </div>


                         </form>
                    </div>
                </div>
                   
            </div>


           </div> 
           <!-- end row-->
       </div>
   </div>


<script type="text/javascript">

     //sweetalert2
     var alertMsg = Swal.mixin({
            toast: true,
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
          })

        //clear error message
        function clearData(){
            //Error fields
            $('#current_password_error').text('');
            $('#password_error').text('');
            $('#password_confirmation_error').text('');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        

       function changePassword(){
         let currentPassword = $('#current_password').val();
         let newPassword = $('#password').val();
         let confirmPassword = $('#password_confirmation').val();

         $.ajax({
           type: "post",
           url: "/user/update/password",
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