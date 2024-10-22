<?php

// +----------------------------------------------------------------------
// | Admin Plugin for ThinkAdmin
// +----------------------------------------------------------------------
// | 版权所有 2014~2024 ThinkAdmin [ thinkadmin.top ]
// +----------------------------------------------------------------------
// | 官方网站: https://thinkadmin.top
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// | 免责声明 ( https://thinkadmin.top/disclaimer )
// +----------------------------------------------------------------------
// | gitee 代码仓库：https://gitee.com/zoujingli/think-plugs-admin
// | github 代码仓库：https://github.com/zoujingli/think-plugs-admin
// +----------------------------------------------------------------------

declare(strict_types=1);

namespace app\cyh;

use think\admin\Plugin;

/**
 * 插件服务注册
 * @class Service
 * @package app\admin
 */
class Service extends Plugin
{
    /**
     * 定义插件名称
     * @var string
     */
    protected $appName = '天命西游';

    /**
     * 定义安装包名
     * @var string
     */
    protected $package = 'zoujingli/think-plugs-admin';

    /**
     * 定义插件中心菜单
     * @return array
     */
    public static function menu(): array
    {
        return [
            [
                'name' => '系统配置',
                'subs' => [

                    ['name' => '系统菜单管理', 'icon' => 'layui-icon layui-icon-layouts', 'node' => 'admin/menu/index'],
                ],
            ],
            [
                'name' => '权限管理',
                'subs' => [
                    ['name' => '开新服2024', 'icon' => 'layui-icon layui-icon-username', 'node' => 'cyh/draw/index'],
                ],
            ],
        ];
    }
}