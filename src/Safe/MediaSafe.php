<?php


namespace stlswm\WeChatMp\Safe;


use stlswm\WeChatMp\MiniProgram;

/**
 * 音视频图片内容安全识别
 * https://developers.weixin.qq.com/miniprogram/dev/OpenApiDoc/sec-center/sec-check/mediaCheckAsync.html
 * Class ContentSafe
 * @package stlswm\WeChatMp\Safe
 */
class MediaSafe
{
    /**
     * @var MiniProgram
     */
    protected MiniProgram $miniProgram;

    public function __construct(MiniProgram $miniProgram)
    {
        $this->miniProgram = $miniProgram;
    }

    public function check()
    {

    }
}