<?php

namespace Safe;

use Config;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use stlswm\WeChatMp\MiniProgram;

include "../../vendor/autoload.php";
include '../Config.php';

class MediaSafeTest extends TestCase
{
    /**
     * @throws GuzzleException
     */
    public function testSend()
    {
        $mp = MiniProgram::instance(Config::AppId, Config::Secret);
        $mp->setAccessToken(Config::AccessToken);
        $mediaSafe = $mp->mediaSafe();
        $mediaSafe->openid = Config::OpenId;
        $mediaSafe->media_url = '';
        $mediaSafe->media_type = 2;
        $mediaSafe->scene = 2;
        $response = $mediaSafe->check('我热烈的马');
        var_dump($response);
        $this->assertEquals(0, $response['errcode']);
    }
}