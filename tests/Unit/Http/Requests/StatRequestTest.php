<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\StatRequest;
use Tests\TestCase;

class StatRequestTest extends TestCase
{
    public function test()
    {
        $request = new StatRequest();
        $rules   = $request->rules();

        $this->assertFalse(\Validator::make([], $rules)->passes());
        $this->assertTrue(\Validator::make([
            'from' => '2019-01-01',
            'to'   => '2019-02-01',
        ], $rules)->passes());
    }

}
