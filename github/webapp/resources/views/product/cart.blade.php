@extends('layouts.master')
@section('title', 'Cart')
@section('content')

<section class="products-sec-1">
	<div class="container-fluid">
		<ul class="c-breadcrumb">
			<li><a href="#!">Home</a></li>
			<li><a href="#!">Cart</a></li>
		</ul>
	</div>
</section>

<div class="container">
    <div class="row">
        <div class="col-12">
            <p class="sec-title">Cart</p>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="cart-pg-wrap">
                <div class="cart-list-item top-head">
                    <div class="item">
                        <p>Item</p>
                    </div>
                    <div class="item-quanity">
                        <p>Quantity</p>
                    </div>
                    <div class="sub-total">
                        <p>Price</p>
                    </div>
                    <div class="">
                        <p>Sub Total</p>
                    </div>
                </div>
                @php $total = 0; @endphp
                @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity']; @endphp
                <div class="cart-list-item">
                    <div class="item">
                        <div class="img">
                            <img src="{{ asset('public/assets/images/gallery-card-img-1.png') }}" alt="img" class="img-fluid">
                        </div>
                        <div class="text">
                            <p class="name">{{ $details['name'] }}</p>
                            <div class="size-wrap">
                                <div class="size-box">M</div>
                            </div>
                        </div>
                    </div>
                    <div class="item-quanity">
                        <div class="quantity-wrap">
                            <div class="quaitity-box mt-0">
                                <div class="plus-minus">
                                    <span class="minus"><i class="fa-solid fa-minus"></i></span>
                                    <input type="number" class="count" name="qty" value="{{ $details['quantity'] }}">
                                    <span class="plus"><i class="fa-solid fa-plus"></i></span>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="del-btn remove-from-cart" data-id="{{ base64_encode($id) }}"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                    <div class="sub-total">
                        <p>{{ $data['setCurrency'] . $details['price'] }}</p>
                    </div>
                    <div class="sub-total">
                        <p>{{ $data['setCurrency'] . $details['quantity'] * $details['price'] }}</p>
                    </div>
                </div>
                @endforeach
                @else
                <div class="cart-list-item">
                    <p>No products found.</p>
                </div>
                @endif
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="order-summary-card">
                <div class="summary-group">
                    <p class="title">Order Summary</p>
                </div>
                <div class="summary-group">
                    <ul>
                        <li>
                            <span>Subtotal</span>
                            <span>{{ $data['setCurrency'] . $total }}</span>
                        </li>
                    </ul>
                </div>
                <div class="summary-group">
                    <ul>
                        <li class="pt-0">
                            <span class="total">Order total</span>
                            <span>{{ $data['setCurrency'] . $total }}</span>
                        </li>
                    </ul>
                    <a href="{{ url('checkout') }}" class="gen-btn xy-center mt-5">Checkout <i class="fas fa-chevron-right ps-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('public/assets/js/custom/cart.js') }}"></script>
@endpush