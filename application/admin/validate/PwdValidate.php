<?php


namespace app\admin\validate;


use think\Validate;

class PwdValidate extends Validate
{
    protected $rule = [
        'original_password'  => 'require|length:6,12',
        'password'  => 'require|length:6,12',
        'confirm_password' => 'require|length:6,12',
    ];

    protected $message = [

        'original_password.require' => '原密码不能为空',
        'original_password.length' => '原密码的长度错误',
        'password.require' => '新密码不能为空',
        'password.length' => '新密码的长度必须在6-12位之内',
        'confirm_password.require' => '确认密码不能为空',
        'confirm_password.length' => '确认密码的长度错误',
    ];
    protected $scene = [
        'changePassword'  =>  ['password','confirm_password','original_password'],

    ];
}