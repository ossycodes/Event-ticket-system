<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //log event to laravel.log
        Log::info('Displayed a list of the available categories in database');
        //get all categories from database
        $categories = Category::all(); 
        //return the index view
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //log event to laravel.log
        Log::info('Returned a form, where User with email:' . ' ' . Auth::user()->email . ' ' . ' and name:' . Auth::user()->name . ' ' . 'can create a category');
        //return category create view
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request
        Validator::make($request->all(), [
            'name' => 'required|unique:categories',
        ])->validate();
        //log event to laravel.log
        Log::info('User with email:' . '  ' . Auth::user()->email . ' ' . 'and name:' . '  ' . Auth::user()->name . '  ' . 'just created a category');
        //create the category
        try {
            Category::create($request->all());
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            //return flash session error message to view
            return redirect()->route('system-admin.categories.create')->with('error', 'something went wrong');
        }

        //redirect back 
        return redirect()->route('system-admin.categories.create')->with('success', 'Category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //log event
        log::info('Displayed a category with Id number: ' . $id);
        //find category with $id
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
         //log event
        log::info('User with email of:' . ' ' . Auth::user()->email . ' ' . 'and name:' . Auth::user()->name . ' ' . 'updated a post with Id number: ' . $id);
         //mass update the category
        Category::where('id', $id)->update([
            'name' => $request->name
        ]);
         //return redirect back to edit page
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
            //log event
        Log::info('category with Id number: ' . ' ' . $id . ' ' . 'just got deleted by User with email:' . Auth::user()->email . ' ' . 'and name:' . Auth::user()->name);
            //delete category by id
        Category::destroy($id);
            //return back to category index page
        return redirect()->route('system-admin.categories.index')->with('success', 'Category deleted successfully');

    }
}
