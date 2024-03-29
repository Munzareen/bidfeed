@extends('layouts.master')
@section('title', 'Profile')
@section('content')

<div class="draft-tab-wrap">

    <p class="title">Order Detail</p>
    <table class="table text-center">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Total Amount</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Address</th>
                <th>Status</th>
                <th>Order Datetime</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $detailOrderData->order_number }}</td>
                <td>{{ $data['setCurrency'] . $detailOrderData->order_total_amount }}</td>
                <td>{{ $detailOrderData->order_country }}</td>
                <td>{{ $detailOrderData->order_state }}</td>
                <td>{{ $detailOrderData->order_city }}</td>
                <td>{{ $detailOrderData->order_address }}</td>
                <td>{{ $detailOrderData->order_status }}</td>
                <td>{{ $detailOrderData->order_created_at }}</td>
            </tr>
        </tbody>
    </table>

    <p class="title">Order Products</p>
    <table class="table text-center">
        <thead>
            <tr>
                <th>Image</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($detailOrderData))
            @foreach($detailOrderData->order_products as $detailOrder)
            <tr>
                <td><img src="{{ $detailOrder->product_image }}" alt="" width="50px"></td>
                <td>{{ $detailOrder->product_description }}</td>
                <td>{{ $data['setCurrency'] . $detailOrder->oi_price }}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td>{{ $user_order_list->message }}</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

@endsection