<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function createPost()
    {
        $colors = [
            '#6563FF', '#6BBB6E', '#FE84AA', '#FFD749', '#FFB8CE',
            '#A8FFF0', '#A02D9C', '#BFD5FF', '#ff4dd6', '#0a58ca',
            '#ffc107', '#198754', '#954dff', '#4dd6ff', '#0dcaf0',
            '#dc3545' //, '#365c67'
        ];
        return view('post.create', compact('colors'));
    }

    /** Save post */
    public function savePost(Request $request)
    {
        if ($request->hasFile('post_post_image')) {
            $image = $request->file('post_post_image');
            $post_image = $request->file('post_post_image')->getClientOriginalName();
            $array_data = [
                'user_id' => Session::get('userData')->user_id, 
                'post_is_featured' => '1', 
                'post_upcoming' => '1', 
                'post_image' => new \CURLFile($image), $post_image, 'test_name',
                'post_text' =>  $request->post_text, 
                'post_color' => $request->post_color_cc, 
                'post_type' => $request->post_type, 
            ];
        }
        else{
            $array_data = [
                'user_id' => Session::get('userData')->user_id, 
                'post_is_featured' => '1', 
                'post_upcoming' => '1', 
                'post_text' =>  $request->post_text, 
                'post_color' => $request->post_color_cc, 
                'post_type' => $request->post_type, 
            ];
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'create_post',
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

        $postCreate = json_decode($response);

        if($postCreate->status == 1){
            return redirect('home')->with('success', $postCreate->message);
        }
        else{ 
            return redirect()->back()->with('error', $postCreate->message);
        }
    }
}

