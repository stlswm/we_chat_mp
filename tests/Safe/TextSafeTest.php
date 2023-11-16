<?php

namespace Safe;

use Config;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use stlswm\WeChatMp\MiniProgram;

include "../../vendor/autoload.php";
include '../Config.php';

class TextSafeTest extends TestCase
{
    /**
     * @throws GuzzleException
     */
    public function testSend()
    {
        $mp = MiniProgram::instance(Config::AppId, Config::Secret);
        $mp->setAccessToken(Config::AccessToken);
        $textSafe = $mp->textSafe();
        $textSafe->openid = Config::OpenId;
        $textSafe->scene = 2;
        $response = $textSafe->check('我热烈的马');
        var_dump($response);
        $this->assertEquals(0, $response['errcode']);
    }
}