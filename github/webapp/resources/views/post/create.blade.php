@extends('layouts.master')
@section('title', 'Create Post')
@section('content')

<section class="post-pg-sec bg-color">
	<div class="container">
		<div class="pg-top">
			<a href="javascript:history.go(-1)" class="back-btn">
				<img src="{{ asset('public/assets/images/icon-arrow-left.png') }}" alt="icon" class="img-fluid">
			</a>
			<p class="title">Create a Post</p>
		</div>
		<div class="profile-tab-wrap">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item active" role="presentation">
					<button class="nav-link active" id="profile-2-tab" data-bs-toggle="tab" data-bs-target="#profile-2" type="button" role="tab" aria-controls="profile-2" aria-selected="false">Background Color</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-1-tab" data-bs-toggle="tab" data-bs-target="#profile-1" type="button" role="tab" aria-controls="profile-1" aria-selected="true">Photo/Video</button>
				</li>
				{{--
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-3-tab" data-bs-toggle="tab" data-bs-target="#profile-3" type="button" role="tab" aria-controls="profile-3" aria-selected="false">Link</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-4-tab" data-bs-toggle="tab" data-bs-target="#profile-4" type="button" role="tab" aria-controls="profile-4" aria-selected="false">GIF</button>
				</li>
				--}}
			</ul>
			<div class="tab-content" id="myTabContent">
				<form action="{{ url('save-post') }}" method="POST" enctype="multipart/form-data"> @csrf
					<div class="tab-pane fade show active" id="profile-2" role="tabpanel" aria-labelledby="profile-2-tab">
						<div class="bg-color-wrap">
							<div class="row">
								<div class="col-md-6">
									<div class="bg-color-top">
										<div class="post-user">
											<div class="img">
												@if(!empty(session()->get('userData')->user_image))
												<img src="{{ session()->get('userData')->user_image }}" alt="img" class="img-fluid">
												@else
												<img src="{{ asset('public/assets/images/user-avatar.png') }}" alt="img" class="img-fluid">
												@endif
											</div>
											<p class="name">{{ session()->get('userData')->user_name }}</p>
										</div>
										<div class="post-bg-text">
											<textarea name="post_text" required class="post-bg-input" placeholder="Write something..." id="post-post" style="border: 1px solid #505255; background: none; height: 200px;"></textarea>
										</div>	
									</div>
									<div class="bg-color-bottom">
										<div class="input-colors-wrap">
											<div class="swiper input-color-slider">
												<div class="swiper-wrapper">
													@foreach($colors as $key => $color)
													<div class="swiper-slide">
														<div class="input-color">
															{{-- <input type="radio" value="red" name="post_color_cc" class="post-bg-color" />
															<label style="background:red"></label>  --}}
															<input type="radio" name="post_color_cc" value="{{ $color }}" class="post-bg-color" />
															<label style="background:{{ $color }}"></label>
														</div>
													</div>
													@endforeach
												</div>									
											</div>
											<div class="swiper-button-prev"><i class="fa-solid fa-chevron-left"></i></div>
											<div class="swiper-button-next"><i class="fa-solid fa-chevron-right"></i></div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="post-img-wrap" style="height: 550px;">
										<div class="post-img-left" style="width: 100%; margin-top:-300px">
											<div class="input-upload-wrap">
												{{--<input id="post-img-upload" type="file" class="filepond" name="post_image" />--}}
												<input type="file" class="filepond" name="post_post_image" />
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="post-right-bottom">
										<input type="hidden" name="post_type" id="post_type" value="text">
										<button class="post-btn post-btn-2" type="submit">Post Now</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{--
					<div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-1-tab">
						<div class="post-img-wrap">
							<div class="post-img-left">
								<div class="input-upload-wrap">
									<input id="post-img-upload" type="file" class="filepond" name="post_image" />
									<input id="post-img-upload" type="file" class="filepond" name="post_image" />
								</div>
							</div>
							<div class="post-img-right">
								
									<div class="post-right-bottom">
										
										<button class="post-btn post-btn-2" type="submit">Post Now</button>
									</div>
								
							</div>
						</div>
					</div>
					--}}					
				</form>
			</div>
		</div>
	</div>	
</section>

@endsection
@push('scripts')
    <script src="{{ asset('public/assets/js/custom/post.js') }}"></script> 
@endpush