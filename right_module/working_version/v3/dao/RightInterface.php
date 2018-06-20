<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/18 10:21
 *  文件描述 :  获取、添加、修改、删除权限信息
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\dao;

interface RightInterface{

    /**
     * 名  称 : RightSelect()
     * 功  能 : 声明：获取权限列表数据
     * 创  建 : 2018/06/18 12:40
     */
    public function RightSelect();

    /**
     * 名  称 : RightCreate()
     * 功  能 : 声明：添加权限列表数据
     * 输  入 : (string) $rightName  => '权限名称';
     * 输  入 : (string) $rightRoute => '权限路由';
     * 创  建 : 2018/06/18 12:40
     */
    public function RightCreate($rightName,$rightRoute);

    /**
     * 名  称 : RightUpdate()
     * 功  能 : 声明：修改权限列表数据
     * 输  入 : (string) $index => '权限列表主键';
     * 输  入 : (string) $rightName  => '权限名称';
     * 输  入 : (string) $rightRoute => '权限路由';
     * 创  建 : 2018/06/18 12:40
     */
    public function RightUpdate($index,$rightName,$rightRoute);

    /**
     * 名  称 : RightDelete()
     * 功  能 : 声明：删除权限列表数据
     * 输  入 : (string) $index => '权限列表主键';
     * 创  建 : 2018/06/18 12:40
     */
    public function RightDelete($index);
}