@extends('layouts.master')
@section('title', 'Checkout')
@section('content')

<section class="products-sec-1">
    <div class="container-fluid">
        <ul class="c-breadcrumb">
            <li><a href="#!">Home</a></li>
            <li><a href="#!">Checkout</a></li>
        </ul>
    </div>
</section>

<section class="checkout-sec-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="checkout-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" role="tab" aria-controls="shipping" aria-selected="true">
                                <span class="circle xy-center"></span>
                                <span>Shipping</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" role="tab" aria-controls="review" aria-selected="false">
                                <span class="circle xy-center"></span>
                                <span>Review</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" role="tab" aria-controls="payment" aria-selected="false">
                                <span class="circle xy-center"></span>
                                <span>Payment</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <form action="{{ url('create-order') }}" method="post"> @csrf
                            <div class="tab-pane fade show active" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                <div class="checkout-form">
                                    <div class="row">
                                        <div>
                                            <p class="title">Billing Details</p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <input type="text" placeholder="Country" name="order_country" id="order_country" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <input type="text" placeholder="State" name="order_state" id="order_state" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <input type="text" placeholder="City" name="order_city" id="order_city" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <input type="text" placeholder="Address" name="order_address" id="order_address" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <button class="submit" id="proceed-to-review">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <div class="checkout-form">
                                    <p class="title">Order Details</p>
                                    <div class="cart-pg-wrap">
                                        <div class="cart-list-item top-head">
                                            <div class="item">
                                                <p>Item</p>
                                            </div>
                                            <div class="sub-total">
                                                <p>Sub Total</p>
                                            </div>
                                            <div class="item-quanity text-end">
                                                <p>Actions</p>
                                            </div>
                                        </div>
                                        @php $total = 0 @endphp
                                        @if(session('cart'))
                                        @foreach(session('cart') as $id => $details)
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                        <div class="cart-list-item">
                                            <div class="item">
                                                <div class="img">
                                                    <img src="{{ asset('public/assets/images/gallery-card-img-1.png') }}" alt="img" class="img-fluid">
                                                </div>
                                                <div class="text">
                                                    <p class="name">{{ $details['name'] }}</p>
                                                </div>
                                            </div>
                                            <div class="sub-total">
                                                <p>{{ $data['setCurrency'] . $details['price'] }}</p>
                                            </div>
                                            <div class="item-quanity">
                                                <div class="quantity-wrap justify-content-end">
                                                    <a href="javascript:void(0);" class="del-btn remove-from-cart" data-id="{{ base64_encode($id) }}"><i class="fa-solid fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="d-block">
                                        <div class="form-group">
                                            <button class="submit" id="proceed-to-payment">Proceed To Payment</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                                <div class="checkout-form payment-card">
                                    <!-- <p class="title">Payment Details</p> -->
                                    <div class="container">
                                        <div class="creditcard">
                                            <div class="front">
                                                <div id="ccsingle"></div>
                                                <svg version="1.1" id="cardfront" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
                                                    <g id="Front">
                                                        <g id="CardBackground">
                                                            <g id="Page-1_1_">
                                                                <g id="amex_1_">
                                                                    <path id="Rectangle-1_1_" class="lightcolor grey" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
															C0,17.9,17.9,0,40,0z"></path>
                                                                </g>
                                                            </g>
                                                            <path class="darkcolor greydark" d="M750,431V193.2c-217.6-57.5-556.4-13.5-750,24.9V431c0,22.1,17.9,40,40,40h670C732.1,471,750,453.1,750,431z"></path>
                                                        </g>
                                                        <text transform="matrix(1 0 0 1 60.106 295.0121)" id="svgnumber" class="st2 st3 st4">0123 4567 8910 1112</text>
                                                        <text transform="matrix(1 0 0 1 54.1064 428.1723)" id="svgname" class="st2 st5 st6">JOHN DOE</text>
                                                        <text transform="matrix(1 0 0 1 54.1074 389.8793)" class="st7 st5 st8">Name</text>
                                                        <text transform="matrix(1 0 0 1 479.7754 388.8793)" class="st7 st5 st8">Expiration</text>
                                                        <text transform="matrix(1 0 0 1 65.1054 241.5)" class="st7 st5 st8">Card Number</text>
                                                        <g>
                                                            <text transform="matrix(1 0 0 1 574.4219 433.8095)" id="svgexpire" class="st2 st5 st9">01</text>
                                                            <text transform="matrix(1 0 0 1 617.4219 433.8095)" class="st2 st5 st9">/</text>
                                                            <text transform="matrix(1 0 0 1 636.4219 433.8095)" id="svgexpire-year" class="st2 st5 st9">23</text>
                                                            <text transform="matrix(1 0 0 1 479.3848 417.0097)" class="st2 st10 st11">VALID</text>
                                                            <text transform="matrix(1 0 0 1 479.3848 435.6762)" class="st2 st10 st11">THRU</text>
                                                            <polygon class="st2" points="554.5,421 540.4,414.2 540.4,427.9 		"></polygon>
                                                        </g>
                                                        <g id="cchip">
                                                            <g>
                                                                <path class="st2" d="M168.1,143.6H82.9c-10.2,0-18.5-8.3-18.5-18.5V74.9c0-10.2,8.3-18.5,18.5-18.5h85.3
														c10.2,0,18.5,8.3,18.5,18.5v50.2C186.6,135.3,178.3,143.6,168.1,143.6z"></path>
                                                            </g>
                                                            <g>
                                                                <g>
                                                                    <rect x="82" y="70" class="st12" width="1.5" height="60"></rect>
                                                                </g>
                                                                <g>
                                                                    <rect x="167.4" y="70" class="st12" width="1.5" height="60"></rect>
                                                                </g>
                                                                <g>
                                                                    <path class="st12" d="M125.5,130.8c-10.2,0-18.5-8.3-18.5-18.5c0-4.6,1.7-8.9,4.7-12.3c-3-3.4-4.7-7.7-4.7-12.3
															c0-10.2,8.3-18.5,18.5-18.5s18.5,8.3,18.5,18.5c0,4.6-1.7,8.9-4.7,12.3c3,3.4,4.7,7.7,4.7,12.3
															C143.9,122.5,135.7,130.8,125.5,130.8z M125.5,70.8c-9.3,0-16.9,7.6-16.9,16.9c0,4.4,1.7,8.6,4.8,11.8l0.5,0.5l-0.5,0.5
															c-3.1,3.2-4.8,7.4-4.8,11.8c0,9.3,7.6,16.9,16.9,16.9s16.9-7.6,16.9-16.9c0-4.4-1.7-8.6-4.8-11.8l-0.5-0.5l0.5-0.5
															c3.1-3.2,4.8-7.4,4.8-11.8C142.4,78.4,134.8,70.8,125.5,70.8z"></path>
                                                                </g>
                                                                <g>
                                                                    <rect x="82.8" y="82.1" class="st12" width="25.8" height="1.5"></rect>
                                                                </g>
                                                                <g>
                                                                    <rect x="82.8" y="117.9" class="st12" width="26.1" height="1.5"></rect>
                                                                </g>
                                                                <g>
                                                                    <rect x="142.4" y="82.1" class="st12" width="25.8" height="1.5"></rect>
                                                                </g>
                                                                <g>
                                                                    <rect x="142" y="117.9" class="st12" width="26.2" height="1.5"></rect>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <g id="Back">
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="back">
                                                <svg version="1.1" id="cardback" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
                                                    <g id="Front">
                                                        <line class="st0" x1="35.3" y1="10.4" x2="36.7" y2="11"></line>
                                                    </g>
                                                    <g id="Back">
                                                        <g id="Page-1_2_">
                                                            <g id="amex_2_">
                                                                <path id="Rectangle-1_2_" class="darkcolor greydark" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
													C0,17.9,17.9,0,40,0z"></path>
                                                            </g>
                                                        </g>
                                                        <rect y="61.6" class="st2" width="750" height="78"></rect>
                                                        <g>
                                                            <path class="st3" d="M701.1,249.1H48.9c-3.3,0-6-2.7-6-6v-52.5c0-3.3,2.7-6,6-6h652.1c3.3,0,6,2.7,6,6v52.5
												C707.1,246.4,704.4,249.1,701.1,249.1z"></path>
                                                            <rect x="42.9" y="198.6" class="st4" width="664.1" height="10.5"></rect>
                                                            <rect x="42.9" y="224.5" class="st4" width="664.1" height="10.5"></rect>
                                                            <path class="st5" d="M701.1,184.6H618h-8h-10v64.5h10h8h83.1c3.3,0,6-2.7,6-6v-52.5C707.1,187.3,704.4,184.6,701.1,184.6z"></path>
                                                        </g>
                                                        <text transform="matrix(1 0 0 1 621.999 227.2734)" id="svgsecurity" class="st6 st7">985</text>
                                                        <g class="st8">
                                                            <text transform="matrix(1 0 0 1 518.083 280.0879)" class="st9 st6 st10">security code</text>
                                                        </g>
                                                        <rect x="58.1" y="378.6" class="st11" width="375.5" height="13.5"></rect>
                                                        <rect x="58.1" y="405.6" class="st11" width="421.7" height="13.5"></rect>
                                                        <text transform="matrix(1 0 0 1 59.5073 228.6099)" id="svgnameback" class="st12 st13">John Doe</text>
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-container row mt-5">
                                        <div class="field-container payment-input-col  col-lg-12">
                                            <div class="form-group">
                                                <input name="card_name" id="name" maxlength="20" type="text" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="field-container payment-input-col col-lg-12">
                                            <div class="form-group">
                                                <span id="generatecard">generate random</span>
                                                <input name="cardnumber" id="cardnumber" autocomplete="off" inputmode="numeric" placeholder="Card Number" pattern="[0-9]*" class="form-control card-number" size="20" type="text">
                                                <svg id="ccicon" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"></svg>
                                            </div>
                                        </div>
                                        <div class="field-container payment-input-col  col-6">
                                            <div class="form-group">
                                                <input name="card_expiry_month" id="expirationmonth" class="card-expiry-month" pattern="[0-9]*" inputmode="numeric" placeholder="Expiration MM" size="2" type="text">
                                            </div>
                                        </div>
                                        <div class="field-container payment-input-col col-6">
                                            <div class="form-group">
                                                <input name="card_expiry_year" id="expirationyear" class="card-expiry-year" pattern="[0-9]*" inputmode="numeric" placeholder="Expiration YY" size="2" type="text">
                                            </div>
                                        </div>
                                        <div class="field-container payment-input-col col-12">
                                            <div class="form-group">
                                                <input name="card_security_number" id="securitycode" autocomplete="off" pattern="[0-9]*" inputmode="numeric" placeholder="Security Code" class="card-cvc" size="4" type="text">
                                            </div>
                                        </div>
                                        <div class="field-container payment-input-col col-12">
                                            <div class="form-group mb-0">
                                                <input type="submit" class="submit" value="SUBMIT">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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