<?php

namespace App\Traits;

use App\Models\Product;

trait ProductTrait
{
    
    public function allProduct()
    {
        $products = Product::all();
        return $products;
    }

}
