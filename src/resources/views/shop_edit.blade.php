@extends('layouts.menu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_edit.css') }}">
@endsection

@section('content')
<div class="shop_edit">
    <div class="edit_form">
        <div class="form_header">
            <div class="cancel_btn">
                <a href="/">
                    < </a>
            </div>
            <h2>Shop Edit</h2>
        </div>
        <div class="form_content">
            <form action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="shop_name">店舗名</label>
                    <input type="text" name="shop_name" class="form-control" id="shop_name" value="{{ $shop->shop_name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">説明</label>
                    <textarea name="description" class="form-control" id="description" rows="5" required>{{ $shop->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="area_id">エリア</label>
                    <select name="area_id" id="area">
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ $shop->area_id == $area->id ? 'selected' : '' }}>{{ $area->area_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="genre_id">ジャンル</label>
                    <select name="genre_id" id="genre">
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $shop->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->genre_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">画像</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <div class="form_btn">
                    <button type="submit" class="btn btn-primary">更新する</button>
                </div>
            </form>
            @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection