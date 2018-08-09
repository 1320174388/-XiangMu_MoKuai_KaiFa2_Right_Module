<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  wx_config.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/12 16:57
 *  文件描述 :  模块配置文件
 *  历史记录 :  -----------------------
 */
return [
    // 小程序AppID
    'wx_AppID'     => 'wx211a9e6c3c091db4',
    // 小程序AppSecret秘钥
    'wx_AppSecret' => '43be5e180ff4cac6089c9765797c2096',
    // 用户登录请求OpenId接口地址
    'wx_LoginUrl'  => 'https://api.weixin.qq.com/sns/jscode2session',
    // 获取小程序全局的Access_Token地址URL
    'wx_Access_Token' => 'https://api.weixin.qq.com/cgi-bin/token',
    // 发送模版消息接口地址
    'wx_Push_Url' => 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send',
    // 审核通过提醒 模板ID
    'wx_Push_Adopt'  => 'wWG1PX1WEjjJBd7183tKPugXHP-bd4A52eXBhJqVnr4',
    // 审核未通过提醒 模板ID
    'wx_Push_Not_Through'  => '1paxJaT24_3zjLMKxnxeN2TG5MhzuqhZX9ibC-1xep4'
];