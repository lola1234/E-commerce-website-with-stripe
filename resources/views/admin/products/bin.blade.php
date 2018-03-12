@extends('admin.products.productnav')

@section('productcontent')
<div class="col-lg-12">
	<h1 class="page-header">Bin</h1>
</div>

<table class= "table table-hover">
	<thead>
		
		<th>
			Name
		</th>
		
		<th>
			Restore
		</th>
		
		<th>
			Permanaently Destroy
		</th>
		
	</thead>
	
	<tbody>
		@if($products->count() > 0)
			@foreach($products as $product)
				<tr>
					
					<td>{{ $product->name}}</td>
					<td><img src="{{ asset(Storage::url($product->image))}}" alt="" width="50px" height="50px"></td>
					<td>
						<a href="{{ route('product.restore', ['product' => $product->id]) }}" class="btn btn-xs btn-info">Restore</a>
					</td>
					<td>
						<a href="{{ route('product.kill', ['product' => $product->id]) }}" class="btn btn-xs btn-danger"
						onsubmit="return confirm('The product will be permanent deleted. Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		@else
			<tr> 
				<th colspan="5" class="text-center">Bin Empty</th>
			</tr>
		@endif
	</tbody>

</table>		
@endsection