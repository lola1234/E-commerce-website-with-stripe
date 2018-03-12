<div class="modal fade" id="categoryModal{{$category}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editting: {{ $category->name }}</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			
			<div class="modal-body">			
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
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>										
				</form>				
			</div>
		</div>
	</div>
</div>	
