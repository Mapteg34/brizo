<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\AuthorRequest;
use Tests\TestCase;

class AuthorRequestTest extends TestCase
{
    public function test()
    {
        $request = new AuthorRequest();
        $rules   = $request->rules();

        $this->assertFalse(\Validator::make([], $rules)->passes());
        $this->assertTrue(\Validator::make([
            'name' => 'test name',
        ], $rules)->passes());
    }

}
