<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/15 18:22
 *  文件描述 :  权限管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\controller;
use think\Controller;
use think\Request;
use app\right_module\working_version\v3\service\RightService;

class RightController extends Controller
{
    /**
     * 名  称 : rightAddRoute()
     * 功  能 : 执行添加权限操作
     * 变  量 : --------------------------------------
     * 输  入 : (string) $rightName  => '权限名称';
     * 输  入 : (string) $rightRoute => '权限路由';
     * 输  出 : {"errNum":0,"retMsg":"添加成功","retData":true}
     * 创  建 : 2018/06/18 09:43
     */
    public function rightAddRoute(Request $request)
    {
        // 获取传值
        $rightName  = $request->post('rightName');
        $rightRoute = $request->post('rightRoute');
        // 验证数据
        if(!$rightName)  return returnResponse(1,'请输入权限名称');
        if(!$rightRoute) return returnResponse(2,'请输入权限路由');
        // 引入Service逻辑层代码
        $res = (new RightService())->rightAdd($rightName,$rightRoute);
        if($res['msg']=='error') return returnResponse(3,$res['data']);
        // 返回数据
        return returnResponse(0,'添加成功',true);
    }

    /**
     * 名  称 : rightGetRoute()
     * 功  能 : 获取所有权限信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":true}
     * 创  建 : 2018/06/19 13:51
     */
    public function rightGetRoute()
    {
        // 引入Service逻辑层代码
        $res = (new RightService())->rightGet();
        if($res['msg']=='error') return returnResponse(1,'当前没有添加权限');
        // 返回数据
        return returnResponse(0,'请求成功',$res['data']);
    }

    /**
     * 名  称 : rightDelRoute()
     * 功  能 : 删除权限信息
     * 变  量 : --------------------------------------
     * 输  入 : (string) $index => '权限标识';
     * 输  出 : {"errNum":0,"retMsg":"删除成功","retData":true}
     * 创  建 : 2018/06/19 13:51
     */
    public function rightDelRoute(Request $request)
    {
        // 获取传值
        $index = $request->put('index');
        // 验证数据
        if( !$index ) return returnResponse(1,'请输入权限标识');
        // 引入Service逻辑层代码
        $res = (new RightService())->rightDel($index);
        if($res['msg']=='error') return returnResponse(1,$res['data']);
        // 返回数据
        return returnResponse(0,'删除成功',$res['data']);
    }

    /**
     * 名  称 : rightEditRoute()
     * 功  能 : 删除权限信息
     * 变  量 : --------------------------------------
     * 输  入 : (string) $index      => '权限标识';
     * 输  入 : (string) $rightName  => '权限名称';
     * 输  入 : (string) $rightRoute => '权限路由';
     * 输  出 : {"errNum":0,"retMsg":"更新成功","retData":true}
     * 创  建 : 2018/06/19 13:51
     */
    public function rightEditRoute(Request $request)
    {
        // 获取传值
        $index      = $request->put('index');
        $rightName  = $request->put('rightName');
        $rightRoute = $request->put('rightRoute');
        // 验证数据
        if( !$index )    return returnResponse(1,'请输入权限标识');
        if(!$rightName)  return returnResponse(1,'请输入权限名称');
        if(!$rightRoute) return returnResponse(2,'请输入权限路由');
        // 引入Service逻辑层代码
        $res = (new RightService())->rightEdit($index,$rightName,$rightRoute);
        if($res['msg']=='error') return returnResponse(3,'更新失败');
        // 返回数据
        return returnResponse(0,'更新成功',true);
    }
}