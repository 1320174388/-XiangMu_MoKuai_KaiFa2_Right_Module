<?php
/**
 *  版权声明 :  地老天荒科技（北京）有限公司
 *  文件名称 :  right_route_api.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/15 15:42
 *  文件描述 :  模块路由地址
 *  历史记录 :  -----------------------
 */


// 管理员申请表
Route::post(
    'v2/right_init/:data',
    'right_module_v2/v2.controller.RightController/rightInit'
);

//  查询管理员申请表
Route::post(
    'v2/right_check/:content',
    'right_module_v2/v2.controller.RightController/checkInit'
);


//  添加管理员
Route::post(
    'v2/plus_init/:plus',
    'right_module_v2/v2.controller.RightController/plusInit'
);

//  删除管理员
Route::post(
    'v2/plus_del/:pluedel',
    'right_module_v2/v2.controller.RightController/plusDel'
);


//  添加权限
Route::post(
    'v2/power_add/:power',
    'right_module_v2/v2.controller.RightController/powerAdd'
);


//  删除权限
Route::post(
    'v2/power_del/:power',
    'right_module_v2/v2.controller.RightController/powerDel'
);



//  获取权限
Route::post(
    'v2/power_all/:power',
    'right_module_v2/v2.controller.RightController/powerAll'
);