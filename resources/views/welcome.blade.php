<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->   
	<link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
</head>
<body>
<div id="app">
<div class="container-fluid">
	<div class="shippingBanner text-center">
		<p>Free domestic shipping over €50 | free global shipping over €100</p>
	</div>
   
    <nav class="navbar sticky-top navbar-light bg-light">
		<a class="navbar-brand" href="/">SecondHandShop</a>			
		<a class="nav-link" href ="#">Search</a>
		<a class="nav-link" href ="#">Sale</a>
		<a class="nav-link" href ="#">New Arrival</a>	
		<a class="nav-link" href ="#">LogIn</a>		
		<a class="nav-link" href="{{ route('cart') }}" >Shopping Cart
		<span class="badge badge-info">{{Session::has('cart')? Session::get('cart')->totalQty:''}}</span></a>				
	</nav>
    
	<br>
	<div class="row">
	  <div class="col-md-2">	
		<div id="sideMenu">
		    <a href="/" class="text-center">All Categories</a>
			@foreach($categories as $category)
				<details>											
					<summary>{{$category->name}}</summary>					
					@foreach($category->subcategories as $subcategory)
						<a class="dropdown-item" href="{{ route('sub.products',['slug'=>$subcategory->slug])}}">{{ $subcategory->name }}</a>
					@endforeach								
				</details>
			@endforeach 	
		</div>
	  </div>
	  
	  <div class="col-md-10">
			
		@yield('content')
	  </div>

    </div>




@include('frontend.email')

@include('frontend.footer')
</div>
</div>	
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
       feather.replace();  
	</script>
	@yield('scripts')
</body>
</html>
