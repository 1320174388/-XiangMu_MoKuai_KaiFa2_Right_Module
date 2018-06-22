<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ApplyDao.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/22 19:01
 *  文件描述 :  操作模型，获取用户删除用户申请表数据
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v2\dao;
use  app\right_module\working_version\v2\model\ApplyModel;

class ApplyDao implements ApplyInterface
{
    /**
     * 名  称 : applySelect()
     * 功  能 : 声明：获取管理员申请表用户数据
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 输  出 : [ 'msg'=>'success', 'data'=>$user ]
     * 输  出 : [ 'msg'=>'error'  , 'data'=>false ]
     * 创  建 : 2018/06/22 19:03
     */
    public function applySelect($token='')
    {
        // 获取用户数据
        if( $token == '' ){
            $user = ApplyModel::all();
        }else{
            $user = ApplyModel::where('apply_token',$token)->find();
        }
        // 判断数据
        if(!$user) return returnData('error');
        // 返回数据
        return returnData('success',$user);
    }

    /**
     * 名  称 : applyCreate()
     * 功  能 : 声明：添加管理员申请表用户数据
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 输  入 : (string) $name  => '用户名称';
     * 输  入 : (string) $phone => '用户电话';
     * 输  出 : [ 'msg'=>'success', 'data'=>true ]
     * 输  出 : [ 'msg'=>'error'  , 'data'=>false ]
     * 创  建 : 2018/06/22 19:03
     */
    public function applyCreate($token,$name,$phone)
    {
        // 实例化数据库模型
        $applyModel = new ApplyModel;
        // 处理数据
        $applyModel->apply_token = $token;
        $applyModel->apply_name  = $name;
        $applyModel->apply_phone = $phone;
        $applyModel->apply_time  = time();
        // 写入数据库
        $res = $applyModel->save();
        // 判断是否写入成功
        if(!$res){
            return returnData('error');
        }
        // 返回数据
        return returnData('success',true);
    }

    /**
     * 名  称 : applyDelete()
     * 功  能 : 声明：删除管理员申请表用户数据
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 输  出 : [ 'msg'=>'success', 'data'=>true ]
     * 创  建 : 2018/06/22 19:03
     */
    public function applyDelete($token)
    {
        // 删除管理员申请数据
        $res = ApplyModel::get($token)->delete();
        // 判断是否删除成功
        if($res)return returnData('success',true);
    }
}