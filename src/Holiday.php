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
        if ($today == '12-25') {
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
}