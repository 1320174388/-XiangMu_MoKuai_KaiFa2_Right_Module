<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  UserDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/21 14:43
 *  文件描述 :  获取最高管理员用户信息
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\dao;
use app\right_module\working_version\v3\model\UserModel;

class UserDao implements UserInterface
{
    /**
     * 名  称 : UserSelect()
     * 功  能 : 获取最高管理员用户信息
     * 创  建 : 2018/06/21 14:43
     */
    public function UserSelect()
    {
        // 获取用户表第一个人的数据
        $user = UserModel::get(1);
        // 验证数据
        if(!$user) return returnData('error');
        // 返回数据
        return returnData('success',$user);
    }
}