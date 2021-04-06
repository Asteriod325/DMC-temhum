<?php


namespace app\admin\model;


use think\Db;
use think\facade\Session;
use think\Model;

class Device extends Model
{


    /*
    * 保存注册的数据
    */
    public static function setDatas($data){
        $res['tem'] = $data['tem'];
        $res['hum'] = $data['hum'];
        $res['date']=$data['recordTime'];
        $device_id= Db::name('device')->insertGetId($res);
        return $device_id;
    }
}