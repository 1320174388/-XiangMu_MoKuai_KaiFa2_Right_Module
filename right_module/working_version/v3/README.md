Right_Module : 权限管理模块目录
===============

> 模块基于ThinkPHP5.1目录开发，以项目开发基础目录为标准

## 目录结构

~~~

├─right_module                      模块目录
│  ├─config                         配置目录
│  │  ├─v3_tableName.php            数据表配置文件
│  │  ├─v3_rightConfig.php          权限管理模块路由
│  │  └─ ...                        更多配置
│  ├─working_version                工作版本目录
│  │  ├─v1                          版本1目录
│  │  ├─v2                           版本2目录
│  │  ├─v3                          版本3目录
│  │  │  ├─controller               控制器目录
│  │  │  ├─dao                      数据持久层目录
│  │  │  ├─library                  自定义类目目录
│  │  │  ├─model                    模型目录
│  │  │  ├─service                  逻辑层目录
│  │  │  ├─README.md                版本说明文件
│  │  │  ├─right_route_v3_api.php   版本路由文件
│  │  │  ├─right_v1_sql.php.php     可执行数据库迁移文件
│  │  │  └─Right_v3_IsAdmin.php.php 执行验证的中间件
│  │  └─ ...                        更多版本目录      
│  └─common.php                     模块函数文件
├─README.md                         模块说明文件
~~~

<br/>

## 模块使用说明：

### `文件：/right_module/config/v3_tableName.php`
### `说明：修改表名为项目使用的表名`
<br/>
### `文件：/right_module/config/v3_rightConfig.php`
### `说明：修改权限访问地址成为前端书写的路径地址`
<br/>
### `文件：/right_module/working_version/v3/right_route_v3_api.php`
### `说明：保存到项目 /route 目录下,路由自动生效`
<br/>
### `文件：/right_module/working_version/v3/right_route_v3_api.php`
### `说明：需要修改配置数组信息，对应项目的数据表名，库名`
### `使用：执行命令 php right_v1_sql.php 自动生成数据表`
<br/>
### `文件：/right_module/working_version/v3/Right_v3_IsAdmin.php`
### `说明：验证是不是管理员的中间件，如使用请参考ThinkPHP5.1中间件使用`
### `使用：保存文件到，项目目录 /application/http/middleware/ 目录下`

<br/>

## v3版本接口说明：企业权限管理

### `功能：用户申请成为管理员`
### `传值：post`
### `接口：/v3/right_module/apply_init`
### `参数：userToken  => '用户身份标识'`
### `参数：applyName  => '用户名称'`
### `参数：applyPhone => '用户电话'`
### `响应：{"errNum":0,"retMsg":"申请成功","retData":true}
### `响应：{"errNum":1,"retMsg":"没有发送用户身份标识","retData":false}
### `响应：{"errNum":2,"retMsg":"请输入姓名","retData":false}
### `响应：{"errNum":3,"retMsg":"请输入电话","retData":false}
### `响应：{"errNum":4,"retMsg":"已申请管理员","retData":false}
<br/>
### `功能：判断用户是不是管理员`
### `传值：get`
### `接口：/v3/right_module/is_admin/:token`
### `响应：{"errNum":0,"retMsg":"请求成功","retData":true}`
### `响应：{"errNum":1,"retMsg":"请求失败","retData":false}`
<br/>
### `功能：获取管理员可管理的模块信息`
### `传值：get`
### `接口：/v3/right_module/admin_right/:token`
### `参数：token  => '管理员Token标识，写在url中'`
### `响应：{"errNum":0,"retMsg":"请求成功","retData":"数据"}`
### `响应：{"errNum":1,"retMsg":"请求失败","retData":false}`
<br/>
### `功能：获取要申请成为管理员的用户信息`
### `传值：get`
### `接口：/v3/right_module/apply_list`
### `响应：{"errNum":0,"retMsg":"请求成功","retData":"申请表数据"}`
### `响应：{"errNum":1,"retMsg":"请求失败","retData":false}`
<br/>
### `功能：将申请成为管理员的用户，审核通过为管理员`
### `传值：post`
### `接口：/v3/right_module/admin_init/:applyToken`
### `参数：applyToken  => '申请人Token标识，写在url中'`
### `响应：{"errNum":0,"retMsg":"设置成功","retData":true}`
### `响应：{"errNum":1,"retMsg":"已申请管理员","retData":false}`
<br/>
### `功能：获取所有管理员数据`
### `传值：get`
### `接口：/v3/right_module/admin_route`
### `响应：{"errNum":0,"retMsg":"请求成功","retData":"数据"}`
### `响应：{"errNum":1,"retMsg":"请求失败","retData":false}`
<br/>
### `功能：获取职位信息`
### `传值：get`
### `接口：/v3/right_module/role_route`
### `响应：{"errNum":0,"retMsg":"请求成功","retData":"数据"}`
### `响应：{"errNum":1,"retMsg":"请求失败","retData":false}`
<br/>	
### `功能：修改管理员职位信息`
### `传值：put`
### `接口：/v3/right_module/admin_init/:applyToken`
### `参数：token       => '管理员Token标识，写在url中'`
### `参数：roleString  => '职位标识字符串，逗号隔开'`
### `响应：{"errNum":0,"retMsg":"设置成功","retData":true}`
### `响应：{"errNum":1,"retMsg":"请选择职位","retData":false}`
### `响应：{"errNum":2,"retMsg":"设置失败","retData":false}`
<br/>	
### `功能：删除管理员信息`
### `传值：delete`
### `接口：/v3/right_module/admin_route/:token`
### `参数：token       => '管理员Token标识，写在url中'`
### `响应：{"errNum":0,"retMsg":"删除成功","retData":true}`
### `响应：{"errNum":1,"retMsg":"删除失败","retData":false}`
<br/>	
### `功能：获取所有项目管理权限路由信息`
### `传值：get`
### `接口：/v3/right_module/right_route`
### `响应：{"errNum":0,"retMsg":"请求成功","retData":true}`
### `响应：{"errNum":1,"retMsg":"当前没有添加权限","retData":false}`
<br/>	
### `功能：添加职位`
### `传值：post`
### `接口：/v3/right_module/role_route`
### `参数：roleName => '职位名称'`
### `参数：roleInfo => '职位介绍'`
### `参数：rightStr => '权限标识字符串，多个权限用逗号隔开'`
### `响应：{"errNum":0,"retMsg":"添加成功","retData":true}`
### `响应：{"errNum":1,"retMsg":"请输入职位名称","retData":false}`
### `响应：{"errNum":2,"retMsg":"请选择权限","retData":false}`
### `响应：{"errNum":3,"retMsg":"职位已存在","retData":false}`
### `响应：{"errNum":3,"retMsg":"添加失败","retData":false}`
<br/>	
### `功能：获取职位信息`
### `传值：get`
### `接口：/v3/right_module/role_route`
### `响应：{"errNum":0,"retMsg":"请求成功","retData":"数据"}`
### `响应：{"errNum":1,"retMsg":"请求失败","retData":false}`
<br/>	
### `功能：修改职位信息`
### `传值：put`
### `接口：/v3/right_module/role_route`
### `参数：index => '要修改的职位主键：role_index ,写在URL中'`
### `参数：roleName => '职位名称'`
### `参数：roleInfo => '职位介绍'`
### `参数：rightStr => '限标识字符串，多个权限用逗号隔开'`
### `响应：{"errNum":0,"retMsg":"添加成功","retData":true}`
### `响应：{"errNum":1,"retMsg":"请输入职位名称","retData":false}`
### `响应：{"errNum":2,"retMsg":"请选择权限","retData":false}`
### `响应：{"errNum":3,"retMsg":"职位已存在","retData":false}`
### `响应：{"errNum":3,"retMsg":"职位已存在","retData":false}`
<br/>	
### `功能：删除职位信息`
### `传值：delete`
### `接口：/v3/right_module/role_route/:index`
### `参数：index => '要删除的职位主键：role_index ,写在URL中'`
### `响应：{"errNum":0,"retMsg":"删除成功","retData":true}`
### `响应：{"errNum":3,"retMsg":"删除失败","retData":false}`
<br/>	
### `功能：添加项目管理权限，前端开发接口，不给用户使用`
### `传值：post`
### `接口：/v3/right_module/right_route`
### `参数：rightName => '权限名称'`
### `参数：rightRoute => '权限路由'`
### `响应：{"errNum":0,"retMsg":"添加成功","retData":true}`
### `响应：{"errNum":1,"retMsg":"请输入权限名称","retData":false}`
### `响应：{"errNum":2,"retMsg":"请输入权限路由","retData":false}`
### `响应：{"errNum":3,"retMsg":"权限已存在","retData":false}`
### `响应：{"errNum":3,"retMsg":"添加失败","retData":false}`
<br/>	
### `功能： 更新项目管理权限，前端开发接口，不给用户使用`
### `传值：put`
### `接口：/v3/right_module/right_route/:index`
### `参数：index => '要更新的权限主键：right_index ,写在URL中'`
### `参数：rightName => '权限名称'`
### `参数：rightRoute => '权限路由'`
### `响应：{"errNum":0,"retMsg":"更新成功","retData":true}`
### `响应：{"errNum":1,"retMsg":"请输入权限名称","retData":false}`
### `响应：{"errNum":2,"retMsg":"请输入权限路由","retData":false}`
### `响应：{"errNum":3,"retMsg":"更新失败","retData":false}`
<br/>	
### `功能： 删除项目管理权限，前端开发接口，不给用户使用
### `传值：delete`
### `接口：/v3/right_module/right_route/:index`
### `参数：index => '要删除的权限主键：right_index ,写在URL中'`
### `响应：{"errNum":0,"retMsg":"删除成功","retData":true}`
### `响应：{"errNum":1,"retMsg":"权限已被使用","retData":false}`
### `响应：{"errNum":1,"retMsg":"权限删除失败","retData":false}`