@extends('layouts.menu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_owner.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="left_content">
        <div class="form_content">
            <div class="form_content-header">
                <h2>Shop Register</h2>
            </div>
            <div class="form_content-main">
                <form action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-name">
                        <label for="shop_name">店舗名</label>
                        <input type="text" name="shop_name" class="form-control" id="shop_name" required>
                    </div>
                    <div class="form-description">
                        <label for="description">説明</label>
                        <textarea name="description" class="form-control" id="description" rows="3" cols="30" required></textarea>
                    </div>
                    <div class="form-tag">
                        <div class="form-area">
                            <label for="area">地域</label>
                            <select name="area_id" id="area">
                                <option value="">All area</option>
                                @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-genre">
                            <label for="genre">ジャンル</label>
                            <select name="genre_id" id="genre">
                                <option value="">All Genre</option>
                                @foreach($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-img">
                        <label for="image">画像</label>
                        <input type="file" name="image" class="form-control" id="image" required>
                    </div>
                    <div class="form-btn">
                        <button type="submit" class="btn btn-primary">登録する</button>
                    </div>
                </form>
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
            <div class="alert-success">
                {{ session('success') }}
            </div>
            @endif
        </div>
    </div>
    <div class="right_content">
        <div class="right_content-header">
            <h2>登録店舗及び予約一覧</h2>
        </div>
        <div class="reserve">
            @foreach ($shops as $shop)
            <div class="reserve_content">
                <div class="reserve_content-header">
                    <h2>{{ $shop->shop_name }}</h2>
                    <div class="exit_btn">
                        <button type="submit"><a href="{{ route('shops.edit', $shop->id) }}">編集</a></button>
                    </div>
                </div>
                <div class="reserve_text">
                    @if($shop->reservations->isNotEmpty())
                    <p>ご予約</p>
                    @else
                    <p>予約はありません</p>
                    @endif
                </div>
                @foreach ($shop->reservations as $reservation)
                @php
                $reservationDateTime = \Carbon\Carbon::parse($reservation->date . ' ' . $reservation->time);
                @endphp
                @if ($reservationDateTime->isFuture())
                <div class="reserve_nav">
                    <table>
                        <tr>
                            <th>Date</th>
                            <td>
                                <p>{{ $reservation->date }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <td>
                                <p>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>
                                <p>{{ $reservation->user->name }}様</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Number</th>
                            <td>
                                <p>{{ $reservation->number }}名様</p>
                            </td>
                        </tr>
                    </table>
                </div>
                @endif
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection