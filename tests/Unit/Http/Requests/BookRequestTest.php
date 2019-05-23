<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\BookRequest;
use Tests\TestCase;

class BookRequestTest extends TestCase
{
    public function test()
    {
        $request = new BookRequest();
        $rules   = $request->rules();

        $this->assertFalse(\Validator::make([], $rules)->passes());
        $this->assertTrue(\Validator::make([
            'name' => 'test name',
        ], $rules)->passes());
    }

}
