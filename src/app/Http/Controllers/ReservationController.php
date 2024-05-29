<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Review;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
    {
        $userId = auth()->id();
        $shopId = $request->input('shop_id');

        try {
            $reservation = new Reservation();
            $reservation->user_id = $userId;
            $reservation->shop_id = $shopId;
            $reservation->date = $request->input('date');
            $reservation->time = $request->input('time');
            $reservation->number = $request->input('number');
            $reservation->save();
            return view('done');
        } catch (\Exception $e) {
            return back();
        }
    }

    //追加実装予約編集

    public function cancelReservation($id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->delete();

        return redirect('mypage');
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservation.edit', compact('reservation'));
    }

    public function update(ReservationRequest $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->number = $request->input('number');
        $reservation->save();

        return redirect()->route('mypage');
    }

    //追加実装評価コメント機能

    public function reviewCreate(Request $request)
    {
        $reservation = Reservation::find($request->reservation);

        $shop = $reservation->shop;

        return view('review', compact('shop', 'reservation'));
    }

    public function reviewsStore(StoreReviewRequest $request)
    {
        Review::create([
            'shop_id' => $request->shop_id,
            'user_id' => Auth::id(),
            'reservation_id' => $request->reservation_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return redirect()->route('mypage');
    }
}
