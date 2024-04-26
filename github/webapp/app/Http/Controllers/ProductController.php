<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /** Create product */
    public function createProduct()
    {
        $data = array();

        $goto = new HomeController();
        $productCategory = $goto->productCategory();

        $productCategory_decode = json_decode($productCategory);

        if ($productCategory_decode->status == 1) {
            $data['productCategories'] = $productCategory_decode->data;
        }

        return view('product.create', $data);
    }

    /** Save product */
    public function saveProduct(Request $request)
    {
        // dd($request->product_image, Session::get('bearer_token'), Session::get('userData')->user_id);

        

        // $i = 0;
        // foreach ($request->file('product_image') as $index => $file) {
        //     $single_file = curl_file_create($file);
        //     $array_data['product_image'][$i] = $single_file;
        //     $i++;
        // }

        // $files = [];

        // foreach($request->file('product_image') as $key => $photo) {
        //     // dd($photo->getClientMimeType());
        //     // $cfile = new \CURLFile($photo . $photo, 'image/jpeg', $key);
        //     $cfile = new \CURLFile($photo . $photo, $photo->getClientMimeType(), $key);
        //     $files[$key] = $cfile;
        // }

        // dd($files);

        $image = $request->file('product_image');
        $post_image = $request->file('product_image')->getClientOriginalName();
        
        $array_data = [
            'user_id' => Session::get('userData')->user_id,
            'product_pc_id' => $request->product_pc_id,
            'product_condition' => $request->product_condition,
            'product_description' => $request->product_description,
            'product_is_featured' => $request->product_is_featured,
            'product_upcoming' => $request->product_upcoming,
            'pp_type' => $request->pp_type,
            'pp_time' => $request->pp_time,
            'pp_price' => $request->pp_price,
            'pd_cost' => $request->pd_cost,
            'pd_internationally' =>  $request->pd_internationally,
            'pdd_pounds' =>  $request->pdd_pounds,
            'pdd_ounces' => $request->pdd_ounces,
            'pdd_lenght' =>  $request->pdd_lenght,
            'pdd_width' => $request->pdd_width,
            'pdd_height' => $request->pdd_height,
            'pds_type' => $request->pds_type,
            'pds_title' => $request->pds_title,
            'pds_price' => $request->pds_price,
            'pds_time' => $request->pds_time,
            'product_image[]' => new \CURLFile($image), $post_image, $image->getClientMimeType(),
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'create_product',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $array_data,
            CURLOPT_HTTPHEADER => array(
                'Authentication: ' . Session::get('bearer_token') . ''
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $productCreate = json_decode($response);

        if ($productCreate->status == 1) {
            return redirect('home')->with('success', $productCreate->message);
        } else {
            return redirect()->back()->with('error', $productCreate->message);
        }
    }
}
