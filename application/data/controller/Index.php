<?php

namespace app\data\controller;
use \think\Db;
class Index
{
    /**构造方法
     * Index constructor.
     */
    public function __construct()
    {
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
    }

    public function index()
    {
        phpinfo();
    }
    /**
     * 平乐数据迁移
        1	M_PL_BVS_ORDER	订单表
        2	M_PL_CHAT	沟通表
        3	M_PL_CUSTOMER	客户表
        4	M_PL_CUSTOMER_STORE	客户门店表            -----------没有
        5	M_PL_EMPLOYEE	员工表
        6	M_PL_POTENTIAL_NEED	需求表
        7	M_PL_POTENTIAL_USER	高潜用户表
        8	M_PL_USER	老板表
     */
    /**
     * bvs 订单数据表
     */
    public function bvsOrder(){

    }

    /**
     * 平乐沟通表
     */
    public function plChat(){

    }

    public function plCustomer(){

    }
    /** 7 平乐高潜用户表数据迁移
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function plUser(){
        $i=0;
        do{
            $data = Db::table('wy_zclerk_custom')->limit($i,1000)->select();
            $i += 1000;
            $this->addPlUser($data);
        }while($data);

    }

    /**
     * @param $data  //高潜用户数据处理
     */
    private function addPlUser($data){
        $list = [];
        $i =0;
        foreach ($data as $v){
            $list[$i]['ID'] = $v['id'];
            $list[$i]['EMPLOYEE_ID'] = $v['cid'];
            $list[$i]['CUSTOMER_CODE'] = $v['username'];
            $list[$i]['STORE_CODE'] = '';
            $list[$i]['NAME'] = $v['cname'];
            $list[$i]['MOBILE'] = $v['cmobile'];
            $ccity = explode(' ',$v['ccity']);
            $list[$i]['PROVINCE'] = isset($ccity[0]) ? $ccity[0] : '';
            $list[$i]['CITY'] = isset($ccity[1]) ? $ccity[1] : '';
            $list[$i]['REGION'] = isset($ccity[2]) ? $ccity[2] : '';
            $list[$i]['COMMUNITY'] = $v['address'];
            $list[$i]['COMMENTS'] = $v['cinfo'];
            $xqdc = '';
            switch ($v['xqdc']){
                case '经济小区':
                    $xqdc = 'EC';
                    break;
                case '高档小区':
                    $xqdc = 'HC';
                    break;
                case '别墅区':
                    $xqdc = 'VC';
                    break;
            }
            $list[$i]['COMMUNITY_GRADE_VALUE'] = $xqdc; //'小区档次编码（EC.经济小区，HC.高档小区，VC别墅区）';
            $list[$i]['COMMUNITY_GRADE_NAME'] = $v['xqdc']; //'小区档次名称';
            $zzhx = '';
            $zzhx_name = '';
            switch ($v['zzhx']){
                case '1室1厅':
                    $zzhx = '1-1';
                    $zzhx_name = '一室一厅';
                    break;
                case '2室1厅':
                    $zzhx = '2-1';
                    $zzhx_name = '二室一厅';
                    break;
                case '3室1厅':
                    $zzhx = '3-1';
                    $zzhx_name = '三室一厅';
                    break;
                case '3室2厅':
                    $zzhx = '3-2';
                    $zzhx_name = '三室二厅';
                    break;
                case '4室1厅':
                    $zzhx = '4-1';
                    $zzhx_name = '四室一厅';
                    break;
                default:
                    $zzhx = '0-0';
                    $zzhx_name = '其他';
                    break;
            }
            $list[$i]['HOUSE_TYPE_VALUE'] = $zzhx; // '住宅户型编码（1-1.一室一厅，2-1.两室一厅，3-1.三室一厅，3-2.三室两厅，4-1.四室一厅，0-0.其他）';
            $list[$i]['HOUSE_TYPE_NAME'] = $zzhx_name; //'住宅户型名称';
            $fwmj = '';
            switch ($v['fwmj']){
                case '60平方以下':
                    $fwmj = 'A';
                    break;
                case '60-70平方':
                    $fwmj = 'B';
                    break;
                case '70-80平方':
                    $fwmj = 'B';
                    break;
                case '80-100平方':
                    $fwmj = 'D';
                    break;
                case '100-200平方':
                    $fwmj = 'E';
                    break;
                case '200平方以上':
                    $fwmj = 'F';
                    break;
            }
            $list[$i]['HOUSE_AREA_VALUE'] = $fwmj; //'房屋面积编码（A.60平方以下,B.60-70平方,C.70-80平方，D.80-100平方，E.100-200平方，F.200平方以上）';
            $list[$i]['HOUSE_AREA_NAME'] = $v['fwmj']; //'房屋面积名称'
            $jtrs = '';
            switch ($v['jtrs']){
                case '1人':
                    $jtrs = 1;
                    break;
                case '2人':
                    $jtrs = 2;
                    break;
                case '3人':
                    $jtrs = 3;
                    break;
                case '4人':
                    $jtrs = 4;
                    break;
                case '5人':
                    $jtrs = 5;
                    break;
                case '6人':
                    $jtrs= 6;
                    break;
                case '7人及以上':
                    $jtrs = '7+';
                    break;
            }
            $list[$i]['FAMILY_MEMBER_VALUE'] = $jtrs; // '家庭人口数量编码（1：1人，2：2人，3：3人，4：4人，5:5人,6:6人，7+：7人及以上）';
            $list[$i]['FAMILY_MEMBER_NAME'] = $v['jtrs']; // '家庭人口数量名称';
            $actual_value = '';
            $actual_name = '';
            if(strpos ( $v['ext'] , '良好' )){
                $actual_value = 'GD';
                $actual_name = '良好';
            }elseif (strpos ( $v['ext'] , '优越' )){
                $actual_value = 'SR';
                $actual_name = '优越';
            }elseif (strpos ( $v['ext'] , '极好' )){
                $actual_value = 'ET';
                $actual_name = '极好';
            }
            $list[$i]['FAMILY_ACTUAL_VALUE'] = $actual_value; // '家庭状况编码（GD.良好，SR.优越，ET.极好）';
            $list[$i]['FAMILY_ACTUAL_NAME'] = $actual_name; // '家庭状况名称';
            $buy_des_val = '';
            $buy_des_name = '';
            if(strpos ( $v['ext'] , '有' )){
                $buy_des_val = 'Y';
                $buy_des_name = '有';
            }elseif (strpos ( $v['ext'] , '无' )){
                $buy_des_val = 'N';
                $buy_des_name = '无';
            }elseif (strpos ( $v['ext'] , '强烈' )){
                $buy_des_val = 'S';
                $buy_des_name = '强烈';
            }
            $list[$i]['BUY_DESIRE_VALUE'] = $buy_des_val; // '购买欲望编码（Y.有，N.无，S.强烈）';
            $list[$i]['BUY_DESIRE_NAME'] = $buy_des_name; // '购买欲望名称';
            $master_value = '';
            $master_name = '';
            if(strpos ( $v['ext'] , '女主人' )){
                $master_name = '女主人';
                $master_value = 'WN';
            }elseif (strpos ( $v['ext'] , '男主人' )){
                $master_name = '男主人';
                $master_value = 'MN';
            }

            $list[$i]['MASTER_VALUE'] = $master_value; // '主权人编码（MN.男主人，WN.女主人）';
            $list[$i]['MASTER_NAME'] = $master_name; // '主权人名称';
            $ha_amount = '';
            if(strpos ( $v['ext'] , '1台' )){
                $ha_amount = 1;
            }elseif (strpos ( $v['ext'] , '2台' )){
                $ha_amount = 2;
            }elseif (strpos ( $v['ext'] , '3台' )){
                $ha_amount = 3;
            }
            $list[$i]['HA_AMOUNT'] = $ha_amount; // '家电数量(Home Applicance)';
            $list[$i]['EXT'] = "$xqdc,$zzhx,$fwmj,$jtrs,$actual_value,$buy_des_val,$master_value"; // '家庭情况（全部家庭信息）';
            $list[$i]['CONTENT']  = empty($v['goutong']) ? '': $v['goutong'];//'沟通内容';
            $list[$i]['DATA_TYPE'] = 1; // '数据来源（1.平乐，2.计算）';
//            $flag = Db::table('wy_bvs_lingshou_order')->where('consigneeMobile='.$v['cmobile'])->find();
            $list[$i]['ESTORE_FLAG'] = 0; // '是否有estore订单（1.有，0.无）';
            $list[$i]['IS_MANUAL'] = 1; // '是否为手动导入（1.是，0.否）';
            $list[$i]['CREATOR'] = $v['cid']; // '创建人';
            $list[$i]['CREATE_TIME'] = date('Y-m-d H:i:s',$v['ctime']); // '创建时间';
            $list[$i]['UPDATOR'] = ''; // '修改人';
            $list[$i]['UPDATE_TIME'] = ''; // '修改时间';
            $res = Db::table('M_PL_POTENTIAL_USER')->insert($list[$i]);
            $i++;
        }
    }
}
