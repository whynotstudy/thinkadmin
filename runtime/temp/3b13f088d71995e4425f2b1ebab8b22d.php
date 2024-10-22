<?php /*a:3:{s:70:"D:\phpstudy_pro\WWW\ftpuser\thinkadmin\app\admin\view\oplog\index.html";i:1728976221;s:64:"D:\phpstudy_pro\WWW\ftpuser\thinkadmin\app\admin\view\table.html";i:1728976221;s:77:"D:\phpstudy_pro\WWW\ftpuser\thinkadmin\app\admin\view\oplog\index_search.html";i:1728976221;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((string) lang($title)); ?><div class="pull-right"><!--<?php if(auth("remove")): ?>--><button data-table-id="OplogTable" data-action='<?php echo url("remove"); ?>' data-rule="id#{id}" data-confirm="确定要删除选中的日志吗？" class='layui-btn layui-btn-sm layui-btn-primary'><?php echo lang('批量删除'); ?></button><!--<?php endif; ?>--><!--<?php if(auth("clear")): ?>--><button data-table-id="OplogTable" data-load='<?php echo url("clear"); ?>' data-confirm="确定要清空所有日志吗？" class='layui-btn layui-btn-sm layui-btn-primary'><?php echo lang('清空数据'); ?></button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><?php if(!(empty($showErrorMessage) || (($showErrorMessage instanceof \think\Collection || $showErrorMessage instanceof \think\Paginator ) && $showErrorMessage->isEmpty()))): ?><div class="think-box-notify" type="error"><b><?php echo lang('系统提示：'); ?></b><span><?php echo $showErrorMessage; ?></span></div><?php endif; ?><div class="think-box-shadow"><fieldset><legend><?php echo lang('条件搜索'); ?></legend><form class="layui-form layui-form-pane form-search" action="<?php echo sysuri(); ?>" onsubmit="return false" method="get" autocomplete="off"><div class="layui-form-item layui-inline"><label class="layui-form-label"><?php echo lang('操作账号'); ?></label><div class="layui-input-inline"><select name='username' lay-search class="layui-select"><option value=''>-- <?php echo lang('全部'); ?> --</option><?php foreach($users as $user): if($user == input('get.username')): ?><option selected value="<?php echo htmlentities((string) $user); ?>"><?php echo htmlentities((string) $user); ?></option><?php else: ?><option value="<?php echo htmlentities((string) $user); ?>"><?php echo htmlentities((string) $user); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label"><?php echo lang('操作行为'); ?></label><div class="layui-input-inline"><select name="action" lay-search class="layui-select"><option value=''>-- <?php echo lang('全部'); ?> --</option><?php foreach($actions as $action): if($action == input('get.action')): ?><option selected value="<?php echo htmlentities((string) $action); ?>"><?php echo htmlentities((string) $action); ?></option><?php else: ?><option value="<?php echo htmlentities((string) $action); ?>"><?php echo htmlentities((string) $action); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label"><?php echo lang('操作节点'); ?></label><label class="layui-input-inline"><input name="node" value="<?php echo htmlentities((string) (isset($get['node']) && ($get['node'] !== '')?$get['node']:'')); ?>" placeholder="<?php echo lang('请输入操作节点'); ?>" class="layui-input"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label"><?php echo lang('操作内容'); ?></label><label class="layui-input-inline"><input name="content" value="<?php echo htmlentities((string) (isset($get['content']) && ($get['content'] !== '')?$get['content']:'')); ?>" placeholder="<?php echo lang('请输入操作内容'); ?>" class="layui-input"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label"><?php echo lang('访问地址'); ?></label><label class="layui-input-inline"><input name="geoip" value="<?php echo htmlentities((string) (isset($get['geoip']) && ($get['geoip'] !== '')?$get['geoip']:'')); ?>" placeholder="<?php echo lang('请输入访问地址'); ?>" class="layui-input"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label"><?php echo lang('创建时间'); ?></label><label class="layui-input-inline"><input data-date-range name="create_at" value="<?php echo htmlentities((string) (isset($get['create_at']) && ($get['create_at'] !== '')?$get['create_at']:'')); ?>" placeholder="<?php echo lang('请选择创建时间'); ?>" class="layui-input"></label></div><div class="layui-form-item layui-inline"><button type="submit" class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i><?php echo lang('搜 索'); ?></button><button type="button" data-form-export="<?php echo url('index'); ?>?type=<?php echo htmlentities((string) (isset($type) && ($type !== '')?$type:'')); ?>" class="layui-btn layui-btn-primary"><i class="layui-icon layui-icon-export"></i><?php echo lang('导 出'); ?></button></div></form></fieldset><script>
    require(['excel'], function (excel) {
        excel.bind(function (data) {

            // 设置表格内容
            data.forEach(function (item, index) {
                data[index] = [item.id, item.username, item.node, item.geoip, item.geoisp, item.action, item.content, item.create_at];
            });

            // 设置表头内容
            data.unshift(['ID', '<?php echo lang("操作账号"); ?>', '<?php echo lang("操作节点"); ?>', '<?php echo lang("访问地址"); ?>', '<?php echo lang("网络服务商"); ?>', '<?php echo lang("操作行为"); ?>', '<?php echo lang("操作内容"); ?>', '<?php echo lang("创建时间"); ?>']);

            // 应用表格样式
            return this.withStyle(data, {A: 60, B: 80, C: 99, E: 120, G: 120});

        }, '<?php echo lang("操作日志"); ?>' + layui.util.toDateString(Date.now(), '_yyyyMMdd_HHmmss'));
    });
</script><table id="OplogTable" data-url="<?php echo request()->url(); ?>" data-target-search="form.form-search"></table></div></div></div><script>
    $(function () {
        $('#OplogTable').layTable({
            even: true, height: 'full',
            sort: {field: 'id', type: 'desc'},
            cols: [[
                {checkbox: true},
                {field: 'id', title: 'ID', width: 80, sort: true, align: 'center'},
                {field: 'username', title: '<?php echo lang("操作账号"); ?>', minWidth: 100, width: '8%', sort: true, align: 'center'},
                {field: 'node', title: '<?php echo lang("操作节点"); ?>', minWidth: 120},
                {field: 'action', title: '<?php echo lang("操作行为"); ?>', minWidth: 120},
                {field: 'content', title: '<?php echo lang("操作内容"); ?>', minWidth: 150},
                {field: 'geoip', title: '<?php echo lang("访问地址"); ?>', minWidth: 100, width: '10%'},
                {field: 'geoisp', title: '<?php echo lang("网络服务商"); ?>', minWidth: 100},
                {field: 'create_at', title: '<?php echo lang("创建时间"); ?>', minWidth: 170, align: 'center', sort: true},
                {toolbar: '#toolbar', title: '<?php echo lang("操作面板"); ?>', align: 'center', minWidth: 80, width: '8%', fixed: 'right'}
            ]]
        });
    });
</script><script type="text/html" id="toolbar"><!--<?php if(auth('remove')): ?>--><a data-action='<?php echo url("remove"); ?>' data-value="id#{{d.id}}" data-confirm="确认要删除这条记录吗？" class="layui-btn layui-btn-sm layui-btn-danger"><?php echo lang('删 除'); ?></a><!--<?php endif; ?>--></script></div>