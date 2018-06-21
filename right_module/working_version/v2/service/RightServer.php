<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightService.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/15 22:33
 *  文件描述 :
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v2\service;

use app\right_module\working_version\v2\dao\RightDao;
class RightServer
{
    /**
     * 名  称 : rightInit()
     * 功  能 : 添加管理员申请
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 输  出 :
     * 创  建 : 2018/06/18 09:15
     */

    public function rightInit($data)
    {
        // 添加管理员到申请列表
        $res = (new RightDao)->rightCreate($data);
        if($res['msg']=='error'){
            return returnData('error');
        }

        return returnData('success',$res);
    }

    /**
     * 名  称 : checkedInit()
     * 功  能 : 查询管理员申请
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 输  出 :
     * 创  建 : 2018/06/18 09:16
     */

    public function checkedInit($content)
    {
        // 查询管理员申请表
        $content = (new RightDao())->centerCre($content);

        return returnData('success',$content);
    }


    /**
     * 名  称 : plusInit()
     * 功  能 : 添加管理员
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 输  出 :
     * 创  建 : 2018/06/18 09:17
     */
    public function plusInit($plus)
    {
        // 添加管理员
        $plus = (new RightDao())->plusCreate($plus);

        return returnData('success',$plus);
    }

    /**
     * 名  称 : plusDel()
     * 功  能 : 删除管理员
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 输  出 :
     * 创  建 : 2018/06/19 21:54
     */
    public function plusDel($pluedel)
    {
        // 删除管理员
        $plusdel = (new RightDao())->plusDel($pluedel);

        return returnData('success',$plusdel);
    }

    /**
     * 名  称 : powerAdd()
     * 功  能 : 添加职位
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 输  出 :
     * 创  建 : 2018/06/19 22:20
     */
    public function powerAdd($power)
    {
        // 删除管理员
        $power = (new RightDao())->powerAdd($power);

        return returnData('success',$power);
    }


    /**
     * 名  称 : powerDel()
     * 功  能 : 删除职位
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 输  出 :
     * 创  建 : 2018/06/19 22:25
     */
    public function powerDel($power)
    {
        // 删除管理员
        $power = (new RightDao())->powerDel($power);

        return returnData('success',$power);
    }

    /**
     * 名  称 : powerAll()
     * 功  能 : 查找全部职位
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 输  出 :
     * 创  建 : 2018/06/19 22:31
     */
    public function powerAll($power)
    {
        // 删除管理员
        $power = (new RightDao())->powerAll($power);

        return returnData('success',$power);
    }

    
}