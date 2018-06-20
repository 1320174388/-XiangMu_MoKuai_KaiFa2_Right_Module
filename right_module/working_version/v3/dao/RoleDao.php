<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/19 16:16
 *  文件描述 :  操作职位数据表数据
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\dao;
use app\right_module\working_version\v3\model\RoleModel;
use app\right_module\working_version\v3\library\RightLibrary;
use think\Db;

class RoleDao implements RoleInterface
{
    /**
     * 名  称 : RoleSelect()
     * 功  能 : 声明：获取职位列表数据
     * 创  建 : 2018/06/16 13:50
     */
    public function RoleSelect()
    {
        // 获取所有职位数据
        $allData = RoleModel::all();
        // 验证数据
        if(!$allData) return returnData('error');
        // 返回数据
        return returnData('success',$allData);
    }

    /**
     * 名  称 : RoleNameSelect()
     * 功  能 : 声明：获取对应职位数据列表数据
     * 创  建 : 2018/06/19 22:36
     */
    public function RoleNameSelect($roleName)
    {
        // 获取对应职位数据
        $res = RoleModel::where('role_name',$roleName)->find();
        // 验证数据
        if(!$res) return returnData('error');
        // 返回数据
        return returnData('success',$res);
    }

    /**
     * 名  称 : RoleCreate()
     * 功  能 : 声明：添加职位列表数据
     * 输  入 : (string) $roleName => '职位名称';
     * 输  入 : (string) $roleInfo => '职位介绍';
     * 输  入 : (string) $rightArr => '权限数组';
     * 创  建 : 2018/06/16 13:52
     */
    public function RoleCreate($roleName,$roleInfo,$rightArr)
    {
        // 启动事务
        Db::startTrans();
        try {
            // 实例化模型
            $roleModel = new RoleModel;
            // 生成index主键
            $index = (new RightLibrary)->RightToken();
            // 处理数据
            $roleModel->role_index = $index;
            $roleModel->role_name  = $roleName;
            $roleModel->role_info  = $roleInfo;
            // 写入数据
            $res = $roleModel->save();
            // 验证数据
            if(!$res) return returnData('error');
            // 获取添加职位数据
            $role = RoleModel::get($index);
            // 处理权限
            $arr = [];
            foreach($rightArr as $v){ $arr[] = $v; }
            // 执行写入权限操作
            $right = $role->rights()->saveAll($arr);
            // 验证数据
            if(!$right) return returnData('error');
            Db::commit();
            // 返回数据格式
            return returnData('success',true);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            // 验证数据
            return returnData('error');
        }
    }

    /**
     * 名  称 : RoleUpdate()
     * 功  能 : 声明：修改职位列表数据
     * 输  入 : (string) $index     => '职位标识';
     * 输  入 : (string) $roleName => '职位名称';
     * 输  入 : (string) $roleInfo => '职位介绍';
     * 输  入 : (string) $rightArr => '权限数组';
     * 创  建 : 2018/06/16 13:52
     */
    public function RoleUpdate($index,$roleName,$roleInfo,$rightArr)
    {
        // 启动事务
        Db::startTrans();
        try {
            // 获取添加职位数据
            $role = RoleModel::get($index);
            // 处理数据
            $role->role_name  = $roleName;
            $role->role_info  = $roleInfo;
            // 保存数据
            $role->save();
            // 处理权限
            $arr = [];
            foreach($rightArr as $v){ $arr[] = $v;}
            // 获取表明
            $table = config('v3_tableName.RoleRight');
            // 删除原关联
            $dd = Db::table($table)->where('role_index',$index)->delete();
            if(!$dd) return  returnData('error');
            // 执行写入权限操作
            $right = $role->rights()->saveAll($arr);
            // 验证数据
            if(!$right) return returnData('error');
            Db::commit();
            // 返回数据格式
            return returnData('success',true);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            // 验证数据
            return returnData('error');
        }
    }

    /**
     * 名  称 : RoleDelete()
     * 功  能 : 声明：删除职位列表数据
     * 输  入 : (string) $index => '职位列表主键';
     * 创  建 : 2018/06/16 13:54
     */
    public function RoleDelete($index)
    {
        // 获取表明
        $table = config('v3_tableName.AdminRole');
        // 获取关联
        $dd = Db::table($table)->where('role_index',$index)->find();
        // 验证数据
        if($dd) return returnData('error','职位已被使用');
        // 启动事务
        Db::startTrans();
        try {
            // 删除职位数据
            $role = RoleModel::get($index)->delete();
            if(!$role) return  returnData('error','删除失败');
            // 获取表明
            $table = config('v3_tableName.RoleRight');
            // 删除原关联
            $dd = Db::table($table)->where('role_index',$index)->delete();
            if(!$dd) return  returnData('error','删除失败');
            Db::commit();
            // 返回数据格式
            return returnData('success',true);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            // 验证数据
            return returnData('error','删除失败');
        }
    }
}