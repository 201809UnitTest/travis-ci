<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/29
 * Time: 上午 09:39
 */

namespace Tests;

use App\Holiday;
use PHPUnit\Framework\TestCase;

class HolidayTest extends TestCase
{
    public function test_today_is_xmas()
    {
//        $holiday = new Holiday();
        $holiday = new HolidayForTest();
        $holiday->setToday('12-25');
        $response = $holiday->sayXmas();
        $this->assertEquals('Merry Xmas', $response);
    }
}

class HolidayForTest extends Holiday
{
    private $today;

    public function setToday($today)
    {
        $this->today = $today;
    }

    protected function getToday()
    {
        return $this->today;
    }
}













