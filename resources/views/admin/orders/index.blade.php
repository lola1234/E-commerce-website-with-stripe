@extends('layouts.app')

@section('content')

<!--Show all order in the database -->
<table class="table" id="ordersTable">					
	<thead class="thead-light">
		<tr>
			<th>Date ordered</th>
			<th>Customer Name</th>
			<th>Quantity</th>
			<th>Total</th>
			<th>Delete</th>						
		</tr>
	</thead>
	<tbody>
		@if($orders->count())
			@foreach($orders as $order)
				<tr>
				    <td>{{ $order->created_at }}</td>
					<td>{{ $order->customer->name }}</td>
					<td>{{ $order->cart->totalQty }}</td>
					<td>€{{ $order->cart->totalPrice }}</td>
					<td>
						<form action="{{ route('order.destroy', ['order' => $order]) }}" method="POST"
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
		$('#ordersTable').DataTable();
	});
@endsection