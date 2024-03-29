@extends('layouts.master')
@section('title', 'Create Post')
@section('content')

<section class="post-pg-sec bg-color">
	<div class="container">
		<div class="pg-top">
			<button class="back-btn">
				<img src="assets/images/icon-arrow-left.png" alt="icon" class="img-fluid">
			</button>
			<p class="title">Create a Post</p>
		</div>
		<div class="profile-tab-wrap">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="profile-1-tab" data-bs-toggle="tab" data-bs-target="#profile-1" type="button" role="tab" aria-controls="profile-1" aria-selected="true">Photo/Video</button>
				</li>
				<li class="nav-item active" role="presentation">
					<button class="nav-link" id="profile-2-tab" data-bs-toggle="tab" data-bs-target="#profile-2" type="button" role="tab" aria-controls="profile-2" aria-selected="false">Background Color</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-3-tab" data-bs-toggle="tab" data-bs-target="#profile-3" type="button" role="tab" aria-controls="profile-3" aria-selected="false">Link</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-4-tab" data-bs-toggle="tab" data-bs-target="#profile-4" type="button" role="tab" aria-controls="profile-4" aria-selected="false">GIF</button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="profile-1" role="tabpanel" aria-labelledby="profile-1-tab">
					<div class="post-img-wrap">
						<div class="post-img-left">
							<div class="input-upload-wrap">
								<input id="post-img-upload" type="file" class="filepond" name="filepond" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="30">
							</div>
						</div>
						<div class="post-img-right">
							<form>
								<div class="post-right-top post-user-wrap">
									<div class="post-user">
										<div class="img">
											<img src="{{ asset('public/assets/images/user-review-img.png') }}" alt="img" class="img-fluid">
										</div>
										<p class="name">Theresa Webb</p>
									</div>
									<textarea placeholder="Write something..."></textarea>
								</div>
								<div class="post-right-bottom">
									<button class="post-btn post-btn-1">Save as Draft</button>
									<button class="post-btn post-btn-2">Post Now</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="profile-2" role="tabpanel" aria-labelledby="profile-2-tab">
					<div class="bg-color-wrap">
						<div class="bg-color-top">
							<div class="post-user">
								<div class="img">
									<img src="{{ asset('public/assets/images/user-review-img.png') }}" alt="img" class="img-fluid">
								</div>
								<p class="name">Afrikrea.com</p>
							</div>
							<div class="post-bg-text">
								<input type="text" placeholder="Write something..." class="post-bg-input">
							</div>	
						</div>
						<div class="bg-color-bottom">
							<div class="input-colors-wrap">
								<div class="swiper input-color-slider">
									<div class="swiper-wrapper">
										<div class="swiper-slide">
											<div class="input-color">
												<input type="radio" value="" name="bg-color-select">
												<label class="color-1"></label>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="input-color">
												<input type="radio" value="" name="bg-color-select">
												<label class="color-2"></label>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="input-color">
												<input type="radio" value="" name="bg-color-select">
												<label class="color-3"></label>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="input-color">
												<input type="radio" value="" name="bg-color-select">
												<label class="color-4"></label>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="input-color">
												<input type="radio" value="" name="bg-color-select">
												<label class="color-5"></label>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="input-color">
												<input type="radio" value="" name="bg-color-select">
												<label class="color-6"></label>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="input-color">
												<input type="radio" value="" name="bg-color-select">
												<label class="color-7"></label>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="input-color">
												<input type="radio" value="" name="bg-color-select">
												<label class="color-8"></label>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="input-color">
												<input type="radio" value="" name="bg-color-select">
												<label class="color-9"></label>
											</div>
										</div>
									</div>
									
								</div>
								<div class="swiper-button-prev"><i class="fa-solid fa-chevron-left"></i></div>
								<div class="swiper-button-next"><i class="fa-solid fa-chevron-right"></i></div>
							</div>
							<div class="post-right-bottom">
								<button class="post-btn post-btn-1">Save as Draft</button>
								<button class="post-btn post-btn-2">Post Now</button>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="profile-3" role="tabpanel" aria-labelledby="profile-3-tab">
					<div class="post-link-wrap">
						<div class="post-input">
							<input type="text" placeholder="Enter website link">
						</div>

						<div class="row products-row">
							<div class="col-lg-4 col-md-4 col-sm-6 col-12 sell-prod-col">
								<div class="product-card">
									<div class="img">
										<img src="assets/images/product-img-1.png" alt="img" class="img-fluid">
										<!-- <button class="price-btn">$135</button> -->
									</div>
									<div class="desc">
										<a href="#!">Tracksuit Men African Clothing Print Shirt Suit.</a>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-12 sell-prod-col">
								<div class="product-card">
									<div class="img">
										<img src="assets/images/product-img-2.png" alt="img" class="img-fluid">
										<!-- <button class="price-btn">$135</button> -->
									</div>
									<div class="desc">
										<a href="#!">Tracksuit Men African Clothing Print Shirt Suit.</a>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-12 sell-prod-col">
								<div class="product-card">
									<div class="img">
										<img src="assets/images/product-img-3.png" alt="img" class="img-fluid">
										<!-- <button class="price-btn">$135</button> -->
									</div>
									<div class="desc">
										<a href="#!">Tracksuit Men African Clothing Print Shirt Suit.</a>
									</div>
								</div>
							</div>
						</div>

						<div class="post-right-bottom">
							<button class="post-btn post-btn-1">Save as Draft</button>
							<button class="post-btn post-btn-2">Post Now</button>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="profile-4" role="tabpanel" aria-labelledby="profile-4-tab">
					<div class="post-gif-wrap">
						<div class="post-input">
							<img src="assets/images/search-icon.svg" alt="icon" class="img-fluid">
							<input type="text" placeholder="Search GIFY">
						</div>
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-6 col-6">
								<div class="gif-box">
									<input type="radio" name="post-gif">
									<label>
										<img src="assets/images/post-gif-img-1.png" alt="img" class="img-fluid">
									</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-6">
								<div class="gif-box">
									<input type="radio" name="post-gif">
									<label>
										<img src="assets/images/post-gif-img-2.png" alt="img" class="img-fluid">
									</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-6">
								<div class="gif-box">
									<input type="radio" name="post-gif">
									<label>
										<img src="assets/images/post-gif-img-3.png" alt="img" class="img-fluid">
									</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-6">
								<div class="gif-box">
									<input type="radio" name="post-gif">
									<label>
										<img src="assets/images/post-gif-img-4.png" alt="img" class="img-fluid">
									</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-6">
								<div class="gif-box">
									<input type="radio" name="post-gif">
									<label>
										<img src="assets/images/post-gif-img-5.png" alt="img" class="img-fluid">
									</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-6">
								<div class="gif-box">
									<input type="radio" name="post-gif">
									<label>
										<img src="assets/images/post-gif-img-6.png" alt="img" class="img-fluid">
									</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-6">
								<div class="gif-box">
									<input type="radio" name="post-gif">
									<label>
										<img src="assets/images/post-gif-img-7.png" alt="img" class="img-fluid">
									</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-6">
								<div class="gif-box">
									<input type="radio" name="post-gif">
									<label>
										<img src="assets/images/post-gif-img-8.png" alt="img" class="img-fluid">
									</label>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-6">
								<div class="gif-box">
									<input type="radio" name="post-gif">
									<label>
										<img src="assets/images/post-gif-img-9.png" alt="img" class="img-fluid">
									</label>
								</div>
							</div>
							<div class="col-12 mt-5 d-flex justify-content-center">
								<button class="next-btn">Next</button>
							</div>
						</div>
					</div>
					<div class="posting-gif-wrap">
						<div class="post-img-wrap">
							<div class="post-img-left post-gif-left" style="background: url(assets/images/upload-gif.png);">
								<div class="upload-gif-input">
									<input type="file">
									<label>Select another GIF</label>
								</div>
							</div>
							<div class="post-img-right">
								<form>
									<div class="post-right-top post-user-wrap">
										<div class="post-user">
											<div class="img">
												<img src="{{ asset('public/assets/images/user-review-img.png') }}" alt="img" class="img-fluid">
											</div>
											<p class="name">Theresa Webb</p>
										</div>
										<textarea placeholder="Write something..."></textarea>
									</div>
									<div class="post-right-bottom">
										<button class="post-btn post-btn-1">Save as Draft</button>
										<button class="post-btn post-btn-2">Post Now</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</section>

@endsection
@push('scripts')
    <script src="{{ asset('public/assets/js/custom/post.js') }}"></script> 
@endpush