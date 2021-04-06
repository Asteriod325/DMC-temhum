<?php


namespace app\admin\validate;


use think\Validate;

class LoginValidate extends Validate
{
    protected $rule = [
        'account' => 'require',
        'password' => 'require|length:6,15',
        'code' => 'require',
        'phone' => 'require|length:11,13',
        'phone_code' => 'require',

    ];

    protected $message = [

        'code.require' => '验证码不能为空',
        'phone.require' => '手机号不能为空',
        'phone.length' => '手机号无效！' ,
        'phone_code.require' => '手机短信验证码不能为空',
        'account.require' => '用户名不能为空' ,
        'password.require' => '密码不能为空' ,
        'password.length' => '密码长度必须是6到12位' ,
    ];

    protected $scene = [
        'send'  =>  ['phone'],
        'register'  =>  ['phone','phone_code'],
        'login'  =>  ['account','code','password'],
    ];
}