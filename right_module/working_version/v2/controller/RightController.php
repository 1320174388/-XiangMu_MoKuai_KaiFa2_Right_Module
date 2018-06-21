<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightController.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/15 22:18
 *  文件描述 :  用户权限控制器
 *  历史记录 :  -----------------------
 */

namespace app\right_module\working_version\v2\controller;
use think\Controller;
use app\right_module\working_version\v2\service\RightServer;
class RightController extends Controller
{
    /*
     *  名      称:  rightInit
     *  功      能:  管理员申请
     *  输      入:
     *  输      出:
    */
    public function rightInit($data)
    {
        // 调用RightServer逻辑
        $data = (new RightServer())->rightInit($data);

        if ($data['msg'] == 'error') {
            return returnResponse('error', '添加失败');
        }
        // 返回数据格式
        return returnResponse(0, '添加成功');
    }


    /*
     *  名      称:  checkInit
     *  功      能:  查询管理员申请表
     *  输      入:
     *  输      出:
    */
    public function checkInit($content)
    {
        // 调用RightServer逻辑
        $content = (new RightServer())->checkedInit($content);

        return returnResponse(0, $content['data']);
    }


    /*
     *  名      称:  plusInit
     *  功      能:  添加管理员
     *  输      入:
     *  输      出:
    */
    public function plusInit($plus)
    {
        // 调用RightServer逻辑
        $plus = (new RightServer())->plusInit($plus);
        // 返回数据格式
        return returnResponse(0, '添加管理员成功');
    }

    /*
     *  名      称:  plusdel
     *  功      能:  删除管理员
     *  输      入:
     *  输      出:
    */
    public function plusDel($pluedel)
    {
        // 调用LoginService逻辑
        $authority = (new RightServer())->plusDel($pluedel);
        // 返回数据格式D
        return returnResponse(0, '删除成功');
    }

    /*
     *  名      称:  powerAdd
     *  功      能:  添加职位
     *  输      入:
     *  输      出:
    */
    public function powerAdd($power)
    {
        // 调用LoginService逻辑
        $power = (new RightServer())->powerAdd($power);
        // 返回数据格式D
        return returnResponse(0, '添加职位成功');
    }

    /*
     *  名      称:  powerDel
     *  功      能:  删除职位
     *  输      入:
     *  输      出:
    */
    public function powerDel($power)
    {
        // 调用LoginService逻辑
        $power = (new RightServer())->powerDel($power);
        // 返回数据格式
        return returnResponse(0, '删除职位成功');
    }

    /*
     *  名      称:  powerAll
     *  功      能:  删除职位
     *  输      入:
     *  输      出:
    */
    public function powerAll($power)
    {
        // 调用LoginService逻辑
        $power = (new RightServer())->powerAll($power);
        // 返回数据格式
        return returnResponse(0, '删除职位成功');
    }

    
}
