<?php

namespace Tests\Unit\Models;

use App\Models\Transfer;
use Carbon\Carbon;
use Tests\TestCase;

class TransferTest extends TestCase
{
    public function testGetStat()
    {
        $result = Transfer::getStat('month', Carbon::createFromDate(0,0,0), Carbon::now());
        $this->assertIsIterable($result);

        $result = Transfer::getStat('year', Carbon::createFromDate(0,0,0), Carbon::now());
        $this->assertIsIterable($result);

        $result = Transfer::getStat('total', Carbon::createFromDate(0,0,0), Carbon::now());
        $this->assertIsIterable($result);
    }
}
