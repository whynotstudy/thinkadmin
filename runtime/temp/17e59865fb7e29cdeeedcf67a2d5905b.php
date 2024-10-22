<?php /*a:3:{s:70:"D:\phpstudy_pro\WWW\ftpuser\thinkadmin\app\admin\view\queue\index.html";i:1728976221;s:64:"D:\phpstudy_pro\WWW\ftpuser\thinkadmin\app\admin\view\table.html";i:1728976221;s:77:"D:\phpstudy_pro\WWW\ftpuser\thinkadmin\app\admin\view\queue\index_search.html";i:1728976221;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((string) lang($title)); ?><div class="pull-right"><?php if(isset($super) and $super): ?><a data-table-id="QueueTable" class="layui-btn layui-btn-sm layui-btn-primary" data-queue="<?php echo url('admin/api.plugs/optimize'); ?>"><?php echo lang('优化数据库'); ?></a><?php if(isset($iswin) and ($iswin or php_sapi_name() == 'cli')): ?><button data-load='<?php echo url("admin/api.queue/start"); ?>' class='layui-btn layui-btn-sm layui-btn-primary'><?php echo lang('开启服务'); ?></button><button data-load='<?php echo url("admin/api.queue/stop"); ?>' class='layui-btn layui-btn-sm layui-btn-primary'><?php echo lang('关闭服务'); ?></button><?php endif; if(auth("clean")): ?><button data-table-id="QueueTable" data-queue='<?php echo url("clean"); ?>' class='layui-btn layui-btn-sm layui-btn-primary'><?php echo lang('定时清理'); ?></button><?php endif; ?><?php endif; if(auth("remove")): ?><button data-table-id="QueueTable" data-action='<?php echo url("remove"); ?>' data-rule="id#{id}" data-confirm="<?php echo lang('确定批量删除记录吗？'); ?>" class='layui-btn layui-btn-sm layui-btn-primary'><?php echo lang('批量删除'); ?></button><?php endif; ?></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><?php if(!(empty($showErrorMessage) || (($showErrorMessage instanceof \think\Collection || $showErrorMessage instanceof \think\Paginator ) && $showErrorMessage->isEmpty()))): ?><div class="think-box-notify" type="error"><b><?php echo lang('系统提示：'); ?></b><span><?php echo $showErrorMessage; ?></span></div><?php endif; ?><div class="think-box-notify" type="info"><!--<?php if(isset($super) and $super): ?>--><b><?php echo lang('服务状态'); ?>：</b><b class="margin-right-5" data-queue-message><span class="color-desc"><?php echo lang('检查中'); ?></span></b><b data-tips-text="<?php echo lang('点击可复制【服务启动指令】'); ?>" class="layui-icon pointer margin-right-20" data-copy="<?php echo htmlentities((string) (isset($command) && ($command !== '')?$command:'')); ?>">&#xe633;</b><script>$('[data-queue-message]').load('<?php echo sysuri("admin/api.queue/status"); ?>');</script><!--<?php endif; ?>--><b><?php echo lang('任务统计'); ?>：</b><?php echo lang('待处理 %s 个任务，处理中 %s 个任务，已完成 %s 个任务，已失败 %s 个任务。', [
    '<b class="color-text" data-extra="pre">..</b>',
    '<b class="color-blue" data-extra="dos">..</b>',
    '<b class="color-green" data-extra="oks">..</b>',
    '<b class="color-red" data-extra="ers">..</b>'
    ]); ?></div><div class="think-box-shadow"><fieldset><legend><?php echo lang('条件搜索'); ?></legend><form class="layui-form layui-form-pane form-search" action="<?php echo sysuri(); ?>" onsubmit="return false" method="get" autocomplete="off"><div class="layui-form-item layui-inline"><label class="layui-form-label"><?php echo lang('编号名称'); ?></label><label class="layui-input-inline"><input name="title" value="<?php echo htmlentities((string) (isset($get['title']) && ($get['title'] !== '')?$get['title']:'')); ?>" placeholder="<?php echo lang('请输入名称或编号'); ?>" class="layui-input"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label"><?php echo lang('任务指令'); ?></label><label class="layui-input-inline"><input name="command" value="<?php echo htmlentities((string) (isset($get['command']) && ($get['command'] !== '')?$get['command']:'')); ?>" placeholder="<?php echo lang('请输入任务指令'); ?>" class="layui-input"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label"><?php echo lang('任务状态'); ?></label><label class="layui-input-inline"><select name="status" class="layui-select"><option value=''>-- <?php echo lang('全部'); ?> --</option><?php foreach(['1'=>lang('等待处理'),'2'=>lang('正在处理'),'3'=>lang('处理完成'),'4'=>lang('处理失败')] as $k=>$v): if(isset($get['status']) and $get['status'] == $k): ?><option selected value="<?php echo htmlentities((string) $k); ?>"><?php echo htmlentities((string) $v); ?></option><?php else: ?><option value="<?php echo htmlentities((string) $k); ?>"><?php echo htmlentities((string) $v); ?></option><?php endif; ?><?php endforeach; ?></select></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label"><?php echo lang('计划时间'); ?></label><label class="layui-input-inline"><input data-date-range name="exec_time" value="<?php echo htmlentities((string) (isset($get['exec_time']) && ($get['exec_time'] !== '')?$get['exec_time']:'')); ?>" placeholder="<?php echo lang('请选择计划时间'); ?>" class="layui-input"></label></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i><?php echo lang('搜 索'); ?></button></div></form></fieldset><table id="QueueTable" data-line="2" data-url="<?php echo request()->url(); ?>" data-target-search="form.form-search"></table></div></div></div><script>
    $(function () {
        $('#QueueTable').layTable({
            even: true, height: 'full',
            sort: {field: 'loops_time desc,id', type: 'desc'},
            // 扩展数据处理，需要返回原 items 数据
            filter: function (items, result) {
                return result && result.extra && $('[data-extra]').map(function () {
                    this.innerHTML = result.extra[this.dataset.extra] || 0;
                }), items;
            },
            cols: [[
                {checkbox: true, fixed: 'left'},
                {
                    field: 'id', title: '<?php echo lang("任务名称"); ?>', width: '25%', sort: true, templet: function (d) {
                        if (d.loops_time > 0) {
                            d.one = '<span class="layui-badge think-bg-blue">循</span>';
                        } else {
                            d.one = '<span class="layui-badge think-bg-red">次</span>';
                        }
                        if (parseInt(d.rscript) === 1) {
                            d.two = '<span class="layui-badge layui-bg-green">复</span>';
                        } else {
                            d.two = '<span class="layui-badge think-bg-violet">单</span>';
                        }
                        return laytpl('{{-d.one}}任务编号：<b>{{d.code}}</b><br>{{-d.two}}任务名称：{{d.title}}').render(d);
                    }
                },
                {
                    field: 'exec_time', title: '<?php echo lang("任务计划"); ?>', width: '25%', templet: function (d) {
                        d.html = '执行指令：' + d.command + '<br>计划执行：' + d.exec_time;
                        if (d.loops_time > 0) {
                            return d.html + ' ( 每 <b class="color-blue">' + d.loops_time + '</b> 秒 ) ';
                        } else {
                            return d.html + ' <span class="color-desc">( 单次任务 )</span> ';
                        }
                    }
                },
                {
                    field: 'loops_time', title: '<?php echo lang("任务状态"); ?>', width: '30%', templet: function (d) {
                        d.html = ([
                            '<span class="pull-left layui-badge layui-badge-middle layui-bg-gray">未知</span>',
                            '<span class="pull-left layui-badge layui-badge-middle layui-bg-black">等待</span>',
                            '<span class="pull-left layui-badge layui-badge-middle layui-bg-blue">执行</span>',
                            '<span class="pull-left layui-badge layui-badge-middle layui-bg-green">完成</span>',
                            '<span class="pull-left layui-badge layui-badge-middle layui-bg-red">失败</span>',
                        ][d.status] || '') + '执行时间：';
                        d.enter_time = d.enter_time || '';
                        d.outer_time = d.outer_time || '0.0000';
                        if (d.enter_time.length > 12) {
                            d.html += d.enter_time.substring(12) + '<span class="color-desc"> ( ' + d.outer_time + ' ) </span>';
                            d.html += ' 已执行 <b class="color-blue">' + (d.attempts || 0) + '</b> 次';
                        } else {
                            d.html += '<span class="color-desc">任务未执行</span>'
                        }
                        return d.html + '<br>执行结果：<span class="color-blue">' + (d.exec_desc || '<span class="color-desc">未获取到执行结果</span>') + '</span>';
                    }
                },
                {toolbar: '#toolbar', title: '<?php echo lang("操作面板"); ?>', align: 'center', minWidth: 210, fixed: 'right'}
            ]]
        });
    });
</script><script type="text/html" id="toolbar"><!--<?php if(auth('redo')): ?>-->
    {{# if(d.status===4||d.status===3){ }}
    <a class="layui-btn layui-btn-sm" data-confirm="确定要重置该任务吗？" data-queue="<?php echo url('redo'); ?>?code={{d.code}}"><?php echo lang('重 置'); ?></a>
    {{# }else{ }}
    <a class="layui-btn layui-btn-sm layui-btn-disabled"><?php echo lang('重 置'); ?></a>
    {{# } }}
    <!--<?php endif; ?>--><!--<?php if(auth('remove')): ?>--><a class='layui-btn layui-btn-sm layui-btn-danger' data-confirm="<?php echo lang('确定要删除该记录吗？'); ?>" data-action='<?php echo url("remove"); ?>' data-value="id#{{d.id}}"><?php echo lang('删 除'); ?></a><!--<?php endif; ?>--><a class='layui-btn layui-btn-sm layui-btn-normal' onclick="$.loadQueue('{{d.code}}',false,this)"><?php echo lang('日 志'); ?></a></script></div>