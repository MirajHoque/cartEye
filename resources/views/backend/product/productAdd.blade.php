@extends('admin.master')

@section('admin')


<div class="container-full">
  
    <!-- Main content -->
    <section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
        <h4 class="box-title">Add Product</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <div class="row">
            <div class="col">
                <form novalidate>
                <div class="row">
                    <div class="col-12">
                        <div class="row"> <!--Start 1st row-->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Select Brand</h5>
                                    <div class="controls">
                                    <select name="brand_id" id="brand_id" class="form-control">
                                        <option value="" selected disabled>Select Brand</option>
                                        @foreach ($brands as $element)
                                        <option value="{{ $element->id }}">
                                            {{ $element->brand_name_en }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="brand_name_en_error"></span>
                                    </div>
                                </div>
                                 

                            </div>  <!--end column-->

                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <h5>Select Category</h5>
                                    <div class="controls">
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach ($categories as $element)
                                        <option value="{{ $element->id }}">
                                            {{ $element->category_name_en }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="category_name_en_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->

                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <h5>Select Sub Category</h5>
                                    <div class="controls">
                                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                                        <option value="" selected disabled>Select SubCategory</option>
                                    </select>
                                    <span class="text-danger" id="category_name_en_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->
                            



                        </div>  <!--end 1st row-->

                        <div class="row"> <!--Start 2nd row-->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Select Sub SubCategory</h5>
                                    <div class="controls">
                                    <select name="subsubcategory_id" id="subsubcategory_id" class="form-control">
                                        <option value="" selected disabled>Select Brand</option>
                                    </select>
                                    <span class="text-danger" id="subsubcategory_id_error"></span>
                                    </div>
                                </div>
                                 

                            </div>  <!--end column-->

                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <h5>Product Name English<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name-en" id="product_name-en" class="form-control">
                                        <span class="text-danger" id="product_name-en_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->

                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <h5>Product Name Bengali<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_ban" id="product_name_ban" class="form-control">
                                        <span class="text-danger" id="product_name_ban_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->
                            



                        </div>  <!--end 2nd row-->     
                        
                        <div class="row"> <!--Start 3rd row-->

                            <div class="col-md-4">
                                
                                <div class="form-group">
                                    <h5>Product Code<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_code" id="product_code" class="form-control">
                                        <span class="text-danger" id="product_code_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->

                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <h5>Product Quantity<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_qty" id="product_qty" class="form-control">
                                        <span class="text-danger" id="product_qty_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->

                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <h5>Product Tags English<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_tag_en" id="product_tag_en" value="Lorem,Ipsum,Amet" data-role="tagsinput" class="form-control">
                                        <span class="text-danger" id="product_tag_en_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->                            

                        </div>  <!--end 3rd row--> 



                        <div class="row"> <!--Start 4th row-->

                            <div class="col-md-4">
                                
                                <div class="form-group">
                                    <h5>Product Tags Bengali<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_tag_ban" id="product_tag_ban" value="Lorem,Ipsum,Amet" data-role="tagsinput"  class="form-control">
                                        <span class="text-danger" id="product_tag_ban_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->

                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <h5>Product Size English<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_size_en" id="product_size_en" value="Small,Medium,Large" data-role="tagsinput"  class="form-control">
                                        <span class="text-danger" id="product_size_en_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->

                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <h5>Product Size Bengali<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_size_ban" id="product_size_ban" value="ছোট,মাঝারি,বড়" data-role="tagsinput" class="form-control">
                                        <span class="text-danger" id="product_size_ban_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->
                            



                        </div>  <!--end 4th row--> 


                        <div class="row"> <!--Start 5th row-->

                            <div class="col-md-4">
                                
                                <div class="form-group">
                                    <h5>Product Color English<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_color_en" id="product_color_en" value="Red,Green,Blue" data-role="tagsinput"  class="form-control">
                                        <span class="text-danger" id="product_color_en_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->

                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <h5>Product Color Bengali<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_color_ban" id="product_color_ban" value="লাল,সবুজ,নীল" data-role="tagsinput"  class="form-control">
                                        <span class="text-danger" id="product_color_ban_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->

                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <h5>Product Selling Price<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="value" name="selling_price" id="selling_price" class="form-control">
                                        <span class="text-danger" id="selling_price_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->
                            



                        </div>  <!--end 5th row--> 
                        
                        

                        
                        <div class="form-group">
                            <h5>File Input Field <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="file" class="form-control" required> </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <h5>Basic Select <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="select" id="select" required class="form-control">
                                    <option value="">Select Your City</option>
                                    <option value="1">India</option>
                                    <option value="2">USA</option>
                                    <option value="3">UK</option>
                                    <option value="4">Canada</option>
                                    <option value="5">Dubai</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Textarea <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <textarea name="textarea" id="textarea" class="form-control" required placeholder="Textarea text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Checkbox <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="checkbox" id="checkbox_1" required value="single">
                                    <label for="checkbox_1">Check this custom checkbox</label>
                                </div>								
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Checkbox Group <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_2" required value="x">
                                        <label for="checkbox_2">I am unchecked Checkbox</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_3" value="y">
                                        <label for="checkbox_3">I am unchecked too</label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-info" value="Add Product">
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
    <!-- /.content -->
</div>

@endsection

@push('script')
<script src="{{asset('assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
@endpush