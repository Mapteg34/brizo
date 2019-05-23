<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 */
class BookRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:4|unique:'.with(new Book)->getTable(),
        ];
    }
}
