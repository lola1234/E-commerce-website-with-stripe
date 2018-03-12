@extends('admin.products.productnav')

@section('productcontent')	
<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
	<div class="form-row">
		<div class="form-group col-md-10">
			<label for="name">Name</label>
			<input type="text" name="name" value="{{ old('name') }}" class="form-control">
		</div>
		
		<div class="form-group col-md-3">
			<label for="image">Image</label>
			<input type="file" name="image" class="form-control-file">
		</div>
		
		<div class="form-group col-md-3">
			<label for="price">Price</label>
			<input type="number" name="price" value="{{ old('price') }}" class="form-control">
		</div>
		
		<div class="form-group col-md-4">
			<label for="price">Quantity</label>
			<input type="number" name="quantity" value="{{ old('quantity') }}" class="form-control">
		</div>
		
		<div class="form-group col-md-10">
			<label for="description">Description</label>
			<textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ old('description') }}</textarea>
		</div>
		
		<div class="form- col-md-10">
			<select name="subcategory_id" class="form-control">
				@foreach($subcategories as $subcategory)
					<option value="{{$subcategory->id }}">{{ $subcategory->name }}</option>
				@endforeach
			</select>
		</div>					
	</div>
	
	<div class="form-group">
		<div class="text-center">
			<button class ="btn.btn.success" type="submit">Publish</button>
		</div>
	</div>
</form>
		
@endsection