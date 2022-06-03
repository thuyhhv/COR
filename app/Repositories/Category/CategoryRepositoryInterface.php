<?php
namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getCategory($request);

    public function postCategory($request);

    public function updateCategory($request, $id);
}