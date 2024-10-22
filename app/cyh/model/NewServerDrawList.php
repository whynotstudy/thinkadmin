<?php

// +----------------------------------------------------------------------
// | Library for ThinkAdmin
// +----------------------------------------------------------------------
// | 版权所有 2014~2024 ThinkAdmin [ thinkadmin.top ]
// +----------------------------------------------------------------------
// | 官方网站: https://thinkadmin.top
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// | 免费声明 ( https://thinkadmin.top/disclaimer )
// +----------------------------------------------------------------------
// | gitee 仓库地址 ：https://gitee.com/zoujingli/ThinkLibrary
// | github 仓库地址 ：https://github.com/zoujingli/ThinkLibrary
// +----------------------------------------------------------------------

declare (strict_types=1);

namespace app\cyh\model;

use think\admin\Model;

/**
 * 开新服2024模型
 * @class NewServerDrawList
 * @package think\admin\model
 */
class NewServerDrawList extends Model
{
    protected $createTime = 'add_time';
    protected $updateTime = false;

    /**
     * 日志名称
     * @var string
     */
    protected $oplogName = '开新服2024';

    /**
     * 日志类型
     * @var string
     */
    protected $oplogType = '开新服2024';

    /**
     * 获取指定数据列表
     * @param string $type 数据类型
     * @param array $data 外围数据
     * @param string $field 外链字段
     * @param string $bind 绑定字段
     * @return array
     */
    public static function items(string $type, array &$data = [], string $field = 'base_code', string $bind = 'base_info'): array
    {
        $map = ['id' => $type, 'status' => 1, 'deleted' => 0];
        $bases = static::mk()->where($map)->order('id asc')->column('id,mid,name,content', 'id');
        if (count($data) > 0) foreach ($data as &$vo) $vo[$bind] = $bases[$vo[$field]] ?? [];
        return $bases;
    }

    /**
     * 获取所有数据类型
     * @param boolean $simple 加载默认值
     * @return array
     */
    public static function types(bool $simple = false): array
    {
        $types = static::mk()->where(['deleted' => 0])->distinct()->column('goods_name');
        if (empty($types) && empty($simple)) $types = ['财神的钱袋（绑）500金币'];
        return $types;
    }

    /**
     * 格式化创建时间
     * @param mixed $value
     * @return string
     */
    public function getCreateAtAttr($value): string
    {
        return format_datetime($value);
    }
}