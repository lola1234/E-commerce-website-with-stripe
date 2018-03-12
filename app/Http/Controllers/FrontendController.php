<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use App\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
		return view('welcome');
	}
	
	public function products(){
		return view('frontend.products',['products'=>Product::paginate(8)]);										
	}
	
	public function subProducts($slug){
		$s = Subcategory::where('slug',$slug)->first();
		return view('frontend.products',['products'=>$s->products()->paginate(8)]);
	}
	

}
