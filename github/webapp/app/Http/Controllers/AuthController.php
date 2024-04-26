<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;

class AuthController extends Controller
{
    public function signInForm()
    {
        return view('auth.sign-in');
    }

    public function signUpForm()
    {
        return view('auth.sign-up');
    }

    public function user_create(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'user',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'user_name' => $request->user_name,
                'user_email' => $request->user_email,
                'user_password' => $request->user_password,
                'user_device' => 'web',
                'user_device_token' => $request->user_device_token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($response);

        if ($res->status == 1) {
            Session::put('userId', $res->data->user_id);
            Session::put('bearer_token', $res->data->user_authentication);
            Session::put('userData', $res->data);
        }
        return $response;
    }

    public function otpVerification()
    {
        if (empty(Session::get('userId')) || Session::get('userData')->user_is_verify == 1) {
            return redirect('/sign-up');
        }

        return view('auth.otp-verification');
    }


    public function otpVerify(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'verification_code',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('user_id' => Session::get('userId'), 'verification_code' => $request->otp),
            CURLOPT_HTTPHEADER => array(
                'Authentication: ' . Session::get('bearer_token') . ''
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public function authenticate(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array( 
            CURLOPT_URL => $this->apiBaseUrl . 'login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'user_email' => $request->user_email,
                'user_password' => $request->user_password,
                'user_device' => 'web',
                'user_device_token' => $request->device_token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $res = json_decode($response);

        if ($res->status == 1) {
            Session::put('userId', $res->data->user_id);
            Session::put('bearer_token', $res->data->user_authentication);
            Session::put('userData', $res->data);
        }

        return $response;
    }

    public function profile($user_id)
    {
        $userId = base64_decode($user_id);
        $goto = new HomeController();
        $response = $goto->productCategory();

        $res = json_decode($response);
        $data = array();

        if ($res->status == 1) {
            $data['productCategories'] = $res->data;
        }

        $user_post_list = $this->getUserPost(Session::get('userData')->user_id, $userId);
        $user_product_list = $this->getUserProduct(Session::get('userData')->user_id, $userId);
        $user_order_list = $this->getOrderList(Session::get('userData')->user_id);
        $user_bid_list = $this->getBidList(Session::get('userData')->user_id);
        $user_profile = $this->getUserProfile(Session::get('userData')->user_id, $userId);

        $data['user_post_list_decode'] = json_decode($user_post_list);
        $data['user_product_list_decode'] = json_decode($user_product_list);
        $data['user_order_list'] = json_decode($user_order_list);
        $data['user_bid_list'] = json_decode($user_bid_list);
        $data['user_profile'] = json_decode($user_profile);
        $data['user_id'] = $userId;

        // dd($data['user_profile']);

        return view('user.profile', $data);
    }

    /** User profile */
    public function getUserProfile($userId, $otherid)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'user_profile?user_id=' . $userId . '&other_id=' . $otherid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authentication: ' . Session::get('bearer_token') . ''
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    /** User posts */
    public function getUserPost($userId, $otherid)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'user_post_list?user_id=' . $userId . '&other_id=' . $otherid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authentication: ' . Session::get('bearer_token') . ''
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    /** User products */
    public function getUserProduct($userId, $otherid)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'user_product_list?user_id=' . $userId . '&other_id=' . $otherid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authentication: ' . Session::get('bearer_token') . ''
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    /** Get order list */
    public function getOrderList($userId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'list_order?user_id=' . $userId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authentication: ' . Session::get('bearer_token') . ''
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    /** Detail order */
    public function detailOrder($order_id)
    {
        $orderId = base64_decode($order_id);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'detail_order?user_id=' . Session::get('userData')->user_id . '&order_id=' . $orderId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authentication: ' . Session::get('bearer_token') . ''
            ),
        ));

        $detailOrder = curl_exec($curl);

        curl_close($curl);

        $data['user_order_list'] = json_decode($detailOrder);

        if ($data['user_order_list']->status == 0) {
            return redirect()->back()->with('error', $data['user_order_list']->message);
        } else {
            $detailOrderData = $data['user_order_list']->data;
            return view('user.order-details', compact('detailOrderData'));
        }
    }

    /** Get bid list */
    public function getBidList($userId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'list_bid?user_id=' . $userId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authentication: ' . Session::get('bearer_token') . ''
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    /** create follow */
    public function createFollow(Request $request)
    {
        $follower_id = base64_decode($request->id);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'create_follow',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'user_id' => Session::get('userData')->user_id, 
                'follower_id' => $follower_id
            ),
            CURLOPT_HTTPHEADER => array(
                'Authentication: ' . Session::get('bearer_token') . ''
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    /** logout */
    public function logout()
    {
        session()->forget('userId');
        session()->forget('bearer_token');
        session()->forget('userData');

        return redirect('/');
    }
}
