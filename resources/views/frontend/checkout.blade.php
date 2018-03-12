@extends('welcome')

@section('content')
	
<h1 class="text-center">Checkout</h1>
<h4 class="text-center">Your Total: €{{ $total }}</h4>
<div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : ''  }}">
	{{ Session::get('error') }}
</div>

<form action="{{ route('checkout')}}" method="post" id="checkout-form">
    {{ csrf_field() }}
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" id="name" name="name" class="form-control" required>
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label for="address">Address</label>
				<input type="text" id="address" name="address" class="form-control" required>
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" id="email" name="email" class="form-control" required>
			</div>
		</div>
		<hr>
		<div class="col-md-5">
			<div class="form-group">
				<label for="card-name">Card Holder Name</label>
				<input type="text" id="card-name" class="form-control" required>
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label for="card-number">Credit Card Number</label>
				<input type="text" id="card-number" class="form-control" required>
			</div>
		</div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="card-expiry-month">Expiration Month</label>
						<input type="text" id="card-expiry-month" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="card-expiry-year">Expiration Year</label>
						<input type="text" id="card-expiry-year" class="form-control" required>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="card-cvc">CVC</label>
				<input type="text" id="card-cvc" class="form-control" required>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-success">Buy now</button>
</form>
@endsection	

@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="{{ URL::to('js/checkout.js') }}"></script>
@endsection