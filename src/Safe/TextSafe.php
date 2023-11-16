<?php


namespace stlswm\WeChatMp\Safe;


use Exception;
use GuzzleHttp\Exception\GuzzleException;
use stlswm\WeChatMp\MiniProgram;

/**
 * 检查用户输入内容是否安全
 * https://developers.weixin.qq.com/miniprogram/dev/OpenApiDoc/sec-center/sec-check/msgSecCheck.html
 * Class TextSafe
 * @package stlswm\WeChatMp\Safe
 */
class TextSafe
{
    /**
     * @var MiniProgram
     */
    protected MiniProgram $miniProgram;

    public string  $openid;//用户的openid（用户需在近两小时访问过小程序）
    public string  $content;//需检测的文本内容，文本字数的上限为2500字，需使用UTF-8编码
    public float   $version = 2;//接口版本号，2.0版本为固定值2
    public int     $scene   = 1;//场景枚举值（1 资料；2 评论；3 论坛；4 社交日志）
    public ?string $title;//文本标题，需使用UTF-8编码
    public ?string $nickname;//用户昵称，需使用UTF-8编码
    public ?string $signature;//个性签名，该参数仅在资料类场景有效(scene=1)，需使用UTF-8编码

    public function __construct(MiniProgram $miniProgram)
    {
        $this->miniProgram = $miniProgram;
    }

    /**
     * @param  string  $content
     * @return array
     * @throws GuzzleException
     */
    public function check(string $content = ''): array
    {
        $accessToken = $this->miniProgram->getAccessToken();
        $url = MiniProgram::$baseUri."/wxa/msg_sec_check?access_token={$accessToken}";
        $data = [
            'content'   => $content ? $content : $this->content,
            'version'   => $this->version,
            'scene'     => $this->scene,
            'openid'    => $this->openid,
            'title'     => $this->title ?? null,
            'nickname'  => $this->nickname ?? null,
            'signature' => $this->signature ?? null,
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