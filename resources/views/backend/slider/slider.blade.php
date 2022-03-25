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
                <h3 class="box-title">Slider</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Slider Image</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($sliders as $element)
                          <tr>
                            <td>
                                @if($element->title)
                                {{ $element->title }}

                                @else
                                <span class="badge badge-pill badge badge-danger">No Ttile</span>

                                @endif
                            </td>

                            <td>
                                @if($element->description)
                                {{ $element->description }}

                                @else
                                <span class="badge badge-pill badge badge-danger">No Description</span>

                                @endif
                            </td>

                            <td>
                                @if($element->status == 1)
                                <span class="badge badge-pill badge badge-success">Active</span>

                                @else
                                <span class="badge badge-pill badge badge-success">InActive</span>

                                @endif
                            </td>
                            <td>
                                <img src="{{ asset($element->slider) }}"
                                   style="width: 130px; height 70px" alt="">
                            </td>
                            <td style="width: 27%">
                              <a href="{{ route('slider.edit', $element->id) }}" id="btnedit" title="Edit Slider" class="btn btn-info">
                                  <i class="fa-solid fa-pen-to-square"></i>
                              </a>

                              <a href="{{ route('slider.delete', $element->id) }}" id="btndelete" title="Delete Slider" class="btn btn-danger pl-5">
                                  <i class="fa-solid fa-trash-can"></i>
                              </a>

                                @if ($element->status == 1)
                                <a href="{{ route('slider.inactive', $element->id) }}" id="btnedit" class="btn btn-danger" title="Inactive Now">
                                  <i class="fa fa-arrow-down "></i>
                                </a>
                                  @else
                                  <a href="{{ route('slider.active', $element->id) }}" id="btnedit" class="btn btn-primary" title="Active Now">
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

          <!-- Add slider-->
          <div class="col-4">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Add Slider</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                    <form id="addSlider" enctype="multipart/form-data">	
                        @csrf
                        <div class="form-group">
                            <h5>Title</h5>
                            <div class="controls">
                            <input type="text" id="title" name="title" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Description</h5>
                            <div class="controls">
                            <input type="text" id="description" name="description" class="form-control">                            </div>
                        </div>

                        <div class="form-group">
                        <h5>Slider Image</h5>
                        <div class="controls">
                        <input type="file" id="slider" name="slider" class="form-control" >
                        <span class="text-danger" id="slider_error"></span>
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
      $('#slider').val('');

      //error fields
        $('#slider_error').text('');
    }

        //ajax from submission
        $("#addSlider").submit( function (e) { 
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    type: 'post',
                    url: '/slider/store',
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
                        $('#slider_error').text(err.responseJSON.errors.slider); 
                    }
                })
                
            });

</script>

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/data-table.js') }}"></script>


    
@endpush