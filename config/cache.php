<?php

// +----------------------------------------------------------------------
// | Static Plugin for ThinkAdmin
// +----------------------------------------------------------------------
// | 版权所有 2014~2024 ThinkAdmin [ thinkadmin.top ]
// +----------------------------------------------------------------------
// | 官方网站: https://thinkadmin.top
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// | 免责声明 ( https://thinkadmin.top/disclaimer )
// +----------------------------------------------------------------------
// | gitee 代码仓库：https://gitee.com/zoujingli/think-plugs-static
// | github 代码仓库：https://github.com/zoujingli/think-plugs-static
// +----------------------------------------------------------------------

return [
    // 默认缓存驱动
    'default' => env('cache.type', 'file'),
    //'default' => env('cache.type','redis'),
    // 缓存连接配置
    'stores'  => [
        'file'  => [
            // 驱动方式
            'type'       => 'File',
            // 缓存保存目录
            'path'       => '',
            // 缓存名称前缀
            'prefix'     => '',
            // 缓存有效期 0 表示永久缓存
            'expire'     => 0,
            // 缓存标签前缀
            'tag_prefix' => 'tag:',
            // 序列化机制
            'serialize'  => [],
        ],
        'safe'  => [
            // 驱动方式
            'type'       => 'File',
            // 缓存保存目录
            'path'       => syspath('safefile/cache/'),
            // 缓存名称前缀
            'prefix'     => '',
            // 缓存有效期 0 表示永久缓存
            'expire'     => 0,
            // 缓存标签前缀
            'tag_prefix' => 'tag:',
            // 序列化机制
            'serialize'  => [],
        ],
        'redis' => [
            // 驱动方式
            'type'     => 'redis',
            'host'     => env('cache.redis_hostname', '81.70.135.124'),
            'port'     => env('cache.redis_hostport', 6379),
            'password' => env('cache.redis_password', 'ccc258369'),
            'select'   => env('cache.redis_select', 0),
        ]
    ],
];