<?php

namespace App\Http\Controllers;

use App\Subcategory;
use App\Category;
use Session;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subcategories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
			'category_id' => 'required'
        ]);
		
        Subcategory::create([
			'name' => $request->name,
			'slug' => str_slug($request->name),
			'category_id' => $request->category_id
		]);
        Session::flash('success', 'New Sub Category created ');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $subcategory = Subcategory::find($subcategory->id);
        $subcategory->name = $request->name;
		$subcategory->slug = str_slug($request->name);
		$subcategory->category_id = $request->category_id;
        $subcategory->save();
		
        Session::flash('success', 'You succesfully updated the category.');
		
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory = Subcategory::find($subcategory->id);
		
        foreach($subcategory->products as $p){
            $p->forceDelete();
        }	
		
        $subcategory->delete();
        Session::flash('success', ' Subcategory deleted');
		
        return redirect()->back();
    }
}
