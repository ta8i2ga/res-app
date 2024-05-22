@extends('layouts.menu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="main_left">
    <div class="content_header">
        <div class="back_btn">
            <a href="/">
                <strong>
                    < </strong></a>
        </div>
        <div class="shop_name">
            <h2>{{ $shop->shop_name }}</h2>
        </div>
    </div>

    <div class="shop_img">
        <img src="{{ $shop->img_url }}" alt="店舗写真">
    </div>
    <div class="tag">
        <div class="tag_area">
            <p><strong>#</strong>{{ $area->area_name }}</p>
        </div>
        <div class="tag_genre">
            <p><strong>#</strong>{{ $genre->genre_name }}</p>
        </div>
    </div>
    <div class="description">
        <p>{{ $shop->description }}</p>
    </div>
</div>
<div class="main_right">
    <div class="right_content">
        <div class="title">
            <h2>予約</h2>
        </div>
        <form action="/detail" method="post">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <div class="reserve_date">
                <input type="date" name="date" id="selectedDate" value="{{ old('date') }}">
            </div>
            <div class="reserve_time">
                <select name="time" id="time">
                    <?php
                    $start = 17;
                    $end = 22;
                    for ($hour = $start; $hour < $end; $hour++) {
                        for ($minutes = 0; $minutes < 60; $minutes += 30) {
                            $time = sprintf("%02d:%02d", $hour, $minutes);
                            echo "<option value='$time'>$time</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class=" reserve_number">
                <select name="number" id="number">
                    <?php
                    $start = 1;
                    $end = 10;
                    for ($i = $start; $i <= $end; $i++) {
                        echo "<option value='$i'>{$i}人</option>";
                    }
                    ?>
                </select>
            </div>
            @if($reservations->isNotEmpty())
            <div class="confirmation">
                @foreach($reservations as $reservation)
                <table class="confirm_table">
                    <tr class="confirm_shop">
                        <th>Shop</th>
                        <td>{{ $reservation->shop->shop_name }}</td>
                    </tr>
                    <tr class="confirm_date">
                        <th>Date</th>
                        <td>{{ $reservation->date }}</td>
                    </tr>
                    <tr class="confirm_time">
                        <th>Time</th>
                        <td>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td>
                    </tr>
                    <tr class="confirm_number">
                        <th>Number</th>
                        <td>{{ $reservation->number }}人</td>
                    </tr>
                </table>
                @endforeach
            </div>
    </div>
    @endif
    <div class="reserve_btn">
        <button type="submit">予約する</button>
    </div>
    </form>
    @endsection