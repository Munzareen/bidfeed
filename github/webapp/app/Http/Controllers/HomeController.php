<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use PDO;

class HomeController extends Controller
{
    public function home()
    {
        $data = array();

        $productCategory = $this->productCategory();
        $productCategory_decode = json_decode($productCategory);

        $home_list = $this->home_list();
        $home_list_decode = json_decode($home_list);

        if ($productCategory_decode->status == 1) {
            $data['productCategories'] = $productCategory_decode->data;
        }

        if ($home_list_decode->status == 1) {
            $data['featured'] = $home_list_decode->data->featured;
            $data['upcoming'] = $home_list_decode->data->upcoming;
        }
        else{
            if($home_list_decode->status == 0 && $home_list_decode->message == 'Authentication is not valid.'){
                session()->forget('userId');
                session()->forget('bearer_token');
                session()->forget('userData');
                return redirect('sign-in')->with('error', $home_list_decode->message);
            }
        }

        return view('index', $data);
    }


    /** Product Category */
    public function productCategory()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'get_product_category?user_id=' . Session::get('userData')->user_id,
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

    /** Home products */
    public function home_list()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'home_list?user_id=' . Session::get('userData')->user_id,
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

    /** Product details */
    public function productDetails($productId)
    {
        $id = base64_decode($productId);
        $data = array();

        $productDetail = $this->getProductDetail($id);

        $productCategory = $this->productCategory();
        $productCategory_decode = json_decode($productCategory);
        $productDetail_decode = json_decode($productDetail);

        if ($productCategory_decode->status == 1) {
            $data['productCategories'] = $productCategory_decode->data;
        }

        if ($productCategory_decode->status == 1) {
            $data['productDetail'] = $productDetail_decode->data;
        }

        // Buy now
        if ($data['productDetail']->pp_type == 'buy_now') {
            return view('product.buy-now', $data);
        } else { // Bid now
            return view('product.bid-now', $data);
        }
    }

    /** Product Detail */
    public function getProductDetail($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'product_detail?user_id=' . Session::get('userData')->user_id . '&product_id=' . $id,
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

    /** Create like */
    public function createLike(Request $request)
    {
        $source = base64_decode($request->source);
        $type = $request->type;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'create_like',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'user_id' => Session::get('userData')->user_id, 
                'other_id' => $source,
                'type' => $type
            ),
            CURLOPT_HTTPHEADER => array(
                'Authentication: ' . Session::get('bearer_token') . ''
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
