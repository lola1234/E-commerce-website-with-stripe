@extends('welcome')

@section('content')
<div class="row">
	@foreach($products as $product)
        <div class="col-md-4">	  					
			<img src="{{ asset(Storage::url($product->image))}}" alt=" " style="width:100%, height:100%" class="img-fluid">				
			<a href="{{ route('cart.add',['id'=>$product->id])}}" class="btn btn-success">Add to cart</a>
			<a href="{{ route('product.show',['product'=>$product])}}"><b>{{ $product->name }}</b></a>
			<p class="text-center"><b>€{{ $product->price }}</b></p>				
        </div> 		
    @endforeach
</div>

<br>
<div class="text-center">
	<p>{{ $products->links() }}</p>
</div>
@endsection