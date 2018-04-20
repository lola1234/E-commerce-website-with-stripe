@extends('layouts.app')

@section('content')
<h5 class="title">Editting: {{ $subcategory->name }}</h5>
			
<form action="{{ route('subcategory.update',['subcategory'=>$subcategory]) }}" id="edit" method="POST" >
	{{ csrf_field() }}
	{{ method_field('PUT') }}
						
	<div class="form-group">				
		<input type="text" name="name" id="name" class="form-control text-center" value="{{ $subcategory->name }}">	
	</div>
	<div class="form-group">
		<select name="category_id" id="category_id" class="form-control">
			@foreach($categories as $category)
				<option value="{{ $category->id}}"
					@if($subcategory->category->id == $category->id)
						selected
					@endif
				>{{ $category->name}}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group text-center">
		<button class="btn btn-primary" id="update" type="submit">Update</button>
	</div>			
</form>				

@endsection