<?php
namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getProduct($request);
    
    public function postProduct($request);

    public function updateProduct($request, $id);
}