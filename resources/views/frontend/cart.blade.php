@extends('welcome')

@section('content')
@if(Session::has('cart'))

	<h3 class="text-center">Shopping Cart</h3>	

	@foreach($products as $product)  	
	<table class="table table-cart">
		<tbody valign="middle">
			<tr>
				<td><a class="item-remove" href="{{ route('cart.remove', ['id'=>$product['item']['id']] )}}"><i class="fas fa-times"></i></a></td>
				<td><a href="#"><img src="{{ asset(Storage::url($product['item']['image']))}}" alt=" " width="80px" height="40px" class="img-fluid"></a></td>

				<td>
				  <h5>{{ $product['item']['name'] }}</h5>
				  <span>{{ $product['item']['description'] }}</span>
				</td>

				<td>
					<span><a class="incr" href="{{ route('cart.add',['id'=>$product['item']['id']])}}"><i class="fas fa-plus-circle"></i></a>
						<input type="number" id="prodQty" value="{{ $product['qty'] }}" class="text-center" readonly>
						<a class="decr" href="{{route('cart.decr',['id'=>$product['item']['id']])}}"><i class="fas fa-minus-circle"></i></a>
					</span>
				</td>

				<td><h4 id="pTotal">€{{ $product['price'] }}</h4></td>
			</tr>
		</tbody>
	</table>
	@endforeach
	<hr>
	<p class="total-price"><b>Total:  <span id="price">
		 {{ $totalPrice }}
		</span></b>
	</p>
	<br>	
	<div class="text-center">
		<a href="{{ route('cart.checkout')}}" class="btn btn-secondary checkout">Checkout</a>
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

@section('scripts')
$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$(".item-remove").click(function(event){
		event.preventDefault();
		var url=$(this).attr("href");
		var row=$(this).parent().parent();
		$.ajax({
			type:'GET',
			url: url,
			success: function (data) {
				row.remove();
				$("#cartqty").html(data.totalQty);
				$("#price").html(data.totalPrice);			
			}				
		});
	});
	$(".incr").click(function(event){
		event.preventDefault();
		
		var url=$(this).attr("href");
		var oldqty=$("#prodQty").val();
		
		$.ajax({
			type:'GET',
			url: url,
			success: function (data) {			
				$("#cartqty").html(data.cart.totalQty);			
				$("#price").html(data.cart.totalPrice);
				newqty=parseInt(oldqty) + 1;
				$("#prodQty").val(newqty);
				$("#pTotal").html(data.price);
			}				
		});
	});
	$(".decr").click(function(event){
		event.preventDefault();
		var url=$(this).attr("href");
		var oldqty=$("#prodQty").val();
		$.ajax({
			type:'GET',
			url: url,
			success: function (data) {			
				$("#cartqty").html(data.cart.totalQty);			
				$("#price").html(data.cart.totalPrice);
				newqty=parseInt(oldqty) - 1;
				$("#prodQty").val(newqty);
				$("#pTotal").html(data.price);
			}				
		});
	});
	
});
@endsection








