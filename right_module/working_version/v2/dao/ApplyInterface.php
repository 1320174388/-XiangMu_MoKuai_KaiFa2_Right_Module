<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ApplyInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/16 14:25
 *  文件描述 :  获取、添加、删除管理员申请信息
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v2\dao;

interface ApplyInterface{

    /**
     * 名  称 : applySelect()
     * 功  能 : 声明：获取管理员申请表用户数据
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 创  建 : 2018/06/16 13:09
     */
    public function applySelect($token);

    /**
     * 名  称 : applyCreate()
     * 功  能 : 声明：获取管理员申请表用户数据
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 创  建 : 2018/06/16 14:09
     */
    public function applyCreate($token,$name,$phone);

    /**
     * 名  称 : applyDelete()
     * 功  能 : 声明：删除管理员申请表用户数据
     * 输  入 : (string) $token => '项目小程序用户标识';
     * 创  建 : 2018/06/16 13:38
     */
    public function applyDelete($token);

}