<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Book;

class BookResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $book = $this->resource;

        if (empty($book) || !($book instanceof Book) || empty($book->id)) {
            return null;
        }

        return [
            'id'   => $book->id,
            'name' => $book->name,
        ];
    }
}
