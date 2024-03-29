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
					<img src="{{ asset('public/assets/images/bid-card-img.png') }}" alt="img" class="img-fluid">
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