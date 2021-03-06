<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Requests\StatRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Transfer;
use App\Services\StatProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        $search = '';
        if ($request->has('search')) {
            $search = (string)$request->get('search');
        }

        return BookResource::collection(
            Book::search($search)
                ->orderBy('id', 'asc')
                ->paginate()
        );
    }

    public function store(BookRequest $request)
    {
        $book = Book::create($request->all());

        return BookResource::make($book);
    }

    public function show(Book $book)
    {
        return BookResource::make($book);
    }

    /**
     * @param Book $book
     * @param BookUpdateRequest $request
     *
     * @return BookResource
     * @throws \Throwable
     */
    public function update(Book $book, BookUpdateRequest $request)
    {
        $book->fill($request->all())->saveOrFail();

        return BookResource::make($book);
    }

    /**
     * @param Book $book
     *
     * @return BookResource
     * @throws \Exception
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return BookResource::make($book);
    }

    public function stat(StatRequest $request, StatProvider $statProvider)
    {
        return $statProvider->getTransfersStat(Carbon::parse($request->from), Carbon::parse($request->to));
    }
}
