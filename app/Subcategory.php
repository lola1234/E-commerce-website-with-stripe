<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['name', 'slug', 'category_id'];
	
	
	public function Category(){
		return $this->belongsTo('App\Category');
	}
	
	public function Products(){
		return $this->hasMany('App\Product');
	}
	
	
	
	



}