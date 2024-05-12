@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="content">
    <p>会員登録ありがとうございます</p>
    <div class="content_btn">
        <a href="/login">ログインする</a>
    </div>
</div>
@endsection