<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
	/*
	An example of Route Model Binding(Implicit Binding, check 
	laravel doocumentation for explicit binding)
	*/

    public function index(Product $product){
    	
    	//$name = $product->name;
    	//echo $product; die;
    	return view('displayproductpage')->with(compact('product'));
    }

    /*
    The normal find by primary key method
    */

    public function show($id = null){
    	//echo $id; die;
    	$productDetails = Product::find($id);
    	//or
    	$productDetails = Product::where(['id' => $id])->first();
    	//echo $productDetails; die;
    	echo $productDetails->name; die;
    }

    /*public function showPrice(Request $request, Product $product){
    	echo $product->price; die;
    }*/

    public function showPrice($id=null){
    	
    	/*
    	This fetches all the values in the product table  and displays them
    	as JSON
    	$productDetails = Product::get();

    	Then this is to access individual property
		echo $productDetails->name; die;
    	*/
    	
    	/*
		This fetches all values of  an item with a particular id from the table
    	*/
    	
    	//$productDetails = Product::where(['id' => $id])->first();
    	return Product::showProductDetails($id);
    	
    	//echo $productDetails; die;
    }

}
