<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ApplySerivce.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/12 17:24
 *  文件描述 :  处理管理员申请的业务逻辑
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\service;
use \think\Db;
use app\right_module\working_version\v3\model\UserModel;
use app\right_module\working_version\v3\dao\ApplyDao;
use app\right_module\working_version\v3\dao\AdminDao;
use app\right_module\working_version\v3\library\PushLibrary;

class ApplyService
{
    /**
     * 名  称 : rightApply()
     * 功  能 : 执行用户申请管理员操作
     * 输  入 : (string) $token => '用户标识';
     * 输  入 : (string) $name  => '用户名称';
     * 输  入 : (string) $phone => '用户电话';
     * 输  入 : (string) $formId => '表单ID';
     * 输  出 : [ 'msg'=>'success' , 'data'=>$info['data'] ]
     * 输  出 : [ 'msg'=>'error'   , 'data'=>false ]
     * 创  建 : 2018/06/16 21:50
     */
    public function rightApply($token,$name,$phone,$formId)
    {
        // 引入RightDao层数据结构
        $applyInfo = new ApplyDao();
        $adminInfo = new AdminDao();

        // 查看申请表是否有当先用户信息
        $result = $applyInfo->applySelect($token);
        if($result['msg']=='success') return returnData('error');

        // 查看管理员表是否有当前用户信息
        $user = $adminInfo->adminSelect($token);
        if($user['msg']=='success') return returnData('error');

        // 添加管理员申请数据库信息
        $info = $applyInfo->applyCreate($token,$name,$phone,$formId);
        if($info['msg']=='error') return returnData('error');

        // 返回数据
        return returnData('success',$info['data']);
    }

    /**
     * 名  称 : applyData()
     * 功  能 : 获取所有申请成为管理员的用户信息
     * 输  入 : (string) $token => '用户标识';
     * 输  出 : [ 'msg'=>'success' , 'data'=>$list['data'] ]
     * 输  出 : [ 'msg'=>'error'   , 'data'=>false ]
     * 创  建 : 2018/06/17 06:17
     */
    public function applyData($token='')
    {
        // 获取管理员数据
        $data = (new ApplyDao)->applySelect($token);
        // 判断是否有数据
        if($data['msg']=='error') return returnData('error');
        // 返回数据格式
        return returnData('success',$data['data']);
    }

    /**
     * 名  称 : applyDataDel()
     * 功  能 : 执行管理员删除操作
     * 输  入 : string) $delete['applyToken']  => '管理员申请标识';
     * 输  出 : ['msg'=>'success','data'=>true ]
     * 创  建 : 2018/08/09 09:37
     */
    public function applyDataDel($delete)
    {
        // 获取管理员数据
        $data = (new ApplyDao)->applySelect($delete['applyToken']);
        // 判断是否有数据
        if($data['msg']=='error') return returnData(
            'error','此管理员申请不存在'
        );

        // 获取用户openid
        $user = UserModel::where(
            'user_token',
            $delete['applyToken']
        )->find();
        // 实例化发送模板消息类库
        $pushLibrary = new PushLibrary();
        // 处理模板消息数据
        $data = [
            'touser'           => $user['user_openid'],
            'template_id'      => config('wx_config.wx_Push_Not_Through'),
            'page'             => '/pages/index/index',
            'form_id'          => $data['data']['apply_formid'],
            'data'             => [
                'keyword1'=>['value'=>'申请中春果业管理员'],
                'keyword2'=>['value'=>$data['data']['apply_name']],
                'keyword3'=>['value'=>'未通过'],
                'keyword4'=>['value'=>date('Y-m-d H:i',time())]
            ],
        ];
        // 发送模板消息
        $pushLibrary->sendTemplate($data);

        // 执行管理员删除操作
        $res = (new ApplyDao)->applyDelete($delete['applyToken']);
        // 判断是否删除成功
        if($res['msg']=='error') return returnData(
            'error','删除失败'
        );

        // 返回数据格式
        return returnData('success','删除成功');
    }
}