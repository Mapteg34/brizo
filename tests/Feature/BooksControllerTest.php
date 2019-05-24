<?php

namespace Tests\Feature;

use App\Models\Book;
use Tests\TestCase;

class BooksControllerTest extends TestCase
{
    private $endpoint = '/api/books';

    public function json($method, $uri, array $data = [], array $headers = [])
    {
        return parent::json($method, $this->endpoint.$uri, $data, $headers);
    }

    public function testMain()
    {
        $bookData = [
            'name' => 'test book name',
        ];

        // create
        $response = $this->json('POST', '', $bookData);
        $this->assertContains($response->status(), [200, 201]);
        $this->assertInstanceOf(Book::class, $response->original);
        $book = $response->original;
        $this->assertEquals('test book name', $response->original->name);

        // try recreate
        $this->json('POST', '', $bookData)->assertStatus(422);

        $this->checkIndexMethod();
        $this->checkEditMethod($book);
        $this->checkShowMethod($book);

        $response = $this->json('DELETE', '/'.$book->id);
        $this->assertContains($response->status(), [200, 201]);
        $this->assertInstanceOf(Book::class, $response->original);
    }

    private function checkIndexMethod()
    {
        $response = $this->json('GET', '');
        $this->assertContains($response->status(), [200, 201]);
        $this->assertGreaterThan(0, $response->json('meta')['total']);

        $response = $this->json('GET', '', ['search'=>'test']);
        $this->assertContains($response->status(), [200, 201]);
        $this->assertGreaterThan(0, $response->json('meta')['total']);
    }

    private function checkEditMethod(Book $book)
    {
        // edit
        $response = $this->json('PATCH', '/'.$book->id, [
            'name' => 'test book edited',
        ]);
        $this->assertContains($response->status(), [200, 201]);
        $this->assertInstanceOf(Book::class, $response->original);
        $this->assertEquals('test book edited', $response->original->name);
    }

    private function checkShowMethod(Book $book)
    {
        // try show
        $response = $this->json('GET', '/'.$book->id);
        $this->assertContains($response->status(), [200, 201]);
        $this->assertInstanceOf(Book::class, $response->original);
    }

    public function testStat()
    {
        $response = $this->json('GET', '/stat', [
            'from'=>'2019-01-01',
            'to'=>'2019-02-01',
        ]);
        $this->assertContains($response->status(), [200, 201]);
    }
}
