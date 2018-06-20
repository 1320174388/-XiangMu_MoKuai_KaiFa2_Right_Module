<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/19 15:57
 *  文件描述 :  处理职位的业务逻辑
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\service;
use app\right_module\working_version\v3\dao\RoleDao;

class RoleService
{
    /**
     * 名  称 : addRole()
     * 功  能 : 执行添加职位信息逻辑
     * 输  入 : (string) $roleName => '职位名称';
     * 输  入 : (string) $roleInfo => '职位介绍';
     * 输  入 : (string) $rightStr => '权限主键集合字符串，逗号隔开主键';
     * 输  出 : [ 'msg'=>'success','data'=>true ]
     * 创  建 : 2018/06/18 06:58
     */
    public function addRole($roleName,$roleInfo,$rightStr)
    {
        // 处理权限数据,将权限字符串数据转换为数组
        $rightArr = explode(',',$rightStr);
        // 获取对应职位名称数据
        $data = (new RoleDao())->RoleNameSelect($roleName);
        if($data['msg']=='success')  return returnData('error','职位已存在');
        // 引入RoleDao数据层
        $res = (new RoleDao())->RoleCreate($roleName,$roleInfo,$rightArr);
        if($res['msg']=='error') return returnData('error','添加失败');
        // 返回数据
        return returnData('success',true);
    }

    /**
     * 名  称 : getRole()
     * 功  能 : 获取所有职位信息
     * 输  入 : (string) $roleName => '职位名称';
     * 输  入 : (string) $roleInfo => '职位介绍';
     * 输  入 : (string) $rightStr => '权限主键集合字符串，逗号隔开主键';
     * 输  出 : [ 'msg'=>'success','data'=>true ]
     * 创  建 : 2018/06/18 06:58
     */
    public function getRole()
    {
        // 获取所有职位数据
        $data = (new RoleDao)->RoleSelect();
        // 验证数据
        if($data['msg']=='error') return returnData('error');
        // 返回数据
        return returnData('success',$data['data']);
    }

    /**
     * 名  称 : editRole()
     * 功  能 : 修改职位信息
     * 输  入 : (string) $index     => '职位标识';
     * 输  入 : (string) $roleName  => '职位名称';
     * 输  入 : (string) $roleInfo  => '职位介绍';
     * 输  入 : (string) $rightStr => '权限主键集合字符串，逗号隔开主键';
     * 输  出 : [ 'msg'=>'success','data'=>true ]
     * 创  建 : 2018/06/19 23:59
     */
    public function editRole($index,$roleName,$roleInfo,$rightStr)
    {
        // 处理权限数据,将权限字符串数据转换为数组
        $rightArr = explode(',',$rightStr);
        // 获取对应职位名称数据
        $data = (new RoleDao())->RoleNameSelect($roleName);
        if(($data['msg']=='success')&&($data['data']['role_index']!=$index))
            return returnData('error','职位已存在');
        // 引入RoleDao数据层
        $res=(new RoleDao())->RoleUpdate($index,$roleName,$roleInfo,$rightArr);
        if($res['msg']=='error') return returnData('error','更新失败');
        // 返回数据
        return returnData('success',true);
    }

    /**
     * 名  称 : delRole()
     * 功  能 : 删除职位信息
     * 输  入 : (string) $index     => '职位标识';
     * 输  出 : [ 'msg'=>'success','data'=>true ]
     * 创  建 : 2018/06/19 23:59
     */
    public function delRole($index)
    {
        // 删除对应职位名称数据
        $res = (new RoleDao())->RoleDelete($index);
        // 验证是否删除
        if($res['msg']=='error') return returnData('error',$res['data']);
        // 返回数据
        return returnData('success',true);
    }
}