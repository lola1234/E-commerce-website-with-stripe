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
				<select name="category_id" class="form-control">
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
						<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#subcategoryModal">Edit</button>
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

<!-- Edit subCategory -->
@if($subcategories->count())
	<div class="modal fade" id="subcategoryModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editting: {{ $subcategory->name }}</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<div class="modal-body">			
					<form action="{{ route('subcategory.update',['subcategory'=>$subcategory]) }}" method="POST" >
						{{ csrf_field() }}
						{{ method_field('PUT') }}
											
						<div class="form-group">				
							<input type="text" name="name" class="form-control text-center" value="{{ $subcategory->name }}">				
						</div>
						<div class="form-group">
							<select name="category_id" class="form-control">
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
							<button class="btn btn-primary" type="submit">Update</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
								
					</form>				
				</div>
			</div>
		</div>
	</div>
@endif


@section('javascript')
	$(document).ready(function()
	{
		$('#subTable').DataTable();
	});
@endsection