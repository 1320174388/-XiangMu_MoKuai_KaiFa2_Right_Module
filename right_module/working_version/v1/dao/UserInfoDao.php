<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  UserInfoDao.php
 *  创 建 者 :  feng
 *  创建日期 :  2018/06/15 17:54
 *  文件描述 :  操作用户数据表
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;
use app\right_module\working_version\v1\model\XcxUserInfo as modelUserInfo;
use app\right_module\working_version\v1\model\XcxUserPower as modelUserPower;
use app\right_module\working_version\v1\model\XcxUserApply as modelUserApply;
class UserInfoDao
{
    /**
     * 名  称 : rootDao()
     * 功  能 : 添加超级管理员
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token => 用户$token;
     * 输  出 :
     * 创  建 : 2018/06/15 15:16
     */
    public function rootDao($token)
    {
       $isRoot = (new modelUserInfo())->where('user_level',1)->find();

        if ($isRoot){
            return returnData('error','只能有一个超级管理员');
        }else{
            $res = modelUserInfo::where('user_token',$token)->find();
            if ($res){
                modelUserInfo::where('user_token',$token)->update(['user_level'=>1]);
            }else{
                modelUserInfo::create([
                    'user_token'    => $token,
                    'user_level'    => 1
                ],false);
            }

            return returnData('success',true);
        }

    }
    /**
     * 名  称 : userFind()
     * 功  能 : 声明：获取用户数据
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token => 用户$token;
     * 输  出 :
     * 创  建 : 2018/06/15 15:16
     */
    public function userFind($token)
    {
        $res = modelUserInfo::where('user_token',$token)->find();
        return $res;
    }
    /**
     * 名  称 : queryUser()
     * 功  能 : 声明：获取用户权限
     * 变  量 : --------------------------------------
     * 输  入 : (int) $level => $level;
     * 输  出 :
     * 创  建 : 2018/06/15 15:16
     */
    public function queryUser($level)
    {

        $res = modelUserPower::where('user_level',$level)->field('user_name,user_level')->find();
        return $res;
    }
    /**
     * 名  称 : createUser()
     * 功  能 : 添加到管理员表
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token => 'token' $level => '申请等级';
     * 输  出 :
     * 创  建 : 2018/06/15 22:16
     */
    public function createUser($token,$level)
    {
       $hasToken = modelUserInfo::where('user_token',$token)->find();
       if ($hasToken){
           return returnData('error');
       }else{
          $applyData = modelUserApply::where('user_token',$token)->find();
          $applyData['user_token'] = $token;
          $applyData['user_level'] = $level;
           $res =  modelUserInfo::create($applyData->toArray(),false);
           if ($res){
               return returnData('success',$res);
           }else{
               return returnData('error',$res);
           }
       }
    }
    /**
     * 名  称 : applyList()
     * 功  能 : 获取申请管理员列表
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 创  建 : 2018/06/16 17:16
     */
    public function applyList()
    {
        $data = modelUserApply::all();
        if ($data){
           return returnData('success',$data);
        }else{
            return returnData('error');
        }
    }
    /**
     * 名  称 : adminDao()
     * 功  能 : 获取管理员列表
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 创  建 : 2018/06/17 22:16
     */
   public function adminDao()
   {
       $data =modelUserInfo::all();
       if ($data){
           return returnData('success',$data);
       }else{
           return returnData('error');
       }
   }
    /**
     * 名  称 : addApplyTable()
     * 功  能 : 添加申请管理员
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token = 用户标识 $name = 用户昵称
     * 输  出 :
     * 创  建 : 2018/06/16 18:16
     */
    public function addApplyTable($token,$postData)
    {
        $isToken = modelUserApply::where('user_token',$token)->find();
        $isApply = modelUserInfo::where('user_token',$token)->find();
       if ($isToken || $isApply){
           return returnData('error',false);
       }else{
           $postData['user_token'] = $token;
           $postData['time'] =  ''.time().'';
           modelUserApply::create($postData,false);
           return returnData('success',true);
       }

    }
    /**
     * 名  称 : deletApplyData()
     * 功  能 : 删除申请管理员
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token = 用户标识
     * 输  出 :
     * 创  建 : 2018/06/16 18:16
     */
    public function deletApplyData($token)
    {
        $res = modelUserApply::where('user_token',$token)->delete();
        if ($res){
            return returnData('success',true);
        }else{
            return returnData('error',false);
        }
    }
    /**
     * 名  称 : deletApplyUser()
     * 功  能 : 删除管理员
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token = 用户标识
     * 输  出 :
     * 创  建 : 2018/06/16 18:16
     */
    public function deletApplyUser($token)
    {
        $res = modelUserInfo::where('user_token',$token)->delete();
        if ($res){
            return returnData('success',true);
        }else{
            return returnData('error',false);
        }
    }
}