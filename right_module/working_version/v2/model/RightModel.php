<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightModel.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/15 22:31
 *  文件描述 :
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v2\model;
use think\Model;


class RightModel extends Model
{
    protected $table;
    public function RightTable()
    {
        $this->table = config('v2_tableName.RightTable');
        return $this;
    }

    public function PuleInit()
    {
        $this->table = config('v2_tableName.PuleInit');
        return $this;
    }

    public function powerAdd()
    {
        $this->table = config('v2_tableName.powerAdd');
        return $this;
    }
}