<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/16 20:12
 *  文件描述 :  操作模型，获取用户删除用户申请表数据
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\dao;
use app\right_module\working_version\v3\model\UserModel;
use app\right_module\working_version\v3\model\AdminModel;
use app\right_module\working_version\v3\model\RightModel;
use think\Db;

class AdminDao implements AdminInterface
{
    /**
     * 名  称 : adminSelect()
     * 功  能 : 声明：获取管理员用户数据
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 输  出 : [ 'msg'=>'success', 'data'=>$user ]
     * 输  出 : [ 'msg'=>'error'  , 'data'=>false ]
     * 创  建 : 2018/06/16 13:42
     */
    public function adminSelect($token='')
    {
        // 获取用户数据
        if( $token == '' ){
            $user = AdminModel::all();
        }else{
            $user = AdminModel::where('admin_token',$token)->find();
        }
        // 判断数据
        if(!$user) return returnData('error');
        // 返回数据
        return returnData('success',$user);
    }

    /**
     * 名  称 : adminCreate()
     * 功  能 : 声明：添加管理员用户数据
     * 输  入 : (object) $applyInfo => '管理员申请数据对象';
     * 输  入 : (string) $roleArr   => '权限数组';
     * 输  出 : [ 'msg'=>'success', 'data'=>$user ]
     * 输  出 : [ 'msg'=>'empty'  , 'data'=>false ]
     * 创  建 : 2018/06/16 13:43
     */
    public function adminCreate($applyInfo,$roletArr)
    {
        // 启动事务
        Db::startTrans();
        try {
            // 实例化管理员数据模型
            $adminModel = new AdminModel;
            // 处理数据
            $adminModel->admin_token = $applyInfo['apply_token'];
            $adminModel->admin_name  = $applyInfo['apply_name'];
            $adminModel->admin_phone = $applyInfo['apply_phone'];
            $adminModel->admin_time  = $applyInfo['apply_time'];
            // 写入数据
            $res = $adminModel->save();
            if(!$res)return returnData('error');
            // 获取添加职位数据
            $role = AdminModel::get($applyInfo['apply_token']);
            // 处理权限
            $arr = [];
            foreach($roletArr as $v){ $arr[] = $v; }
            // 执行写入权限操作
            $roles = $role->roles()->saveAll($arr);
            // 验证数据
            if(!$roles) return returnData('error');
            // 确定事务
            Db::commit();
            // 返回数据
            return returnData('success',$applyInfo);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            // 验证数据
            return returnData('error');
        }
    }

    /**
     * 名  称 : adminUpdate()
     * 功  能 : 声明：修改管理员用户数据
     * 输  入 : (string) $token    => '项目小程序用户标识';
     * 输  入 : (string) $roletArr => '职位数组';
     * 输  出 : [ 'msg'=>'success', 'data'=>$user ]
     * 输  出 : [ 'msg'=>'empty'  , 'data'=>false ]
     * 创  建 : 2018/06/16 13:44
     */
    public function adminUpdate($token,$roletArr)
    {
        // 启动事务
        Db::startTrans();
        try {
            // 获取表明,删除原关联
            $table = config('v3_tableName.AdminRole');
            $dd = Db::table($table)->where('admin_token',$token)->delete();
            if(!$dd) return  returnData('error');
            // 实例化管理员数据模型
            $role = AdminModel::get($token);
            // 处理权限
            $arr = [];
            foreach($roletArr as $v){ $arr[] = $v; }
            // 执行写入权限操作
            $roles = $role->roles()->saveAll($arr);
            // 验证数据
            if(!$roles) return returnData('error');
            // 确定事务
            Db::commit();
            // 返回数据
            return returnData('success',true);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            // 验证数据
            return returnData('error');
        }
    }

    /**
     * 名  称 : adminDelete()
     * 功  能 : 声明：删除管理员用户数据
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 输  出 : [ 'msg'=>'success', 'data'=>true ]
     * 创  建 : 2018/06/16 13:45
     */
    public function adminDelete($token)
    {
        // 启动事务
        Db::startTrans();
        try {
            // 删除管理员
            $res = AdminModel::get($token)->delete();
            if(!$res) return returnData('error');

            // 获取表明,删除原关联
            $table = config('v3_tableName.AdminRole');
            $dd = Db::table($table)->where('admin_token',$token)->delete();
            if(!$dd) return  returnData('error');

            Db::commit();
            // 返回数据
            return returnData('success',true);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            // 验证数据
            return returnData('error');
        }

    }

    /**
     * 名  称 : adminRoute()
     * 功  能 : 声明：获取管理员权限
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 输  出 : [ 'msg'=>'success', 'data'=>true ]
     * 创  建 : 2018/06/21 00:00
     */
    public function adminRoute($token)
    {
        // 获取最高权限的第一个小程序用户
        $user  = UserModel::get(1);
        // 判断是否有权限
        if ($token==$user['user_token']) {
            // 获取最高权限
            $arr = [];
            $arr[] = config('v3_rightConfig.rightRoute');
            // 获取其他权限
            $rightArr  = RightModel::all()->toArray();
            // 合并所有权限
            $newArr = array_merge($arr,$rightArr);
            // 返回数据
            return returnData('success',$newArr);
        }
        // 获取管理员可管理的所有权限
        $config = config('v3_tableName.');
        $arr = Db::field(
            $config['RightTable'].'.right_index,'.
            $config['RightTable'].'.right_name,'.
            $config['RightTable'].'.right_route'
        )
            ->table($config['AdminTable'])
            ->join ($config['AdminRole'],
                $config['AdminTable'].'.admin_token = '.
                $config['AdminRole'].'.admin_token')
            ->join ($config['RoleTable'],
                $config['AdminRole'].'.role_index = '.
                $config['RoleTable'].'.role_index')
            ->join ($config['RoleRight'],
                $config['RoleTable'].'.role_index = '.
                $config['RoleRight'].'.role_index')
            ->join ($config['RightTable'],
                $config['RoleRight'].'.right_index = '.
                $config['RightTable'].'.right_index')
            ->where($config['AdminTable'].'.admin_token','=',$token)
            ->select();
        // 处理数据
        foreach ($arr as $k=>$v){ $arr[$k] = serialize($v); }
        $arr = array_unique($arr);
        foreach ($arr as $k=>$v){ $arr[$k] = unserialize($v); }
        // 返回数据
        return returnData('success',$arr);
    }
}