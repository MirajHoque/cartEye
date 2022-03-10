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
                      <!-- Edit Sub-SubCategory-->
          <div class="col-12 ml-1 mr-5">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit Sub-SubCategory</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                    <form id="updateSubSubCategory" method="" action="">	
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $subSubCategory->id }}">
                        <div class="form-group">
                            <h5>Select Category</h5>
                            <div class="controls">
                            <select name="category_select" id="category_select" class="form-control">
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($categories as $element)
                                <option value="{{ $element->id }}"
                                  {{ $element->id == $subSubCategory->category_id ? 'selected' : '' }}>
                                    {{ $element->category_name_en }}
                                </option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="category_name_en_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Select SubCategory</h5>
                            <div class="controls">
                            <select name="sub_category_select" id="sub_category_select" class="form-control">
                                <option value="" selected disabled>Select  SubCategory</option>
                                @foreach ($subCategories as $element)
                                <option value="{{ $element->id }}"
                                  {{ $element->id == $subSubCategory->sub_category_id ? 'selected' : '' }}>
                                    {{ $element->sub_category_name_en }}
                                </option>
                                @endforeach
                                
                            </select>
                            <span class="text-danger" id="sub_category_name_en_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Sub-SubCategory Name English</h5>
                            <div class="controls">
                            <input type="text" id="sub_sub_category_name_en" name="sub_sub_category_name_en" value="{{ $subSubCategory->sub_sub_category_name_en }}" class="form-control" >
                            <span class="text-danger" id="sub_sub_category_name_en_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Sub-SubCategory Name Bengali</h5>
                            <div class="controls">
                            <input type="text" id="sub_sub_category_name_ban" name="sub_sub_category_name_ban" value="{{ $subSubCategory->sub_sub_category_name_ban }}" class="form-control" >
                            <span class="text-danger" id="sub_sub_category_name_ban_error"></span>
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
      $('#category_select').val('');
      $('#sub_category_select').val('');
      $('#sub_sub_category_name_en').val('');
      $('#sub_sub_category_name_ban').val('');

      //error fields
        $('#category_name_en_error').text('');
        $('#sub_category_name_en_error').text('');
        $('#sub_sub_category_name_en_error').text('');
        $('#sub_sub_category_name_ban_error').text('');
    }

        //ajax from submission
        $("#updateSubSubCategory").submit( function (e) { 
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    type: 'post',
                    url: '/category/sub/sub/update',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res){
                        clearData();
                        window.location = res.redirect_uri;
                        //firing sweetalert2          
                        alertMsg.fire({
                            title: res.msg,
                        })
                    },
                    error: function(err){
                        $('#category_name_en_error').text(err.responseJSON.errors.category_select);
                        $('#sub_category_name_en_error').text(err.responseJSON.errors.sub_category_select); 
                        $('#sub_sub_category_name_en_error').text(err.responseJSON.errors.sub_sub_category_name_en);
                        $('#sub_sub_category_name_ban_error').text(err.responseJSON.errors.sub_sub_category_name_ban); 
                    }
                });
                
            });            



</script>

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/data-table.js') }}"></script>


    
@endpush