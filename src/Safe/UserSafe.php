<?php


namespace stlswm\WeChatMp\Safe;


use stlswm\WeChatMp\MiniProgram;

/**
 * 获取用户安全等级
 * https://developers.weixin.qq.com/miniprogram/dev/OpenApiDoc/sec-center/safety-control-capability/getUserRiskRank.html
 * Class UserSafe
 * @package stlswm\WeChatMp\Safe
 */
class UserSafe
{
    /**
     * @var MiniProgram
     */
    protected MiniProgram $miniProgram;

    public string  $content;//需检测的文本内容，文本字数的上限为2500字，需使用UTF-8编码
    public float   $version = 2;//接口版本号，2.0版本为固定值2
    public int     $scene   = 1;//场景枚举值（1 资料；2 评论；3 论坛；4 社交日志）
    public string  $openid;//用户的openid（用户需在近两小时访问过小程序）
    public ?string $title;//文本标题，需使用UTF-8编码
    public ?string $nickname;//用户昵称，需使用UTF-8编码
    public ?string $signature;//个性签名，该参数仅在资料类场景有效(scene=1)，需使用UTF-8编码


    public function getUserRiskRank()
    {

    }
}