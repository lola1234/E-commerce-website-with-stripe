@extends('layouts.app')

@section('content')

<!--Creates category -->
<form action="{{ route('category.store') }}" method="POST" >
	{{ csrf_field() }}
	<div class="row text-center">
		<div class="col-md-5">
			<div class="form-group">				
				<input type="text" name="name"  class="form-control text-center" required>				
			</div>
			<div class="form-group">				
				<textarea name="description" cols="5" rows="5" class="form-control text-center"  required></textarea>	
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
						<a href="{{ route('category.edit',['category'=>$category]) }}" class="btn btn-info">Edit</a>					
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
				<!-- Modal -->
				<div class="modal fade" id="{{ $category}}" role="dialog">
					<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Editing:</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						  
						</div>
						<div class="modal-body">
							<form action="{{ route('category.update',['category'=>$category]) }}" id="update">
								
								<div class="form-group">				
									<input type="text" id="name" value="{{ $category->name }}"class="form-control text-center" required>				
								</div>
								<div class="form-group">				
									<textarea id="description" cols="5" rows="5" class="form-control text-center" required>{{ $category->description }}</textarea>	
								</div>
									
							</form>			
						</div>
						<div class="modal-footer">
						  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  <button class="btn btn-secondary" id="btn-edit" type="submit">Save</button>
						</div>
					</div>
				  </div>
			</div>
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
	   $.ajaxSetup({
		   headers:{
			 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		   }	    
	   });
	    $("#btn-edit").click(function(e){
			e.preventDefault();
			var url=$("[id=update]").attr("action");
			
			var data={
				name: $("#name").val(),
				description: $("#description").val()
			};
			$.ajax({
				type:"PUT",
				url:url,
				data:data,
				success:function(data){
					console.log(data);
				}
			});
		});

	});
@endsection