<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleRight.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/19 19:42
 *  文件描述 :  职位权限关联表数据模型
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v3\model;
use think\model\Pivot;

class RoleRight extends Pivot
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 加载配置数据表名
    protected function initialize()
    {
        parent::initialize();
        $this->table = config('v3_tableName.RoleRight');
    }
}