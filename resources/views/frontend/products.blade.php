@extends('welcome')

@section('content')
<!--show all products-->
<div class="row">
	@foreach($products as $product)
        <div class="col-md-4">
			<div class="card">
				<div class="card-body">
				<a href="{{ route('product.show',['product'=>$product])}}"><b>{{ $product->name }}</b></a>
				<img src="{{ asset(Storage::url($product->image))}}" alt=" " style="width:100%, height:100%" class="img-fluid">				
				<button id="add" class="btn btn-success"  value="{{ route('cart.add',['id'=>$product->id])}}">Add to cart</button>				
				<span class="text-center float-right"><b>€{{ $product->price }}</b></span>				
				</div>		
			</div>
			</br>
		</div> 
		
    @endforeach
</div>

<br>
<div class="text-center">
	<p>{{ $products->links() }}</p>
</div>
@endsection


@section('scripts')
//Cart ajax request
$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}	
    });
	
	$("[id=add]").click(function(event){
		event.preventDefault();
		var url=$(this).val();

		$.ajax({
			type:'GET',
			url: url,
			success: function (data) {
				$("#cartqty").html(data.cart.totalQty);
			}				
		});
	});
});	   
@endsection