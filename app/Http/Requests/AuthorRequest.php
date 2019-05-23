<?php

namespace App\Http\Requests;

use App\Models\Author;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 */
class AuthorRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:4|unique:'.with(new Author)->getTable(),
        ];
    }
}
