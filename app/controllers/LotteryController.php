<?php
include_once app_path().'/controllers/Common.php';

class LotteryController extends BaseController {

    public function choujiang(){
        $user = Session::get('user');
        if(empty($user)) {
            Session::put('targetUrl', '/choujiang');
            return Redirect::to(WX_OAUTH_URL);
        }
        return View::make('choujiang');
    }
 
    public function lottery() {
        $user = Session::get('user');
        if(empty($user)) {
            Session::put('targetUrl', '/choujiang');
            return Redirect::to(WX_OAUTH_URL);
        }
        $todayBegin = date('Y-m-d 00:00:00');
        $todayEnd = date('Y-m-d 23:59:59');

        $lottery = null;
        try {
            $lottery = DB::table('lottery')
                ->where('user_id', $user['id'])
                ->whereBetween('created_at', array($todayBegin, $todayEnd))->first();
        } catch (Exception $e) {
        }

        //return $lottery;
        if(!empty($lottery)) {

            if($lottery->prize > 0){
                $usedstatus = '请在今天内点餐，下单结算时系统将会自动抵扣，';
                if($lottery->used > 0){
                    $usedstatus = '下单结算时系统将会自动抵扣，';
                }
                $result['err'] = '您已经抽中了'.$lottery->prize.'元代金券，'.$usedstatus.'明天再来抽奖吧！';
                return json_encode($result);
            }
            if($lottery->count == 3) {
                $result['err'] = '对不起，您今天的抽奖次数已经用完，请明天再来尝试！';
                return json_encode($result);
            } 
        }
        $prize_arr = array( 
            '0' => array('id'=>1,'min'=>array(0,56,128,200,272,344),'max'=>array(16,88,160,232,304,360),'prize'=>0,'v'=>70), 
            '1' => array('id'=>2,'min'=>array(92,236),'max'=>array(124,268),'prize'=>2,'v'=>30), 
            '2' => array('id'=>3,'min'=>array(20,166),'max'=>array(52,194),'prize'=>5,'v'=>0), 
            '3' => array('id'=>4,'min'=>308,'max'=>340,'prize'=>8,'v'=>0)
            //'6' => array('id'=>7,'min'=>array(1,46,136,181,226,271), 'max'=>array(44,134,179,224,269,359),'prize'=>'再接再厉','v'=>50) 
        ); 

        foreach ($prize_arr as $key => $val) { 
            $arr[$val['id']] = $val['v']; 
        } 
         
        $rid = getRand($arr); //根据概率获取奖项id 
         
        $res = $prize_arr[$rid-1]; //中奖项 
        $min = $res['min']; 
        $max = $res['max']; 
        if($res['id']==1){ //0yuan奖 
            $i = mt_rand(0,2); 
            $result['angle'] = mt_rand($min[$i],$max[$i]); 
        }
        else if($res['id']==2 || $res['id']==3){ //2、5yuan奖 
            $i = mt_rand(0,1); 
            $result['angle'] = mt_rand($min[$i],$max[$i]); 
        }else{ 
            $result['angle'] = mt_rand($min,$max); //随机生成一个角度 
        } 
        $result['prize'] = $res['prize']; 
        commonLog('user: '.$user['id'].';'.json_encode($result), '');
        try {
            if(empty($lottery)){
                Lottery::create(array('user_id' => $user['id'], 
                    'prize' => $res['prize'],
                    'count' => 1,
                    ));
        
            }else{
                DB::table('lottery')
                ->where('id', $lottery->id)
                ->update(array('prize' => $res['prize'], 'count' => $lottery->count + 1));
            }
        } catch (Exception $e) {
            commonLog(var_dump($e), '');            
        }
        
        return json_encode($result); 
    }
}

function getRand($proArr) { 
    $result = ''; 
 
    //概率数组的总概率精度 
    $proSum = array_sum($proArr); 
 
    //概率数组循环 
    foreach ($proArr as $key => $proCur) { 
        $randNum = mt_rand(1, $proSum); 
        if ($randNum <= $proCur) { 
            $result = $key; 
            break; 
        } else { 
            $proSum -= $proCur; 
        } 
    } 
    unset ($proArr); 
 
    return $result; 
} 