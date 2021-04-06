<?php


namespace app\admin\controller;


use rbac\Rbac;
use rbac\Rbac_2;
use think\Controller;
use think\facade\Request;
use think\facade\Session;

class Base extends Controller
{
    protected function initialize()
    {

        if (!Session::get("aflag")) {
                $this->success('正在跳转到登录页面', 'login/index');
            }
    }
}