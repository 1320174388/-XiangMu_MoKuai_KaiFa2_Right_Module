<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ApplySerivce.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/22 19:01
 *  文件描述 :  处理管理员申请的业务逻辑
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v2\service;
use app\right_module\working_version\v2\dao\ApplyDao;
use app\right_module\working_version\v2\dao\AdminDao;

class ApplyService
{
    /**
     * 名  称 : rightApply()
     * 功  能 : 执行用户申请管理员操作
     * 输  入 : (string) $token => '用户标识';
     * 输  入 : (string) $name  => '用户名称';
     * 输  入 : (string) $phone => '用户电话';
     * 输  出 : [ 'msg'=>'success' , 'data'=>$info['data'] ]
     * 输  出 : [ 'msg'=>'error'   , 'data'=>false ]
     * 创  建 : 2018/06/22 19:03
     */
    public function rightApply($token,$name,$phone)
    {
        // 引入RightDao层数据结构
        $applyInfo = new ApplyDao();
        $adminInfo = new AdminDao();

        // 查看申请表是否有当先用户信息
        $result = $applyInfo->applySelect($token);
        if($result['msg']=='success') return returnData('error');

        // 查看管理员表是否有当前用户信息
        $user = $adminInfo->adminSelect($token);
        if($user['msg']=='success') return returnData('error');

        // 添加管理员申请数据库信息
        $info = $applyInfo->applyCreate($token,$name,$phone);
        if($info['msg']=='error') return returnData('error');

        // 返回数据
        return returnData('success',$info['data']);
    }

    /**
     * 名  称 : applyData()
     * 功  能 : 获取所有申请成为管理员的用户信息
     * 输  入 : (string) $token => '用户标识';
     * 输  出 : [ 'msg'=>'success' , 'data'=>$list['data'] ]
     * 输  出 : [ 'msg'=>'error'   , 'data'=>false ]
     * 创  建 : 2018/06/22 19:03
     */
    public function applyData($token='')
    {
        // 获取管理员数据
        $data = (new ApplyDao)->applySelect($token);
        // 判断是否有数据
        if($data['msg']=='error') return returnData('error');
        // 返回数据格式
        return returnData('success',$data['data']);
    }
}