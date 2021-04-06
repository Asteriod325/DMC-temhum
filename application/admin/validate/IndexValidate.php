<?php


namespace app\admin\validate;


use think\Validate;

class IndexValidate extends Validate
{
    protected $rule = [
        'account' => 'require',

    ];

    protected $message = [

        'account.require' => '输入不能为空' ,

    ];

    protected $scene = [

        'index'  =>  ['account'],
    ];
}