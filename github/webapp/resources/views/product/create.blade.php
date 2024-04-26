@extends('layouts.master')
@section('title', 'Product create')
@section('content')


<section class="post-pg-sec bg-color">
	<div class="container">
		<div class="pg-top">
			<a href="javascript:history.go(-1)" class="back-btn">
				<img src="{{ asset('public/assets/images/icon-arrow-left.png') }}" alt="icon" class="img-fluid">
            </a>
			<p class="title">List An Item</p>
		</div>
		<div class="list-item-card">
			<form action="{{ url('create-product') }}" method="post" id="create-product-form" enctype="multipart/form-data"> @csrf
				<div class="accordion" id="accordionExample">
					<div class="accordion-item">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							Basic Info
						</button>
						<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
							<div class="accordion-body">
								<div class="row">
									<div class="col-12">
										<div class="input-group mb-3 upload-group">
											<input type="file" class="form-control" name="product_image" id="inputGroupFile02">
											<label class="input-group-text" for="inputGroupFile02">Upload Images</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<input type="text" class="form-control" id="li-input-1" placeholder="Title">
											<label for="li-input-1">Item Title</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<select class="form-select" name="product_pc_id" id="li-input-2" aria-label="Floating label select example">
                                                <option value="">--Select--</option>
                                                @if(!empty($productCategories) && count($productCategories) > 0)
                                                @foreach($productCategories as $key => $productCategory)
                                                <option value="{{ $productCategory->pc_id }}">{{ $productCategory->pc_name }}</option>
                                                @endforeach
                                                @endif
											</select>
											<label for="li-input-2">Category</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<select class="form-select" name="product_condition" id="li-input-3" aria-label="Floating label select example">
												<option value="new">New</option>
												<option value="used">Used</option>
												<option value="open_box">Open Box</option>
												<option value="seller_refurbished">Seller Refurbished</option>
												<option value="for_parts_or_not_working">For Parts or Not Working</option>
											</select>
											<label for="li-input-3">Contition</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<textarea class="form-control" name="product_description" placeholder="Description" id="li-input-4"></textarea>
											<label for="li-input-4">Description</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-check form-switch mb-3">
											<input class="form-check-input" type="checkbox" role="switch" id="li-input-5 product_is_featured" value="1" name="product_is_featured">
											<label class="form-check-label" for="li-input-5">Is featured</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-check form-switch mb-3">
											<input class="form-check-input" type="checkbox" role="switch" id="li-input-6 product_upcoming" value="1" name="product_upcoming">
											<label class="form-check-label" for="li-input-6">Product Upcoming</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							Type/Pricing
						</button>
						<div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
							<div class="accordion-body">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<select class="form-select" id="li-input-7" name="pp_type" aria-label="Floating label select example">
												<option value="auction">Auction</option>
												<option value="buy_now">Buy Now</option>
											</select>
											<label for="li-input-7">Type</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<input type="time" class="form-control" id="li-input-8" name="pp_time" placeholder="00:00">
											<label for="li-input-8">Time</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" id="li-input-9" name="pp_price" placeholder="$20">
											<label for="li-input-9">Price</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" name="pd_cost" id="li-input-10" placeholder="$20">
											<label for="li-input-10">Cost</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							Delivery
						</button>
						<div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
							<div class="accordion-body">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<select class="form-select" name="pd_internationally" id="li-input-11" aria-label="Floating label select example">
												<option value="1">Yes</option>
												<option value="0">No</option>
											</select>
											<label for="li-input-11">Internationally</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" name="pdd_pounds" id="li-input-12" placeholder="Pdd Pounds">
											<label for="li-input-12">Pdd Pounds</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" name="pdd_ounces" id="li-input-13" placeholder="Pdd Ounces">
											<label for="li-input-13">Pdd Ounces</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" name="pdd_lenght" id="li-input-14" placeholder="Length">
											<label for="li-input-14">Pdd Length</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" name="pdd_width" id="li-input-15" placeholder="Width">
											<label for="li-input-15">Pdd Width</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" name="pdd_height" id="li-input-16" placeholder="Height">
											<label for="li-input-16">Pdd Height</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<select class="form-select" id="li-input-17" name="pds_type" aria-label="Floating label select example">
												<option value="economy">Economy</option>
												<option value="standard">Standard</option>
											</select>
											<label for="li-input-17">Pds Type</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<input type="text" class="form-control" name="pds_title" id="li-input-18" placeholder="Pds Title">
											<label for="li-input-18">Pds Title</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" name="pds_price" id="li-input-19" placeholder="Pds Price">
											<label for="li-input-19">Pds Price</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-floating mb-3">
											<input type="time" class="form-control" name="pds_time" id="li-input-20" placeholder="Pds Time">
											<label for="li-input-20">Pds Time</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="text-center mt-3">
					<button type="submit" class="submit">SUBMIT</button>
				</div>
			</form>
		</div>
	</div>	
</section>

@endsection
@push('scripts')
<script>

    // $("#create-product-form").validate();

    $("#create-product-form").validate({
        rules: {
            product_pc_id: "required",
            product_condition: "required",
            product_description: "required",
            // product_condition: {
            //     required: true,
            // },
        },
    });
</script>
@endpush