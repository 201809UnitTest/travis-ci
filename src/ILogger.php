<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/29
 * Time: 下午 12:09
 */

namespace App;

interface ILogger
{
    public function save(string $message);

    public function info(string $randomCode);
}