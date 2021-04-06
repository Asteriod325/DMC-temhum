<?php


namespace app\admin\model;


use think\Db;
use think\facade\Session;
use think\Model;

class Admin extends Model
{
    // 定义自动时间戳和数据格式
    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d H:i:s';
    /*
     * 登录，比对数据库，存入缓存
     */
    public static function login($data){

        $info = self::where('account',$data['account'])->find();

        if(!$info){
            return false;
        }

        if(!password_verify($data['password'],$info['password'])){
            return false;
        }

        //判断是否首次登录
        //id,account账号,aflag账号的状态
        Session::set('aid',$info['id']);
        Session::set('aname',$info['account']);
       Session::set('aflag',$info['flag']);
        return true;
    }

    /*
     * 保存注册的数据
     */
    public static function setRegister($data){
        $res['password'] = $data['password'];
        $res['account'] = $data['account'];
        $res['flag']=1;
        $res['create_time']=time();
        $admin_id = Db::name('admin')->insertGetId($res);
        return $admin_id;
    }
}