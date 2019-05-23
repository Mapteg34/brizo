<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\AuthorUpdateRequest;
use Tests\TestCase;

class AuthorUpdateRequestTest extends TestCase
{
    public function test()
    {
        $request = new AuthorUpdateRequest();
        $rules   = $request->rules();

        $this->assertFalse(\Validator::make([], $rules)->passes());
        $this->assertTrue(\Validator::make([
            'name' => 'test name',
        ], $rules)->passes());
    }

}
