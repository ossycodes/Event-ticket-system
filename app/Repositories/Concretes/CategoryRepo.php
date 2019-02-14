<?php

namespace App\Repositories\Concretes;

use App\Category;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Contracts\CategoryRepoInterface;

class CategoryRepo implements CategoryRepoInterface
{

    /**
     * @return mixed
     */
    public function getAllCategories()
    {
        $result = Cache::remember('all_categories_cache', 1440, function () {
            return Category::all();
        });

        return $result;        
    }

    /**
     * @return int
     */
    public function getTotalCategories()
    {
        return Category::all()->count();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getCategoryWithEvent(int $id)
    {
        return Category::where('id', $id)->with('events')->orderBy('id', 'DESC')->paginate(1);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getCategory(int $id)
    {
        return Category::findOrFail($id);
    }

    /**
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function updateCategory(int $id, \Illuminate\Http\Request $request)
    {
        return Category::where('id', $id)->update([
            'name' => $request->name
        ]);
    }

    /**
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCategoriesForAdminPage() {
        return Category::all();
    }

    /**
     * @param int $id
     * @return int
     */
    public function deleteCategory(int $id) {
        return Category::destroy($id);
    }

    /**
     * @return mixed
     */
    public function createCategory(Array $request)
    {
        return Category::create($request);
    }
}