## 模块使用说明：

#### 1、超级管理员接口
>####   传值：$token 申请人Token标识，写在url中
>####  接口地址：post:/v1/right_module/root/:token

#### 2、获取用户用户等级
>####   传值：$token 申请人Token标识，写在url中
>####  接口地址：post:/v1/right_module/getPower/:token

#### 3、申请管理员
>####   传值：$token 申请人Token标识，写在url中
>####  接口地址：post:/v1/right_module/addApply/:token

#### 4、同意添加管理员
>####   传值：$token 申请人Token标识，写在url中
>####  接口地址：post:/v1/right_module/powerApply/:token

#### 5、删除管理员
>####   传值：$token 申请人Token标识，写在url中
>####  接口地址：post:/v1/right_module/deletApply/:token

#### 6、申请管理员列表
>####   传值：$level 申请人等级，写在url中
>####  接口地址：post:/v1/right_module/applyAdmin/:level

#### 7、管理员列表
>####   传值：$level 申请人等级，写在url中
>####  接口地址：post:/v1/right_module/applyAdmin/:level

