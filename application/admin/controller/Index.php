<?php


namespace app\admin\controller;


use app\admin\model\Admin as AdminModel;
use app\admin\model\Device as DeviceModel;
use app\admin\model\Device;
use app\admin\validate\PwdValidate as PwdValidate;

use think\Console;
use think\facade\Cache;
use think\facade\Session;
use think\facade\Request;


class Index extends Base
{
    /**
     *
     * 获取token
     */
    public function get_token(){
        $url = config('base.device_token');//配置token
        return $this->curl_get($url);
    }

    /**
     *
     * 获取设备信息的地址
     */
    public function get_device(){
        $url = config('base.device_getdevice').'?allterms=false';//配置设备
        return $this->curl_get_header($url);
    }
    /**
     *
     * 获取设备实时信息
     */
    public function get_realtimeData(){
        $url = config('base.device_realtimedata');//配置实时信息
        return $this->curl_get($url);
        ///api/data/getHistoryData
    }
    public function  get_HistoryData($beginTime,$beginTime1,$endTime,$endTime1){
        $url=config('base.device_getHistoryData').'&beginTime='.$beginTime.' '.$beginTime1.'&endTime='.$endTime.' '.'&endTime='.$endTime1;//配置获取历史数据
        return  $this->curl_get("http://weixin.0531yun.cn/data/gethistorydata?devAddr=24218374&termPos=1&beginTime=2021-03-14%2010%3A25%20&endTime=%202021-03-20%2010%3A25&_=1616207124759");
    }


    //开启curl get请求
    public function curl_get($url) {
        $curl = curl_init();
        $token=Cache::get('token');
        $header = ['authorization:'.$token]; //设置一个你的浏览器agent的header
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $data;
    }
    public function curl_get_header($url){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //TRUE 将curl_exec()获取的信息以字符串返回，而不是直接输出。
        $token=Cache::get('token');
        $header = ['authorization:'.$token]; //设置一个你的浏览器agent的header
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_HEADER, 1); //返回response头部信息
        curl_setopt($ch, CURLINFO_HEADER_OUT, true); //TRUE 时追踪句柄的请求字符串，从 PHP 5.1.3 开始可用。这个很关键，就是允许你查看请求header
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        echo curl_getinfo($ch, CURLINFO_HEADER_OUT); //官方文档描述是“发送请求的字符串”，其实就是请求的header。这个就是直接查看请求header，因为上面允许查看
        curl_close($ch);
        return $result;
    }

    /**
     * 发送HTTP请求方法
     * @param  string $url    请求URL
     * @param  array  $params 请求参数
     * @param  string $method 请求方法GET/POST
     * @return array  $data   响应数据
     */
    public static  function http($url, $params="")
    {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);  //curl可以直接
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json;charset='utf-8'")); //设置响应头
        if ($params) {
            curl_setopt($curl, CURLOPT_POST, 1);
            $data = json_encode($params);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        $data = curl_exec($curl);
        curl_close($curl);

        return $data;
    }

    /**
     *生产者-高某人的生产者入口接口
     * @param $produce
     * @return array
     */
    public static function producer($produce){
    $url="http://47.93.216.229:8288/produce";
    $params=array(
        "Topic"=>"phone","Msg"=>$produce,"Key"=>"hxBA7bZlcJKE72kZ1adLmdnjhGx0Q+PgM3joSeLxcTM="
    );
    return self::http($url,$params);
    }

    /**
     * 获得实时数据
     * @return mixed
     */
   public function  getdata(){
       if (Cache::get('token')) {
           //获取设备$device = $this->get_device();
           //return $device;
           $realtimeData=json_decode($this->get_realtimeData(),true);
           //return $realtimeData['data'][0]['terms'][0]['recordTime'];
           //Cache::set('realtimeData',$realtimeData);
           self::producer(json_encode($realtimeData['data'][0]['terms'][0]));

         //  return  $realtimeData['data'][0];
               //$realtimeData['data'][0]['terms'][0]['tem'];
         //  return $this->get_HistoryData('2021-03-19','00:00:00','2021-03-19','08:49:29');
           $this->assign('datas',$realtimeData['data'][0]['terms'][0]);
           return $realtimeData['data'][0]['terms'][0];

       } else {
           $data_token = json_decode($this->get_token(),true);
           $token= $data_token['data']['token'];

           // return  $token;
           Cache::set('token',$token,7200);
           $realtimeData=json_decode($this->get_realtimeData(),true);
           self::producer(json_encode($realtimeData['data'][0]['terms'][0]));
//           $this->assign('datas',$realtimeData['data']);
//           return json($realtimeData['data']);
           $this->assign('datas',$realtimeData['data'][0]['terms'][0]);
           return $realtimeData['data'][0]['terms'][0];
       }

   }


    /**
     * 监控中心
     * @return mixed
     *
    $json_msg = '{"amount":0.10,"orderId":"208945155KijUs","status":"success"}';
    $arr = json_decode($json_msg, true);
    $amount = $arr['amount'];
    $orderId = $arr['orderId'];
    $status = $arr['status'];
     */
    public function index(){

        $realtimeData=json_decode($this->get_realtimeData(),true);
        $this->assign('datas',$realtimeData['data'][0]['terms']);
       return $this->fetch();
    }
    /**
     * 数据中心
     * @return mixed
     */
    public function device(){
        //模板赋值
        $this -> view -> assign('title', '数据中心');
        return $this->fetch();
    }

    /**
     * 数据中心的列表
     * @return string|\think\response\Json
     * @throws \Exception
     */
    public function deviceList(){
        //  return Session::get('account');
        // 定义分页参数
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        // 获取到所有的图片
        $adminList = DeviceModel::page($page, $limit)-> select();

    // return $adminList;
        //return $adminList;
        $total = count(DeviceModel::select());
        $result = array("code" => 0, "msg" => "查询成功", "count" => $total, "data" => $adminList);
        return json($result);
        // 3. 设置模板变量
        $this -> view -> assign('indexList', $adminList);
        // 4. 渲染模板
        return $this -> view -> fetch('device');
    }

    /**
     * @return mixed
     */
    public function about(){

        return $this->fetch();
    }

    /**
     * @return mixed
     */
    public function password(){
        return $this->fetch();
    }

    /**
     *   编辑密码
     * @return string
     * @throws \Exception
     */
    public function editPassword()
    {
        // 获取当前信息 id,account
        $id = Session::get('aid');
        $account = Session::get("aname");
        // 设置模板变量
        $this -> view -> assign([
            'id' => $id,
            'account' => $account,
            'title' => '修改密码'
        ]);

        // 渲染模板
        return $this -> view -> fetch('editPassword');
    }


    /**
     * 执行修改密码
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function doEditPwd()
    {


        // 获取的用户提交的信息
        $data = Request::param();
        //参数检测  id,original_password:原密码 password:新密码  confirm_password：确认密码
        //验证器重支持定义场景，并且验证不同场景的数据scene
        $validate = new PwdValidate();
        if (!$validate->scene('changePassword')->check($data)) {//验证
            return resMsg(0, $validate->getError() . '<br>' ,'editPassword' );
            //return ['code' => 0, 'msg' => $validate->getError()];
        }


            $password = AdminModel::where('id', $data['id'])->find()['password'];
            //判断原密码是否与验证输入的原密码相同
            //bool password_verify ( string $password , string $hash )
            //password: 用户的密码 hash: 一个由 password_hash() 创建的散列值。
            if (!password_verify($data['original_password'], $password)) {
                //不相同
                return resMsg(-1, '原密码错误，请重新输入', 'editPassword');
            }
            $datas = [
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'update_time' => time()
            ];

            try {
                // 执行密码修改操作
                $admin = AdminModel::where('id', $data['id'])->update($datas);
            } catch (\Exception $e) {
                return resMsg(0, '密码修改失败' . '<br>' . $e->getMessage(), 'editPassword');
            }
            return resMsg(1, '密码修改成功', 'index');

        }

}