<?php
namespace App\Tool\WechatMenu;

use App\Models\M3Result;

class WechatMenu
{
    private $appid = 'wx53694abecee08672';
    private $appsecret = 'ebd777398da95e76875a383910abd2fa';
    private $url;
    private $access_token;
    private $jsonmenu = '{
    "button": [
        {
            "type": "view", 
            "name": "微小茶", 
            "url": "http://fenxiaoshop.tunnel.2bdata.com/home"
        }, 
        {
            "name": "代言人", 
            "sub_button": [
                {
                    "type": "click", 
                    "name": "我的二维码", 
                    "key": "V1001_TODAY_MUSIC"
                }, 
                {
                    "type": "view", 
                    "name": "个人中心", 
                    "url": "http://wxc123.tunnel.2bdata.com/personal"
                }
            ]
        }, 
        {
            "name": "服务中心", 
            "sub_button": [
                {
                    "type": "view", 
                    "name": "品牌那些事儿", 
                    "url": "http://wxc123.tunnel.2bdata.com/"
                }, 
                {
                    "type": "view", 
                    "name": "个人茶叶那些事儿", 
                    "url": "http://wxc123.tunnel.2bdata.com/"
                }, 
                {
                    "type": "view", 
                    "name": "如何购买", 
                    "url": "http://wxc123.tunnel.2bdata.com/"
                }, 
                {
                    "type": "view", 
                    "name": "探茶之旅", 
                    "url": "http://wxc123.tunnel.2bdata.com/"
                }, 
                {
                    "type": "view", 
                    "name": "联系我们", 
                    "url": "http://wxc123.tunnel.2bdata.com/"
                }
            ]
        }
    ]
}';

    public function createMenu()
    {
        $this->getToken();
        //创建菜单实现
        $this->url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $this->access_token;
        $result = $this->https_request($this->url, $this->jsonmenu);
        $m3_result = new M3Result();
        if($result == null) {
            $m3_result->status = 9;
            $m3_result->message = "未知错误";
        }
        if(json_decode($result)->errcode != 0) {
            $m3_result->status = $result->statusCode;
            $m3_result->message = $result->statusMsg;
        }else{
            $m3_result->status = 0;
            $m3_result->message = '发送成功';
        }

        return $m3_result->toJson();
    }

    private function getToken()
    {
        $this->url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;
        $output = $this->https_request($this->url);
        $jsoninfo = json_decode($output,true);
        $this->access_token = $jsoninfo["access_token"];
    }

    protected function https_request($url , $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}