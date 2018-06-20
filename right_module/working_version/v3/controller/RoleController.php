<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/19 15:44
 *  文件描述 :  职位管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\controller;
use think\Controller;
use think\Request;
use app\right_module\working_version\v3\service\RoleService;

class RoleController extends Controller
{
    /**
     * 名  称 : roleAdd()
     * 功  能 : 执行添加职位操作
     * 变  量 : --------------------------------------
     * 输  入 : (string) $roleName  => '职位名称';
     * 输  入 : (string) $roleInfo  => '职位介绍';
     * 输  入 : (string) $rightStr => '权限主键集合字符串，逗号隔开主键';
     * 输  出 : {"errNum":0,"retMsg":"添加成功","retData":true}
     * 创  建 : 2018/06/19 15:49
     */
    public function roleAdd(Request $request)
    {
        // 获取传值
        $roleName  = $request->post('roleName');
        $roleInfo  = $request->post('roleInfo');
        $rightStr  = $request->post('rightStr');
        // 验证数据
        if(!$roleName) return returnResponse(1,'请输入职位名称');
        if(!$rightStr) return returnResponse(2,'请选择权限');
        if(!$roleInfo) $roleInfo = '';
        // 引入RoleService逻辑
        $res = (new RoleService)->addRole($roleName,$roleInfo,$rightStr);
        // 验证返回数据
        if($res['msg']=='error') return returnResponse(3,$res['data']);
        // 返回数据
        return returnResponse(0,'添加成功',true);
    }

    /**
     * 名  称 : roleGet()
     * 功  能 : 执行获取职位操作
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":true}
     * 创  建 : 2018/06/19 22:32
     */
    public function roleGet()
    {
        // 引入RoleService逻辑
        $res = (new RoleService)->getRole();
        // 验证返回数据
        if($res['msg']=='error') return returnResponse(1,'请求失败');
        // 返回数据
        return returnResponse(0,'请求成功',$res['data']);
    }


    /**
     * 名  称 : roleEdit()
     * 功  能 : 执行修改职位操作
     * 变  量 : --------------------------------------
     * 输  入 : (string) $index     => '职位标识';
     * 输  入 : (string) $roleName  => '职位名称';
     * 输  入 : (string) $roleInfo  => '职位介绍';
     * 输  入 : (string) $rightStr => '权限主键集合字符串，逗号隔开主键';
     * 输  出 : {"errNum":0,"retMsg":"更新成功","retData":true}
     * 创  建 : 2018/06/19 15:49
     */
    public function roleEdit($index,Request $request)
    {
        // 获取传值
        $roleName  = $request->put('roleName');
        $roleInfo  = $request->put('roleInfo');
        $rightStr  = $request->put('rightStr');
        // 验证数据
        if(!$roleName) return returnResponse(1,'请输入职位名称');
        if(!$rightStr) return returnResponse(2,'请选择权限');
        if(!$roleInfo) $roleInfo = '';
        // 引入RoleService逻辑
        $res=(new RoleService)->editRole($index,$roleName,$roleInfo,$rightStr);
        // 验证返回数据
        if($res['msg']=='error') return returnResponse(3,$res['data']);
        // 返回数据
        return returnResponse(0,'更新成功',true);
    }

    /**
     * 名  称 : roleDel()
     * 功  能 : 删除职位操作
     * 变  量 : --------------------------------------
     * 输  入 : (string) $index     => '职位标识';
     * 输  出 : {"errNum":0,"retMsg":"删除成功","retData":true}
     * 创  建 : 2018/06/19 15:49
     */
    public function roleDel($index)
    {
        // 引入RoleService逻辑
        $res=(new RoleService)->delRole($index);
        // 验证返回数据
        if($res['msg']=='error')return returnResponse(1,$res['data']);
        // 返回数据
        return returnResponse(0,'删除成功',true);
    }

}