<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;

class ChatController extends Controller
{
    /** Chat lists */
    public function chatList()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'chat_list?user_id=' . Session::get('userData')->user_id,
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

        $chat_list = curl_exec($curl);

        curl_close($curl);

        $goto = new HomeController();
        $productCategory = $goto->productCategory();

        $res = json_decode($productCategory);
        $data = array();

        if ($res->status == 1) {
            $data['productCategories'] = $res->data;
        }

        $data['chat_lists'] = json_decode($chat_list);

        return view('chat.chat-list', $data);
    }

    /** Get messsage */
    public function getMessage(Request $request)
    {
        $reciever_id = base64_decode($request->source);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'get_message?user_id=' . Session::get('userData')->user_id . '&reciever_id=' . $reciever_id . '&offset=0',
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
        
        $res_data = json_decode($response);
        $res['source'] = $reciever_id;
        $res['res_data'] = $res_data;
        return json_encode($res);
    }

    /** Send message */
    public function sendMessage(Request $request)
    {
        $reciever_id = base64_decode($request->source);
        $message = $request->message;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiBaseUrl . 'send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'user_id' =>  Session::get('userData')->user_id,
                'reciever_id' => $reciever_id,
                'message' => $message
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
