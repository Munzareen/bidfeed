<div class="cartbox-inner">
    <div>
        <div class="cartbox-top">
            <p>Your Cart</p>
            <button class="close-cart"><img src="{{ asset('public/assets/images/icon-cross.png') }}" alt="icon" class="img-fluid"></button>
        </div>
        @php $total = 0 @endphp
        @if(session('cart'))
        @foreach(session('cart') as $id => $details)
        @php $total += $details['price'] * $details['quantity'] @endphp
        <div class="cart-item-wrap" data-id="{{ base64_encode($id) }}">
            <div class="cart-item">
                <div class="img">
                    @if(!empty($details['image']))
                    <img src="{{ $details['image'] }}" alt="img" class="img-fluid">
                    @else
                    <img src="{{ asset('public/assets/images/no-image.png') }}" alt="img" class="img-fluid">
                    @endif
                </div>
                <div class="text">
                    <p class="name">{{ $details['name'] }}</p>
                    <div class="size-wrap">
                        <div class="size-box">42</div>
                    </div>
                    <p class="price">{{ $data['setCurrency'] . $details['quantity'] * $details['price'] }}</p>
                    <div class="item-action">
                        <div class="quantity-wrap">
                            <div class="quaitity-box mt-0">
                                <div class="plus-minus">
                                    <span class="minus"><i class="fa-solid fa-minus"></i></span>
                                    <input type="number" class="count" name="qty" value="{{ $details['quantity'] }}">
                                    <span class="plus"><i class="fa-solid fa-plus"></i></span>
                                </div>
                            </div>
                        </div>
                        {{--
                        <div class="action">
                            <a href="javascript:void(0);"><i class="fa-solid fa-trash pe-1"></i>Delete</a>
                        </div>
                        --}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="cart-list-item">
            <p>No products found.</p>
        </div>
        @endif
    </div>
    @if(session('cart'))
    <div>
        <div class="amount-wrap">
            <ul>
                <li>
                    <span><strong>Total</strong></span>
                    <span><strong>{{ $data['setCurrency'] . $total }}</strong></span>
                </li>
            </ul>
        </div>
        <div class="btn-box">
            <a href="{{ url('cart') }}" class="outline">View Cart</a>
        </div>
    </div>
    @endif
</div>