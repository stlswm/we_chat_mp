<?php

use PHPUnit\Framework\TestCase;
use stlswm\WeChatMp\MiniProgram;

/**
 * Class SubscribeMessageTest
 */
class SubscribeMessageTest extends TestCase
{
    public function testSend()
    {
        include "../vendor/autoload.php";
        $mp = MiniProgram::instance('', '');
        $accessToken = '34_mTItkb3gopodlkULjDg6kOoQ_qleccCOaZt7-O_68CX-u7pnPZTJavYB0sVTEOr9dcKnHGS2_9MRgJ8tHZozg-IhkHcnndBSVA85mw6ezK_QWte8djVGUo1akoMdiK8XyheggH_g4WPJLruODTShAHAIYX';
        $res = $mp->subscribeMessage()->send($accessToken, 'o6Y325csA_mLmI2mPdx-pbwC4I40',
            'WyF1DGRCMkPYxWhd1Yz5VyNwZy9X9uZ0eSf8xJDRPOA', '', [
                'thing2' => [
                    'value' => '测试',
                ],
                'thing1' => [
                    'value' => '通过',
                ],
                'thing3' => [
                    'value' => '备注',
                ]
            ]);
        var_dump($res);
    }
}