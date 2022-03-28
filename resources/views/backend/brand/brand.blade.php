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
                <h3 class="box-title">Brands</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Name in English</th>
                              <th>Name in Bengali</th>
                              <th>Image</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($brands as $element)
                          <tr>
                            <td>{{ $element->brand_name_en }}</td>
                            <td>{{ $element->brand_name_ban }}</td>
                            <td>
                                <img src="{{ asset($element->brand_image) }}"
                                   style="width: 50px; height 40px" alt="">
                            </td>
                            <td>
                              <button type="button" id="btnedit" onclick="editBrand($element->id)" title="Edit Brand" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></button>
                              <button type="button" id="btndelete" onclick="deleteBrand($element->id)" title="Delete Brand" class="btn btn-danger pl-5"><i class="fa-solid fa-trash-can"></i></button>
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
                 <h3 class="box-title">Brands</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                    <form id="addBrand" enctype="multipart/form-data">	
                        @csrf

                        <div class="form-group">
                            <h5>Brand Name English</h5>
                            <div class="controls">
                            <input type="text" id="brand_name_en" name="brand_name_en" class="form-control" >
                            <span class="text-danger" id="brand_name_en_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Brand Name Bangla</h5>
                            <div class="controls">
                            <input type="text" id="brand_name_ban" name="brand_name_ban" class="form-control" >
                            <span class="text-danger" id="brand_name_ban_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                        <h5>Brand Image</h5>
                        <div class="controls">
                        <input type="file" id="brand_image" name="brand_image" class="form-control" >
                        <span class="text-danger" id="brand_image_error"></span>
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
      $('#brand_name_en').val('');
      $('#brand_name_ban').val('');
      $('#brand_image').val('');

      //error fields
        $('#brand_name_en_error').text('');
        $('#brand_name_ban_error').text('');
        $('#brand_image_error').text('');
    }

        //ajax from submission
        $("#addBrand").submit( function (e) { 
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    type: 'post',
                    url: '/brand/store',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res){
                        clearData();
                        //firing sweetalert2          
                        alertMsg.fire({
                            title: res.msg,
                        })
                    },
                    error: function(err){
                        $('#brand_name_en_error').text(err.responseJSON.errors.brand_name_en);
                        $('#brand_name_ban_error').text(err.responseJSON.errors.brand_name_ban); 
                        $('#brand_image_error').text(err.responseJSON.errors.brand_image); 
                    }
                })
                
            });

</script>

<script type="text/javascript">

function editBrand(id){
              $.ajax({
                type: 'GET',
                dataType: 'json',
                url: "brand/edit/"+id,
                success: function(data){
                  console.log(data);
                  //$("#brand_name_en").val(data.name);
                  //$("#brand_name_ban").val(data.title);
                  //$("#brand_image").val(data.institute);
                  //console.log(data);
                },
                error: function(){
                  //
                }
              })
            }
</script>

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/data-table.js') }}"></script>


    
@endpush