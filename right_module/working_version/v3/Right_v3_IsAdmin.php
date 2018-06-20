<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  Right_v3_IsAdmin.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/20 22:01
 *  文件描述 :  v3_权限管理模块中间件
 *  历史记录 :  -----------------------
 */
namespace app\http\middleware;
use app\right_module\working_version\v3\model\UserModel;
use app\right_module\working_version\v3\model\AdminModel;
use think\Request;

class Right_v3_IsAdmin
{
    /**
     * 名  称 : handle()
     * 功  能 : 权限认证中间件
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token => '用户标识';
     * 输  出 : {"errNum":102,"retMsg":"权限不足","retData":false}
     * 创  建 : 2018/06/20 06:20
     */
    public function handle(Request $request, \Closure $next)
    {
        // 获取用户标识
        $token = $request->param('token');
        // 获取最高权限的第一个小程序用户
        $user  = UserModel::get(1);
        // 判断是不是管理员
        $admin = AdminModel::get($token);
        // 判断是否有权限
        if (($token!=$user['user_token'])||(!$admin)) {
            return redirect('v3/right_module/return_right');
        }
        // 执行控制器代码
        return $next($request);
    }
}
