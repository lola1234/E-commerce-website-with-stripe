@extends('welcome')

@section('content')
@if(Session::has('cart'))

<h3 class="text-center">Shopping Cart</h3>	
<ul class="list-group">
	@foreach($products as $product)  
		<li class="list-group-item">	
			<img src="{{ asset(Storage::url($product['item']['image']))}}" alt=" " width="40px" height="40px" class="img-fluid">	
			<strong>{{ $product['item']['name'] }}</strong>
			<span class="text-center">{{ $product['qty'] }}</span>
			<p class="text-center">€{{ $product['price'] }}</p>
			
			<div class="btn-group float-right">
				<button type="button" class="btn btn-primary btn-xs dropdown-toogle" data-toggle="dropdown">Action <span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="{{ route('cart.decr',['id'=>$product['item']['id']] )}}">Reduce by 1</a></li>
					<li><a href="{{ route('cart.remove', ['id'=>$product['item']['id']] )}}">Reduce All</a></li>
				</ul>
			</div>
		</li>
		<br>
	@endforeach
</ul>		
	
<div class="float-right">
	<strong>Total: {{ $totalPrice }}</strong>
</div>
<br>	
<div class="text-center">
	<a href="{{ route('cart.checkout')}}" class="btn btn-success">Checkout</a>
</div>
<br>
<br>
	
@else
	<div class="row">
		<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
			<h2>No Items in Cart!</h2>
		</div>
	</div>
@endif
@endsection








