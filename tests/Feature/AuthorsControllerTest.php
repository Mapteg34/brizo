<?php

namespace Tests\Feature;

use App\Models\Author;
use Tests\TestCase;

class AuthorsControllerTest extends TestCase
{
    private $endpoint = '/api/authors';

    public function json($method, $uri, array $data = [], array $headers = [])
    {
        return parent::json($method, $this->endpoint.$uri, $data, $headers);
    }

    public function testMain()
    {
        $authorData = [
            'name' => 'test author name',
        ];

        // create
        $response = $this->json('POST', '', $authorData);
        $this->assertContains($response->status(), [200, 201]);
        $this->assertInstanceOf(Author::class, $response->original);
        $author = $response->original;
        $this->assertEquals('test author name', $response->original->name);

        // try recreate
        $this->json('POST', '', $authorData)->assertStatus(422);

        $this->checkIndexMethod();
        $this->checkEditMethod($author);
        $this->checkShowMethod($author);

        $response = $this->json('DELETE', '/'.$author->id);
        $this->assertContains($response->status(), [200, 201]);
        $this->assertInstanceOf(Author::class, $response->original);
    }

    private function checkIndexMethod()
    {
        $response = $this->json('GET', '');
        $this->assertContains($response->status(), [200, 201]);
        $this->assertGreaterThan(0, $response->json('meta')['total']);
    }

    private function checkEditMethod(Author $author)
    {
        // edit
        $response = $this->json('PATCH', '/'.$author->id, [
            'name' => 'test author edited',
        ]);
        $this->assertContains($response->status(), [200, 201]);
        $this->assertInstanceOf(Author::class, $response->original);
        $this->assertEquals('test author edited', $response->original->name);
    }

    private function checkShowMethod(Author $author)
    {
        // try show
        $response = $this->json('GET', '/'.$author->id);
        $this->assertContains($response->status(), [200, 201]);
        $this->assertInstanceOf(Author::class, $response->original);
    }
}
