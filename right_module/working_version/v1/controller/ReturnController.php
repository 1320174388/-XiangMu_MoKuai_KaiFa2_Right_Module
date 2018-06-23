<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ReturnController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/23 10:57
 *  文件描述 :  无权限返回数据控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\controller;
use think\Controller;

class ReturnController extends Controller
{
    /**
     * 名  称 : returnRight()
     * 功  能 : 返回无权限数据
     * 输  出 : {"errNum":102,"retMsg":"权限不足","retData":false}
     * 创  建 : 2018/06/22 18:53
     */
    public function returnRight()
    {
        // 返回无权限数据
        return returnResponse(102,'权限不足');
    }
}