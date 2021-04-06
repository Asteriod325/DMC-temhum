<?php


namespace app\admin\controller;


use think\Controller;
use think\facade\Cache;

class Test extends Controller
{
    public static  function test()
    {
        if (Cache::get('token')) {
            $device = self::curl_post(config('base.device_url'), array(['allterms' => true]), array(['authorization' => Cache::get('token')]));
        } else {
            $token = self::curl_post(config('base.device_url'), array(['loginName' => 'qyx', 'password' => '12345']), null);

            Cache::set('token', $token, 7200);
            // $device=self::curl_post(config('base.device_url'),array(['allterms'=>true]),array(['authorization'=>$token]));
            //   $relt = json_decode($rel,true);
        }
    }
}