<?php

namespace stlswm\WeChatMp\SubscribeMessage;

use stlswm\WeChatMp\MiniProgram;
use Exception;

/**
 * Class SubscribeMessage
 * @package stlswm\WeChatMp\SubscribeMessage
 */
class SubscribeMessage
{
    /**
     * @var MiniProgram
     */
    protected $miniProgram;

    public function __construct(MiniProgram $miniProgram)
    {
        $this->miniProgram = $miniProgram;
    }

    /**
     * @param  string  $accessToken
     * @param  string  $toUser
     * @param  string  $templateId
     * @param  string  $page
     * @param  array  $data
     * @param  string|null  $miniProgramState
     * @param  string|null  $lang
     * @return array
     * @throws Exception
     */
    public function send(
        string $accessToken,
        string $toUser,
        string $templateId,
        string $page,
        array $data,
        string $miniProgramState = null,
        string $lang = null
    ): array {
        $url = MiniProgram::$baseUri."/cgi-bin/message/subscribe/send?access_token={$accessToken}";
        $req = [
            'touser'      => $toUser,
            'template_id' => $templateId,
            'page'        => $page,
            'data'        => $data,
        ];
        if ($miniProgramState) {
            $req['miniprogram_state'] = $miniProgramState;
        }
        if ($lang) {
            $req['lang'] = $lang;
        }
        $response = MiniProgram::guzzleHttpClient()->post($url, [
            "json" => $req,
        ]);
        if ($response->getStatusCode() != 200) {
            throw new Exception('网络请求失败：'.$response->getStatusCode());
        }
        $body = (string)$response->getBody();
        return json_decode($body, true);
    }
}