<?php

namespace stlswm\WeChatMp;

use GuzzleHttp\Client;
use stlswm\WeChatMp\Auth\Auth;
use stlswm\WeChatMp\SubscribeMessage\SubscribeMessage;
use stlswm\WeChatMp\UniformMessage\UniformMessage;

/**
 * Class MiniProgram
 * @package stlswm\WeChatMp
 */
class MiniProgram
{
    /**
     * @var string
     */
    protected $appId;
    /**
     * @var string
     */
    protected $secret;

    /**
     * @var string 接口地址
     */
    public static $baseUri = 'https://api.weixin.qq.com';

    /**
     * MiniProgram constructor.
     */
    protected function __construct()
    {
    }

    /**
     * @return Client
     */
    public static function guzzleHttpClient(): Client
    {
        return new Client([
            'timeout' => 10,
        ]);
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @return Auth
     */
    public function auth(): Auth
    {
        return new Auth($this);
    }

    /**
     * @var UniformMessage $uniformMessageInstance
     */
    protected UniformMessage $uniformMessageInstance;

    /**
     * @return UniformMessage
     */
    public function uniformMessage(): UniformMessage
    {
        if ($this->uniformMessageInstance) {
            return $this->uniformMessageInstance;
        }
        $this->uniformMessageInstance = new UniformMessage($this);
        return $this->uniformMessageInstance;
    }

    /**
     * @var SubscribeMessage $subscribeMessageInstance
     */
    protected $subscribeMessageInstance;

    /**
     * @return SubscribeMessage
     */
    public function subscribeMessage(): SubscribeMessage
    {
        if ($this->subscribeMessageInstance) {
            return $this->subscribeMessageInstance;
        }
        $this->subscribeMessageInstance = new SubscribeMessage($this);
        return $this->subscribeMessageInstance;
    }


    /**
     * @param  string  $appId
     * @param  string  $secret
     * @return MiniProgram
     */
    public static function instance(string $appId, string $secret): MiniProgram
    {
        $miniProgram = new MiniProgram();
        $miniProgram->appId = $appId;
        $miniProgram->secret = $secret;
        return $miniProgram;
    }
}