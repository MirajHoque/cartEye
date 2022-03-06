@extends('admin.master')

@section('cdn')

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
                              <th>Brand En</th>
                              <th>Brand Ban</th>
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
                                <img src="{{ asset('$element->brand_image') }}"
                                   style="width: 70px; height 40px" alt="">
                            </td>
                            <button type="button" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
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
                    <form method="POST" action="{{ url('brand/store') }}" enctype="multipart/form-data">	
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
                        <button type="submit" class="btn btn-rounded btn-primary md-5">Add Brand</button>
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

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
	<script src="{{ asset('backend/js/pages/data-table.js') }}"></script>
    
@endpush