<?php

namespace stlswm\WeChatMp;

use stlswm\WeChatMp\Auth\Auth;

/**
 * Class MiniProgram
 *
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
     * MiniProgram constructor.
     */
    protected function __construct()
    {
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
        $auth = new Auth($this);
        return $auth;
    }


    /**
     * @param string $appId
     * @param string $secret
     *
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