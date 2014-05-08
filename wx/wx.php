<?php
/**
  * 微信接口
  */

//define your token
define("TOKEN", "lamperus");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();

class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	$this->responseMsg();//验证后处理用户发关的消息-这里是原样返回用户的消息]
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                          
				if(!empty( $keyword ))
                {
					if(preg_match("/(help|h|Hello2BizUser)/i",$keyword)){
						$contentStr = "功能描述：\n\n1，发送含有简历关键词的句子或者短语把我的简历回复给你。\n2，发送北京公交670，回复此公交的相关信息。\n3，对诗词，发送题目回复全诗。\n\n努力开发中。。。";
						$this->sendText( $fromUsername, $toUserName, $contentStr);
					}elseif($this->checkResume($keyword)){
						$this->sendResume($fromUsername, $toUsername,$keyword);
					}else{
						$contentStr = $keyword . '么么哒';//用户输入什么都回复他什么，加上后缀么么哒。
						$this->sendText ( $fromUsername, $toUsername, $contentStr );
					}
                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }
	
    private function checkResume($content){
    	$resum_keywords = array('jl','jianli','简历');
    	foreach ($resum_keywords as $key => $value) {
    		if(preg_match("/$value/i", $content))
    			return true;
    	}
    	return false;
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
	
	/**
	 * 发送个人信息，图文类型
	 */
	private function sendResume($fromUsername, $toUsername,$keyword){
		$time = time();
		$msgType = 'news';
		$count = 1;//消息的数量
		$contentStr = "<xml>
						 <ToUserName><![CDATA[$fromUsername]]></ToUserName>
						 <FromUserName><![CDATA[$toUsername]]></FromUserName>
						 <CreateTime>$time</CreateTime>
						 <MsgType><![CDATA[$msgType]]></MsgType>
						 <ArticleCount>$count</ArticleCount>
						 <Articles>";
		//简历数椐
		$description1 = '从2010年在学校时开始接触php语言及mysql数椐库，熟练使用，了解php语言的内部原理及解释执行的过程及mysql常用优化的方法。';
		$contentStr .= "<item>
						 <Title><![CDATA[邹喜东简历PHP工程师]]></Title> 
						 <Description><![CDATA[$description1]]></Description>
						 <PicUrl><![CDATA[http://blog.lamper.us/wx/image/tongleqi.jpg]]></PicUrl>
						 <Url><![CDATA[http://blog.lamper.us/resume.html]]></Url>
						 </item>";
		
		$contentStr .= "</Articles>
						 <FuncFlag>1</FuncFlag>
						 </xml> ";
		echo $contentStr;
	}
	/**
	 * 发送文本类型的信息
	 * @param fromUsername
	 * @param toUsername
	 * @param contentStr
	 */
	private function sendText($fromUsername, $toUsername, $contentStr) {
		$time = time();
		$msgType = "text";
		$textTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[%s]]></MsgType>
		<Content><![CDATA[%s]]></Content>
		<FuncFlag>1</FuncFlag>
		</xml>";  //这里的<FuncFloag>0</FuncFlag>中的0要修改成1,这样用户微信中才会有显示新消息的标志
		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
		echo $resultStr;
	}
	
	
	/**
	 * 
	 * @param unknown_type $degubinfo
	 * @param String $basedir 项目所在的目录 
	 * @param unknown_type $clear
	 * @throws Exception
	 * @todo 1,$basedir 
	 */
	 function dong($debuginfo,$basedir='',$clear=false){
		 $mod = $clear ? 'wb+':'a+';
		 $path = dirname(__FILE__);
		 if($basedir != ''){
			$expr = '/'.$basedir.'/';
			if(preg_match($expr, $path)){
				$arr = explode(DIRECTORY_SEPARATOR.$basedir.DIRECTORY_SEPARATOR,$path);
				$path = $arr[0].DIRECTORY_SEPARATOR.$basedir;
			}
		 }
		 $fp = fopen($path.'/'.$basedir.'_debug.htm',$mod);
	
		 $print_info = '<pre>'.print_r($debuginfo,true).'</pre>';
		 $header_info = $clear?"<meta http-equiv='Content-Type' content='text/html' charset='utf-i' />\r\n":'';
		 $help_info = "<br />\r\n<span style='color:grey;'>链接地址:http://".$_SERVER['HPPT_HOST'].$_SERVER['REQUEST_URI']
			 ."\r\n<br />\r\n时间:".date('Y-m-d H:i:s',time())
			 ."</span>\r\n<br /n>\r\n";
	
		 if(@fwrite($fp,$header_info.$help_info.$print_info) === false){
			 $error = '你没有权限了';
			 throw new Exception($error);
		 }
	 }
}

?>