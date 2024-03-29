<header>
	<div class="container header-container">
		<div class="header-row">
			<div class="header-logo">
				<a href="{{ url('home') }}"><img src="{{ asset('public/assets/images/header-logo.png') }}" alt="icon" class="img-fluid"></a>
			</div>
			<form class="header-search">
				<div class="cat-dropdown">
					<span class="cat-icon"><img src="{{ asset('public/assets/images/category-icon.svg') }}" alt="icon" class="img-fluid"></span>
					<select>
						<option value="">Select Category</option>
						@if(!empty($productCategories) && count($productCategories) > 0)
						@foreach($productCategories as $key => $productCategory)
						<option value="{{ $productCategory->pc_id }}">{{ $productCategory->pc_name }}</option>
						@endforeach
						@endif
					</select>
				</div>
				<div class="sreach-bar">
					<span><img src="{{ asset('public/assets/images/search-icon.svg') }}" alt="icon" class="img-fluid"></span>
					<input type="text" placeholder="Search products">
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
							<li><a href="#!"><img src="{{ asset('public/assets/images/notification-icon.svg') }}" alt="icon" class="img-fluid"></a></li>
							<li><a href="{{ url('chat-list') }}"><img src="{{ asset('public/assets/images/chat-icon.svg') }}" alt="icon" class="img-fluid"></a></li>
							<li>
								<a href="#!" id="cart-box-btn">
									<img src="{{ asset('public/assets/images/cart-icon.svg') }}" alt="icon" class="img-fluid">
									<span class="noti-count" id="nav-cart-count">{{ count((array) session('cart')) }}</span>
								</a>
								<div class="cartbox-dropdown" id="cartbox-dropdown-only" style="display: none;">
									<div class="cartbox-inner">
										<div>
											<div class="cartbox-top">
												<p>Your Cart</p>
												<button class="close-cart"><img src="{{ asset('public/assets/images/icon-cross.png') }}" alt="icon" class="img-fluid"></button>
											</div>
											@if(session('cart'))
											@foreach(session('cart') as $id => $details)
											<div class="cart-item-wrap" data-id="{{ base64_encode($id) }}">
												<div class="cart-item">
													<div class="img">
														<img src="{{ asset('public/assets/images/gallery-card-img-1.png') }}" alt="img" class="img-fluid">
													</div>
													<div class="text">
														<p class="name">{{ $details['name'] }}</p>
														<div class="size-wrap">
															<div class="size-box">42</div>
														</div>
														<p class="price">{{ $data['setCurrency'] . $details['quantity'] * $details['price'] }}</p>
														<div class="item-action">
															<div class="quantity-wrap">
																<div class="quaitity-box mt-0">
																	<div class="plus-minus">
																		<span class="minus"><i class="fa-solid fa-minus"></i></span>
																		<input type="number" class="count" name="qty" value="{{ $details['quantity'] }}">
																		<span class="plus"><i class="fa-solid fa-plus"></i></span>
																	</div>
																</div>
															</div>
															{{--
															<div class="action">
																<a href="javascript:void(0);"><i class="fa-solid fa-trash pe-1"></i>Delete</a>
															</div>
															--}}
														</div>
													</div>
												</div>
												@endforeach
												@else
												<div class="cart-list-item">
													<p>No products found.</p>
												</div>
												@endif
											</div>
										</div>
										<div>
											<div class="amount-wrap">
												<ul>
													<li>
														<span>Tax Total</span>
														<span>$ 0.00</span>
													</li>
													<li>
														<span><strong>Total</strong></span>
														<span><strong>$ 2210</strong></span>
													</li>
												</ul>
											</div>
											<div class="btn-box">
												<a href="{{ url('cart') }}" class="outline">View Cart</a>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="user-info">
						<div class="user-img">
							<a href="{{ url('profile') }}">
								@if(!empty(session()->get('userData')->user_image))
								<img src="{{ session()->get('userData')->user_image }}" alt="icon" class="img-fluid">
								@else
								<img src="{{ asset('public/assets/images/user-avatar.png') }}" alt="icon" class="img-fluid">
								@endif
							</a>
						</div>
						<div class="user-det">
							<p class="name">{{ session()->get('userData')->user_name }}</p>
							<p class="email">{{ session()->get('userData')->user_email }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>