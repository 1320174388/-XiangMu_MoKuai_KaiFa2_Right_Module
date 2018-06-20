<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/19 15:28
 *  文件描述 :  管理员添加控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\controller;
use think\Controller;
use think\Request;
use app\right_module\working_version\v3\service\AdminService;

class AdminController extends Controller
{
    /**
     * 名  称 : adminInit()
     * 功  能 : 执行添加管理员操作
     * 变  量 : --------------------------------------
     * 输  入 : (string) $applyToken => '用户标识';
     * 输  入 : (string) $roleString => '职位标识字符串，逗号隔开';
     * 输  出 : {"errNum":0,"retMsg":"设置成功","retData":true}
     * 创  建 : 2018/06/16 21:49
     */
    public function adminInit($applyToken,Request $request)
    {
        // 获取职位数据
        $roleString = $request->post('roleString');
        // 验证数据
        if(!$roleString) return returnResponse(1,'请选择职位');
        // 引入Service逻辑层数据
        $admin = (new AdminService())->rightAdmin($applyToken,$roleString);
        // 判断是否审核成功
        if($admin['msg']=='error') return returnResponse(2,$admin['data']);
        // 返回接口响应数据
        return returnResponse(0,'设置成功',$admin['data']);
    }

    /**
     * 名  称 : adminGet()
     * 功  能 : 获取管理员数据
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"数据"}
     * 创  建 : 2018/06/20 02:01
     */
    public function adminGet()
    {
        // 获取所有管理员数据
        $res = (new AdminService())->getAdmin();
        // 验证删除逻辑
        if($res['msg']=='error') return returnResponse(1,'请求失败');
        // 返回数据格式
        return returnResponse(0,'请求成功',$res['data']);
    }

    /**
     * 名  称 : adminGetInif()
     * 功  能 : 获取单个管理员数据
     * 输  入 : (string) $token => '用户标识';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":true}
     * 创  建 : 2018/06/20 23:43
     */
    public function adminGetInif($token)
    {
        // 获取单个管理员数据
        $res = (new AdminService())->getUserAdmin($token);
        // 验证数据逻辑
        if($res['msg']=='error') return returnResponse(1,'请求失败');
        // 返回数据格式
        return returnResponse(0,'请求成功',true);
    }

    /**
     * 名  称 : adminGetRoute()
     * 功  能 : 获取管理员可管理的模块信息
     * 输  入 : (string) $token => '用户标识';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"数据"}
     * 创  建 : 2018/06/20 23:56
     */
    public function adminGetRoute($token)
    {
        // 获取管理员可管理的模块信息
        $res = (new AdminService())->getAdminRoute($token);
        // 验证数据逻辑
        if($res['msg']=='error') return returnResponse(1,'请求失败');
        // 返回数据格式
        return returnResponse(0,'请求成功',$res['data']);
    }

    /**
     * 名  称 : adminDel()
     * 功  能 : 删除管理员操作
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token => '用户标识';
     * 输  出 : {"errNum":0,"retMsg":"删除成功","retData":true}
     * 创  建 : 2018/06/20 02:01
     */
    public function adminDel($token)
    {
        // 执行删除管理员逻辑
        $res = (new AdminService())->delAdmin($token);
        // 验证删除逻辑
        if($res['msg']=='error') return returnResponse(1,'删除失败');
        // 返回数据格式
        return returnResponse(0,'删除成功',true);
    }

    /**
     * 名  称 : adminEdit()
     * 功  能 : 执行修改管理员操作
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token      => '用户标识';
     * 输  入 : (string) $roleString => '职位标识字符串，逗号隔开';
     * 输  出 : {"errNum":0,"retMsg":"设置成功","retData":true}
     * 创  建 : 2018/06/20 06:20
     */
    public function adminEdit($token,Request $request)
    {
        // 获取职位数据
        $roleString = $request->put('roleString');
        // 验证数据
        if(!$roleString) return returnResponse(1,'请选择职位');
        // 引入Service逻辑层数据
        $admin = (new AdminService())->editRight($token,$roleString);
        // 判断是否设置成功
        if($admin['msg']=='error') return returnResponse(2,$admin['data']);
        // 返回接口响应数据
        return returnResponse(0,'设置成功',$admin['data']);
    }
}