@extends('welcome')

@section('content')
<p class="text-center"><b>{{ $product->name }}</b></p>
<div class="row">	
    <div class="col-md-5">	  					
		<img src="{{ asset(Storage::url($product->image))}}" alt=" " style="width:100%, height:100%" class="img-fluid">				
	</div>
	<br>
	<div class="col-md-5">
		<a href="{{ route('cart.add',['id'=>$product->id])}}" class="btn btn-success btn">Add to cart</a>					
		<br>
		<p>{{ $product->description }}</p>
		<p><b>€{{ $product->price }}</b></p>
    </div> 		  
</div>

<br>
@endsection