<?php

namespace App\Traits;

use App\Models\Category;

trait CategoryTrait
{
    
    public function allCategory()
    {
        $Categories = Category::all();
        return $Categories;
    }
}
