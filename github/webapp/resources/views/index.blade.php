@extends('layouts.master')
@section('title', 'Home')
@section('content')

<section class="featured-sec bg-color">
	<div class="container">
		<div class="feature-top">
			<p class="title">Featured</p>
			<a href="#!" class="see-all">See All <span><img src="{{ asset('public/assets/images/purple-arrow-right.svg') }}" alt="icon" class="img-fluid"></span></a>
		</div>
	</div>	
	<div class="featured-slider-wrap">
		<div class="swiper featured-slider">
			<div class="swiper-wrapper">
				@if(!empty($featured) && count($featured) > 0)
				@foreach($featured as $key => $featured)
				<div class="swiper-slide">
					<div class="feature-img">
						<a href="{{ $featured->product_image }}" data-fancybox="gallery" data-caption="">
							<img src="{{ $featured->product_image }}" alt="img" class="img-fluid">
						</a>	
					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</div>
</section>

<section class="upcoming-sec bg-color">
	<div class="container">
		<div class="feature-top">
			<p class="title">Upcoming</p>
			<button class="filter-btn">
				<span><img src="{{ asset('public/assets/images/icon-filter.png') }}" alt="icon" class="img-fluid"></span>
				Filters
			</button>
		</div>
		<div class="upcoming-gallery-wrap">
			<div class="upcoming-gallery">
				@if(!empty($upcoming) && count($upcoming) > 0)
				@foreach($upcoming as $key => $upcoming)
				<a href="{{ url('product-details', base64_encode($upcoming->product_id)) }}">
					<div class="gallery-card-wrap">
						<div class="gallery-card">
							<div class="gallery-img">
								<img src="{{ $upcoming->product_image }}" alt="img" class="img-fluid">
								<a href="javascript:void(0);" class="like-btn like-this @if($upcoming->is_liked == 1) active-like @endif" source="{{ base64_encode($upcoming->product_id) }}" type="product">
									<img src="{{ asset('public/assets/images/icon-heart.png') }}" alt="icon" class="img-fluid">
								</a>
							</div>
							<div class="gallery-info">
								<p class="name">{{ $upcoming->product_description }}</p>
								<div class="card-user-info">
									<div class="name-img">
										<div class="img">
											@if(!empty($upcoming->user_image))
											<img src="{{ $upcoming->user_image }}" alt="icon" class="img-fluid">
											@else
											<img src="{{ asset('public/assets/images/gallery-user-img.png') }}" alt="icon" class="img-fluid">
											@endif
										</div>
										<div class="user-name"><p>{{ $upcoming->user_name }}</p></div>
									</div>
									{{--<div class="card-tag">BOOSTED</div>--}}
								</div>
							</div>
						</div>
					</div>
				</a>
				@endforeach
				@endif
			</div>
			<div class="gallery-col last-col">
				<button class="load-btn">Load more cards</button>
			</div>
		</div>
	</div>
</section>

@endsection
@push('scripts')
    <script src="{{ asset('public/assets/js/custom/home.js') }}"></script> 
@endpush
