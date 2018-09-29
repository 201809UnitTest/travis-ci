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
    private $holiday;

    protected function setUp()
    {
        $this->holiday = new HolidayForTest();
    }

    public function test_today_is_xmas()
    {
        $this->givenToday('12', '25');
        $this->shouldResponse('Merry Xmas');
    }

    public function test_12_24_is_xmas_too()
    {
        $this->givenToday('12', '24');
        $this->shouldResponse('Merry Xmas');
    }

    private function givenToday($month, $day): void
    {
        $this->holiday->setToday($month . '-' . $day);
    }

    private function shouldResponse($expected): void
    {
        $this->assertEquals($expected, $this->holiday->sayXmas());
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













