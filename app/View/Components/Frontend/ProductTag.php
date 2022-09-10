<?php

namespace App\View\Components\Frontend;

use App\Models\Product;
use Illuminate\View\Component;

class ProductTag extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if(session()->get('language') == 'Bengali'){
            $tags = Product::groupBy('product_tag_ban')->select('product_tag_ban')->get();
        }
        else{
            $tags = Product::groupBy('product_tag_en')->select('product_tag_en')->get();
        }

        return view('components.frontend.product-tag', compact('tags'));
    }
}
