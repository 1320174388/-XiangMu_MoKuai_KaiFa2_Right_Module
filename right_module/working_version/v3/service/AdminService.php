<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/12 17:24
 *  文件描述 :  处理管理员的业务逻辑
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\service;
use \think\Db;
use app\right_module\working_version\v3\dao\ApplyDao;
use app\right_module\working_version\v3\dao\AdminDao;
use app\right_module\working_version\v3\dao\UserDao;

class AdminService
{
    /**
     * 名  称 : rightAdmin()
     * 功  能 : 执行审核管理员操作
     * 输  入 : (string) $token      => '用户标识';
     * 输  入 : (string) $roleString => '职位标识字符串，逗号隔开';
     * 输  出 : [ 'msg'=>'success' , 'data'=>true ]
     * 创  建 : 2018/06/17 21:57
     */
    public function rightAdmin($token,$roleString)
    {
        // 处理职位数据,将权限字符串数据转换为数组
        $roletArr = explode(',',$roleString);
        // 获取管理员数据
        $data = (new ApplyDao)->applySelect($token);
        if($data['msg']=='error') return returnData('error','没有申请');

        // 启动事务
        Db::startTrans();
        try {
            // 删除管理员申请数据
            (new ApplyDao)->applyDelete($token);
            // 添加管理员
            $admin = (new AdminDao)->adminCreate($data['data'],$roletArr);// 返回数据格式
            if($admin['msg']=='error') return returnData('error','审核失败');
            // 提交事务
            Db::commit();
            // 返回数据格式
            return returnData('success',true);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return returnData('error','审核失败');
        }
    }

    /**
     * 名  称 : getAdmin()
     * 功  能 : 获取所有管理员数据
     * 输  入 : --------------------------------------
     * 输  出 : [ 'msg'=>'success' , 'data'=>$list['data'] ]
     * 创  建 : 2018/06/20 16:46
     */
    public function getAdmin()
    {
        // 获取管理员数据
        $list = (new AdminDao())->adminSelect();
        // 验证数据格式
        if($list['msg']=='error') return  returnData('error');
        // 返回数据
        return returnData('success',$list['data']);
    }

    /**
     * 名  称 : getUserAdmin()
     * 功  能 : 获取单个管理员数据
     * 输  入 : string) $token => '用户标识';
     * 输  出 : [ 'msg'=>'success' , 'data'=>$info['data'] ]
     * 创  建 : 2018/06/20 23:44
     */
    public function getUserAdmin($token)
    {
        // 获取最高管理员数据
        $user = (new UserDao())->UserSelect();
        // 验证数据
        if($user['msg']=='success'){
            if($token==$user['data']['user_token'])
            return returnData('success',$user['data']);
        }
        // 获取管理员数据
        $info = (new AdminDao())->adminSelect($token);
        // 验证数据格式
        if($info['msg']=='error') return  returnData('error');
        // 返回数据
        return returnData('success',$info['data']);
    }

    /**
     * 名  称 : getAdminRoute()
     * 功  能 : 获取管理员可管理的模块信息
     * 输  入 : string) $token => '用户标识';
     * 输  出 : [ 'msg'=>'success' , 'data'=>$route['data'] ]
     * 创  建 : 2018/06/20 23:44
     */
    public function getAdminRoute($token)
    {
        // 获取管理员权限数据
        $route = (new AdminDao())->adminRoute($token);
        // 验证数据格式
        if($route['msg']=='error') return  returnData('error');
        // 返回数据
        return returnData('success',$route['data']);
    }

    /**
     * 名  称 : delAdmin()
     * 功  能 : 执行删除管理员操作
     * 输  入 : (string) $token => '用户标识';
     * 输  出 : [ 'msg'=>'success' , 'data'=>$list['data'] ]
     * 创  建 : 2018/06/20 10:56
     */
    public function delAdmin($token)
    {
        // 获取管理员数据
        $data = (new AdminDao())->adminSelect($token);
        if($data['msg']=='error') return  returnData('error');
        // 删除管理员
        $res = (new AdminDao())->adminDelete($token);
        if($res['msg']=='error') return returnData('error');
        // 返回数据
        return returnData('success');
    }

    /**
     * 名  称 : editRight()
     * 功  能 : 执行修改管理员操作
     * 输  入 : (string) $token      => '用户标识';
     * 输  入 : (string) $roleString => '职位标识字符串，逗号隔开';
     * 输  出 : [ 'msg'=>'success' , 'data'=>$list['data'] ]
     * 创  建 : 2018/06/17 21:57
     */
    public function editRight($token,$roleString)
    {
        // 处理职位数据,将权限字符串数据转换为数组
        $roletArr = explode(',',$roleString);
        // 获取管理员数据
        $data = (new AdminDao)->AdminSelect($token);
        if($data['msg']=='error') return returnData('error','没有此管理员');
        // 修改管理员权限
        $admin = (new AdminDao)->adminUpdate($token,$roletArr);
        // 验证数据格式
        if($admin['msg']=='error') return returnData('error','更新失败');
        // 返回数据格式
        return returnData('success',true);
    }
}