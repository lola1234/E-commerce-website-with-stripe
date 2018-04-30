
<nav class="d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
	<ul class="nav flex-column">
	  <li class="nav-item">
		<a class="nav-link active" href="{{ route('product.index')}}">
		  <span data-feather="shopping-cart"></span>
		  Products <span class="sr-only">(current)</span>
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="{{ route('order.index')}}">
		  <span data-feather="file"></span>
		  Orders
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="{{ route('customer.index')}}">
		  <span data-feather="users"></span>
		  Customers
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="{{ route('subcategory.index')}}">
		  <span data-feather="layers"></span>
		  SubCategories
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="{{ route('category.index')}}">
		  <span data-feather="layers"></span>
		  Categories
		</a>
	  </li>
	</ul>
  </div>
</nav>

