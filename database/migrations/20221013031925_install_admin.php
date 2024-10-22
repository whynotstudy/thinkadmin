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

use think\migration\Migrator;

@set_time_limit(0);
@ini_set('memory_limit', -1);

/**
 * 系统模块数据
 */
class InstallAdmin extends Migrator
{
    /**
     * 创建数据库
     */
    public function change()
    {
        $this->_create_system_auth();
        $this->_create_system_auth_node();
        $this->_create_system_base();
        $this->_create_system_config();
        $this->_create_system_data();
        $this->_create_system_file();
        $this->_create_system_menu();
        $this->_create_system_oplog();
        $this->_create_system_queue();
        $this->_create_system_user();
    }

    /**
     * 创建数据对象
     * @class SystemAuth
     * @table system_auth
     * @return void
     */
    private function _create_system_auth()
    {

        // 当前数据表
        $table = 'system_auth';

        // 存在则跳过
        if ($this->hasTable($table)) return;

        // 创建数据表
        $this->table($table, [
            'engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '系统-权限',
        ])
            ->addColumn('title', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '权限名称'])
            ->addColumn('utype', 'string', ['limit' => 50, 'default' => '', 'null' => true, 'comment' => '身份权限'])
            ->addColumn('desc', 'string', ['limit' => 500, 'default' => '', 'null' => true, 'comment' => '备注说明'])
            ->addColumn('sort', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '排序权重'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1, 'null' => true, 'comment' => '权限状态(1使用,0禁用)'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true, 'comment' => '创建时间'])
            ->addIndex('sort', ['name' => 'i73a781d61_sort'])
            ->addIndex('title', ['name' => 'i73a781d61_title'])
            ->addIndex('status', ['name' => 'i73a781d61_status'])
            ->create();

        // 修改主键长度
        $this->table($table)->changeColumn('id', 'integer', ['limit' => 11, 'identity' => true]);
    }

    /**
     * 创建数据对象
     * @class SystemAuthNode
     * @table system_auth_node
     * @return void
     */
    private function _create_system_auth_node()
    {

        // 当前数据表
        $table = 'system_auth_node';

        // 存在则跳过
        if ($this->hasTable($table)) return;

        // 创建数据表
        $this->table($table, [
            'engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '系统-授权',
        ])
            ->addColumn('auth', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '角色'])
            ->addColumn('node', 'string', ['limit' => 200, 'default' => '', 'null' => true, 'comment' => '节点'])
            ->addIndex('auth', ['name' => 'i4cd9aaff6_auth'])
            ->addIndex('node', ['name' => 'i4cd9aaff6_node'])
            ->create();

        // 修改主键长度
        $this->table($table)->changeColumn('id', 'integer', ['limit' => 11, 'identity' => true]);
    }

    /**
     * 创建数据对象
     * @class SystemBase
     * @table system_base
     * @return void
     */
    private function _create_system_base()
    {

        // 当前数据表
        $table = 'system_base';

        // 存在则跳过
        if ($this->hasTable($table)) return;

        // 创建数据表
        $this->table($table, [
            'engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '系统-字典',
        ])
            ->addColumn('type', 'string', ['limit' => 20, 'default' => '', 'null' => true, 'comment' => '数据类型'])
            ->addColumn('code', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '数据代码'])
            ->addColumn('name', 'string', ['limit' => 500, 'default' => '', 'null' => true, 'comment' => '数据名称'])
            ->addColumn('content', 'text', ['default' => NULL, 'null' => true, 'comment' => '数据内容'])
            ->addColumn('sort', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '排序权重'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1, 'null' => true, 'comment' => '数据状态(0禁用,1启动)'])
            ->addColumn('deleted', 'integer', ['limit' => 1, 'default' => 0, 'null' => true, 'comment' => '删除状态(0正常,1已删)'])
            ->addColumn('deleted_at', 'string', ['limit' => 20, 'default' => '', 'null' => true, 'comment' => '删除时间'])
            ->addColumn('deleted_by', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '删除用户'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true, 'comment' => '创建时间'])
            ->addIndex('type', ['name' => 'i2a29c450f_type'])
            ->addIndex('code', ['name' => 'i2a29c450f_code'])
            ->addIndex('name', ['name' => 'i2a29c450f_name'])
            ->addIndex('sort', ['name' => 'i2a29c450f_sort'])
            ->addIndex('status', ['name' => 'i2a29c450f_status'])
            ->addIndex('deleted', ['name' => 'i2a29c450f_deleted'])
            ->create();

        // 修改主键长度
        $this->table($table)->changeColumn('id', 'integer', ['limit' => 11, 'identity' => true]);
    }

    /**
     * 创建数据对象
     * @class SystemConfig
     * @table system_config
     * @return void
     */
    private function _create_system_config()
    {

        // 当前数据表
        $table = 'system_config';

        // 存在则跳过
        if ($this->hasTable($table)) return;

        // 创建数据表
        $this->table($table, [
            'engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '系统-配置',
        ])
            ->addColumn('type', 'string', ['limit' => 20, 'default' => '', 'null' => true, 'comment' => '配置分类'])
            ->addColumn('name', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '配置名称'])
            ->addColumn('value', 'string', ['limit' => 2048, 'default' => '', 'null' => true, 'comment' => '配置内容'])
            ->addIndex('type', ['name' => 'i48e345b98_type'])
            ->addIndex('name', ['name' => 'i48e345b98_name'])
            ->create();

        // 修改主键长度
        $this->table($table)->changeColumn('id', 'integer', ['limit' => 11, 'identity' => true]);
    }

    /**
     * 创建数据对象
     * @class SystemData
     * @table system_data
     * @return void
     */
    private function _create_system_data()
    {

        // 当前数据表
        $table = 'system_data';

        // 存在则跳过
        if ($this->hasTable($table)) return;

        // 创建数据表
        $this->table($table, [
            'engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '系统-数据',
        ])
            ->addColumn('name', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '配置名'])
            ->addColumn('value', 'text', ['default' => NULL, 'null' => true, 'comment' => '配置值'])
            ->addColumn('create_time', 'datetime', ['default' => NULL, 'null' => true, 'comment' => '创建时间'])
            ->addColumn('update_time', 'datetime', ['default' => NULL, 'null' => true, 'comment' => '更新时间'])
            ->addIndex('name', ['name' => 'icbccedc16_name'])
            ->addIndex('create_time', ['name' => 'icbccedc16_create_time'])
            ->create();

        // 修改主键长度
        $this->table($table)->changeColumn('id', 'integer', ['limit' => 11, 'identity' => true]);
    }

    /**
     * 创建数据对象
     * @class SystemFile
     * @table system_file
     * @return void
     */
    private function _create_system_file()
    {

        // 当前数据表
        $table = 'system_file';

        // 存在则跳过
        if ($this->hasTable($table)) return;

        // 创建数据表
        $this->table($table, [
            'engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '系统-文件',
        ])
            ->addColumn('type', 'string', ['limit' => 20, 'default' => '', 'null' => true, 'comment' => '上传类型'])
            ->addColumn('hash', 'string', ['limit' => 32, 'default' => '', 'null' => true, 'comment' => '文件哈希'])
            ->addColumn('tags', 'string', ['limit' => 50, 'default' => '', 'null' => true, 'comment' => '文件标签'])
            ->addColumn('name', 'string', ['limit' => 180, 'default' => '', 'null' => true, 'comment' => '文件名称'])
            ->addColumn('xext', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '文件后缀'])
            ->addColumn('xurl', 'string', ['limit' => 500, 'default' => '', 'null' => true, 'comment' => '访问链接'])
            ->addColumn('xkey', 'string', ['limit' => 500, 'default' => '', 'null' => true, 'comment' => '文件路径'])
            ->addColumn('mime', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '文件类型'])
            ->addColumn('size', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '文件大小'])
            ->addColumn('uuid', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '用户编号'])
            ->addColumn('unid', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '会员编号'])
            ->addColumn('isfast', 'integer', ['limit' => 1, 'default' => 0, 'null' => true, 'comment' => '是否秒传'])
            ->addColumn('issafe', 'integer', ['limit' => 1, 'default' => 0, 'null' => true, 'comment' => '安全模式'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1, 'null' => true, 'comment' => '上传状态(1悬空,2落地)'])
            ->addColumn('create_at', 'datetime', ['default' => NULL, 'null' => true, 'comment' => '创建时间'])
            ->addColumn('update_at', 'datetime', ['default' => NULL, 'null' => true, 'comment' => '更新时间'])
            ->addIndex('type', ['name' => 'i738a363ca_type'])
            ->addIndex('hash', ['name' => 'i738a363ca_hash'])
            ->addIndex('uuid', ['name' => 'i738a363ca_uuid'])
            ->addIndex('xext', ['name' => 'i738a363ca_xext'])
            ->addIndex('unid', ['name' => 'i738a363ca_unid'])
            ->addIndex('tags', ['name' => 'i738a363ca_tags'])
            ->addIndex('name', ['name' => 'i738a363ca_name'])
            ->addIndex('status', ['name' => 'i738a363ca_status'])
            ->addIndex('issafe', ['name' => 'i738a363ca_issafe'])
            ->addIndex('isfast', ['name' => 'i738a363ca_isfast'])
            ->addIndex('create_at', ['name' => 'i738a363ca_create_at'])
            ->create();

        // 修改主键长度
        $this->table($table)->changeColumn('id', 'integer', ['limit' => 11, 'identity' => true]);
    }

    /**
     * 创建数据对象
     * @class SystemMenu
     * @table system_menu
     * @return void
     */
    private function _create_system_menu()
    {

        // 当前数据表
        $table = 'system_menu';

        // 存在则跳过
        if ($this->hasTable($table)) return;

        // 创建数据表
        $this->table($table, [
            'engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '系统-菜单',
        ])
            ->addColumn('pid', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '上级ID'])
            ->addColumn('title', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '菜单名称'])
            ->addColumn('icon', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '菜单图标'])
            ->addColumn('node', 'string', ['limit' => 100, 'default' => '', 'null' => true, 'comment' => '节点代码'])
            ->addColumn('url', 'string', ['limit' => 400, 'default' => '', 'null' => true, 'comment' => '链接节点'])
            ->addColumn('params', 'string', ['limit' => 500, 'default' => '', 'null' => true, 'comment' => '链接参数'])
            ->addColumn('target', 'string', ['limit' => 20, 'default' => '_self', 'null' => true, 'comment' => '打开方式'])
            ->addColumn('sort', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '排序权重'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1, 'null' => true, 'comment' => '状态(0:禁用,1:启用)'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true, 'comment' => '创建时间'])
            ->addIndex('pid', ['name' => 'i29b9da675_pid'])
            ->addIndex('sort', ['name' => 'i29b9da675_sort'])
            ->addIndex('status', ['name' => 'i29b9da675_status'])
            ->create();

        // 修改主键长度
        $this->table($table)->changeColumn('id', 'integer', ['limit' => 11, 'identity' => true]);
    }

    /**
     * 创建数据对象
     * @class SystemOplog
     * @table system_oplog
     * @return void
     */
    private function _create_system_oplog()
    {

        // 当前数据表
        $table = 'system_oplog';

        // 存在则跳过
        if ($this->hasTable($table)) return;

        // 创建数据表
        $this->table($table, [
            'engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '系统-日志',
        ])
            ->addColumn('node', 'string', ['limit' => 200, 'default' => '', 'null' => false, 'comment' => '当前操作节点'])
            ->addColumn('geoip', 'string', ['limit' => 15, 'default' => '', 'null' => false, 'comment' => '操作者IP地址'])
            ->addColumn('action', 'string', ['limit' => 200, 'default' => '', 'null' => false, 'comment' => '操作行为名称'])
            ->addColumn('content', 'string', ['limit' => 1024, 'default' => '', 'null' => false, 'comment' => '操作内容描述'])
            ->addColumn('username', 'string', ['limit' => 50, 'default' => '', 'null' => false, 'comment' => '操作人用户名'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false, 'comment' => '创建时间'])
            ->addIndex('create_at', ['name' => 'id7cb1c775_create_at'])
            ->create();

        // 修改主键长度
        $this->table($table)->changeColumn('id', 'integer', ['limit' => 11, 'identity' => true]);
    }

    /**
     * 创建数据对象
     * @class SystemQueue
     * @table system_queue
     * @return void
     */
    private function _create_system_queue()
    {

        // 当前数据表
        $table = 'system_queue';

        // 存在则跳过
        if ($this->hasTable($table)) return;

        // 创建数据表
        $this->table($table, [
            'engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '系统-任务',
        ])
            ->addColumn('code', 'string', ['limit' => 20, 'default' => '', 'null' => false, 'comment' => '任务编号'])
            ->addColumn('title', 'string', ['limit' => 100, 'default' => '', 'null' => false, 'comment' => '任务名称'])
            ->addColumn('command', 'string', ['limit' => 500, 'default' => '', 'null' => true, 'comment' => '执行指令'])
            ->addColumn('exec_pid', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '执行进程'])
            ->addColumn('exec_data', 'text', ['default' => NULL, 'null' => true, 'comment' => '执行参数'])
            ->addColumn('exec_time', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '执行时间'])
            ->addColumn('exec_desc', 'string', ['limit' => 500, 'default' => '', 'null' => true, 'comment' => '执行描述'])
            ->addColumn('enter_time', 'decimal', ['precision' => 20, 'scale' => 4, 'default' => '0.0000', 'null' => true, 'comment' => '开始时间'])
            ->addColumn('outer_time', 'decimal', ['precision' => 20, 'scale' => 4, 'default' => '0.0000', 'null' => true, 'comment' => '结束时间'])
            ->addColumn('loops_time', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '循环时间'])
            ->addColumn('attempts', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '执行次数'])
            ->addColumn('message', 'text', ['default' => NULL, 'null' => true, 'comment' => '最新消息'])
            ->addColumn('rscript', 'integer', ['limit' => 1, 'default' => 1, 'null' => true, 'comment' => '任务类型(0单例,1多例)'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1, 'null' => true, 'comment' => '任务状态(1新任务,2处理中,3成功,4失败)'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false, 'comment' => '创建时间'])
            ->addIndex('code', ['name' => 'if64376974_code'])
            ->addIndex('title', ['name' => 'if64376974_title'])
            ->addIndex('status', ['name' => 'if64376974_status'])
            ->addIndex('rscript', ['name' => 'if64376974_rscript'])
            ->addIndex('create_at', ['name' => 'if64376974_create_at'])
            ->addIndex('exec_time', ['name' => 'if64376974_exec_time'])
            ->create();

        // 修改主键长度
        $this->table($table)->changeColumn('id', 'integer', ['limit' => 11, 'identity' => true]);
    }

    /**
     * 创建数据对象
     * @class SystemUser
     * @table system_user
     * @return void
     */
    private function _create_system_user()
    {

        // 当前数据表
        $table = 'system_user';

        // 存在则跳过
        if ($this->hasTable($table)) return;

        // 创建数据表
        $this->table($table, [
            'engine' => 'InnoDB', 'collation' => 'utf8mb4_general_ci', 'comment' => '系统-用户',
        ])
            ->addColumn('usertype', 'string', ['limit' => 20, 'default' => '', 'null' => true, 'comment' => '用户类型'])
            ->addColumn('username', 'string', ['limit' => 50, 'default' => '', 'null' => true, 'comment' => '用户账号'])
            ->addColumn('password', 'string', ['limit' => 32, 'default' => '', 'null' => true, 'comment' => '用户密码'])
            ->addColumn('nickname', 'string', ['limit' => 50, 'default' => '', 'null' => true, 'comment' => '用户昵称'])
            ->addColumn('headimg', 'string', ['limit' => 255, 'default' => '', 'null' => true, 'comment' => '头像地址'])
            ->addColumn('authorize', 'string', ['limit' => 255, 'default' => '', 'null' => true, 'comment' => '权限授权'])
            ->addColumn('contact_qq', 'string', ['limit' => 20, 'default' => '', 'null' => true, 'comment' => '联系QQ'])
            ->addColumn('contact_mail', 'string', ['limit' => 20, 'default' => '', 'null' => true, 'comment' => '联系邮箱'])
            ->addColumn('contact_phone', 'string', ['limit' => 20, 'default' => '', 'null' => true, 'comment' => '联系手机'])
            ->addColumn('login_ip', 'string', ['limit' => 255, 'default' => '', 'null' => true, 'comment' => '登录地址'])
            ->addColumn('login_at', 'string', ['limit' => 20, 'default' => '', 'null' => true, 'comment' => '登录时间'])
            ->addColumn('login_num', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '登录次数'])
            ->addColumn('describe', 'string', ['limit' => 255, 'default' => '', 'null' => true, 'comment' => '备注说明'])
            ->addColumn('sort', 'biginteger', ['limit' => 20, 'default' => 0, 'null' => true, 'comment' => '排序权重'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1, 'null' => true, 'comment' => '状态(0禁用,1启用)'])
            ->addColumn('is_deleted', 'integer', ['limit' => 1, 'default' => 0, 'null' => true, 'comment' => '删除(1删除,0未删)'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true, 'comment' => '创建时间'])
            ->addIndex('sort', ['name' => 'i34b957835_sort'])
            ->addIndex('status', ['name' => 'i34b957835_status'])
            ->addIndex('username', ['name' => 'i34b957835_username'])
            ->addIndex('is_deleted', ['name' => 'i34b957835_is_deleted'])
            ->create();

        // 修改主键长度
        $this->table($table)->changeColumn('id', 'integer', ['limit' => 11, 'identity' => true]);
    }
}