@extends('admin.products.productnav')

@section('productcontent')	
<form action="{{ route('product.update', [ 'product'=>$product ]) }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
	<div class="form-row">
		<div class="form-group col-md-10">
			<label for="name">Name</label>
			<input type="text" name="name" value="{{ $product->name }}" class="form-control">
		</div>
		
		<div class="form-group col-md-3">
			<label for="image">Image</label>
			<input type="file" name="image" class="form-control-image">
		</div>
		
		<div class="form-group col-md-3">
			<label for="price">Price</label>
			<input type="text" name="price" value="{{ $product->price }}" class="form-control">
		</div>
		
		<div class="form-group col-md-4">
			<label for="price">Quantity</label>
			<input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control">
		</div>
		
		<div class="form-group col-md-10">
			<label for="description">Description</label>
			<textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ $product->description }}</textarea>
		</div>
		
		<div class="form- col-md-10">
			<select name="subcategory_id" class="form-control">
				@foreach($subcategories as $subcategory)
					<option value="{{$subcategory->id }}"
						@if($product->subcategory->id == $subcategory->id)
							selected
						@endif
					>{{ $subcategory->name }}</option>
				@endforeach
			</select>
		</div>			
	</div>
	<div class="form-group">
		<div class="text-center">
			<button class ="btn.btn.success" type="submit">Update</button>
		</div>
	</div>
</form>	
@endsection