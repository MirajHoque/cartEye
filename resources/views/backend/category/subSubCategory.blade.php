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
                <h3 class="box-title">Sub->SubCategory List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Category</th>
                              <th>SubCategory Name</th>
                              <th>Sub-SubCategory Name English</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($subSubCategories as $element)
                          <tr>
                            <td>{{ $element['category']['category_name_en']}}</td>
                            <td>{{ $element['subCategory']['sub_category_name_en']}}</td>
                            <td>{{ $element->sub_sub_category_name_en }}</td>
                            <td>{{ $element->sub_sub_category_name_ban }}</td>
                            <td width= "30%">
                              <a href="{{ route('subCategory.edit',$element->id) }}" id="btnedit" class="btn btn-info" title="Edit SubCategory">
                                <i class="fa-solid fa-pen-to-square"></i>
                              </a>
                              <a href="{{ route('subCategory.remove',$element->id) }}" id="btndelete" class="btn btn-danger pl-5" title="Delete SubCategory">
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
                 <h3 class="box-title">Add Sub-SubCategory</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                    <form id="addSubSubCategory" method="" action="">	
                        @csrf
                        <div class="form-group">
                            <h5>Select Category</h5>
                            <div class="controls">
                            <select name="category_select" id="category_select" class="form-control">
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($categories as $element)
                                <option value="{{ $element->id }}">{{ $element->category_name_en }}</option>
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
                                
                            </select>
                            <span class="text-danger" id="category_name_en_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Sub-SubCategory Name English</h5>
                            <div class="controls">
                            <input type="text" id="sub_sub_category_name_en" name="sub_sub_category_name_en" class="form-control" >
                            <span class="text-danger" id="sub_sub_category_name_en_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Sub-SubCategory Name Bengali</h5>
                            <div class="controls">
                            <input type="text" id="sub_sub_category_name_ban" name="sub_sub_category_name_ban" class="form-control" >
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
   
   $(document).ready(function () {
       $('select[name = "category_select"]').on('change', function () {
          var categoryId = $(this).val();
          if(categoryId){
              $.ajax({
                  type: "GET",
                  url: "/category/subcategory/grave/"+categoryId,
                  dataType: "json",
                  success: function (res) {
                      var data = $('select[name = "sub_category_select"]').empty();
                      $.each(res, function (key, value) {
                          $('select[name = "sub_category_select"]').append(
                              '<option value="'+value.id+'">'
                                +value.sub_category_name_en+
                                '</option>'
                          ) 
                           
                      });
                      
                  }
              });
          }
          else{
              alert('danger');
          }
       });
   });

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
      $('sub_sub_category_name_en').val('');
      $('sub_sub_category_name_ban').val('');

      //error fields
        $('category_name_en_error').text('');
        $('sub_sub_category_name_ban_error').text('');
        $('sub_sub_category_icon_error').text('');
    }

        //ajax from submission
        $("#addSubSubCategory").submit( function (e) { 
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    type: 'post',
                    url: '/category/sub/store',
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
                        $('#sub_category_name_en_error').text(err.responseJSON.errors.sub_category_name_en);
                        $('#sub_category_name_ban_error').text(err.responseJSON.errors.sub_category_name_ban); 
                    }
                })
                
            });            



</script>

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/data-table.js') }}"></script>


    
@endpush