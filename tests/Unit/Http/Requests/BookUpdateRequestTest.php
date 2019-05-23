<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\BookUpdateRequest;
use Tests\TestCase;

class BookUpdateRequestTest extends TestCase
{
    public function test()
    {
        $request = new BookUpdateRequest();
        $rules   = $request->rules();

        $this->assertFalse(\Validator::make([], $rules)->passes());
        $this->assertTrue(\Validator::make([
            'name' => 'test name',
        ], $rules)->passes());
    }

}
