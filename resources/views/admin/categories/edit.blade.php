@extends('layouts.app')

@section('content')

<h5 class="title">Editting: {{ $category->name }}</h5>
									
<form action="{{ route('category.update',['category'=>$category]) }}" method="POST">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
						
	<div class="form-group">				
		<input type="text" name="name" class="form-control text-center" value="{{ $category->name }}">				
	</div>
	<div class="form-group">				
		<textarea name="description" cols="5" rows="5" class="form-control text-center">{{ $category->description }}</textarea>	
	</div>
	<div class="form-group text-center">
		<button  type="submit" class="btn btn-primary">Update</button>
	</div>										
</form>				
			
@endsection