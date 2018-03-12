@extends('layouts.app')

@section('content')

<!--Creates category -->
<form action="{{ route('category.store') }}" method="POST" >
	{{ csrf_field() }}
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">				
				<input type="text" name="name" class="form-control text-center" placeholder="New Category" required>				
			</div>
			<div class="form-group">				
				<textarea name="description" cols="5" rows="5" class="form-control text-center" placeholder="Describe categroy..." required></textarea>	
			</div>
			<div class="form-group">
				<div class="text-center">
					<button class="btn btn-secondary" type="submit">Save</button>
				</div>					
			</div>
		</div>
	</div>
</form>			

<!--Show all category in the database -->
<table class="table" id="categoriesTable">					
	<thead class="thead-light">
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Edit</th>
			<th>Delete</th>						
		</tr>
	</thead>
	<tbody>
		@if($categories->count())
			@foreach($categories as $category)
				<tr>
					<td>{{ $category->name }}</td>
					<td>{{ $category->description }}</td>
					<td>
						<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#categoryModal{{$category}}">Edit</button>
					</td>		
					<td>
						<form action="{{ route('category.destroy', ['category' => $category->id]) }}" method="POST"
							onsubmit="return confirm('All subcategories under this category will be deleted. Are you sure?')">
									{{ csrf_field() }}
									{{ method_field('DELETE')}}
									
							<button class= "btn btn-danger btn-sm" type="submit">Delete</button>
						</form>
					</td>
				</tr>
				
				@include('admin.categories.edit')
			@endforeach
		@else
			<h3>Empty</h3>
		@endif
	</tbody>
</table>  
@endsection  
			

@section('javascript')
	$(document).ready(function()
	{
		$('#categoriesTable').DataTable();
	});
@endsection