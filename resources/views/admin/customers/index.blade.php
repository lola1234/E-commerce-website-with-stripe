@extends('layouts.app')

@section('content')

<!--Show all customer in the database -->
<table class="table" id="customersTable">					
	<thead class="thead-light">
		<tr>
			<th>Date</th>
			<th>Name</th>
			<th>Address</th>
			<th>Email</th>
			<th>Delete</th>						
		</tr>
	</thead>
	<tbody>
		@if($customers->count())
			@foreach($customers as $customer)
				<tr>
				    <td>{{ $customer->created_at }}</td>
					<td>{{ $customer->name }}</td>
					<td>{{ $customer->address }}</td>
					<td>{{ $customer->email }}</td>
					<td>
						<form action="{{ route('customer.destroy', ['customer' => $customer]) }}" method="POST"
							onsubmit="return confirm('Order will be permanently deleted. Are you sure?')">
									{{ csrf_field() }}
									{{ method_field('DELETE')}}
									
							<button class= "btn btn-danger btn-sm" type="submit">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
		@else
			<tr> 
				<th colspan="5" class="text-center">Empty</th>
			</tr>
		@endif
	</tbody>
</table>      
@endsection

@section('javascript')
	$(document).ready(function()
	{
		$('#customersTable').DataTable();
	});
@endsection