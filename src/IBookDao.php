<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/29
 * Time: 下午 03:16
 */

namespace App;

interface IBookDao
{
    public function insert(Order $order);
}