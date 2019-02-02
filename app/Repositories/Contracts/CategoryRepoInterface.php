<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface CategoryRepoInterface
{
    public function getAllCategories();

    public function getTotalCategories();

    public function getCategoryWithEvent(int $id); 

    public function getCategory(int $id);
    
    public function updateCategory(int $id, Request $request);

    public function getCategoriesForAdminPage();

    public function deleteCategory(int $id);
}
