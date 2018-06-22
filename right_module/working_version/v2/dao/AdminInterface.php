<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/16 13:09
 *  文件描述 :  获取、添加、修改、删除管理员信息
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v2\dao;

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
     * 创  建 : 2018/06/16 13:43
     */
    public function adminCreate($applyInfo);

    /**
     * 名  称 : adminDelete()
     * 功  能 : 声明：删除管理员用户数据
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 创  建 : 2018/06/16 13:45
     */
    public function adminDelete($token);
}
