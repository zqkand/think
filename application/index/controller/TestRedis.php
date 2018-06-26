<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/26
 * Time: 15:25
 */

namespace app\index\controller;

use think\cache\driver\Redis;

class TestRedis
{
    public function index(){
        $redis = new Redis();
        $handler = $redis->handler();
        $handler->sAdd('key','rt');
        $handler->sAdd('key','rt1');
        $handler->sAdd('key','hjhu');
        $handler->sRem('key','rt');
        $k = $handler->sMembers('key');
        dump($k);
    }
}