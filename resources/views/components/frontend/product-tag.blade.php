<!-- ============================================== PRODUCT TAGS ============================================== -->
<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title ">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
     
      <div class="tag-list"> 
        @foreach ($tags as $tag)
          <a class="item" title="Phone" href="{{ route('product-tag', $tag->product_tag_en ?? $tag->product_tag_ban) }}">
            {{ str_replace(',', ' ', $tag->product_tag_en)}}  {{ str_replace(',', ' ', $tag->product_tag_ban) }}
          </a>
        @endforeach            
      <!-- /.tag-list --> 
    </div>
    <!-- /.sidebar-widget-body --> 
  </div>
  <!-- /.sidebar-widget --> 
</div>
  <!-- ============================================== PRODUCT TAGS : END ============================================== --> 