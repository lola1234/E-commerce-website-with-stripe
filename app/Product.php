<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['name', 'slug', 'image', 'price', 
		'subcategory_id', 'description', 'quantity'
	];
	
	protected $dates=['deleted_at'];
	
	public function Subcategory(){
		return $this->belongsTo('App\Subcategory');
	}
	
	public function getNameAttribute($name){
		return ucfirst($name);
	}
	
	public function getDescriptionAttribute($description){
		return ucfirst($description);
	}
	
	
}
