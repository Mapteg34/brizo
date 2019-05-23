<?php

namespace App\Http\Resources;

use App\Models\Author;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $author = $this->resource;

        if (empty($author) || !($author instanceof Author) || empty($author->id)) {
            return null;
        }

        return [
            'id'   => $author->id,
            'name' => $author->name,
        ];
    }
}
