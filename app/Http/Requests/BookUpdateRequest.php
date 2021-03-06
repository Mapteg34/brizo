<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 */
class BookUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:4',
        ];
    }
}
