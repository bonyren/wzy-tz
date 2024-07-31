<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Validate;
use think\Db;
use think\Env;

// 应用公共文件
function ajaxSuccess($msg = '操作成功', $data = '', $html = ''){
	return json([
		'code'=>1,
		'msg'=>$msg,
		'data'=>$data,
		'html'=>$html
	]);	
}
function ajaxError($msg = '操作失败', $data = '', $html = ''){
	return json([
		'code'=>0,
		'msg'=>$msg,
		'data'=>$data,
		'html'=>$html
	]);	
}
/**
 * @param string $msg
 */
function ajaxDatagridDataError($msg = '加载数据失败'){
	return json([
		'total'=>0,
		'rows'=>[],
		'error'=>$msg
	]);	
}
//it must return text/html content, so can't use ajaxSuccess
function uploadSuccess($msg = '', $data = [], $html = ''){
	exit(json_encode([
		'code'=>1,
		'msg'=>$msg,
		'data'=>$data,
		'html'=>$html
	]));
}
function uploadError($msg = '', $data = [], $html = ''){
	exit(json_encode([
		'code'=>0,
		'msg'=>$msg,
		'data'=>$data,
		'html'=>$html
	]));
}

function startsWith($haystack, $needle) {
	// search backwards starting from haystack length characters from the end
	return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}

function endsWith($haystack, $needle) {
	// search forward starting from end minus needle length characters
	return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}

function abstractNameFromEmail($email){
	$pos = strpos($email, '@');
	if($pos === false){
		return $email;
	}
	return substr($email, 0, $pos);
}
function validateEmail($email){
	$pattern = '/^[a-z0-9]+([._-][a-z0-9]+)*@([0-9a-z]+\.[a-z]{2,14}(\.[a-z]{2})?)$/i';
	if(preg_match($pattern, $email)){
		return true;
	}else{
		return false;
	}
}
function validateMobile($mobile){
	$pattern = '/^1\d{10}$/';
	if(preg_match($pattern, $mobile)){
		return true;
	}else{
		return false;
	}
}
function validateUrl($url){
	$pattern = "/^(https?:\/\/)?(((www\.)?[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)?\.([a-zA-Z]+))|(([0-1]?[0-9]?[0-9]|2[0-5][0-5])\.([0-1]?[0-9]?[0-9]|2[0-5][0-5])\.([0-1]?[0-9]?[0-9]|2[0-5][0-5])\.([0-1]?[0-9]?[0-9]|2[0-5][0-5]))(\:\d{0,4})?)(\/[\w- .\/?%&=]*)?$/i";
	if(preg_match($pattern, $url)){
		return true;
	}else{
		return false;
	}
}
function validateDate($date){
	//匹配日期格式
	if (preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts)) {
		//检测是否为日期,checkdate为月日年
		if(checkdate($parts[2],$parts[3],$parts[1])) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
function validateDatetime($datetime){
	//匹配日期格式
	if (preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2}) [0-9]{2}:[0-9]{2}:[0-9]{2}$/", $datetime, $parts)) {
		//检测是否为日期,checkdate为月日年
		if(checkdate($parts[2],$parts[3],$parts[1])) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
/**********************************************************************************************************************/
/*
function generateAppointOrderNo(){
	$prefix = 'YY';
	$rand = mt_rand(0,9999);
	$orderNo = $prefix . date('YmdHis') . str_pad($rand,4,'0',STR_PAD_LEFT);
	return $orderNo;
}*/
function generateSequenceNo($key, $prefix=''){
	if (Env::get('production')) {
		Db::execute("lock tables redis write");
	}
	$nowValue = Db::table('redis')->where(['key'=>$key])->value('value');
	if(empty($nowValue)){
		$nowValue = 0;
	}else{
		$nowValue = intval($nowValue);
	}
	if($nowValue == 0){
		Db::table('redis')->insert([
			'key' => $key,
			'value' => strval($nowValue + 1)
		]);
	}else {
		Db::table('redis')->where(['key' => $key])->setField('value', strval($nowValue + 1));
	}
	if (Env::get('production')) {
		Db::execute("unlock tables");
	}
	$order_no = $prefix . date('Y') . str_pad($nowValue,8,'0',STR_PAD_LEFT);
	return $order_no;
}
function obfuscateString($string){
	$l = strlen(($string));
	if ($l > 3) {
		$obf = substr($string, 0, 1);
		$obf .= str_repeat('*', $l - 2);
		$obf .= substr($string, -1, 1);
	} else {
		$obf = str_repeat('*', $l);
	}
	return $obf;
}
function obfuscateEmailAddress($emailAddress){
	if (validateEmail($emailAddress)) {
		list($userName, $domain) = explode('@', strtolower($emailAddress));
		$obf = obfuscateString($userName).'@';
		$domainParts = explode('.', $domain);
		$TLD = array_pop($domainParts);
		foreach ($domainParts as $dPart) {
			$obf .= obfuscateString($dPart).'.';
		}
		return $obf.$TLD;
	}
	return $emailAddress;
}
function mb_pathInfo($filepath){
	$path_parts = array();
	$path_parts ['dirname'] = rtrim(mb_substr($filepath, 0, mb_strrpos($filepath, DS)),DS).DS;
	$path_parts ['basename'] = ltrim(mb_substr($filepath, mb_strrpos($filepath, DS)),DS);
	$path_parts ['extension'] = mb_substr(mb_strrchr($filepath, '.'), 1);
	$path_parts ['filename'] = ltrim(mb_substr($path_parts ['basename'], 0, mb_strrpos($path_parts ['basename'], '.')),DS);
	return $path_parts;
}

//监测是否移动设备
function isMobile() {
    static $res = null;
    if (!is_null($res)) {
        return $res;
    }
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
        $res = true;
        return $res;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset($_SERVER['HTTP_VIA'])) {
        // 找不到为flase,否则为true
        $res = stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        return $res;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高。其中'MicroMessenger'是电脑微信
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel',
            'lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi',
            'openwave','nexusone','cldc','midp','wap','mobile','MicroMessenger');
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $res = true;
            return $res;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if (
            (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) &&
            (
                strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false ||
                (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))
            )
        ) {
            $res = true;
            return $res;
        }
    }
    $res = false;
    return $res;
}
function truncateString($str, $len){
	if(strlen($str) > $len){
		$str = substr($str, 0, $len);
	}
	return $str;
}
function mb_truncateString($str, $len){
	if(mb_strlen($str) > $len){
		$str = mb_strcut($str, 0, $len);
	}
	return $str;
}
function beautifyLogArray($arr){
    return str_replace('array', '', var_export($arr, true));
    //return preg_replace('/^array \( (.*), \)$/', "[$1]", var_export($arr, true));
}