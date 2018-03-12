<?php

namespace App\Http\Controllers;

use App\Category;
use Session;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index',['categories'=>Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
			'description' => 'required'
        ]);
		
        $category = new Category;
        $category->name = $request->name;
		$category->description = $request->description;
		$category->slug = str_slug($request->name);
        $category->save();
		
        Session::flash('success', 'Category created.');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
		$category = Category::findOrFail($category->id);
        $category->name = $request->name;
		$category->slug = str_slug($request->name);
		$category->description = $request->description;
        $category->save();
		
        Session::flash('success', 'Category updated');
		
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category = Category::findOrFail($category->id);
		
        foreach($category->Subcategories as $subcategory){
             foreach($subcategory->products as $product){
				$product->forceDelete();
			}
			$subcategory->delete();
        }	
		
        $category->delete();
        Session::flash('success', 'Category deleted');		
        return redirect()->route('category.index');
    }
}
