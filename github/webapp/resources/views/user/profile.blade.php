@extends('layouts.master')
@section('title', 'Profile')
@section('content')

<section class="profile-sec bg-color">
	<div class="container">
		<div class="user-profile-wrap">
			<div class="img-box">
				@if(!empty(session()->get('userData')->user_image))
				<img src="{{ session()->get('userData')->user_image }}" alt="icon" class="img-fluid">
				@else
				<img src="{{ asset('public/assets/images/user-avatar.png') }}" alt="icon" class="img-fluid">
				@endif
			</div>
			<p class="profile-name">{{ session()->get('userData')->user_name }}</p>
			<p class="profile-handle">{{ session()->get('userData')->user_email }}</p>
			<div class="followers-det">
				<p><span>204</span> Following</p>
				<span>•</span>
				<p><span>125k</span> Followers</p>
			</div>
			{{--
			<div class="user-profile-btns">
				<button class="user-btn">Message</button>
				<button class="user-btn btn-1">Follow</button>
			</div>
			--}}
		</div>
		<div class="profile-tab-wrap">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active tab-gal-1" id="profile-1-tab" data-bs-toggle="tab" data-bs-target="#profile-1" type="button" role="tab" aria-controls="profile-1" aria-selected="true">Posts</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-2-tab" data-bs-toggle="tab" data-bs-target="#profile-2" type="button" role="tab" aria-controls="profile-2" aria-selected="false">Products</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-3-tab" data-bs-toggle="tab" data-bs-target="#profile-3" type="button" role="tab" aria-controls="profile-3" aria-selected="false">Favorite</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-4-tab" data-bs-toggle="tab" data-bs-target="#profile-4" type="button" role="tab" aria-controls="profile-4" aria-selected="false">My Orders</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-5-tab" data-bs-toggle="tab" data-bs-target="#profile-5" type="button" role="tab" aria-controls="profile-5" aria-selected="false">My Bid</button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="profile-1" role="tabpanel" aria-labelledby="profile-1-tab">
					<div class="upcoming-gallery-wrap">
						<div class="upcoming-gallery tab-gallery-1">
							@if($user_post_list_decode->status == 1)
							@foreach($user_post_list_decode->data as $key => $user_post_list)
							<div class="gallery-card-wrap">
								<div class="gallery-card">
									<div class="gallery-img">
										<img src="{{ asset('public/assets/images/gallery-card-img-1.png') }}" alt="img" class="img-fluid">
										<a href="#!" class="like-btn"><img src="{{ asset('public/assets/images/icon-heart.png') }}" alt="icon" class="img-fluid"></a>
										<button class="bid-btn">Bid Now</button>
									</div>
									<div class="gallery-info">
										<p class="name">Tracksuit Men African Clothing Print Shirt Suit.</p>
										<div class="card-user-info">
											<div class="name-img">
												<div class="img">
													<img src="{{ asset('public/assets/images/gallery-user-img.png') }}" alt="img" class="img-fluid">
												</div>
												<div class="user-name">
													<p>Phillip Saris</p>
												</div>
											</div>
											<div class="card-tag">BOOSTED</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach
							@else
							<div class="gallery-card-wrap">
								<p>{{ $user_post_list_decode->message }}</p>
							</div>
							@endif
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="profile-2" role="tabpanel" aria-labelledby="profile-2-tab">
					<div class="selling-tab-wrap">
						<div class="row products-row">
							@if($user_product_list_decode->status == 1)
							@foreach($user_product_list_decode->data as $key => $user_product_list)
							<div class="col-lg-3 col-md-4 col-sm-6 col-12 sell-prod-col">
								<div class="product-card">
									<div class="img">
										<img src="{{ $user_product_list->product_image }}" alt="img" class="img-fluid">
									</div>
									<div class="desc">
										<a href="{{ url('product-details', base64_encode($user_product_list->product_id)) }}">{{ $user_product_list->product_description }}</a>
									</div>
								</div>
							</div>
							@endforeach
							@else
							<div class="gallery-card-wrap">
								<p>{{ $user_product_list_decode->message }}</p>
							</div>
							@endif
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="profile-3" role="tabpanel" aria-labelledby="profile-3-tab">
					<div class="draft-tab-wrap">
						<p class="title">Products</p>
						<div class="row products-row">
							<div class="col-lg-3 col-md-4 col-sm-6 col-12 sell-prod-col">
								<div class="product-card">
									<div class="img">
										<img src="assets/images/product-img-1.png" alt="img" class="img-fluid">
										<button class="price-btn">$135</button>
									</div>
									<div class="desc">
										<a href="#!">Tracksuit Men African Clothing Print Shirt Suit.</a>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-12 sell-prod-col">
								<div class="product-card">
									<div class="img">
										<img src="assets/images/product-img-2.png" alt="img" class="img-fluid">
										<button class="price-btn">$135</button>
									</div>
									<div class="desc">
										<a href="#!">Tracksuit Men African Clothing Print Shirt Suit.</a>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-12 sell-prod-col">
								<div class="product-card">
									<div class="img">
										<img src="assets/images/product-img-3.png" alt="img" class="img-fluid">
										<button class="price-btn">$135</button>
									</div>
									<div class="desc">
										<a href="#!">Tracksuit Men African Clothing Print Shirt Suit.</a>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-12 sell-prod-col">
								<div class="product-card">
									<div class="img">
										<img src="assets/images/product-img-4.png" alt="img" class="img-fluid">
										<button class="price-btn">$135</button>
									</div>
									<div class="desc">
										<a href="#!">Tracksuit Men African Clothing Print Shirt Suit.</a>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-12 sell-prod-col">
								<div class="product-card">
									<div class="img">
										<img src="assets/images/product-img-5.png" alt="img" class="img-fluid">
										<button class="price-btn">$135</button>
									</div>
									<div class="desc">
										<a href="#!">Tracksuit Men African Clothing Print Shirt Suit.</a>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-12 sell-prod-col">
								<div class="product-card">
									<div class="img">
										<img src="assets/images/product-img-6.png" alt="img" class="img-fluid">
										<button class="price-btn">$135</button>
									</div>
									<div class="desc">
										<a href="#!">Tracksuit Men African Clothing Print Shirt Suit.</a>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-12 sell-prod-col">
								<div class="product-card">
									<div class="img">
										<img src="assets/images/product-img-7.png" alt="img" class="img-fluid">
										<button class="price-btn">$135</button>
									</div>
									<div class="desc">
										<a href="#!">Tracksuit Men African Clothing Print Shirt Suit.</a>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-12 sell-prod-col">
								<div class="product-card">
									<div class="img">
										<img src="assets/images/product-img-8.png" alt="img" class="img-fluid">
										<button class="price-btn">$135</button>
									</div>
									<div class="desc">
										<a href="#!">Tracksuit Men African Clothing Print Shirt Suit.</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="profile-4" role="tabpanel" aria-labelledby="profile-4-tab">
					<div class="draft-tab-wrap">
						<p class="title">Orders</p>
						<table class="table text-center">
							<thead>
								<tr>
									<th>Order Number</th>
									<th>Total Amount</th>
									<th>Order Datetime</th>
									<th>Total Products</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if(!empty($user_order_list) && $user_order_list->status == 1)
								@foreach($user_order_list->data as $order_list)
								<tr>
									<td>{{ $order_list->order_number }}</td>
									<td>{{ $data['setCurrency'] . $order_list->order_total_amount }}</td>
									<td>{{ $order_list->order_created_at }}</td>
									<td>{{ number_format($order_list->total_product_count) }}</td>
									<td>
										<a href="{{ url('detail-order', base64_encode($order_list->order_id)) }}"><i class="fa-solid fa-eye"></i></a>
									</td>
								</tr>
								@endforeach
								@else
								<tr>
									<td>{{ $user_order_list->message }}</td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane fade" id="profile-5" role="tabpanel" aria-labelledby="profile-5-tab">
					<div class="draft-tab-wrap">
						<p class="title">Bids</p>
						<table class="table text-center">
							<thead>
								<tr>
									<th>Image</th>
									<th>Description</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
								@if(!empty($user_bid_list) && $user_bid_list->status == 1)
								@foreach($user_bid_list->data as $bid_list)
								<tr>
									<td><img src="{{ $bid_list->product_image }}" alt="" width="50px"></td>
									<td>{{ $bid_list->product_description }}</td>
									<td>{{ $data['setCurrency'] . $bid_list->bid_amount }}</td>
								</tr>
								@endforeach
								@else
								<tr>
									<td>{{ $user_bid_list->message }}</td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection