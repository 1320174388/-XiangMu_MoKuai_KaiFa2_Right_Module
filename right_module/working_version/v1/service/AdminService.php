<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/23 10:57
 *  文件描述 :  处理管理员的业务逻辑
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\service;
use app\right_module\working_version\v1\dao\UserDao;

class AdminService
{
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
        if($user['msg']=='error') return returnData('error');
        // 验证数据
        if($token==$user['data']['user_token'])
        return returnData('success',$user['data']);
        // 返回数据
        return returnData('error');
    }
}