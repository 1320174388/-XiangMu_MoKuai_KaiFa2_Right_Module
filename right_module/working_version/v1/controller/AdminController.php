<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/23 10:57
 *  文件描述 :  管理员添加控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\controller;
use think\Controller;
use app\right_module\working_version\v1\service\AdminService;

class AdminController extends Controller
{
    /**
     * 名  称 : adminGetInif()
     * 功  能 : 获取单个管理员数据
     * 输  入 : (string) $token => '用户标识';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":true}
     * 创  建 : 2018/06/23 13:45
     */
    public function adminGetInif($token)
    {
        // 获取单个管理员数据
        $res = (new AdminService())->getUserAdmin($token);
        // 验证数据逻辑
        if($res['msg']=='error') return returnResponse(1,'请求失败');
        // 返回数据格式
        return returnResponse(0,'请求成功',true);
    }
}