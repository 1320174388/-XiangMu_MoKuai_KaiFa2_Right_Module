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
│  │  ├─v2                          版本2目录
│  │  ├─v3                          版本3目录
│  │  │  ├─controller               控制器目录
│  │  │  ├─dao                      数据持久层目录
│  │  │  ├─library                  自定义类目目录
│  │  │  ├─model                    模型目录
│  │  │  ├─service                  逻辑层目录
│  │  │  ├─README.md                版本说明文件
│  │  │  ├─right_route_v3_api.php   版本路由文件
│  │  │  ├─right_v3_sql.php.php     可执行数据库迁移文件
│  │  │  ├─wx_config.php            模块配置文件
│  │  │  └─Right_v3_IsAdmin.php.php 执行验证的中间件
│  │  └─ ...                        更多版本目录      
│  └─common.php                     模块函数文件
├─README.md                         模块说明文件
~~~

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
### `文件：/right_module/working_version/v3/right_v3_sql.php`
### `说明：需要修改配置数组信息，对应项目的数据表名，库名`
### `使用：执行命令 php right_v3_sql.php 自动生成数据表`
<br/>
### `文件：/right_module/working_version/v3/Right_v3_IsAdmin.php`
### `说明：验证是不是管理员的中间件，如使用请参考ThinkPHP5.1中间件使用`
### `使用：保存文件到，项目目录 /application/http/middleware/ 目录下`
<br/>
### `文件：/right_module/working_version/v3/wx_config.php`
### `说明：V3版本配置信息文件`
### `使用：保存文件到，项目目录 /config/ 目录下,在配置信息内部，有管理员审核发送模板消息逻辑，请找到模板消息代码，进行处理。改成对应项目的模板消息ID以及需要信息处理、
`