<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property Carbon $from
 * @property Carbon $to
 */
class StatRequest extends FormRequest
{
    public function rules()
    {
        return [
            'from' => 'required|date|before:to',
            'to'   => 'required|date|after:from',
        ];
    }
}
