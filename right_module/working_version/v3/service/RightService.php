<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/12 17:24
 *  文件描述 :  处理权限的业务逻辑
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\service;
use app\right_module\working_version\v3\dao\RightDao;

class RightService
{
    /**
     * 名  称 : rightAdd()
     * 功  能 : 执行添加权限信息逻辑
     * 输  入 : (string) $rightName  => '权限名称';
     * 输  入 : (string) $rightRoute => '权限路由';
     * 输  出 : [ 'msg'=>'success' , 'data'=>$list['data'] ]
     * 创  建 : 2018/06/18 06:58
     */
    public function rightAdd($rightName,$rightRoute)
    {
        // 获取当前$rightName权限
        $data = (new RightDao)->RightNameSelest($rightName);
        // 验证是否有数据
        if($data['msg']=='success') return returnData('error','权限已存在');
        // 添加权限
        $res = (new RightDao)->RightCreate($rightName,$rightRoute);
        // 验证是否添加成功
        if($res['msg']=='error') return returnData('error','添加失败');
        // 返回数据格式
        return returnData('success',true);
    }

    /**
     * 名  称 : rightGet()
     * 功  能 : 获取所有权限信息逻辑
     * 输  入 : --------------------------------------
     * 输  出 : [ 'msg'=>'success' , 'data'=>$res['data'] ]
     * 创  建 : 2018/06/18 06:58
     */
    public function rightGet()
    {
        // 获取权限信息
        $res = (new RightDao)->RightSelect();
        // 是否获取到数据
        if($res['msg']=='error') return returnData('error');
        // 返回数据格式
        return returnData('success',$res['data']);
    }

    /**
     * 名  称 : rightDel()
     * 功  能 : 删除权限信息逻辑
     * 输  入 : (string) $index => '权限标识';
     * 输  出 : [ 'msg'=>'success' , 'data'=>$res['data'] ]
     * 创  建 : 2018/06/18 06:58
     */
    public function rightDel($index)
    {
        // 删除要删除的权限数据
        $res = (new RightDao)->RightDelete($index);
        // 是否删除成功
        if($res['msg']=='error') return returnData('error',$res['data']);
        // 返回数据格式
        return returnData('success',true);
    }

    /**
     * 名  称 : rightEdit()
     * 功  能 : 更新权限信息逻辑
     * 输  入 : (string) $index      => '权限标识';
     * 输  入 : (string) $rightName  => '权限名称';
     * 输  入 : (string) $rightRoute => '权限路由';
     * 输  出 : [ 'msg'=>'success' , 'data'=>$res['data'] ]
     * 创  建 : 2018/06/18 06:58
     */
    public function rightEdit($index,$rightName,$rightRoute)
    {
        // 更新$index的权限数据
        $res = (new RightDao)->RightUpdate($index,$rightName,$rightRoute);
        // 是否修改成功
        if($res['msg']=='error') return returnData('error');
        // 返回数据格式
        return returnData('success',true);
    }
}