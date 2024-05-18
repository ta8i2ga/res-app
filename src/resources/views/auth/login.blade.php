@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="main_header">
        <h2>Login</h2>
    </div>
    <div class="main_content">
        <form class="form" action="/login" method="post">
            @csrf

            <div class="email">
                <div class="email_content">
                    <img class="email_img" src="https://img.icons8.com/ios-glyphs/30/new-post.png" alt="new-post" />
                </div>
                <div class="email_text">
                    <input type="email" name="email" placeholder="{{ old('email') . 'Email' }}">
                </div>
            </div>

            <div class="password">
                <div class="password_content">
                    <img class="password_img" src="https://img.icons8.com/material-rounded/24/lock--v1.png" alt="lock--v1" />
                </div>
                <div class="password_text">
                    <input type="text" name="password" placeholder="Password">
                </div>
            </div>
            <div class="btn">
                <button type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@if ($errors->any())
<div class="error_messages">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection