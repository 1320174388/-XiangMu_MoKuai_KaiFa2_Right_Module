<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  right_route_api.php
 *  创 建 者 :  feng
 *  创建日期 :  2018/06/15 16:40
 *  文件描述 :  模块路由地址
 *  历史记录 :  -----------------------
 */
/**
 * 传值方式：POST
 * 传值参数：[ :v => 版本号 ]
 * 路由功能：超级管理员
 */
Route::post(
    'v1/right_module/root/:token',
    'right_module/v1.controller.PowerController/root'
);

/**
 * 传值方式：POST
 * 传值参数：[ :v => 版本号 ]
 * 路由功能：获取用户用户等级
 */
Route::post(
    'v1/right_module/getPower/:token',
    'right_module/v1.controller.PowerController/powerIndex'
);
/**
 * 传值方式：POST
 * 传值参数：[ :v => 版本号 ]
 * 路由功能：申请管理员
 */
Route::post(
    'v1/right_module/addApply/:token',
    'right_module/v1.controller.PowerController/addApply'
);
/**
 * 传值方式：POST
 * 传值参数：[ :v => 版本号 ]
 * 路由功能：同意添加管理员
 */
Route::post(
    'v1/right_module/powerApply/:token',
    'right_module/v1.controller.PowerController/powerApply'
);
/**
 * 传值方式：POST
 * 传值参数：[ :v => 版本号 ]
 * 路由功能：删除管理员
 */
Route::post(
    'v1/right_module/deletApply/:token',
    'right_module/v1.controller.PowerController/deletApply'
);
/**
 * 传值方式：POST
 * 传值参数：[ :v => 版本号 ]
 * 路由功能：申请管理员列表
 */
Route::post(
    'v1/right_module/applyAdmin/:level',
    'right_module/v1.controller.PowerController/applyAdmin'
);
/**
 * 传值方式：POST
 * 传值参数：[ :v => 版本号 ]
 * 路由功能：管理员列表
 */
Route::post(
    'v1/right_module/userAdmin/:level',
    'right_module/v1.controller.PowerController/userAdmin'
);
