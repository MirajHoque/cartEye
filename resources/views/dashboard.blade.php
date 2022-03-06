@extends('frontend.layout')

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
                         <a class="btn btn-primary btn-sm btn-block disabled">Home</a>
                         <a class="btn btn-primary btn-sm btn-block" href="{{ route('user.profile') }}">Update Info </a>
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
                        Welcome to cartEye
                    </h3>
                </div>
                   
            </div>


           </div> 
           <!-- end row-->
       </div>
   </div>



@endsection