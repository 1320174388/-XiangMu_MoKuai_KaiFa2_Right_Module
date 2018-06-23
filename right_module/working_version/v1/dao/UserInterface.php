<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  UserInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/21 14:43
 *  文件描述 :  获取最高管理员用户信息
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;

interface UserInterface{

    /**
     * 名  称 : UserSelect()
     * 功  能 : 获取最高管理员用户信息
     * 创  建 : 2018/06/21 14:43
     */
    public function UserSelect();
}