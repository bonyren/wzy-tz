<?php
// +----------------------------------------------------------------------
// | WZYCODING [ SIMPLE SOFTWARE IS THE BEST ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2025 wzycoding All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://license.coscl.org.cn/MulanPSL2 )
// +----------------------------------------------------------------------
// | Author: wzycoding <wzycoding@qq.com>
// +----------------------------------------------------------------------
namespace app\index\service;
use think\Log;
use think\Db;
use think\Debug;

class Credit extends Base{
    const SECRET_ID = '';
    const SECRET_KEY = '';
    protected function __construct(){
        parent::__construct();
    }
    /**
     //success
    {
    "code": 200,
    "msg": "成功",
    "taskNo": "41020892700032664119", 
    "data": {
        "paging": {
        "pageSize": 10,
        "pageIndex": 1,
        "totalRecords": 191 // 记录总数
        },
        "result": [
        {
            "companyName": "杭州安那其科技有限公司",  // 公司名称
            "creditNo": "91330110MA2CC1X505", // 统一社会信用代码
            "companyCode": "330184000798156",  // 注册号
            "legalPerson": "薛梅",  // 法人
            "companyStatus": "正常",   // 登记状态
            "establishDate": "20180523" // 成立时间
        },
        ...
        ]
    }
    }
    //失败
    {
        "msg": "关键字不能为空",
        "code": 400
    }
     */
    public function search($kw){
        $source = 'market';
        // 签名
        $datetime = gmdate('D, d M Y H:i:s T');
        $signStr = sprintf("x-date: %s\nx-source: %s", $datetime, $source);
        $sign = base64_encode(hash_hmac('sha1', $signStr, self::SECRET_KEY, true));
        $auth = sprintf('hmac id="%s", algorithm="hmac-sha1", headers="x-date x-source", signature="%s"', self::SECRET_ID, $sign);
        
        // 请求方法
        $method = 'POST';
        // 请求头
        $headers = array(
            'X-Source' => $source,
            'X-Date' => $datetime,
            'Authorization' => $auth,
        );
        // 查询参数
        $queryParams = array ();
        // body参数
        $bodyParams = [
            'keyword' => $kw
        ];
        // url参数拼接
        $url = 'https://service-la9pcjft-1305308687.sh.apigw.tencentcs.com/release/enterprise/business/query';
        if (count($queryParams) > 0) {
            $url .= '?' . http_build_query($queryParams);
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_map(function ($v, $k) {
                return $k . ': ' . $v;
            }, array_values($headers), array_keys($headers))
        );
        if (in_array($method, array('POST', 'PUT', 'PATCH'), true)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($bodyParams));
        }
        $data = curl_exec($ch);
        if (curl_errno($ch)) {
            Log::error("Error: " . curl_error($ch));
            curl_close($ch);
            exception("Error: " . curl_error($ch));
        }
        curl_close($ch);
        Log::notice("Credit response content: " . $data);
        $jsonObj = json_decode($data, true);
        if(empty($jsonObj)){
            Log::error("Failed to json decode " . $data);
            exception("Failed to json decode " . $data);
        }
        if(!isset($jsonObj['code'])){
            Log::error("Failed to find code in " . $data);
            exception("Failed to find code in " . $data);
        }
        if($jsonObj['code'] != 200){
            Log::error("code indicate fail in " . $data);
            exception($jsonObj['msg']);
        }
        return $jsonObj['data']['result'];
    }
}