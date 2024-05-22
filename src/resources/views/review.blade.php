@extends('layouts.menu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review_form">
    <h2>この度は{{ $shop->shop_name }}にご予約ご来店いただきまして、誠にありがとうございます。</h2>
    <form action="{{ route('reviews.store') }}" method="post">
        @csrf
        <div class="review_form_main">
            <div class="content_title">
                <h3>Review</h3>
            </div>
            <div class="form_content">
                <div class="form_content-left">
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                    <div class="reservation_details">
                        <p>日付：{{ $reservation->date }}</p>
                        <p>時間：{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</p>
                        <p>予約人数：{{ $reservation->number }}人</p>
                    </div>
                </div>
                <div class="form_content-right">
                    <div class="rating">
                        <label for="rating">店舗の総合評価</label>
                        <select name="rating" id="rating">
                            @for($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="comment">
                        <label for="comment"></label>
                        <textarea name="comment" id="comment" rows="6" placeholder="この店舗での体験、感想を記入してください">{{ old('comment') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="submit_btn">
                <button type="submit">レビューを送信する</button>
            </div>
        </div>
    </form>
</div>
@endsection