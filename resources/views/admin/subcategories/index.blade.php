@extends('layouts.app')

@section('content')

<!--Creates Subcategory -->
<form action="{{ route('subcategory.store') }}" method="POST" >
	{{ csrf_field() }}
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">				
				<input type="text" name="name" class="form-control text-center" placeholder="New Sub-category" required>				
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<select name="category_id"  class="form-control">
					@foreach($categories as $category)
						<option value="{{ $category->id}}">{{ $category->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
	
	<div class="form-group">
		<div class="text-center">
			<button class="btn btn-secondary" type="submit">Save</button>
		</div>					
	</div>
	</div>
</form>			

<!--Show all Subcategories in the database -->
<table class="table" id="subTable">					
	<thead class="thead-light">
		<tr>
			<th>Name</th>
			<th>Category</th>
			<th>Edit</th>
			<th>Delete</th>						
		</tr>
	</thead>
	<tbody>
		@if($subcategories->count())
			@foreach($subcategories as $subcategory)
				<tr>
					<td>{{ $subcategory->name }}</td>
					<td>{{ $subcategory->category->name }}</td>
					<td>
						<a href="{{ route('subcategory.edit',['subcategory'=>$subcategory]) }}" class="btn btn-primary btn-sm" >Edit</a>
					</td>
					
					<td>
						<form action="{{ route('subcategory.destroy', ['subcategory' => $subcategory]) }}" method="POST"
							onsubmit="return confirm('All products under this subcategory will be deleted. Are you sure?')">
									{{ csrf_field() }}
									{{ method_field('DELETE')}}
									
							<button class= "btn btn-danger btn-sm" type="submit">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
		@endif
	</tbody>
</table>    
@endsection

@section('javascript')
$(document).ready(function()
{
	$('#subTable').DataTable();
});
@endsection