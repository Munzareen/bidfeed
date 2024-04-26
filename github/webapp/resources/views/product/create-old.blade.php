@extends('layouts.master')
@section('title', 'Product create')
@section('content')

<section class="checkout-sec-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form action="{{ url('create-product') }}" method="post" id="create-product-form"> @csrf
                    <div class="checkout-form">
                        <div class="row">
                            <div>
                                <p class="title">Product Create</p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="product_pc_id">Category</label>
                                    <select class="form-control" name="product_pc_id">
                                        <option value="">--Select--</option>
                                        @if(!empty($productCategories) && count($productCategories) > 0)
                                        @foreach($productCategories as $key => $productCategory)
                                        <option value="{{ $productCategory->pc_id }}">{{ $productCategory->pc_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="product_condition">Condition</label>
                                    <select class="form-control" name="product_condition" required>
                                        <option value="">--Select--</option>
                                        <option value="new">New</option>
                                        <option value="used">Used</option>
                                        <option value="open_box">Open Box</option>
                                        <option value="seller_refurbished">Seller Refurbished</option>
                                        <option value="for_parts_or_not_working">For Parts or Not Working</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="product_description">Description</label>
                                    <textarea name="product_description" class="form-control" id="product_description" rows="3" placeholder="Product Description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <input type="checkbox" value="1" placeholder="product_is_featured" name="product_is_featured" id="product_is_featured" required>
                                </div>
                                Is featured
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <input type="checkbox" value="1" placeholder="product_upcoming" name="product_upcoming" id="product_upcoming" required>
                                </div>
                                Product Upcoming
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pp_type">Type</label>
                                    <select class="form-control" name="pp_type" required>
                                        <option value="auction">Auction</option>
                                        <option value="buy_now">Buy Now</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pp_time">Time</label>
                                    <input type="time" class="form-control" placeholder="pp_time" name="order_country" id="order_country" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pp_price">Price</label>
                                    <input type="number" placeholder="Price" name="pp_price" id="pp_price" required min="0">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pd_cost">Cost</label>
                                    <input type="number" placeholder="Cost" name="pd_cost" id="pd_cost" required min="0">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pd_internationally">Internationally</label>
                                    <select class="form-control" name="pd_internationally" required>
                                        <option value="">--Select--</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pdd_pounds">Pdd Pounds</label>
                                    <input type="text" placeholder="Pounds" name="pdd_pounds" id="pdd_pounds" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pdd_ounces">Pdd Ounces</label>
                                    <input type="text" placeholder="Ounces" name="pdd_ounces" id="pdd_ounces" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pdd_lenght">Pdd Lenght</label>
                                    <input type="text" placeholder="Lenght" name="pdd_lenght" id="pdd_lenght" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pdd_lenght">Pdd Width</label>
                                    <input type="text" placeholder="Width" name="pdd_width" id="pdd_width" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pdd_height">Pdd Height</label>
                                    <input type="text" placeholder="Height" name="pdd_height" id="pdd_height" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="pds_type-group">
                                    <label for="pds_type">Pds Type</label>
                                    <select class="form-control" name="pds_type" required>
                                        <option value="">--Select--</option>
                                        <option value="economy">Economy</option>
                                        <option value="standard">Standard</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pds_title">Pds Title</label>
                                    <input type="text" placeholder="Title" name="pds_title" id="pds_title" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pds_price">Pds Price</label>
                                    <input type="text" placeholder="Price" name="pds_price" id="pds_price" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pds_time">Pds Time</label>
                                    <input type="text" placeholder="Time" name="pds_time" id="pds_time" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="product_image">Image</label> <br>
                                    <input type="file" name="product_image[]" id="product_image" multiple>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <button type="submit" class="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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