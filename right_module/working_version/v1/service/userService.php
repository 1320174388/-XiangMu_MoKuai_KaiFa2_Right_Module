<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  userService.php
 *  创 建 者 :  feng
 *  创建日期 :  2018/06/15 16:24
 *  文件描述 :  处理用户的业务逻辑
 *  历史记录 :  -----------------------
 */

namespace app\right_module\working_version\v1\service;
use app\right_module\working_version\v1\dao\UserInfoDao;

class userService
{
    /**
     * 名  称 : rootService()
     * 功  能 : 超级管理
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token => $token 用户标识
     * 输  出 :
     * 创  建 : 2018/06/15 15:16
     */
    public function rootService($token)
    {
       $res = (new UserInfoDao())->rootDao($token);
       return returnData('success',$res['data']);
    }
    /**
     * 名  称 : userMain()
     * 功  能 : 获取用户等级
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token => $token 用户标识
     * 输  出 :
     * 创  建 : 2018/06/15 15:16
     */
    public function userMain($token)
    {
        $UserInfoDao = new UserInfoDao();
        $res = $UserInfoDao->userFind($token);
        $level = $UserInfoDao->queryUser($res['user_level']);
        return $level;
    }
    /**
     * 名  称 : addUserInfo()
     * 功  能 : 添加管理员
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token => $token，(int) $level => $level;
     * 输  出 :
     * 创  建 : 2018/06/15 15:16
     */
    public function addUserInfo($token,$level)
    {
        $res = (new UserInfoDao())->createUser($token,$level);
        if (!$res['data']){
            return returnData('error','此用户已经是管理员');
        }else{
            (new UserInfoDao())->deletApplyData($token);
            return returnData('success','添加成功');
        }
    }
    /**
     * 名  称 : applyAdministrators()
     * 变  量 : --------------------------------------
     * 功  能 : 申请管理员列表
     * 输  入 : (int) $level = 权限等级
     * 输  出 :
     * 创  建 : 2018/06/15 15:16
     */
    public function applyAdministrators($level)
    {
        //判断管理员权限
        if ($level == 1){
           $data = (new UserInfoDao())->applyList();
           return returnData('success',$data);

        }else{
            return returnData('error','没有权限');
        }
    }
    /**
     * 名  称 : applyAdministrators()
     * 功  能 : 管理员列表
     * 变  量 : --------------------------------------
     * 输  入 : (int) $level = 权限等级
     * 输  出 :
     * 创  建 : 2018/06/17 00:16
     */
    public function applyAdmin($level)
    {
        //判断管理员权限
        if ($level == 1){
            $data = (new UserInfoDao())->adminDao();
            return returnData('success',$data);

        }else{
            return returnData('error','没有权限');
        }
    }
    /**
     * 名  称 : addApplyService()
     * 功  能 : 添加到申请表
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token = 用户标识 $postData = 用户数据
     * 输  出 :
     * 创  建 : 2018/06/16 18:16
     */
    public function addApplyService($token,$postData)
    {
        $data = new UserInfoDao();
        $res = $data->addApplyTable($token,$postData);
        if ($res['msg'] == 'success'){
            return returnData('success',true);
        }else{
            return returnData('error',false);
        }

    }
    /**
     * 名  称 : deletApplyService()
     * 功  能 : 删除管理员
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token = 用户标识
     * 输  出 :
     * 创  建 : 2018/06/17 22:16
     */
    public function deletApplyService($token)
    {
       $res = (new UserInfoDao)->deletApplyUser($token);
       if ($res['data']){
           return returnData('success',true);
       }else{
           return returnData('error',false);
        }
    }
}