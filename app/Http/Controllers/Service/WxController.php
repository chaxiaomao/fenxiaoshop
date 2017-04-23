<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Entity\Member;

class WxController extends Controller
{
    public function __construct()
    {
        $this->middleware('verify', ['except' => '/service/wechat']);
    }

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        $wechat = app('wechat');
        $userApi = $wechat->user;
        $wechat->server->setMessageHandler(function ($message) use ($userApi) {
            if ($message->MsgType == 'event') {
                # code...
                switch ($message->Event) {
                    case 'subscribe':
                        return $this->guanzhu($userApi, $message);
                        break;
                    case 'unsubscribe':
                        $this->quguan($message);
                        break;
                    default:
                        # code...
                        break;
                }
            }
//            switch ($message->MsgType) {
//                case 'event':
//                    return '收到事件消息'.$userApi->get($message->FromUserName)->nickname;
//                    break;
//                case 'text':
//                    return '收到文字消息'.$userApi->get($message->FromUserName)->nickname;
//                    break;
//                case 'image':
//                    return '收到图片消息';
//                    break;
//                case 'voice':
//                    return '收到语音消息';
//                    break;
//                case 'video':
//                    return '收到视频消息';
//                    break;
//                case 'location':
//                    return '收到坐标消息';
//                    break;
//                case 'link':
//                    return '收到链接消息';
//                    break;
//                // ... 其它消息
//                default:
//                    return '收到其它消息';
//                    break;
//            }
        });
        return $wechat->server->serve();
    }

    protected function guanzhu($useApi, $message)
    {
        $user = $useApi->get($message->FromUserName);
        $member = Member::where('openid', $message->FromUserName)->first();
        //已经关注过
        if ($member && $member->state == 1) {
            return;
        }
        //有记录，之前取消关注的，修改状态为1
        if ($member && $member->state == 0) {
            $member->state = 1;
        }
        //数据库没用户信息，之前没关注过
        if (!$member) {
            //实例化user
            $member = new Member();
            $member->openid = $message->FromUserName;
            $member->user_name = $user->nickname;
            $member->register_at = date("Y-m-d H:i:s", time() + 8 * 60 * 60);
            $member->state = 1;
            //可尝试用DB的getInsertId来返回uid
            $member->save();
            $arr = (int)$member->uid + 10000;
            $member->user_id = $arr;
            $this->qr($member->uid);
            //在判断，是否扫描的场景二维码
            if ($message->EventKey) {
                $puid = substr($message->EventKey, 8);
                $row = Member::find($puid);
                //分配代理关系
                $user->p1 = $row['uid'];
                $user->p2 = $row['p1'];
                $user->p3 = $row['p2'];
            }
        }
        $member->save();
        $msg = '亲爱的' . $member->user_name . "\n"
            . '恭喜您成为了我们第' . $member->uid . '个会员'
            . 'ID：' . $member->user_id . "\n"
            . '感谢您对微小茶事业的关注和支持!' . "\n"
            . '今天是：' . date("Y-m-d") . ',祝你生活愉快~';
        return $msg;
    }

    protected function quguan($message)
    {
        $openid = $message->FromUserName;
        $member = Member::where('openid', $openid)->first();
        if ($member) {
            $member->state = 0;
            $member->save();
        }
    }

    public function mkd()
    {
        $path = date('/Y/md');
        if (!is_dir(public_path() . $path)) {
            mkdir(public_path() . $path, 0777, true);
        }
        return $path;
    }

    public function qr($uid)
    {
        //实例化微信二维码
        $wechat = app('wechat');
        $qrcode = $wechat->qrcode;
        //创建永久二维码
        $result = $qrcode->forever($uid);
        //获取二维码票据
        $ticket = $result->ticket;
        //二维码图片解析后的地址，开发者可根据该地址自行生成需要的二维码图片
        //$url = $result->url;
        //获取二维码内容
        $url = $qrcode->url($ticket);
        $content = file_get_contents($url); // 得到二进制图片内容
        $qr = public_path() . $this->mkd() . '/' . 'qr_' . $uid . '.jpg';
        file_put_contents($qr, $content); // 写入文件

    }
}