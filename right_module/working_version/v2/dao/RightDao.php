<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightDao.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/15 22:18
 *  文件描述 :  用户权限控制器
 *  历史记录 :  -----------------------
 */

namespace app\right_module\working_version\v2\dao;
use app\right_module\working_version\v2\model\RightModel;

class RightDao
{

    /**
     * 名  称 : rightCreate()
     * 功  能 : 添加管理员申请
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 创  建 : 2018/06/18 09:38
     */
    public function rightCreate($data)
    {
        //生成TokEn
        $str  = 'abcdefghijklmnopqrstuvwxyz';
        $str .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str .= '_123456789';

        $newStr = '';
        for( $i = 0; $i < 32; $i++) {
            $newStr .= $str[mt_rand(0,strlen($str)-1)];
        }
        $newStr .= time().mt_rand(100000,999999);

        $res = new RightModel();
        $res->rightInit();
        $res->apply_token = $newStr;
        $res->apply_name  = $data;
        $res->apply_phone = $data;
        $res->apply_time = time();
        $res->save();


        return returnData('success',true);

    }


    /**
     * 名  称 : centerCre()
     * 功  能 : 查询管理员申请
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 创  建 : 2018/06/18 09:38
     */
    public function centerCre($center)
    {
        $cen = new RightModel();
        $cen->RightTable();
        $cen->find();
        return returnData('success',true);
    }



    /**
     * 名  称 : plusCreate()
     * 功  能 : 添加管理员
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 创  建 : 2018/06/18 09:38
     */
    public function plusCreate($plus)
    {
        //生成TokEn
        $str  = 'abcdefghijklmnopqrstuvwxyz';
        $str .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str .= '_123456789';

        $newStr = '';
        for( $i = 0; $i < 32; $i++) {
            $newStr .= $str[mt_rand(0,strlen($str)-1)];
        }
        $newStr .= time().mt_rand(100000,999999);

        //添加管理员
        $res = new RightModel();
        $res->PuleInit();
        $res->admin_token = $newStr;
        $res->admin_name  = $plus;
        $res->admin_phone = $plus;
        $res->admin_time  = time();
        $res->save();


        return returnData('success',true);
    }

    /**
     * 名  称 : plusDel()
     * 功  能 : 删除管理员
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 创  建 : 2018/06/19 21:57
     */
    public function plusDel($plusdel)
    {
        $del = new RightModel();
        $del->PuleInit();
        $del->delete();
        return returnData('success',true);
    }


    /**
     * 名  称 : powerDel()
     * 功  能 : 删除职位
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 创  建 : 2018/06/19 22:25
     */
    public function powerDel($power)
    {
        $add = new RightModel();
        $add->PowerAdd();
        $add->delete();
        return returnData('success',true);
    }


    /**
     * 名  称 : powerAll()
     * 功  能 : 查找全部职位
     * 变  量 : --------------------------------------
     * 输  入 :
     * 输  出 :
     * 创  建 : 2018/06/19 22:31
     */
    public function powerAll($power)
    {
        $add = new RightModel();
        $add->PowerAdd();
        $add->all();
        return returnData('success',true);
    }
}  