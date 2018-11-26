<?php

namespace App\Repositories\Concretes;

use App\Repositories\Contracts\CategoryRepoInterface;
use App\Category;

class CategoryRepo implements CategoryRepoInterface
{

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getTotalCategories()
    {
        return Category::all()->count();
    }

    public function getCategoryWithEvent(int $id)
    {
        return Category::where('id', $id)->with('events')->orderBy('id', 'DESC')->paginate(1);
    }

}