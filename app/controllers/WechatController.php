<?php
include_once app_path().'/controllers/Common.php';

define("TOKEN", "mellbar1234");
define("AMAP_URL", "http://mo.amap.com/?from=%s&to=39.990553,116.478206&type=0&opt=1&dev=1");

class WechatController extends BaseController {

	public function valid()
    {
        $echoStr = Input::get('echostr');
        if(empty($echoStr)) {
        	return "error";
        }
        //valid signature , option
        if($this->checkSignature()){
        	return $echoStr;
        }else{
        	return "error";
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		// commonLog($postStr, '');
      	//extract post data
		if (!empty($postStr)){
            
          	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $msgType = $postObj->MsgType;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";             
			//if(!empty( $keyword ))
            // {
      		
        	switch ($msgType) {
        		case 'location':
        			$location_x = $postObj->Location_X;
        			$location_y = $postObj->Location_Y;
        			$contentStr = sprintf(AMAP_URL, $location_x.','.$location_y);
        			$msgType = "news";
        			$textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<ArticleCount>1</ArticleCount>
					<Articles>
					<item>
					<Title><![CDATA[导航]]></Title>
					<Description><![CDATA[点击后导航到魅尔吧]]></Description>
					<PicUrl><![CDATA[]]></PicUrl>
					<Url><![CDATA[%s]]></Url>
					</item>
					</Articles>
					<FuncFlag>0</FuncFlag>
					</xml>";
        			break;
        		case 'text':
        			$msgType = "transfer_customer_service";
        			$contentStr = "欢迎光临魅尔吧";
        			break;
        		case 'event':
        			$msgType = "text";
                    $event = $postObj->Event;
                    if($event == 'subscribe'){
                        $contentStr = "欢迎加入我们魅族，请你每次点餐前先到<我要优惠>抽取代金券，幸运的你将优惠多多，惊喜不断！";
                    }
                    if($event == 'LOCATION'){
                        $x = $postObj->Latitude;
                        $y = $postObj->Longitude;
                        // commonLog("location:".$x.",".$y, '');
                    }
        			$eventKey = $postObj->EventKey;
        			if($eventKey == 'V1001_SERVICE'){
        				$contentStr = "请把您的地理位置发送给我~";
        			}
                    if($eventKey == 'V1001_VIP'){
                        $contentStr = "会员中心筹建中~";
                    }
        			break;
        		default:
        			# code...
        			break;
        	}
        	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        	// commonLog('return to user: '.$resultStr, '');
        	return $resultStr;
            // }else{
            // 	return "Input something...";
            // }

        }else {
        	return "";
        }
    }
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

