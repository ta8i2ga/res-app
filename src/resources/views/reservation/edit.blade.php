@extends('layouts.menu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="edit_header">
        <h2>Edit</h2>
    </div>
    <div class="edit_content">
        <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="shop_id" value="{{ $reservation->shop->id }}">
            <div class="reserve_date">
                <input type="date" name="date" id="selectedDate" value="{{ $reservation->date }}">
            </div>
            <div class="reserve_time">
                <select name="time" id="time">
                    <?php
                    $start = 17;
                    $end = 22;
                    for ($hour = $start; $hour < $end; $hour++) {
                        for ($minutes = 0; $minutes < 60; $minutes += 30) {
                            $time = sprintf("%02d:%02d", $hour, $minutes);
                            echo "<option value='$time'" . ($time == \Carbon\Carbon::parse($reservation->time)->format('H:i') ? " selected" : "") . ">$time</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="reserve_number">
                <select name="number" id="number">
                    <?php
                    $start = 1;
                    $end = 10;
                    for ($i = $start; $i <= $end; $i++) {
                        echo "<option value='$i'" . ($i == $reservation->number ? " selected" : "") . ">{$i}人</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="reserve_btn">
                <button type="submit">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection