@extends('admin.master')

@section('cdn')
    <!-- csrf token meta for ajax-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
             <h4 class="box-title">Admin Profile Edit</h4>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form method="POST" action="{{ url('admin/profile/store') }}" id="updateAdminInfo"  enctype="multipart/form-data">
                    @csrf
                     <div class="row">
                       <div class="col-12">		
                           <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>User Name</h5>
                                        <div class="controls">
                                        <input type="text" id="name" name="name" value=" {{ $editData->name }} " class="form-control" >
                                        <span class="text-danger" id="nameError"></span>
                                        </div>
                                    </div>
                               </div>

                               <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="email" id="email" name="email" value=" {{ $editData->email }} " class="form-control" >
                                    <span class="text-danger" id="emailError"></span>
                                    </div>
                               </div>
                            </div>
                               </div>

                               <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Profile Picture <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="file" id="profile_photo" name="profile_photo" class="form-control">
                                       </div>
                                    </div>
                                </div>
 
                                <div class="col-md-6">
                                    <img id="show_Profile_img" src="{{ !empty($editData->profile_photo_path) ? 
                                        url('upload/adminImages/'.$editData->profile_photo_path) : url('upload/default.png') }}" alt=""
                                        style="width: 100px; height:100px ">      
                               </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-xs-right">
            <button type="submit" class="btn btn-rounded btn-primary md-5">Update</button>
        </div>
                   </form>

               </div>
               <!-- /.col -->
             </div>
             <!-- /.row -->
           </div>
           <!-- /.box-body -->
         </div>
         <!-- /.box -->

       </section>
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

        $(document).ready(function () {
            $('#profile_photo').change(function (e) { 
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#show_Profile_img').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            });
        });

        //setting up ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

      

        //clear error message
        function clearData(){
            $('#nameError').text('');
            $('#emailError').text('');
        }

        //ajax from submission
        $("#updateAdminInfo").submit( function (e) { 
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                type: 'post',
                url: '/admin/profile/store',
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
                    $('#nameError').text(err.responseJSON.errors.name);
                    $('#emailError').text(err.responseJSON.errors.email);
                }
            })
            
        });


    </script>

@endsection
 

 