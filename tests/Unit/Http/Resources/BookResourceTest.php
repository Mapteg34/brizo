<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Tests\TestCase;

class BookResourceTest extends TestCase
{
    public function testMain()
    {
        $request = app()->make('request');

        $this->assertEquals(null, (new BookResource(null))->toArray($request));

        $book = new Book();
        $this->assertEquals(null, (new BookResource($book))->toArray($request));

        $book->id = 123;
        $result   = (new BookResource($book))->toArray($request);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('name', $result);
    }
}
