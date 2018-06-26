<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/26
 * Time: 13:27
 */

namespace app\index\controller;


class Test
{
    public function index(){
        $i = 3000;
        $j = 1+0.043/12;
        $y = 1000;
        $m = 12;
        $res = 0;
        for($a =1 ;$a<= $y ;$a++){
            for($b = 1; $b<=$m ;$b++){
                $o = $res*($j-1);
                $res *= $j;
                $res += $i;
                echo $a.'--',$b.'--'.$res.'--'.$o.'<br/>';
            }
        }
        echo $res;
    }
}