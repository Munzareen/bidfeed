@extends('layouts.master')
@section('title', 'Chat')
@section('content')

<section class="products-sec-1">
    <div class="container-fluid">
        <ul class="c-breadcrumb">
            <li><a href="#!">Home</a></li>
            <li><a href="#!">Chat</a></li>
        </ul>
    </div>
</section>

<section class="chat-sec-1">
    <div class="container">
        <div class="chat-box-wrap">
            <div class="chat-users-col">
                <div class="col-top">
                    <p class="title">Inbox</p>
                    <button class="toggle-users"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
                <div class="users-list">
                    <ul>
                        @if(!empty($chat_lists) && $chat_lists->status == 1)
                        @foreach($chat_lists->data as $chat_list)
                        <li>
                            <a href="javascript:void(0);" class="chat-user get-message" source="{{ base64_encode($chat_list->user_id) }}">
                                <div class="img">
                                    <img src="{{ asset('public/assets/images/user.png') }}" alt="img" class="img-fluid">
                                </div>
                                <div class="chat-user-info">
                                    <div class="chat-user-top">
                                        <p class="chat-user-name">{{ $chat_list->user_name }}</p>
                                        <p class="user-status">{{ $chat_list->last_chat }}</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                        @else
                        <li><p>{{ $chat_lists->message }}</p></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="chat-msgs-col">
                <div class="col-top">
                    <div class="chat-user">
                        <div class="chat-user-info">
                            <div class="chat-user-top">
                                <p class="chat-user-name">Conversation</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-box-body">
                    <div class="chat-msgs" id="chat-list-data">
                    </div>
                    <div class="chat-type">
                        <form class="user-msg">
                            <input type="hidden" id="source" value="0">
                            <textarea placeholder="Type Here" id="chat-message"></textarea>
                            <button type="button" id="send-message" class="send-msg"><img src="{{ asset('public/assets/images/paper-plane.png') }}" alt="icon" class="img-fluid"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script src="{{ asset('public/assets/js/custom/chat.js') }}"></script>
@endpush