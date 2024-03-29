<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        return view('product.cart');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart(Request $request)
    {
        $id = base64_decode($request->productId);
        $goto = new HomeController();
        $productDetail = $goto->getProductDetail($id);

        $productDetail_decode = json_decode($productDetail);

        if ($productDetail_decode->status == 1) {
            $product = $productDetail_decode->data;

            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    "name" => $product->product_description,
                    "quantity" => 1,
                    "price" => $product->pp_price
                ];
            }
            session()->put('cart', $cart);
            return array(
                'status' => 1,
                'message' => 'Product added to cart successfully.',
                'nav_cart_count' => count((array) session('cart'))
            );
        } else {
            return array(
                'status' => 0,
                'message' => $productDetail_decode->message
            );
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully.');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $id = base64_decode($request->id);
            $cart = session()->get('cart');
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
                session()->flash('success', 'Product removed successfully');
                return array(
                    'status' => 1
                );
            } else {
                return array(
                    'status' => 0,
                    'message' => 'Something went wrong.'
                );
            }
        } else {
            return array(
                'status' => 0,
                'message' => 'Something went wrong.'
            );
        }
    }

    /** Checkout */
    public function checkout()
    {
        if (count(session()->get('cart')) > 0) {
            return view('product.checkout');
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }

    /** Create order */
    public function createOrder(Request $request)
    {
        if (count(session()->get('cart')) > 0) {

            $total = 0;
            $p_array = array();
            foreach(session('cart') as $id => $details){
                $total += $details['price'] * $details['quantity'];
                $p_data['product_id'] = $id;
                $p_data['product_price'] = $details['price'];
                array_push($p_array, $p_data);
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->apiBaseUrl . 'create_order',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'user_id' => Session::get('userData')->user_id, 
                    'order_total_amount' => $total, 
                    'order_country' => $request->order_country, 
                    'order_city' => $request->order_city, 
                    'order_state' => $request->order_state, 
                    'order_address' => $request->order_address, 
                    'order_item' => json_encode($p_array)
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authentication: ' . Session::get('bearer_token') . ''
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $orderCreate = json_decode($response);

            if($orderCreate->status == 1){
                session()->forget('cart');
                return redirect('home')->with('success', $orderCreate->message);
            }
            else{ 
                return redirect()->back()->with('error', $orderCreate->message);
            }
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }
}
