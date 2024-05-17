@extends('layouts.menu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="reserve_content">
    <div class="content_title">
        <h3>予約状況</h3>
    </div>
    <div class="content_box">
        @if($reservations->isNotEmpty())
        @foreach($reservations as $loopkey => $reservation)
        <div class="box_nav">
            <div class="box_nav-head">
                <div class="time_icon"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0,0,256,256">
                        <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                            <g transform="scale(4,4)">
                                <path d="M32,10c12.15,0 22,9.85 22,22c0,12.15 -9.85,22 -22,22c-12.15,0 -22,-9.85 -22,-22c0,-12.15 9.85,-22 22,-22zM34,32c0,-0.366 0,-13.634 0,-14c0,-1.105 -0.896,-2 -2,-2c-1.104,0 -2,0.895 -2,2c0,0.282 0,8.196 0,12c-2.66,0 -9.698,0 -10,0c-1.105,0 -2,0.896 -2,2c0,1.104 0.895,2 2,2c0.366,0 11.826,0 12,0c1.104,0 2,-0.895 2,-2z"></path>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="reserve_number">予約{{ $loopkey + 1 }}</div>
            </div>
            <div class="cancel_btn">
                <form action="{{ route('reservation.cancel', $reservation->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0,0,256,256">
                            <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                <g transform="scale(2,2)">
                                    <path d="M64,6c-15.5,0 -30.1,6 -41,17c-11,10.9 -17,25.5 -17,41c0,15.5 6,30.1 17,41c11,11 25.5,17 41,17c15.5,0 30.1,-6 41,-17c11,-11 17,-25.5 17,-41c0,-15.5 -6,-30.1 -17,-41c-10.9,-11 -25.5,-17 -41,-17zM64,12c13.9,0 26.90078,5.39922 36.80078,15.19922c9.9,9.8 15.19922,22.90078 15.19922,36.80078c0,13.9 -5.39922,26.90078 -15.19922,36.80078c-9.9,9.8 -22.90078,15.19922 -36.80078,15.19922c-13.9,0 -26.90078,-5.39922 -36.80078,-15.19922c-9.9,-9.8 -15.19922,-22.90078 -15.19922,-36.80078c0,-13.9 5.39922,-26.90078 15.19922,-36.80078c9.8,-9.9 22.90078,-15.19922 36.80078,-15.19922zM50.5625,47.5c-0.7625,0 -1.5125,0.30039 -2.0625,0.90039c-1.2,1.2 -1.2,3.09922 0,4.19922l11.30078,11.40039l-11.40039,11.30078c-1.2,1.2 -1.2,3.09922 0,4.19922c0.6,0.6 1.39961,0.90039 2.09961,0.90039c0.7,0 1.49961,-0.30039 2.09961,-0.90039l11.40039,-11.30078l11.30078,11.30078c0.6,0.6 1.39961,0.90039 2.09961,0.90039c0.7,0 1.49961,-0.30039 2.09961,-0.90039c1.2,-1.2 1.2,-3.09922 0,-4.19922l-11.30078,-11.30078l11.30078,-11.30078c1.2,-1.2 1.19961,-3.09883 0.09961,-4.29883c-1.2,-1.2 -3.09922,-1.2 -4.19922,0l-11.40039,11.40039l-11.30078,-11.40039c-0.6,-0.6 -1.37422,-0.90039 -2.13672,-0.90039z"></path>
                                </g>
                            </g>
                        </svg>
                    </button>
            </div>
        </div>
        <div class="reserve_table">
            <table>
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
        @endif
    </div>
</div>

<div class="favorite_shops">
    <div class="user_name">
        <h2>{{ auth()->id() }}さん</h2>
    </div>
    <div class="favorite_title">
        <h3>お気に入り店舗</h3>
    </div>
    <div class="shop">
        @if($favoriteShops->isNotEmpty())
        @foreach($favoriteShops as $shop)
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
                        <form action="{{ route('shop.detail') }}" method="GET">
                            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                            <button type="submit">詳しくみる</button>
                        </form>
                    </div>
                    <div class="favorite_btn">
                        <form action="{{ route('favorites.add') }}" method="post">
                            @csrf
                            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                            <button type="submit">
                                <img class="favorite_heart" src="https://img.icons8.com/fluency/48/hearts.png" alt="red_hearts" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection