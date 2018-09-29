<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/29
 * Time: 上午 11:00
 */

namespace App;

interface IToken
{
    public function getRandom($account);
}