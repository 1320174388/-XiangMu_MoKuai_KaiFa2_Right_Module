<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ApplyController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/19 15:28
 *  文件描述 :  管理员申请控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\controller;
use think\Controller;
use think\Request;
use app\right_module\working_version\v3\service\ApplyService;

class ApplyController extends Controller
{
    /**
     * 名  称 : applyList()
     * 功  能 : 获取管理员申请列表数据
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"申请表数据"}
     * 创  建 : 2018/06/16 21:18
     */
    public function applyList()
    {
        // 引入逻辑代码，获取管理员信息
        $res = (new ApplyService())->applyData();
        // 判断是否有数据
        if($res['msg']=='error')return returnResponse(1,'请求失败');
        // 返回数据
        return returnResponse(0,'请求成功',$res['data']);
    }

    /**
     * 名  称 : applyInit()
     * 功  能 : 执行用户申请管理员操作
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token => '用户标识';
     * 输  入 : (string) $name  => '用户名称';
     * 输  入 : (string) $phone => '用户电话';
     * 输  出 : {"errNum":0,"retMsg":"申请成功","retData":true}
     * 创  建 : 2018/06/16 09:43
     */
    public function applyInit(Request $request)
    {
        // 获取前端提交的用户申请数据
        $token = $request->post('userToken');
        $name  = $request->post('applyName');
        $phone = $request->post('applyPhone');
        // 传值参数
        if(!$token)return returnResponse(1,'没有发送用户身份标识');
        if(!$name) return returnResponse(2,'请输入姓名');
        // 验证电话号码
        if((!$phone)||(!is_numeric($phone))||(strlen($phone)!=11))
            return returnResponse(3,'请正确输入电话');
        // 引入逻辑代码，执行用户申请操作
        $res = (new ApplyService())->rightApply($token,$name,$phone);
        // 判断用户是否申请成功
        if($res['msg']=='error')return returnResponse(4,'已申请管理员');
        if($res['msg']=='error')return returnResponse(5,'申请失败');
        // 返回接口响应数据
        return returnResponse(0,'申请成功',$res['data']);
    }
}