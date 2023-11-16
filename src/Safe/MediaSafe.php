<?php


namespace stlswm\WeChatMp\Safe;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
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

    public string $openid;
    public string $media_url;//要检测的图片或音频的url，支持图片格式包括jpg, jepg, png, bmp, gif（取首帧），支持的音频格式包括mp3, aac, ac3, wma, flac, vorbis, opus, wav
    public int    $media_type;//1:音频;2:图片
    public float  $version = 2;//接口版本号，2.0版本为固定值2
    public float  $scene   = 1;//场景枚举值（1 资料；2 评论；3 论坛；4 社交日志）

    /**
     * @param  string|null  $mediaUrl
     * @param  int|null     $mediaType
     * @return array
     * @throws Exception|GuzzleException
     */
    public function check(?string $mediaUrl = null, ?int $mediaType = null): array
    {
        $accessToken = $this->miniProgram->getAccessToken();
        $url = MiniProgram::$baseUri."/wxa/media_check_async?access_token={$accessToken}";
        $data = [
            'media_url'  => $mediaUrl ? $mediaUrl : $this->media_url,
            'media_type' => $mediaType ? $mediaType : $this->media_type,
            'version'    => $this->version,
            'scene'      => $this->scene,
            'openid'     => $this->openid,
        ];
        $response = MiniProgram::guzzleHttpClient()->post($url, [
            "json" => $data,
        ]);
        if ($response->getStatusCode() != 200) {
            throw new Exception('网络请求失败：'.$response->getStatusCode());
        }
        $body = (string)$response->getBody();
        return (array)json_decode($body, true);
    }
}