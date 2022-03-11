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
                                    <span class="text-danger" id="subcategory_name_en_error"></span>
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


                        <div class="row"> <!--Start 6th row-->

                            <div class="col-md-4">
                                
                                <div class="form-group">
                                    <h5>Product Discount Price<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="value" name="discount_price" id="discount_price"  class="form-control">
                                        <span class="text-danger" id="discount_price_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->

                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <h5>Product Thumbnail<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="file" name="product_thumbnail" id="product_thumbnail" class="form-control">
                                        <span class="text-danger" id="product_thumbnail_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->

                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <h5>Product Image<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="file" name="multi_img[]" id="multi_img[]" class="form-control">
                                        <span class="text-danger" id="multi_img_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->
                            



                        </div>  <!--end 6th row--> 


                        <div class="row"> <!--Start 7th row-->

                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <h5>Short Description English<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <textarea name="short_des_en" id="short_des_en" class="form-control" cols="10" rows="5"></textarea>
                                        <span class="text-danger" id="short_des_en_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->

                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <h5>Short Description Bengali<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <textarea name="short_des-ban" id="short_des-ban" class="form-control" cols="10" rows="5"></textarea>
                                        <span class="text-danger" id="short_des-ban_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->
                            
                        </div>  <!--end 7th row-->


                        <div class="row"> <!--Start 8th row-->

                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <h5>Long Description English<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <textarea id="editor1" name="long_des_en" rows="10" cols="80">
                                            Long Description English...
                                        </textarea>
                                        <span class="text-danger" id="short_des_en_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->

                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <h5>Long Description Bengali<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <textarea id="editor2" name="long_des_ban" rows="10" cols="80">
                                            Long Description Bengali...
                                        </textarea>
                                        <span class="text-danger" id="short_des-ban_error"></span>
                                    </div>
                                </div>

                            </div>  <!--end column-->
                            
                        </div>  <!--end 8th row-->
                        
                        <hr>


                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <fieldset>
                                        <input type="checkbox" id="hot_deals" name="hot_deals" value="1">
                                        <label for="hot_deals">Hot deals</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="featured" name="featured" value="1">
                                        <label for="featured">Featured</label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <fieldset>
                                        <input type="checkbox" id="special_offer" name="special_offer" value="1">
                                        <label for="special_offer">Speaial Offer</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="special_deals" name="special_deals" value="1">
                                        <label for="special_deals">Speaial Deals</label>
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
<script type="text/javascript">
    
    $(document).ready(function () {
    $('select[name = "category_id"]').on('change', function () {
       var categoryId = $(this).val();
       if(categoryId){
           $.ajax({
               type: "GET",
               url: "/category/subcategory/grave/"+categoryId,
               dataType: "json",
               success: function (res) {
                   var data = $('select[name = "subcategory_id"]').empty();
                   $.each(res, function (key, value) {
                       $('select[name = "subcategory_id"]').append(
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


    $('select[name = "subcategory_id"]').on('change', function () {
       var subCategoryId = $(this).val();
       if(subCategoryId){
           $.ajax({
               type: "GET",
               url: "/category/sub/subcategory/grave/"+subCategoryId,
               dataType: "json",
               success: function (res) {
                   var data = $('select[name = "subsubcategory_id"]').empty();
                   $.each(res, function (key, value) {
                       $('select[name = "subsubcategory_id"]').append(
                           '<option value="'+value.id+'">'
                             +value.sub_sub_category_name_en+
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

</script>

<script src="{{asset('assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
<script src="{{ asset('backend/js/pages/editor.js') }}"></script>
@endpush