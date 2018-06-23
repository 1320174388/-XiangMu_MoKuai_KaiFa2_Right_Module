<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  right_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/23 18:42
 *  文件描述 :  权限模块路由地址
 *  历史记录 :  -----------------------
 */

// +------------------------------------------------------
// : 传值方式：GET 路由功能：返回无权限数据
// +------------------------------------------------------
Route::get(
    'v2/right_module/return_right',
    'right_module/v1.controller.ReturnController/returnRight'
);

// +------------------------------------------------------
// : 传值方式：GET 路由功能：判断用户是不是管理员
// +------------------------------------------------------
Route::get(
    'v2/right_module/is_admin/:token',
    'right_module/v1.controller.AdminController/adminGetInif'
);