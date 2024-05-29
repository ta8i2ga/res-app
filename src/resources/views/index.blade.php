@extends('layouts.menu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="search">
    <div class="search_area">
        <form action="/area-search" method="get">
            @csrf
            <select name="area" id="area" onchange="this.form.submit()">
                <option value="">All area</option>
                @foreach($areas as $area)
                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="search_genre">
        <form action="/genre-search" method="get">
            @csrf
            <select name="genre" id="genre" onchange="this.form.submit()">
                <option value="">All genre</option>
                @foreach($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="search_shop">
        <form action="/shop-search" method="get">
            <label for="shop_name">
                <img src="https://img.icons8.com/material/24/000000/search--v3.png" alt="search--v3" />
                <input type="search" name="keyword" id="shop_name" placeholder="Search ...">
            </label>
        </form>
    </div>
</div>

<div class="article">
    @foreach($shops as $shop)
    <div class="section">
        <div class="img_section">
            <img class="shop_img" src="{{ $shop->img_url }}" alt="店舗画像">
        </div>
        <div class="shop_section">
            <div class="shop_section_header">
                <h2>{{ $shop->shop_name }}</h2>
            </div>
            <div class="tag">
                <div class="area_tag">
                    <p>
                        <strong>#</strong><span class="badge">{{ $shop->area->area_name }}</span>
                    </p>
                </div>
                <div class="genre_tag">
                    <p>
                        <strong>#</strong><span class="badge">{{ $shop->genre->genre_name }}</span>
                    </p>
                </div>
            </div>
            <div class="section_footer">
                <div class="footer_btn">
                    <form action="{{ 'detail' }}" method="GET">
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button type="submit">詳しくみる</button>
                    </form>
                </div>
                <div class="favorite_btn">
                    <form action="{{ route('favorites.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button type="submit">
                            @if(in_array($shop->id, $userFavorites))
                            <img class="favorite_heart" src="https://img.icons8.com/fluency/48/hearts.png" alt="red_hearts" />
                            @else
                            <img class="favorite_heart" src="https://img.icons8.com/plumpy/24/hearts.png" alt="grey_hearts" />
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


@endsection