@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="content">
    <p>ご予約ありがとうございます</p>
    <div class="content_btn">
        <a href="/">戻る</a>
    </div>
</div>
@endsection