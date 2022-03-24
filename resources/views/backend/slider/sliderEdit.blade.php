@extends('admin.master')

@section('cdn')
<!-- csrf token meta for ajax-->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<!-- SweetAlert2-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Front Awesome CDN-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


@endsection


@section('admin')


<!-- Content Wrapper. Contains page content -->
<div class="content-wraprpe">
    <div class="container-full">

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <!-- Edit Slider-->
          <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Slider</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                    <form id="updateSlider" method="" action="" enctype="multipart/form-data">	
                        @csrf

                        <input type="hidden" value="{{ $slider->id }}" name="slider_id" id="slider_id">
                        <input type="hidden" value="{{ $slider->slider }}" name='slider_img' id="slider_img">
                        
                        <div class="form-group">
                            <h5><Title></Title></h5>
                            <div class="controls">
                            <input type="text" value="{{ $slider->title }}" id="title" name="title" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Description</h5>
                            <div class="controls">
                            <input type="text" value="{{ $slider->description }}" id="description" name="description" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                        <h5>Image</h5>
                        <div class="controls">
                        <input type="file" id="slider" name="slider" class="form-control" >
                        </div>
                    </div>

                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-primary md-5">
                    </div>
                
                </form>
                   </div>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->          
           </div>
          
          

           

          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
    
</div>


@endsection

@push('script')



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
      //input fields
      $('title').val('');
      $('description').val('');
      $('slider').val('');
    }

        //ajax from submission
        $("#updateSlider").submit( function (e) { 
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    type: 'post',
                    url: '/slider/update',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res){
                        clearData();
                        window.location = res.redirect_uri
                        //firing sweetalert2          
                        alertMsg.fire({
                            title: res.msg,
                        })
                    },
                    error: function(err){}
                })
                
            });



</script>

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/data-table.js') }}"></script>


    
@endpush