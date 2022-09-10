<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
      <ul class="nav">
        @foreach ($categories as $element)
        <li class="dropdown menu-item">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if ($element->category_icon)
            <i class="icon {{ $element->category_icon }}" aria-hidden="true"></i>
            @endif
            @if (session()->get('language') == 'Bengali')
              {{ $element->category_name_ban }}
              @else
              {{ $element->category_name_en }}
            @endif
          </a>
          <ul class="dropdown-menu mega-menu">
            <li class="yamm-content">
              <div class="row">
                @php
                  $subCategories = App\Models\SubCategory::where('category_id', '=', $element->id)
                                   ->orderBy('sub_category_name_en', 'ASC')->get();
                @endphp

                @foreach ($subCategories as $subcategory)
                  <div class="col-sm-12 col-md-3">
                    <h2 class="title">
                      @if (session()->get('language') == 'Bengali')
                      {{ $subcategory->sub_category_name_ban }}
                      @else
                      {{ $subcategory->sub_category_name_en }}
                    @endif
                    </h2>

                    {{-- get child category --}}
                    @php
                      $childCategories = App\Models\SubSubCategory::where('sub_category_id', '=', $subcategory->id)
                                          ->orderBy('sub_sub_category_name_en', 'ASC')->get();
                    @endphp
                    
                    @foreach ($childCategories as $childCategory)
                    <ul class="links list-unstyled">
                      <li>
                        <a href="#">
                        @if (session()->get('language') == 'Bengali')
                          {{ $childCategory->sub_sub_category_name_ban }}
                        @else
                          {{ $childCategory->sub_sub_category_name_en }}
                        @endif
                        </a>
                    </li>    
                    </ul>
                    @endforeach
                    
                  </div>
                @endforeach
                
                <!-- /.col -->
              </div>
              <!-- /.row --> 
            </li>
           
            
            <!-- /.yamm-content -->
          </ul>
          <!-- /.dropdown-menu --> </li>
          @endforeach
          <!-- end category foreach loop-->
        <!-- /.menu-item -->
        
      </ul>
      <!-- /.nav --> 
    </nav>
    <!-- /.megamenu-horizontal --> 
  </div>