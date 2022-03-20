<div class="col-md-4"> 
    <div class="form-group">
        <h5>Product Thumbnail<span class="text-danger"></span></h5>
        <div class="controls">
            <input type="file" name="product_thumbnail" id="product_thumbnail" onchange="thumbnail(this)" class="form-control">
            <span class="text-danger" id="product_thumbnail_error"></span>
            <img src="" id="mainThumbnail" alt="">
        </div>
    </div>

</div>  <!--end column-->

<div class="col-md-4"> 
    <div class="form-group">
        <h5>Product Image<span class="text-danger"></span></h5>
        <div class="controls">
            <input type="file" name="multi_img[]" id="multi_img" multiple="" class="form-control">
            <span class="text-danger" id="multi_img_error"></span>
            <div class="row" id="preview_img"></div>
        </div>
    </div>

</div>  <!--end column-->

