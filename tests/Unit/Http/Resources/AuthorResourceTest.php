<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Tests\TestCase;

class AuthorResourceTest extends TestCase
{
    public function testMain()
    {
        $request = app()->make('request');

        $this->assertEquals(null, (new AuthorResource(null))->toArray($request));

        $author = new Author();
        $this->assertEquals(null, (new AuthorResource($author))->toArray($request));

        $author->id = 123;
        $result     = (new AuthorResource($author))->toArray($request);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('name', $result);
    }
}
