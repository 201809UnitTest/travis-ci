<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/29
 * Time: 上午 09:23
 */

namespace App;

class Holiday
{
    public function sayXmas()
    {
        $today = $this->getToday();
        if ($this->isXmas($today)) {
            return 'Merry Xmas';
        }

        return 'Today is not Xmas';
    }

    /**
     * @return false|string
     */
    protected function getToday()
    {
        return date('m-d');
    }

    /**
     * @param $today
     * @return bool
     */
    private function isXmas($today): bool
    {
        return $today == '12-25' || $today == '12-24';
    }
}