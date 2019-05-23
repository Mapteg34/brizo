<?php

namespace Tests\Unit\Models;

use App\Models\Book;
use Tests\TestCase;

class BookTest extends TestCase
{
    public function testSearch()
    {
        $result = Book::search('test');
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Builder::class, $result);
    }
}
