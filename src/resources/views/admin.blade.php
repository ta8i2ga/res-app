@extends('layouts.menu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="main_header">
        <h2>店舗代表者作成</h2>
    </div>
    <div class="main_content">
        <form action="{{ route('admin.createOwner') }}" method="post">
            @csrf
            <div class="username">
                <div class="username_content">
                    <img class="username_img" src="https://img.icons8.com/ios-glyphs/30/user-male--v1.png" alt="user-male--v1" />
                </div>
                <div class="username_text">
                    <input type="text" name="name" placeholder="{{ old('name') ? old('name') : 'Username' }}">
                </div>
            </div>
            <div class="email">
                <div class="email_content">
                    <img class="email_img" src="https://img.icons8.com/ios-glyphs/30/new-post.png" alt="new-post" />
                </div>
                <div class="email_text">
                    <input type="email" name="email" placeholder="{{ old('email') ? old('email') : 'Email'}}">
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
            <div class="role_id">
                <input type="hidden" name="role_id" value="2">
            </div>
            <div class="btn">
                <button type="submit">登録</button>
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

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@endsection