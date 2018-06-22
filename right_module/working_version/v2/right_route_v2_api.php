<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  right_route_v2_api.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/22 18:42
 *  文件描述 :  权限模块路由地址
 *  历史记录 :  -----------------------
 */

// +------------------------------------------------------
// : 传值方式：GET 路由功能：返回无权限数据
// +------------------------------------------------------
Route::get(
    'v2/right_module/return_right',
    'right_module/v2.controller.ReturnController/returnRight'
);

// +------------------------------------------------------
// : 传值方式：POST 路由功能：执行用户申请管理员功能
// +------------------------------------------------------
Route::post(
    'v2/right_module/apply_init',
    'right_module/v2.controller.ApplyController/applyInit'
);

// +------------------------------------------------------
// : 传值方式：GET 路由功能：判断用户是不是管理员
// +------------------------------------------------------
Route::get(
    'v2/right_module/is_admin/:token',
    'right_module/v2.controller.AdminController/adminGetInif'
);

// +------------------------------------------------------
// : 路由分组：v2/right_module/ 中间件：Right_v3_IsAdmin
// +------------------------------------------------------
Route::group('v2/right_module/', function(){

    /**
     * 传值方式：GET 路由功能：获取管理员申请表数据
     */
    Route::get(
        'apply_list/:token',
        'right_module/v2.controller.ApplyController/applyList'
    );
    /**
     * 传值方式：POST 路由功能：执行添加管理员操作
     */
    Route::post(
        'admin_init/:token',
        'right_module/v2.controller.AdminController/adminInit'
    );
    /**
     * 传值方式：GET 路由功能：获取所有管理员数据
     */
    Route::get(
        'admin_route/:token',
        'right_module/v2.controller.AdminController/adminGet'
    );


    /**
     * 传值方式：DELETE 路由功能：执行删除管理员操作
     */
    Route::delete(
        'admin_route/:token',
        'right_module/v2.controller.AdminController/adminDel'
    );

})->middleware('Right_v3_IsAdmin');