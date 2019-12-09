<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Auth;

use Illuminate\{
    Database\QueryException,
    Http\Request,
    Support\Facades\Log
}; //php7 grouping use statements

use App\{
    Category,
    Http\Controllers\Controller,
    Repositories\Contracts\CategoryRepoInterface
}; //php7 grouping use statements
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $categoryRepo;

    /**
     * CategoryController constructor.
     * @param CategoryRepoInterface $categoryRepo
     */
    public function __construct(CategoryRepoInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepo->getCategoriesForAdminPage();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepo->createCategory($request->validated());
        return redirect()->route('system-admin.categories.create')->with('success', 'Category added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepo->getCategory($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->categoryRepo->updateCategory($id, $request);
        return redirect()->route('system-admin.categories.edit', $id)->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryRepo->deleteCategory($id);
        return redirect()->route('system-admin.categories.index')->with('success', 'Category deleted successfully');
    }
}
