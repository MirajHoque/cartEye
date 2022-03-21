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
            
          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Products List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Image</th>
                              <th>Name in English</th>
                              <th>Name in Bengali</th>
                              <th>Price</th>
                              <th>Discounted Price</th>
                              <th>Quantity</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($products as $element)
                          <tr>
                            <td class="text-center">
                              <img src="{{ asset($element->product_thumbnail) }}" style="width: 60px; height: 40px;">
                          </td>
                            <td>{{ $element->product_name_en }}</td>
                            <td>{{ $element->product_name_ban }}</td>
                            <td>${{ $element->selling_price }}</td>

                            <td>

                              @if ($element->discount_price)

                              @php
                                $discountAmount = $element->selling_price - $element->discount_price;
                                $discountPercentage = ($discountAmount / $element->selling_price) * 100;
                              @endphp

                              <span class="badge badge-pill badge-success">{{ round($discountPercentage) }} %</span>

                              @else
                              <span class="badge badge-pill badge-danger">No Discount</span>
                                
                              @endif
                            
                            </td>
                            <td>{{ $element->product_qty }} units</td>
                            <td>
                              @if ($element->status == 1)
                                 <span class="badge badge-pill badge-success">Active</span>
                                @else
                                <span class="badge badge-pill badge-danger">InActive</span>
                              @endif
                            </td>
                            <td style="width: 17%">
                              <a href="{{ route('product.edit',$element->id) }}" id="btnedit" class="btn btn-info" title="Edit Product">
                                <i class="fa-solid fa-pen-to-square"></i>
                              </a>
                              <a href="{{ route('product.delete', $element->id) }}" id="btndelete" class="btn btn-danger pl-5" title="Delete Product">
                                <i class="fa-solid fa-trash-can"></i>
                              </a>

                              @if ($element->status == 1)
                              <a href="{{ route('product.inactive',$element->id) }}" id="btnedit" class="btn btn-danger" title="Inactive Now">
                                <i class="fa fa-arrow-down "></i>
                              </a>
                                @else
                                <a href="{{ route('product.active',$element->id) }}" id="btnedit" class="btn btn-primary" title="Active Now">
                                  <i class="fa fa-arrow-up"></i>
                                </a>
                              @endif

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