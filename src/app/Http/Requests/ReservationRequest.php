<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Carbon\Carbon;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => 'required',
            'number' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください。',
            'date.date' => '有効な日付を入力してください。',
            'date.after_or_equal' => '日付は今日または今日以降でなければいけません。',
            'time.required' => '時間を指定してください。',
            'number.required' => '人数を選択してください。',
            'number.integer' => '人数は数値で指定してください。',
            'number.min' => '人数は１人以上で指定してください。',
        ];
    }

    protected function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $date = $this->input('date');
            $time = $this->input('time');

            if ($date && $time) {
                $reservationDateTime = Carbon::createFromFormat('Y-m-d H:i', "$date $time");

                if ($reservationDateTime->isPast()) {
                    $validator->errors()->add('time', '予約時間は現在の時間より後でなければなりません。');
                }
            }
        });
    }
}
