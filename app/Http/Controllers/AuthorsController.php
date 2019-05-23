<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;

class AuthorsController extends Controller
{
    public function index()
    {
        return AuthorResource::collection(
            Author::orderBy('id', 'asc')
                  ->paginate()
        );
    }

    public function store(AuthorRequest $request)
    {
        $author = Author::create($request->all());

        return AuthorResource::make($author);
    }

    public function show(Author $author)
    {
        return AuthorResource::make($author);
    }

    /**
     * @param Author $author
     * @param AuthorUpdateRequest $request
     *
     * @return AuthorResource
     * @throws \Throwable
     */
    public function update(Author $author, AuthorUpdateRequest $request)
    {
        $author->fill($request->all())->saveOrFail();

        return AuthorResource::make($author);
    }

    /**
     * @param Author $author
     *
     * @return AuthorResource
     * @throws \Exception
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return AuthorResource::make($author);
    }
}
