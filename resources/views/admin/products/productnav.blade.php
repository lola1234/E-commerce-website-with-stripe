@extends('layouts.app')

@section('content')		
	<ul class="nav nav-tabs justify-content-center">	  
	  <li class="nav-item">
		<a class="nav-link" href="{{ route('product.index')}}">Products</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="{{ route('product.create')}}">Create</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="{{ route('product.bin')}}">Bin</a>
	  </li>
	</ul>
	
	<br>
	
	
	@yield('productcontent')

@endsection