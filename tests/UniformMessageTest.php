<?php

use PHPUnit\Framework\TestCase;
use stlswm\WeChatMp\MiniProgram;

/**
 * Class UniformMessageTest
 */
class UniformMessageTest extends TestCase
{
    public function testSend()
    {
        include "../vendor/autoload.php";
        $mp = MiniProgram::instance('', '');
        $token = $mp->auth()->getAccessToken();
        if ($token['errcode'] != 0) {
            throw new Exception($token['errmsg']);
        }
        $accessToken = $token['access_token'];
        $mp->uniformMessage()->send($accessToken, 'o6Y325csA_mLmI2mPdx-pbwC4I40', [], [
            'appid'       => 'wx20d32832e00108bb',
            'template_id' => '5SEseAZbz-CeUMCylx8IgR6sM9o4VhLgEBH3zbj2SMo',
            'miniprogram' => [
                "appid"    => "wx6852579ea15a4299",
                "pagepath" => "pages/merchant/charge-record/get-detail/index?id=1"
            ],
            'data'        => [
                "first"    => [
                    'value' => '收款单：1234开票状态发生变更，当前状态：SUCCESS',
                    'color' => '#d61313',
                ],
                'keyword1' => [
                    'value' => 'stlswm',
                ],
                'keyword2' => [
                    'value' => '10000',
                ],
            ],
        ]);
    }
}