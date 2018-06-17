<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  right_v3_sql.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/15 12:43
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
        'rightList'  => 'dlth_data_right_lists',  // 权限表
        'roleList'   => 'dlth_data_role_lists',   // 职位表
        'adminRole'  => 'dlth_index_admin_roles', // 管理_职位_关联表
        'roleRight'  => 'dlth_index_role_rights', // 职位_权限_关联表
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
        // 删除权限表
        $pdo->exec('drop table '.$table['rightList'].';');
        echo '删除 '.$table['rightList'].' 权限表
';
        // 删除职位表
        $pdo->exec('drop table '.$table['roleList'].';');
        echo '删除 '.$table['roleList'].' 职位表
';
        // 删除管理~职位~关联表
        $pdo->exec('drop table '.$table['adminRole'].';');
        echo '删除 '.$table['adminRole'].' 管理_职位_关联表
';
        // 职位_权限_关联表
        $pdo->exec('drop table '.$table['roleRight'].';');
        echo '删除 '.$table['roleRight'].' 职位_权限_关联表
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
        // 创建权限表
        $pdo->exec('create table '.$table['rightList'].'(
            right_index varchar(50) primary key,
            right_name varchar(50) unique,
            right_route varchar(50)
        );');
        echo '创建 '.$table['rightList'].' 权限表
';
        // 创建职位表
        $pdo->exec('create table '.$table['roleList'].'(
            role_index varchar(50) primary key,
            role_name varchar(50) unique,
            role_info text(500)
        );');
        echo '创建 '.$table['roleList'].' 职位表
';
        // 创建管理_职位_关联表
        $pdo->exec('create table '.$table['adminRole'].'(
            admin_token varchar(50),
            role_index varchar(50)
        );');
        echo '创建 '.$table['adminRole'].' 管理_职位_关联表
';
        // 创建职位_权限_关联表
        $pdo->exec('create table '.$table['roleRight'].'(
            role_index varchar(50),
            right_index varchar(50)
        );');
        echo '创建 '.$table['roleRight'].' 职位_权限_关联表
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
    