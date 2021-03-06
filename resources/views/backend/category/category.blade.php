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
            
          <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Category List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Icon</th>
                              <th>Category En</th>
                              <th>Category Ban</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($categories as $element)
                          <tr>
                            <td class="text-center">
                              <span><i class="{{ $element->category_icon }}"></i></span>
                          </td>
                            <td>{{ $element->category_name_en }}</td>
                            <td>{{ $element->category_name_ban }}</td>
                            <td>
                              <a href="{{ route('category.edit',$element->id) }}" id="btnedit" class="btn btn-info" title="Edit Category">
                                <i class="fa-solid fa-pen-to-square"></i>
                              </a>
                              <a href="{{ route('category.remove',$element->id) }}" id="btndelete" class="btn btn-danger pl-5" title="Delete Category">
                                <i class="fa-solid fa-trash-can"></i>
                              </a>
                            </td>
                        </tr>
                          @endforeach
                          
                          
                      </tbody>
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->          
          </div>

          <!-- Add Brands-->
          <div class="col-4">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Add Category</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                    <form id="addCategory" method="" action="" enctype="multipart/form-data">	
                        @csrf
                        <div class="form-group">
                            <h5>Category Name English</h5>
                            <div class="controls">
                            <input type="text" id="category_name_en" name="category_name_en" class="form-control" >
                            <span class="text-danger" id="category_name_en_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Category Name Bangla</h5>
                            <div class="controls">
                            <input type="text" id="category_name_ban" name="category_name_ban" class="form-control" >
                            <span class="text-danger" id="category_name_ban_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                        <h5>Category Icon</h5>
                        <div class="controls">
                        <input type="text" id="category_icon" name="category_icon" class="form-control" >
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
        $("#addCategory").submit( function (e) { 
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    type: 'post',
                    url: '/category/store',
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