<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  right_route_v3_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/16 21:03
 *  文件描述 :  权限模块路由地址
 *  历史记录 :  -----------------------
 */

// +------------------------------------------------------
// : 传值方式：GET 路由功能：返回无权限数据
// +------------------------------------------------------
Route::get(
    'v3/right_module/return_right',
    'right_module/v3.controller.ReturnController/returnRight'
);

// +------------------------------------------------------
// : 传值方式：POST 路由功能：执行用户申请管理员功能
// +------------------------------------------------------
Route::post(
    'v3/right_module/apply_init',
    'right_module/v3.controller.ApplyController/applyInit'
);

// +------------------------------------------------------
// : 传值方式：GET 路由功能：判断用户是不是管理员
// +------------------------------------------------------
Route::get(
    'v3/right_module/is_admin/:token',
    'right_module/v3.controller.AdminController/adminGetInif'
);

// +------------------------------------------------------
// : 路由分组：v3/right_module/ 中间件：Right_v3_IsAdmin
// +------------------------------------------------------
Route::group('v3/right_module/', function(){
    /**
     * 传值方式：GET 路由功能：获取管理员可管理权限
     */
    Route::get(
        'admin_right/:token',
        'right_module/v3.controller.AdminController/adminGetRoute'
    );
    /**
     * 传值方式：GET 路由功能：获取管理员申请表数据
     */
    Route::get(
        'apply_list','right_module/v3.controller.ApplyController/applyList'
    );
    /**
     * 传值方式：POST 路由功能：执行添加管理员操作
     */
    Route::post(
        'admin_init/:applyToken',
        'right_module/v3.controller.AdminController/adminInit'
    );
    /**
     * 传值方式：GET 路由功能：获取所有管理员数据
     */
    Route::get(
        'admin_route','right_module/v3.controller.AdminController/adminGet'
    );
    /**
     * 传值方式：PUT 路由功能：执行修改管理员职位
     */
    Route::put(
        'admin_route/:token',
        'right_module/v3.controller.AdminController/adminEdit'
    );
    /**
     * 传值方式：DELETE 路由功能：执行删除管理员操作
     */
    Route::delete(
        'admin_route/:token',
        'right_module/v3.controller.AdminController/adminDel'
    );
    /**
     * 传值方式：POST 路由功能：执行添加权限操作
     */
    Route::post(
        'right_route',
        'right_module/v3.controller.RightController/rightAddRoute'
    );
    /**
     * 传值方式：GET 路由功能：获取所有权限操作
     */
    Route::get(
        'right_route',
        'right_module/v3.controller.RightController/rightGetRoute'
    );
    /**
     * 传值方式：PUT 路由功能：更新index对应权限
     */
    Route::put(
        'right_route/:index',
        'right_module/v3.controller.RightController/rightEditRoute'
    );
    /**
     * 传值方式：DELETE 路由功能：删除index对应权限
     */
    Route::delete(
        'right_route/:index',
        'right_module/v3.controller.RightController/rightDelRoute'
    );
    /**
     * 传值方式：POST 路由功能：添加职位
     */
    Route::post(
        'role_route',
        'right_module/v3.controller.RoleController/roleAdd'
    );
    /**
     * 传值方式：GET 路由功能：获取所有职位信息
     */
    Route::get(
        'role_route',
        'right_module/v3.controller.RoleController/roleGet'
    );
    /**
     * 传值方式：PUT 路由功能：获取所有职位信息
     */
    Route::put(
        'role_route/:index',
        'right_module/v3.controller.RoleController/roleEdit'
    );
    /**
     * 传值方式：DELETE 路由功能：删除职位信息
     */
    Route::delete(
        'role_route/:index',
        'right_module/v3.controller.RoleController/roleDel'
    );
})->middleware('Right_v3_IsAdmin');