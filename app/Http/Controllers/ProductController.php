<?php

namespace App\Http\Controllers;

use Storage;
use App\Product;
use App\Subcategory;
use Session;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create',['subcategories' => Subcategory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
			'name' => 'required',
			'description' => 'required',
			'price' => 'required',
	        'image' => 'required|image',
			'quantity' => 'required',
			'subcategory_id' => 'required'
		]);
		
		Product::create([
		    'image'=> $request->image->store('/public/products'),
			'name' => $request->name,
			'slug' => str_slug($request->name),
			'description' => $request->description,
			'price'	=> $request->price,
			'quantity' => $request->quantity,
			'subcategory_id' => $request->subcategory_id		
		]);
			
		Session::flash('success', 'Product Created');
		return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show',['product'=>Product::findOrFail($product->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit',['product' => Product::findOrFail($product->id), 
    										'subcategories' => Subcategory::all()]);
	}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
			'name' => 'required',
			'price' => 'required',
			'description' => 'required',
			'quantity' => 'required',
			'subcategory_id' => 'required'
		]);
		
		$product = Product::find($product->id);		
		if($request->hasFile('image')){
			
			Storage::delete($product->image);	
			$product->image = $request->image->store('/public/products');
			$product->save();
		}
				
		$product->name = $request->name;
		$product->slug = str_slug($request->name);
		$product->description = $request->description;
		$product->price	= $request->price;
		$product->quantity = $request->quantity;
		$product->subcategory_id = $request->subcategory_id;
		
		$product->save();
		
		Session::flash('success', 'Product Updated');
		return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product = Product::findOrFail($product->id);				
		$product->delete();
		 		
		Session::flash('success', 'Product Deleted');
		return redirect()->route('product.index');
    }
	
	public function bin(){
		return view('admin.products.bin',['products'=>Product::onlyTrashed()->get()]);
	}
	
	public function restore($id){
		$product = Product::withTrashed()->where('id',$id)->first();
		$product->restore();
		
		Session::flash('success', 'Product Restored');
		return redirect()->route('product.index');
	}
	
	public function kill($id){
		$prod = Product::withTrashed()->where('id',$id)->first();
				
		Storage::delete($prod->image);
		$prod->forceDelete();
		
		Session::flash('success', 'Product is permanently deleted');
		return redirect()->route('product.bin');
	}
}
