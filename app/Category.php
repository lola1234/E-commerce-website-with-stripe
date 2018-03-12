<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description'];
	
	public function subcategories(){
		return $this->hasMany('App\Subcategory');
	}
}
