<?php
namespace app\index\controller;
use think\Db;
class Index
{
    private $bvsUrl = 'http://bvs.haier.net/getOrderToRpm';
    public function index()
    {

        echo 111;die;
//        $arr = $this->getPhoneArr();
//        foreach ($arr as $v){
//              if(!empty($v)){
//                  $json = '{
//						"beginTime":"2018-06-02 00:00:00",
//						"endTime":"2018-06-03 23:59:59",
//						"userCode":"rmp",
//						"password":"bvs@rmp",
//						"custCode":"",
//						"custMobile":"'.$v.'"
//					}';
//                  echo $v.'<br/>';
//            $res = self::curlGets($this->bvsUrl,'post',$json);
//            $arr = json_decode($res,true);
//            if(!empty($arr['data'])){
//                echo "<p style='color: red'>$res</p>";
//            }else{
//                echo $res;
//            }
//              }
//        }

    }
    //拉页图有图的数据
//    public function getOrder(){
//        $data = Db::table('wy_bvs_lingshou_order')->field('goodsCode')->limit(100)->order('record_time desc')->select();
//        foreach ($data as $v){
//            $res = self::curlGets('http://hlht.product.haier.net/api/upper/product/drag?key=1000074&secret=fe84096aded43180d4c6c46fdf95ae43&code='.$v['goodsCode']);
//            $arr = json_decode($res,true);
//            if(!empty($arr['result'][0]['items'][0]['url'])){
//                dump($v);
//            }
//        }
//    }































//    public function getPhoneArr()
//    {
//        $str = "15776212421
//15996952425
//18041357445
//15168614952
//15954748919
//17796667702
//15622376797
//15535526559
//13939032926
//15384241955
//18850326403
//16603012381
//13573207083
//
//13327364190
//13718287737
//18639498719
//18302211992
//13678874940
//13515342378
//18211002175
//13976437556
//15066227217
//13017291380
//17804163585
//18678812363
//13810463179
//13708320159
//13982166076
//15266229688
//13061071637
//13313658818
//18997966815
//15699721367
//13705310322
//15510912785
//17763565444
//18563924569
//13691670414
//18615195590
//15714405421
//
//13956008621
//15846528658
//13013071073
//15706950376
//15023629716
//15623991255
//
//15853273366
//15324495918
//
//15380898181
//
//
//18538549892
//18070016767
//13936627958
//13799999999
//15122037705
//13799999999
//13799999999
//17677367856
//18086508690
//13712636344
//13759360156
//18608311616
//13958970833
//13817122121
//17504703030
//18613047955
//13556656817
//
//13178781177
//15779126142
//13807159912
//18993360900
//13373291262
//13488586950
//18119483917
//13717966925
//13832977066
//15838188834
//17860629571
//13306455961
//18131135777
//13127000086
//13643828595
//13127000086
//13061358779
//13478465706
//18091846008
//13888215886
//13868779280
//
//18384251197
//13483053618
//15071179778
//13124520803
//13631305143
//13535041949
//15763687776
//88888888
//18966919798
//17865120053
//13357381107
//13011687520";
//        $arr = explode("\n",$str);
//        return $arr;
//    }
    private static function curlGets($url, $method = 'get', $data = '')
    {
        $ch = curl_init();
        $header = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length:'.strlen($data))
        );
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $temp = curl_exec($ch);

        return $temp;
    }
}
