<header>
	<div class="container header-container">
		<div class="header-row">
			<div class="header-logo">
				<a href="{{ url('home') }}"><img src="{{ asset('public/assets/images/header-logo.png') }}" alt="icon" class="img-fluid"></a>
			</div>
			<form class="header-search" action="{{ url('search') }}"> @csrf
				
				<div class="cat-dropdown">
					<span class="cat-icon"><img src="{{ asset('public/assets/images/category-icon.svg') }}" alt="icon" class="img-fluid"></span>
					<select id="search_type" name="search_type" required>
						<option value="post" @if(!empty($search_type) && $search_type == 'post') selected @endif>Post</option>
						<option value="product" @if(!empty($search_type) && $search_type == 'product') selected @endif>Product</option>
						<option value="user" @if(!empty($search_type) && $search_type == 'user') selected @endif>User</option>
					</select>
				</div>
				
				<div class="sreach-bar">
					<input type="text" required placeholder="Search products, posts or users" id="search_key" name="search_key" value="{{ !empty($search_key) ? $search_key : null }}">

					<button type="submit">
						<span><img src="{{ asset('public/assets/images/search-icon.svg') }}" alt="icon" class="img-fluid" id="search-btsn"></span> 
					</button>
				</div>
			</form>
			<div class="header-right">
				<div class="add-post">
					<button class="add-post-btn" type="button" data-bs-toggle="modal" data-bs-target="#new-post-modal"><img src="{{ asset('public/assets/images/plus-icon.svg') }}" alt="icon" class="img-fluid">Add new post</button>
				</div>
				<button class="resp-sidenav-toggle"><i class="fa-solid fa-bars"></i></button>
				<div class="resp-sidenav-wrap">
					<button class="close-sidebar"><img src="{{ asset('public/assets/images/icon-cross.png') }}" alt="icon" class="img-fluid"></button>
					<div class="btns-list">
						<ul>
							<li><a href="{{ url('chat-list') }}" title="Chat"><img src="{{ asset('public/assets/images/chat-icon.svg') }}" alt="icon" class="img-fluid"></a></li>
							<li>
								<a href="#!" id="cart-box-btn" title="Cart">
									<img src="{{ asset('public/assets/images/cart-icon.svg') }}" alt="icon" class="img-fluid">
									<span class="noti-count" id="nav-cart-count">{{ count((array) session('cart')) }}</span>
								</a>
								<div class="cartbox-dropdown" id="cartbox-dropdown-only" style="display: none;">
									@include('layouts.nav-cart');
								</div>
							</li>
							<li><a href="{{ url('logout') }}" title="Logout"><img src="{{ asset('public/assets/images/logout.png') }}" alt="icon" class="img-fluid"></a></li>
						</ul>
					</div>
					<div class="user-info" title="Profile">
						<a href="{{ url('profile', base64_encode(session()->get('userData')->user_id)) }}">
							<div class="user-img">
								@if(!empty(session()->get('userData')->user_image))
								<img src="{{ session()->get('userData')->user_image }}" alt="icon" class="img-fluid">
								@else
								<img src="{{ asset('public/assets/images/user-avatar.png') }}" alt="icon" class="img-fluid">
								@endif
							</div>
							<div class="user-det">
								<p class="name">{{ session()->get('userData')->user_name }}</p>
								<p class="email">{{ session()->get('userData')->user_email }}</p>
							</div>
						</a>
					</div>

					{{--
					<div class="dropdown">
						<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
							<span><i class="fa fa-gear"></i></span>
						</a>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<li><a class="dropdown-item" href="{{ url('profile', base64_encode(session()->get('userData')->user_id)) }}">Profile</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="{{ url('logout') }}">Logout</a></li>
						</ul>
					</div>
					--}}					
				</div>
			</div>
		</div>
	</div>
</header>