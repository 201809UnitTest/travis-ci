<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/29
 * Time: 上午 10:57
 */

namespace App;

interface IProfile
{
    public function getPassword($account);
}