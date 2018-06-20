<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/16 13:48
 *  文件描述 :  获取、添加、修改、删除职位信息
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\dao;

interface RoleInterface{

    /**
     * 名  称 : RoleSelect()
     * 功  能 : 声明：获取职位列表数据
     * 创  建 : 2018/06/16 13:50
     */
    public function RoleSelect();

    /**
     * 名  称 : RoleCreate()
     * 功  能 : 声明：添加职位列表数据
     * 输  入 : (string) $roleName => '职位名称';
     * 输  入 : (string) $roleInfo => '职位介绍';
     * 输  入 : (string) $rightStr => '权限主键集合字符串，逗号隔开主键';
     * 创  建 : 2018/06/16 13:52
     */
    public function RoleCreate($roleName,$roleInfo,$rightStr);

    /**
     * 名  称 : RoleUpdate()
     * 功  能 : 声明：修改职位列表数据
     * 输  入 : (string) $index => '职位列表主键';
     * 创  建 : 2018/06/16 13:52
     */
    public function RoleUpdate($index,$roleName,$roleInfo,$rightStr);

    /**
     * 名  称 : RoleDelete()
     * 功  能 : 声明：删除职位列表数据
     * 输  入 : (string) $index => '职位列表主键';
     * 创  建 : 2018/06/16 13:54
     */
    public function RoleDelete($index);
}