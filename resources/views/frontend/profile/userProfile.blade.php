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
                         <a class="btn btn-primary btn-sm btn-block" href="{{ route('dashboard') }}">Home</a>
                         <a class="btn btn-primary btn-sm btn-block disabled">Update Info</a>
                         <a class="btn btn-primary btn-sm btn-block" href="{{ route('change.password') }}">Change Password</a>
                         <a class="btn btn-danger btn-sm btn-block" href="{{ route('user.logout') }}">Logout</a>
                     </ul>

               </div>

               <div class="col-md-2 pb-2">
                   
            </div>

            <div class="col-md-6 pt-2">
                <div class="card">
                    <h3 class="text-center">
                        <span class="text-danger">Hi.. </span>
                        <strong>{{ Auth::user()->name }}</strong>
                        Update Your Profile
                    </h3>
                    <div class="card-body">
                         <form id="updateUserInfo"  enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Name <span></span></label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control unicase-form-control text-input">
                                <span id="nameError" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email<span></span></label>
                                <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control unicase-form-control text-input">
                                <span id="emailError" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Phone<span></span></label>
                                <input type="number" id="phone" name="phone" value="{{ $user->phone }}" class="form-control unicase-form-control text-input">
                                <span id="phoneError" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Profile Picture<span></span></label>
                                <input type="file" id="profile_photo" name="profile_photo" class="form-control">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>


                         </form>
                    </div>
                </div>
                   
            </div>


           </div> 
           <!-- end row-->
       </div>
   </div>

   <script>

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
            $('#nameError').text('');
            $('#emailError').text('');
            $('#phoneError').text('');
        }

        //ajax from submission
        $("#updateUserInfo").submit( function (e) { 
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                type: 'post',
                url: '/user/profile/store',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res){
                    clearData();
                    //firing sweetalert2          
                    alertMsg.fire({
                        title: res.msg,
                    })
                    window.location = res.redirect_uri;
                },
                error: function(err){
                    console.log(err);
                    $('#nameError').text(err.responseJSON.errors.name);
                    $('#emailError').text(err.responseJSON.errors.email);
                    $('#phoneError').text(err.responseJSON.errors.phone);
                }
            })
            
        });


   </script>



@endsection