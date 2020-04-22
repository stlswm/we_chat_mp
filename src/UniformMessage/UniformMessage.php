<?php

namespace stlswm\WeChatMp\UniformMessage;

use Exception;
use stlswm\WeChatMp\MiniProgram;

/**
 * Class UniformMessage
 *
 * @package stlswm\WeChatMp\UniformMessage
 */
class UniformMessage
{
    /**
     * @var UniformMessage $instance
     */
    private static $instance;
    /**
     * @var MiniProgram
     */
    protected $miniProgram;

    private function __construct(MiniProgram $miniProgram)
    {
        $this->miniProgram = $miniProgram;
    }

    /**
     * @param string $accessToken
     * @param string $toUser
     * @param array  $weAppTemplateMsg
     * @param array  $mpTemplateMsg
     *
     * @return array
     * @throws Exception
     *
     */
    public function send(string $accessToken, string $toUser, array $weAppTemplateMsg, array $mpTemplateMsg): array
    {
        $url = MiniProgram::$baseUri . "/cgi-bin/message/wxopen/template/uniform_send?access_token={$accessToken}";
        $data = [
            'touser'             => $toUser,
            'weapp_template_msg' => $weAppTemplateMsg,
            'mp_template_msg'    => $mpTemplateMsg,
        ];
        if (empty($weAppTemplateMsg)) {
            unset($data['weapp_template_msg']);
        }
        $response = MiniProgram::guzzleHttpClient()->post($url, [
            "json" => $data,
        ]);
        if ($response->getStatusCode() != 200) {
            throw new Exception('网络请求失败：' . $response->getStatusCode());
        }
        $body = (string)$response->getBody();
        return json_decode($body, TRUE);
    }

    /**
     * @param MiniProgram $miniProgram
     *
     * @return UniformMessage
     */
    public static function newInstance(MiniProgram $miniProgram)
    {
        if (self::$instance) {
            return self::$instance;
        }
        self::$instance = new UniformMessage($miniProgram);
        return self::$instance;
    }
}