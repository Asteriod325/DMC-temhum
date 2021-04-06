<?php


namespace app\admin\controller;


use app\admin\model\Admin as AdminModel;
use app\admin\validate\LoginValidate;
use think\captcha\Captcha;
use think\Controller;
use think\facade\Cache;
use think\facade\Session;
use think\Request;
use aliyun\api_demo\SmsDemo;
Class Login extends Controller
{
    /**
     * 显示资源列表 展示登录页
     *
     * @return mixed
     */
    public function index()
    {
        //加载页面
        return $this->fetch();
    }

    /**
     * 显示资源列表 展示注册页
     *
     * @return mixed
     */
    public function register()
    {
        return $this->fetch();  //加载页面
    }

    /**
     * 验证码
     */
    public function verify()
    {
        $config = [
            // 验证码字体大小
            'fontSize' => 30,
            // 验证码位数
            'length' => 4,
            // 关闭验证码杂点
            'useNoise' => false,

            'useCurve' => false
        ];
        $captcha = new Captcha($config);
        return $captcha->entry();
    }


    /**
     * @param Request $request
     * @return array
     * 登录(输入信息的判断)
     */
    public function adminLogin(Request $request)
    {


        //接收数据
        $params = $request->param();
        //参数检测   account用户名,password密码，code验证码
        //验证器重支持定义场景，并且验证不同场景的数据scene
        //如果验证器返回错误则输出验证的错误提醒用户
        $validate = new LoginValidate();
        if(!$validate->scene('login')->check($params)){
            return ['code'=>0,'msg'=>$validate->getError()];
        }
        //验证码输入错误则输出错误提示
        if(!captcha_check($params['code'])){
            return ['code'=>0,'msg'=>'验证码错误'];
        }
        //在admin表中验证用户名和密码是否正确
        $res = AdminModel::login($params);
        //return $res;
        if($res&&Session('aflag')==1){
            //登陆成功，缓存登录信息，并登录跳转Index/index页面
            return ['code'=>1,'msg'=>'登录成功'];
        }else if($res&&Session('aflag')==0){
            //登陆失败，停留在login/index页面,并刷新
            return ['code'=>0,'msg'=>'此账号已被注销或者停用'];
        }
        else
        {
            return ['code'=>0,'msg'=>'登陆失败'];
        }
    }


    /**
     * 退出登录
     */
    public function logout()
    {
            session('aid', null);
            session('aname', null);
            session('aflag', null);
            //退出到商家版的登录界面
            $this->redirect('login/index');
    }

    /**
     * 用户者注册：发送短信验证码验证
     * @param Request $request
     * @return array
     */
    public function send(Request $request)
    {
        //$params是用户填的phone
        $params = $request->param();
        //验证phone手机号的长度和为不为空


        //判断手机号是否注册过，注册过不能再注册
        $i = AdminModel::where('account',$params['phone'])->find();
        if($i){
            return ['code'=>0,'msg'=>'此手机号已经完成注册,无法再注册！'];
        }
        $phone = $params['phone'];
        //生产随机6位验证码
        $code = mt_rand(100000,999999);
        $params['code']=$code;
        //cache($name, $value='',$expire=0)
        //会使用当前配置的缓存方式用name标识来缓存value值。
        //可以单独设置该缓存数据的有效期，例如：cache(‘name’,‘value’,3600);
        $result = Cache::set($phone,$code,120);
        // 这里可以将验证码存入到缓存当中去，以手机号作为标识

        if($result){
            return SmsDemo::sendSms($params);
        }else{
            return ['code' => 0, 'msg' =>'发送失败！请检查所填电话号码是否正确或重新加载。'];
        }
    }
    /**
     * 用户注册：短信验证码正确=>符合条件注册成功账号密码
     * @param Request $request
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function confirmCode(Request $request)
    {
        $params = $request->param();
        //验证phone手机号,phone_code手机验证码
        $validate = new LoginValidate();
        if (!$validate->scene('register')->check($params)) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        //判断手机号是否注册过，注册过不能再注册
        $i = AdminModel::where('account',$params['phone'])->find();
        if($i){
            return ['code'=>0,'msg'=>'此手机号已经完成注册,无法再注册！'];
        }

        //获取缓存中的手机验证码
        $phone_code = Cache::get($params['phone']);
        //若注册的用户输入的手机验证码与缓存中且发送过的手机验证码一致，则一个注册账号
        if($params['phone_code'] ==$phone_code){
            $res['account'] =$params['phone'];
            //默认密码123456
            $password = config('base.default_password');
            $res['password'] = password_hash($password,PASSWORD_DEFAULT);
            //保存信息(账号account，默认密码password，)
            $result = AdminModel::setRegister($res);
            //保存信息成功
            if($result){
                    return ['code' => 1, 'msg' => '注册成功！您的账号为'.$res['account'].',初始密码为'.$password];
            }else{
                return ['code'=>0,'msg'=>'注册失败！'];
            }
        }else{
            return ['code'=>0,'msg'=>'验证码错误或者已过期'];
        }
    }

}