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

          <!-- Add Brands-->
          <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Brands</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                    <form id="updateCategory" method="" action="" enctype="multipart/form-data">	
                        @csrf
                        <input type="hidden" value="{{ $category->id }}" name="category_id" id="category_id">
                        <div class="form-group">
                            <h5>Category Name English</h5>
                            <div class="controls">
                            <input type="text" value="{{ $category->category_name_en }}" id="category_name_en" name="category_name_en" class="form-control" >
                            <span class="text-danger" id="category_name_en_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Category Name Bangla</h5>
                            <div class="controls">
                            <input type="text" value="{{ $category->category_name_ban }}" id="category_name_ban" name="category_name_ban" class="form-control" >
                            <span class="text-danger" id="category_name_ban_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                        <h5>Category Icon</h5>
                        <div class="controls">
                        <input type="text" value="{{ $category->category_icon }}" id="category_icon" name="category_icon" class="form-control" >
                        <span class="text-danger" id="category_icon_error"></span>
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
      $('category_name_en').val('');
      $('category_name_ban').val('');
      $('category_icon').val('');

      //error fields
        $('category_name_en_error').text('');
        $('category_name_ban_error').text('');
        $('category_icon_error').text('');
    }

        //ajax from submission
        $("#updateCategory").submit( function (e) { 
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    type: 'post',
                    url: '/category/update',
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
                    error: function(err){
                        $('#category_name_en_error').text(err.responseJSON.errors.category_name_en);
                        $('#category_name_ban_error').text(err.responseJSON.errors.category_name_ban); 
                        $('#category_icon_error').text(err.responseJSON.errors.category_icon); 
                    }
                })
                
            });



</script>

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/data-table.js') }}"></script>


    
@endpush