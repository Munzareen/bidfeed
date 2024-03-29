@extends('layouts.master')
@section('title', 'Buy now')
@section('content')


<section class="bid-sec bg-color">
	<div class="container">
		<div class="bid-sec-wrap">
			<a href="javascript:history.go(-1)" class="back-btn">
				<img src="{{ asset('public/assets/images/icon-arrow-left.png') }}" alt="icon" class="img-fluid">
			</a>
			<div class="bid-card">
				<div class="card-left">
					<img src="{{ asset('public/assets/images/bid-card-img.png') }}" alt="img" class="img-fluid">
					<button class="price-btn">{{ $data['setCurrency'] . $productDetail->pp_price }}</button>
					<button class="bid-btn">Buy Now</button>
				</div>
				<div class="card-right buy-card">
					<div class="card-top">
						<button class="close-btn">
							<img src="{{ asset('public/assets/images/icon-cross.png') }}" alt="icon" class="img-fluid">
						</button>
						<p class="title">{{ $productDetail->product_description }}</p>
						<div class="buy-detail-wrap">
                            <div class="buy-detail-box">
                                <p class="heading">Username</p>
                                <p class="text">{{ $productDetail->user_name }}</p>
                            </div>
							<div class="buy-detail-box">
								<p class="heading">Condition</p>
								<p class="text">{{ $productDetail->product_condition }}</p>
							</div>
							<div class="buy-detail-box">
								<p class="heading">Price</p>
								<p class="text">{{ $data['setCurrency'] . $productDetail->pp_price }}</p>
							</div>
							<div class="buy-detail-box">
								<p class="heading">Description</p>
								<p class="text"><span>{{ $productDetail->product_description }}</span></p>
							</div>
						</div>
					</div>
					<div class="card-bottom">
						<button type="button" class="confirm-btn add-cart" product="{{ base64_encode($productDetail->product_id) }}">Add to Cart</button>
						<button type="button" class="confirm-btn">Buy now</button>
					</div>
				</div>
			</div>
		</div>
	</div>	
</section>

@endsection
@push('scripts')
    <script src="{{ asset('public/assets/js/custom/cart.js') }}"></script> 
@endpush