<?php

namespace stlswm\WeChatMp\Auth;

use Exception;
use GuzzleHttp\Client;
use stlswm\WeChatMp\MiniProgram;

/**
 * Class Auth
 *
 * @package stlswm\WeChatMp\Auth
 */
class Auth
{
    /**
     * @var MiniProgram
     */
    protected $miniProgram;

    /**
     * Auth constructor.
     *
     * @param MiniProgram $miniProgram
     */
    public function __construct(MiniProgram $miniProgram)
    {
        $this->miniProgram = $miniProgram;
    }

    /**
     * 登录凭证校验
     * https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/login/auth.code2Session.html
     *
     * @param string $jsCode
     * @param string $grantType
     *
     * @return array
     * @throws Exception
     */
    public function code2Session(string $jsCode, string $grantType = 'authorization_code'): array
    {
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $this->miniProgram->getAppId() . '&secret=' . $this->miniProgram->getSecret()
            . "&js_code={$jsCode}&grant_type={$grantType}";
        $client = new Client([
            'timeout' => 10,
        ]);
        $response = $client->get($url);
        if ($response->getStatusCode() != 200) {
            throw new Exception('网络请求失败：' . $response->getStatusCode());
        }
        $body = (string)$response->getBody();
        return json_decode($body, TRUE);
    }
}