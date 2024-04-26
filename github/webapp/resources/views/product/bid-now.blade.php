@extends('layouts.master')
@section('title', 'Bid now')
@section('content')

<section class="bid-sec bg-color">
	<div class="container">
		<div class="bid-sec-wrap">
			<a href="javascript:history.go(-1)" class="back-btn">
				<img src="{{ asset('public/assets/images/icon-arrow-left.png') }}" alt="icon" class="img-fluid">
			</a>
			<div class="bid-card">
				<div class="card-left">
					<div class="product-det-slider-wrap">
						<div class="swiper product-det-slider">
							<div class="swiper-wrapper">
								@if(!empty($productDetail->product_images) && count($productDetail->product_images) > 0)
								@foreach($productDetail->product_images as $key => $product_image)
								<div class="swiper-slide">
									<img src="{{ $product_image->pf_file }}" alt="img" class="img-fluid">
								</div>
								@endforeach
								@endif
							</div>
							<div class="swiper-button-next"></div>
							<div class="swiper-button-prev"></div>
						</div>
					</div>
					<button class="price-btn">{{ $data['setCurrency'] . $productDetail->pp_price }}</button>
				</div>
				<div class="card-right bidding-card">
					<div class="card-top">
						<button class="close-btn">
							<img src="{{ asset('public/assets/images/icon-cross.png') }}" alt="icon" class="img-fluid">
						</button>
						<p class="title">Enter Bid Amount</p>
						<div class="bidding-box">
							{{--<p class="title">$5 • 0 bids • 24 hrs</p>--}}
							<div class="price-box">
								<div class="plus-minus">
									<span class="minus"><i class="fa-solid fa-minus"></i></span>
									<label for="quantity-select">{{ $data['setCurrency'] }}</label> 
									<input type="number" class="count pp_price" name="pp_price" value="{{ $productDetail->pp_price }}" id="quantity-select">
									<span class="plus"><i class="fa-solid fa-plus"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="card-bottom">
						<div class="bid-card-tab-wrap">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item" role="presentation">
									<button class="nav-link active" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment" type="button" role="tab" aria-controls="comment" aria-selected="true">Reviews</button>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="comment" role="tabpanel" aria-labelledby="comment-tab">
									<div class="comments-wrap">
										<div class="old-comments"> 
											@if(!empty($productReview) && count($productReview) > 0)
											@foreach($productReview as $review) 
											<div class="user-comment">
												<div class="img">
													@if(!empty($review->user_image))
													<img src="{{ $review->user_image }}" alt="img" class="img-fluid">
													@else
													<img src="{{ asset('public/assets/images/user-avatar.png') }}" alt="img" class="img-fluid">
													@endif
												</div>
												<div class="comment-info">
													<div class="comment-top">
														<p class="comment-name">{{ $review->user_name }}</p>
														<p class="comment-time">{{ Carbon\Carbon::parse($review->review_created)->diffForHumans() }} </p>
													</div>
													<p class="comment-text">{{ $review->review_review }}</p>
												</div>
											</div>
											@endforeach
											@endif
										</div>
										<div class="new-comment">
											<div class="new-com-img">
												@if(!empty(session()->get('userData')->user_image))
												<img src="{{ session()->get('userData')->user_image }}" alt="img" class="img-fluid">
												@else
												<img src="{{ asset('public/assets/images/user-avatar.png') }}" alt="img" class="img-fluid">
												@endif
											</div>
											<div class="new-com-text">
												<form method="post" action="{{ url('create-review') }}"> @csrf
													<div class="form-input">
														<input type="text" placeholder="Add a review..." name="review_review">
													</div>
													<div class="form-actions">
														<input type="hidden" name="product_id" value="{{ base64_encode($productDetail->product_id) }}">
														<button type="submit" style="border: 0;"><img src="{{ asset('public/assets/images/paper-plane.png') }}" alt="icon" class="img-fluid"></button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-bottom">
						<p>{{ $productDetail->product_description }}</p>
						<button class="confirm-btn" id="confirm-bid" product="{{ base64_encode($productDetail->product_id) }}">Confirm Bid</button>
					</div>
				</div>
			</div>
		</div>
	</div>	
</section>

@endsection
@push('scripts')
    <script src="{{ asset('public/assets/js/custom/bid.js') }}"></script> 
@endpush