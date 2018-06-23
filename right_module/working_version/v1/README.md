Right_Module : 权限管理模块目录
===============

> 模块基于ThinkPHP5.1目录开发，以项目开发基础目录为标准

## 目录结构

~~~
├─right_module                      模块目录
│  ├─config                         配置目录
│  │  ├─v1_tableName.php            数据表配置文件
│  │  └─ ...                        更多配置
│  ├─working_version                工作版本目录
│  │  ├─v1                          版本1目录
│  │  │  ├─controller               控制器目录
│  │  │  ├─dao                      数据持久层目录
│  │  │  ├─model                    模型目录
│  │  │  ├─service                  逻辑层目录
│  │  │  ├─README.md                版本说明文件
│  │  │  ├─right_route_v1_api.php   版本路由文件
│  │  │  └─Right_v1_IsAdmin.php.php 执行验证的中间件
│  │  ├─v2                          版本2目录
│  │  ├─v3                          版本3目录
│  │  └─ ...                        更多版本目录      
│  └─common.php                     模块函数文件
├─README.md                         模块说明文件
~~~

## 模块使用说明：
### `文件：/right_module/config/v1_tableName.php`
### `说明：修改表名为项目使用的表名`
<br/>
### `文件：/right_module/working_version/v1/right_route_v1_api.php`
### `说明：保存到项目 /route 目录下,路由自动生效`
<br/>
### `文件：/right_module/working_version/v2/Right_v1_IsAdmin.php`
### `说明：验证是不是管理员的中间件，如使用请参考ThinkPHP5.1中间件使用`
### `使用：保存文件到，项目目录 /application/http/middleware/ 目录下`
<br/>
## v2版本接口说明：唯一权限用户

### `功能：判断用户是不是管理员`
### `传值：get`
### `接口：/v2/right_module/is_admin/:token`
### `响应：{"errNum":0,"retMsg":"请求成功","retData":true}`
### `响应：{"errNum":1,"retMsg":"请求失败","retData":false}`