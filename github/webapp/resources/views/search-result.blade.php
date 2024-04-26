@extends('layouts.master')
@section('title', 'Search Result')
@section('content')

<section class="featured-sec bg-color">
	<div class="container">
		<div class="feature-top">
			<p class="title">{{ ucfirst($search_type) }}</p>
		</div>
	</div>	
	<div class="featured-slider-wrap">
		<div class="swiper featured-slider">
			<div class="swiper-wrapper">
				@if(!empty($search->data) && count($search->data) > 0)
				@foreach($search->data as $key => $search_data)

                @if($search_type == 'product')
				<div class="swiper-slide">
					<div class="feature-img">
						<a href="{{ url('product-details', base64_encode($search_data->product_id)) }}">
							<img src="{{ $search_data->product_image }}" alt="img" class="img-fluid"> <br>
                            <h4>{{ $search_data->product_description }}</h4>
						</a>	
					</div>
				</div>
                @elseif($search_type == 'user')
                <div class="swiper-slide">
					<div class="feature-img">
						<a href="{{ url('profile', base64_encode($search_data->user_id)) }}">
							<img src="{{ $search_data->user_image }}" alt="img" class="img-fluid"> <br>
                            <h4>{{ $search_data->user_name }}</h4>
						</a>	
					</div>
				</div>
				
                @elseif($search_type == 'post')
                <div class="swiper-slide">
					<div class="feature-img">
                        <div class="gallery-card-wrap" style="border: 1px solid gray;">
                            <div class="gallery-card">
                                <div class="gallery-img">
                                    @if($search_data->post_type == 'file' && !empty($search_data->post_image))
                                    <img src="{{ $search_data->post_image }}" alt="img" class="img-fluid">
                                    @endif
                                    <a href="#!" style="background:rgb(0 0 0 / 25%)" class="like-btn like-this @if($search_data->is_liked == 1) active-like @endif" source="{{ base64_encode($search_data->post_id) }}" type="post"><img src="{{ asset('public/assets/images/icon-heart.png') }}" alt="icon" class="img-fluid"></a>
                                </div>
                                <div class="gallery-info" style="@if(!empty($search_data->post_color)) background : {{ $search_data->post_color }} @endif">
                                    <p class="name">{{ !empty($search_data->post_text) ? $search_data->post_text : null }}</p>
                                </div>
                            </div>
                        </div>	
					</div>
				</div>
				@endif

				@endforeach
				@endif
			</div>
		</div>
	</div>
</section>

@endsection
@push('scripts')
	<script src="{{ asset('public/assets/js/custom/home.js') }}"></script>
@endpush

