<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/16 13:09
 *  文件描述 :  获取、添加、修改、删除管理员信息
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\dao;

interface AdminInterface{

    /**
     * 名  称 : adminSelect()
     * 功  能 : 声明：获取管理员用户数据
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 创  建 : 2018/06/16 13:42
     */
    public function adminSelect($token);

    /**
     * 名  称 : adminCreate()
     * 功  能 : 声明：添加管理员用户数据
     * 输  入 : (object) $applyInfo => '管理员申请数据对象';
     * 输  入 : (string) $roleArr   => '权限数组';
     * 创  建 : 2018/06/16 13:43
     */
    public function adminCreate($applyInfo,$roletArr);

    /**
     * 名  称 : adminUpdate()
     * 功  能 : 声明：修改管理员用户数据
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 输  入 : (string) $roletArr => '职位数组';
     * 创  建 : 2018/06/16 13:44
     */
    public function adminUpdate($token,$roletArr);

    /**
     * 名  称 : adminDelete()
     * 功  能 : 声明：删除管理员用户数据
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 创  建 : 2018/06/16 13:45
     */
    public function adminDelete($token);

    /**
     * 名  称 : adminRoute()
     * 功  能 : 声明：获取管理员权限
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 创  建 : 2018/06/16 13:45
     */
    public function adminRoute($token);

}
