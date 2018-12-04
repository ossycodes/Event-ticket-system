<?php

namespace App\Repositories\Concretes;

use App\Category;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Contracts\CategoryRepoInterface;

class CategoryRepo implements CategoryRepoInterface
{

    public function getAllCategories()
    {
        $result = Cache::remember('all_categories_cache', 1440, function () {
            return Category::all();
        });

        return $result;
        
    }

    public function getTotalCategories()
    {
        return Category::all()->count();
    }

    public function getCategoryWithEvent(int $id)
    {
        return Category::where('id', $id)->with('events')->orderBy('id', 'DESC')->paginate(1);
    }

    public function getCategory(int $id)
    {
        return Category::findOrFail($id);
    }

}