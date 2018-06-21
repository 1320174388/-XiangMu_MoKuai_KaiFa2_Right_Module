<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  powerController.php
 *  创 建 者 :  feng
 *  创建日期 :  2018/06/15 15:18
 *  文件描述 :  用户权限控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\controller;
use think\Controller;
use app\right_module\working_version\v1\service\userService;

class PowerController extends Controller
{
    /**
     * 名  称 : root()
     * 功  能 : 超级管理员
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token=> '用户token';
     * 创  建 : 2018/06/18 00:50
     */
    public function root($token){

        $res = (new userService())->rootService($token);
        return returnResponse(1,'success',$res);
    }
    /**
     * 名  称 : powerIndex()
     * 功  能 : 获取用户权限
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token=> '用户token';
     * 输  出 :   {"user_name":"超级管理员","user_level":1}
     * 输  出 :   {"user_name":"普通管理员","user_level":2}
     * 创  建 : 2018/06/15 21:50
     */
    public function powerIndex($token)
    {
        $data = new userService();
        $res = $data->userMain($token);
        return returnResponse(0,'success',$res);
    }
    /**
     * 名  称 : powerIndex()
     * 功  能 : 同意添加管理员
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token => 'token' $level => '申请等级';
     * 输  出 :
     * 创  建 : 2018/06/16 21:55
     */
    public function powerApply($token,$level = 2)
    {
        $data = new userService();
        $res = $data->addUserInfo($token,$level);
        return returnResponse(1,$res['data'],true);
    }
    /**
     * 名  称 : addApply()
     * 功  能 : 申请管理员
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token = 用户标识
     * 输  出 :
     * 创  建 : 2018/06/16 21:50
     */
    public function addApply($token)
    {
        //接收用户昵称
        $postData = $_POST;
        //添加到管理员申请表
        $res = (new userService())->addApplyService($token,$postData);
        if ($res['data']){
            return returnResponse(1,'成功',$res['data']);
        }else{
            return returnResponse(0,'你已经申请过',$res['data']);
        }
    }
    /**
     * 名  称 : applyAdmin()
     * 功  能 : 申请管理员列表
     * 变  量 : --------------------------------------
     * 输  入 : (string) $level = 权限等级
     * 输  出 :
     * 创  建 : 2018/06/16 21:50
     */
    public function applyAdmin($level)
    {
        $data = new userService();
        $res = $data->applyAdministrators($level);
        return returnResponse(0,'',$res['data']);
    }
    /**
     * 名  称 : userAdmin()
     * 功  能 : 管理员列表
     * 变  量 : --------------------------------------
     * 输  入 : (string) $level = 权限等级
     * 输  出 :
     * 创  建 : 2018/06/17 22:50
     */
    public function userAdmin($level)
    {
        $data = new userService();
        $res = $data->applyAdmin($level);
        return returnResponse(0,'',$res['data']);
    }
    /**
     * 名  称 : deletApply()
     * 功  能 : 删除管理员
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token = 用户标识
     * 输  出 :
     * 创  建 : 2018/06/17 21:50
     */
    public function deletApply($token)
    {
       $data = new userService();
       $res = $data->deletApplyService($token);
       if ($res['data']){
           return returnResponse(1,'成功',$res['data']);
       }else{
           return returnResponse(0,'失败',$res['data']);
       }
    }
}