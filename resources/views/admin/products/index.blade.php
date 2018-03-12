@extends('admin.products.productnav')

@section('productcontent')		
<div class="card card-default">
	<div class="card-header">Products</div>
	<div class="card-body">
		<table class="table" id="productTable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Image</th>
				<th>Description</th>
				<th>Price</<th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
			<tbody>
				@if($products->count())
					@foreach($products as $product)
						<tr>
							<td>{{ $product->name }}</td>
							<td><img src="{{ asset(Storage::url($product->image)) }}" alt="" width="50px" height="50px"></td>
							<td>{{ $product->description }}</td>
							<td>{{ $product->price }}</td>		
						
							<td>
								<a href="{{ route('product.edit', ['product' =>$product ])}}" class="btn btn-info btn-xs">Edit</a>
							</td>
							
							<td>
								<form action="{{ route('product.destroy', ['product' =>$product ])}}" method="POST"
								onsubmit="return confirm('All products under this subcategory will be deleted. Are you sure?')">
									
										{{ csrf_field() }}	
										{{ method_field('DELETE') }}
										<button class="btn btn-danger btn-xs">Delete</button>
								</form>
							</td>
							
						</tr>
					@endforeach
				@endif
			</tbody>			
		</table>
	</div>	
</div>
@endsection

@section('javascript')
	$(document).ready(function()
	{
		$('#productTable').DataTable();
	});
@endsection