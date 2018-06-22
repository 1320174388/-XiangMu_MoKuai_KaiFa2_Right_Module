<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  right_v2_sql.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/22 18:52
 *  文件描述 :  数据库表迁移文件，删除/创建模块应用表
 *  历史记录 :  -----------------------
 */
    $config = [
        'host'      => '127.0.0.1',          // 数据库地址
        'port'      => '3306',               // 数据库端口
        'database'  => 'dlth_xm_v1',         // 数据库名称
        'charset'   => 'utf8',               // 设置字符集
        'user'      => 'root',               // 用户名称
        'password'  => '',                   // 用户密码
    ];

    $table = [
        'adminApply' => 'dlth_data_admin_applys', // 管理员申请表
        'adminList'  => 'dlth_data_admin_lists',  // 管理员表
    ];

	$date     =  date('Y-m-d H:i:s',time());

	// 连接数据库
    $server  = 'mysql:host='.$config['host'].';';

    $server .= 'port='.$config['port'].';';

    $server .= 'dbname='.$config['database'].';';

    $server .= 'charset='.$config['charset'].';';

    $pdo = new pdo($server,$config['user'],$config['password']);
	
	// 开启事务
	$pdo->beginTransaction();
	
	try{

	    // 删除管理员申请表
	    $pdo->exec('drop table '.$table['adminApply'].';');
	    echo '
删除 '.$table['adminApply'].' 管理员申请表
';
        // 删除管理员表
        $pdo->exec('drop table '.$table['adminList'].';');
        echo '删除 '.$table['adminList'].' 管理员表
';
        // 创建管理员申请表
		$pdo->exec('create table '.$table['adminApply'].'(
			apply_token varchar(50) primary key,
            apply_name varchar(50),
			apply_phone varchar(50) unique,
			apply_time varchar(50)
		);');
		echo '
创建 '.$table['adminApply'].' 管理员申请表
';
        // 创建管理员表
        $pdo->exec('create table '.$table['adminList'].'(
            admin_token varchar(50) primary key,
            admin_name varchar(50),
            admin_phone varchar(50) unique,
            admin_time varchar(50)
        );');
        echo '创建 '.$table['adminList'].' 管理员表
';
		// 添加成功
		$pdo->commit();
		echo '
success
';

    }catch(PDOException $e){
    	// 添加失败
    	$pdo->rollback();
        echo $e->getMessage();
    }   
    