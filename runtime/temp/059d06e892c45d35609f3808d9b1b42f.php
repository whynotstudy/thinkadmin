<?php /*a:2:{s:71:"D:\phpstudy_pro\WWW\ftpuser\thinkadmin\app\admin\view\config\index.html";i:1728976221;s:63:"D:\phpstudy_pro\WWW\ftpuser\thinkadmin\app\admin\view\main.html";i:1728976221;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((string) lang($title)); ?><div class="pull-right"><!--<?php if(isset($super) and $super): ?>--><a class="layui-btn layui-btn-sm layui-btn-primary" data-load="<?php echo url('admin/api.system/config'); ?>"><?php echo lang('清理无效配置'); ?></a><!--<?php endif; ?>--><!--<?php if(auth('system')): ?>--><a class="layui-btn layui-btn-sm layui-btn-primary" data-modal="<?php echo url('system'); ?>"><?php echo lang('修改系统参数'); ?></a><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><?php if(!(empty($showErrorMessage) || (($showErrorMessage instanceof \think\Collection || $showErrorMessage instanceof \think\Paginator ) && $showErrorMessage->isEmpty()))): ?><div class="think-box-notify" type="error"><b><?php echo lang('系统提示：'); ?></b><span><?php echo $showErrorMessage; ?></span></div><?php endif; ?><!--<?php if(!(empty($issuper) || (($issuper instanceof \think\Collection || $issuper instanceof \think\Paginator ) && $issuper->isEmpty()))): ?>--><div class="layui-card padding-20 shadow"><div class="layui-card-header notselect"><span class="help-label"><b style="color:#333!important;"><?php echo lang('运行模式'); ?></b>( <?php echo lang('仅超级管理员可配置'); ?> )
        </span></div><div class="layui-card-body"><div class="layui-btn-group shadow-mini nowrap"><!--<?php if($app->isDebug()): ?>--><a class="layui-btn layui-btn-sm layui-btn-active"><?php echo lang('以开发模式运行'); ?></a><a class="layui-btn layui-btn-sm layui-btn-primary" data-confirm="<?php echo lang('确定要切换到生产模式运行吗？'); ?>" data-load="<?php echo url('admin/api.system/debug'); ?>?state=1"><?php echo lang('以生产模式运行'); ?></a><!--<?php else: ?>--><a class="layui-btn layui-btn-sm layui-btn-primary" data-confirm="<?php echo lang('确定要切换到开发模式运行吗？'); ?>" data-load="<?php echo url('admin/api.system/debug'); ?>?state=0"><?php echo lang('以开发模式运行'); ?></a><a class="layui-btn layui-btn-sm layui-btn-active"><?php echo lang('以生产模式运行'); ?></a><!--<?php endif; ?>--></div><div class="margin-top-20"><p><b><?php echo lang('开发模式'); ?></b>：<?php echo lang('开发人员或在功能调试时使用，系统异常时会显示详细的错误信息，同时还会记录操作日志及数据库 SQL 语句信息。'); ?></p><p><b><?php echo lang('生产模式'); ?></b>：<?php echo lang('项目正式部署上线后使用，系统异常时统一显示 “%s”，只记录重要的异常日志信息，强烈推荐上线后使用此模式。',[config('app.error_message')]); ?></p></div></div></div><div class="layui-card padding-20 shadow"><div class="layui-card-header notselect"><span class="help-label"><b style="color:#333!important;"><?php echo lang('富编辑器'); ?></b>( <?php echo lang('仅超级管理员可配置'); ?> )
        </span></div><div class="layui-card-body layui-clear"><div class="layui-btn-group shadow-mini"><?php if(!in_array(sysconf('base.editor'),['ckeditor4','ckeditor5','wangEditor','auto'])): sysconf('base.editor','ckeditor4'); ?><?php endif; foreach(['ckeditor4'=>'CKEditor4','ckeditor5'=>'CKEditor5','wangEditor'=>'wangEditor','auto'=>lang('自适应模式')] as $k => $v): if(sysconf('base.editor') == $k): if(auth('storage')): ?><a data-title="配置<?php echo htmlentities((string) $v); ?>" class="layui-btn layui-btn-sm layui-btn-active"><?php echo htmlentities((string) $v); ?></a><?php else: ?><a class="layui-btn layui-btn-sm layui-btn-active"><?php echo htmlentities((string) $v); ?></a><?php endif; else: if(auth('storage')): ?><a data-title="配置<?php echo htmlentities((string) $v); ?>" data-action="<?php echo url('admin/api.system/editor'); ?>" data-value="editor#<?php echo htmlentities((string) $k); ?>" class="layui-btn layui-btn-sm layui-btn-primary"><?php echo htmlentities((string) $v); ?></a><?php else: ?><a class="layui-btn layui-btn-sm layui-btn-primary"><?php echo htmlentities((string) $v); ?></a><?php endif; ?><?php endif; ?><?php endforeach; ?></div><div class="margin-top-20 full-width pull-left"><p><b>CKEditor4</b>：<?php echo lang('旧版本编辑器，对浏览器兼容较好，但内容编辑体验稍有不足。'); ?></p><p><b>CKEditor5</b>：<?php echo lang('新版本编辑器，只支持新特性浏览器，对内容编辑体验较好，推荐使用。'); ?></p><p><b>wangEditor</b>：<?php echo lang('国产优质富文本编辑器，对于小程序及App内容支持会更友好，推荐使用。'); ?></p><p><b><?php echo lang('自适应模式'); ?></b>：<?php echo lang('优先使用新版本编辑器，若浏览器不支持新版本时自动降级为旧版本编辑器。'); ?></p></div></div></div><!--<?php endif; ?>--><div class="layui-card padding-20 shadow"><div class="layui-card-header notselect"><span class="help-label"><b style="color:#333!important;"><?php echo lang('存储引擎'); ?></b>( <?php echo lang('文件默认存储方式'); ?> )
        </span></div><!-- 初始化存储配置 --><?php if(!sysconf('storage.type')): sysconf('storage.type','local'); ?><?php endif; if(!sysconf('storage.link_type')): sysconf('storage.link_type','none'); ?><?php endif; if(!sysconf('storage.name_type')): sysconf('storage.name_type','xmd5'); ?><?php endif; if(!sysconf('storage.allow_exts')): sysconf('storage.allow_exts','doc,gif,ico,jpg,mp3,mp4,p12,pem,png,rar,xls,xlsx'); ?><?php endif; if(!sysconf('storage.local_http_protocol')): sysconf('storage.local_http_protocol','follow'); ?><?php endif; ?><div class="layui-card-body"><div class="layui-btn-group shadow-mini nowrap"><?php foreach($files as $k => $v): if(sysconf('storage.type') == $k): if(auth('storage')): ?><a data-title="配置<?php echo htmlentities((string) $v); ?>" data-modal="<?php echo url('storage'); ?>?type=<?php echo htmlentities((string) $k); ?>" class="layui-btn layui-btn-sm layui-btn-active"><?php echo htmlentities((string) $v); ?></a><?php else: ?><a class="layui-btn layui-btn-sm layui-btn-active"><?php echo htmlentities((string) $v); ?></a><?php endif; else: if(auth('storage')): ?><a data-title="配置<?php echo htmlentities((string) $v); ?>" data-modal="<?php echo url('storage'); ?>?type=<?php echo htmlentities((string) $k); ?>" class="layui-btn layui-btn-sm layui-btn-primary"><?php echo htmlentities((string) $v); ?></a><?php else: ?><a class="layui-btn layui-btn-sm layui-btn-primary"><?php echo htmlentities((string) $v); ?></a><?php endif; ?><?php endif; ?><?php endforeach; ?></div><div class="margin-top-20 full-width"><p><b><?php echo lang('本地服务器存储'); ?></b>：<?php echo lang('文件上传到本地服务器的 `static/upload` 目录，不支持大文件上传，占用服务器磁盘空间，访问时消耗服务器带宽流量。'); ?></p><p><b><?php echo lang('自建Alist存储'); ?></b>：<?php echo lang('文件上传到 Alist 存储的服务器或云存储空间，根据服务配置可支持大文件上传，不占用本身服务器空间及服务器带宽流量。'); ?></p><p><b><?php echo lang('七牛云对象存储'); ?></b>：<?php echo lang('文件上传到七牛云存储空间，支持大文件上传，不占用服务器空间及服务器带宽流量，支持 CDN 加速访问，访问量大时推荐使用。'); ?></p><p><b><?php echo lang('又拍云USS存储'); ?></b>：<?php echo lang('文件上传到又拍云 USS 存储空间，支持大文件上传，不占用服务器空间及服务器带宽流量，支持 CDN 加速访问，访问量大时推荐使用。'); ?></p><p><b><?php echo lang('阿里云OSS存储'); ?></b>：<?php echo lang('文件上传到阿里云 OSS 存储空间，支持大文件上传，不占用服务器空间及服务器带宽流量，支持 CDN 加速访问，访问量大时推荐使用。'); ?></p><p><b><?php echo lang('腾讯云COS存储'); ?></b>：<?php echo lang('文件上传到腾讯云 COS 存储空间，支持大文件上传，不占用服务器空间及服务器带宽流量，支持 CDN 加速访问，访问量大时推荐使用。'); ?></p></div></div></div><div class="layui-card padding-20 shadow"><div class="layui-card-header notselect"><span class="help-label"><b style="color:#333!important;"><?php echo lang('系统参数'); ?></b>( <?php echo lang('当前系统配置参数'); ?> )
        </span></div><div class="layui-card-body"><div class="layui-form-item"><div class="help-label"><b><?php echo lang('网站名称'); ?></b>Website</div><label class="relative block"><input readonly value="<?php echo sysconf('site_name'); ?>" class="layui-input layui-bg-gray"><a data-copy="<?php echo sysconf('site_name'); ?>" class="layui-icon layui-icon-release input-right-icon"></a></label><div class="help-block"><?php echo lang('网站名称及网站图标，将显示在浏览器的标签上。'); ?></div></div><div class="layui-form-item"><div class="help-label"><b><?php echo lang('管理程序名称'); ?></b>Name</div><label class="relative block"><input readonly value="<?php echo sysconf('app_name'); ?>" class="layui-input layui-bg-gray"><a data-copy="<?php echo sysconf('app_name'); ?>" class="layui-icon layui-icon-release input-right-icon"></a></label><div class="help-block"><?php echo lang('管理程序名称，将显示在后台左上角标题。'); ?></div></div><div class="layui-form-item"><div class="help-label"><b><?php echo lang('管理程序版本'); ?></b>Version</div><label class="relative block"><input readonly value="<?php echo sysconf('app_version'); ?>" class="layui-input layui-bg-gray"><a data-copy="<?php echo sysconf('app_version'); ?>" class="layui-icon layui-icon-release input-right-icon"></a></label><div class="help-block"><?php echo lang('管理程序版本，将显示在后台左上角标题。'); ?></div></div><div class="layui-form-item"><div class="help-label"><b><?php echo lang('公安备案号'); ?></b>Beian</div><label class="relative block"><input readonly value="<?php echo sysconf('beian')?:'-'; ?>" class="layui-input layui-bg-gray"><a data-copy="<?php echo sysconf('beian'); ?>" class="layui-icon layui-icon-release input-right-icon"></a></label><p class="help-block"><?php echo lang('公安备案号，可以在 %s 查询获取，将在登录页面下面显示。',['<a target="_blank" href="https://www.beian.gov.cn/portal/registerSystemInfo">www.beian.gov.cn</a>']); ?></p></div><div class="layui-form-item"><div class="help-label"><b><?php echo lang('网站备案号'); ?></b>Miitbeian</div><label class="relative block"><input readonly value="<?php echo sysconf('miitbeian')?:'-'; ?>" class="layui-input layui-bg-gray"><a data-copy="<?php echo sysconf('miitbeian'); ?>" class="layui-icon layui-icon-release input-right-icon"></a></label><div class="help-block"><?php echo lang('网站备案号，可以在 %s 查询获取，将显示在登录页面下面。',['<a target="_blank" href="https://beian.miit.gov.cn">beian.miit.gov.cn</a>']); ?></div></div><div class="layui-form-item"><div class="help-label"><b><?php echo lang('网站版权信息'); ?></b>Copyright</div><label class="relative block"><input readonly value="<?php echo sysconf('site_copy'); ?>" class="layui-input layui-bg-gray"><a data-copy="<?php echo sysconf('site_copy'); ?>" class="layui-icon layui-icon-release input-right-icon"></a></label><div class="help-block"><?php echo lang('网站版权信息，在后台登录页面显示版本信息并链接到备案到信息备案管理系统。'); ?></div></div></div></div><!--<?php if($app->isDebug()): ?>--><div class="layui-card padding-20 shadow"><div class="layui-card-header notselect"><span class="help-label"><b style="color:#333!important;"><?php echo lang('系统信息'); ?></b>( <?php echo lang('仅开发模式可见'); ?> )
        </span></div><div class="layui-card-body"><table class="layui-table" lay-even><tbody><tr><th class="nowrap text-center"><?php echo lang('核心框架'); ?></th><td><a target="_blank" href="https://www.thinkphp.cn">ThinkPHP Version <?php echo htmlentities((string) (isset($framework['version']) && ($framework['version'] !== '')?$framework['version']:'None')); ?></a></td></tr><tr><th class="nowrap text-center"><?php echo lang('平台框架'); ?></th><td><a target="_blank" href="https://thinkadmin.top">ThinkAdmin Version <?php echo htmlentities((string) (isset($thinkadmin['version']) && ($thinkadmin['version'] !== '')?$thinkadmin['version']:'6.0.0')); ?></a></td></tr><tr><th class="nowrap text-center"><?php echo lang('操作系统'); ?></th><td><?php echo php_uname(); ?></td></tr><tr><th class="nowrap text-center"><?php echo lang('运行环境'); ?></th><td><?php echo ucfirst($request->server('SERVER_SOFTWARE',php_sapi_name())); ?> & PHP <?php echo htmlentities((string) PHP_VERSION); ?> & <?php echo ucfirst(app()->db->connect()->getConfig('type')); ?></td></tr><!-- <?php if(!(empty($systemid) || (($systemid instanceof \think\Collection || $systemid instanceof \think\Paginator ) && $systemid->isEmpty()))): ?> --><tr><th class="nowrap text-center"><?php echo lang('系统序号'); ?></th><td><?php echo htmlentities((string) (isset($systemid) && ($systemid !== '')?$systemid:'')); ?></td></tr><!-- <?php endif; ?> --></tbody></table></div></div><?php if(!(empty($plugins) || (($plugins instanceof \think\Collection || $plugins instanceof \think\Paginator ) && $plugins->isEmpty()))): ?><div class="layui-card padding-20 shadow"><div class="layui-card-header notselect"><span class="help-label"><b style="color:#333!important;"><?php echo lang('应用插件'); ?></b>( <?php echo lang('仅开发模式可见'); ?> )
        </span></div><div class="layui-card-body"><table class="layui-table" lay-even><thead><tr><th class="nowrap text-center"><?php echo lang('应用名称'); ?></th><th class="nowrap text-center"><?php echo lang('插件名称'); ?></th><th class="nowrap text-left"><?php echo lang('插件包名'); ?></th><th class="nowrap text-center"><?php echo lang('插件版本'); ?></th><th class="nowrap text-center"><?php echo lang('授权协议'); ?></th></tr></thead><tbody><?php foreach($plugins as $key=>$plugin): ?><tr><td class="nowrap text-center"><?php echo htmlentities((string) $key); ?></td><td class="nowrap text-center"><?php echo htmlentities((string) lang($plugin['name'])); ?></td><td class="nowrap text-left"><?php if(empty($plugin['install']['document'])): ?><?php echo htmlentities((string) $plugin['package']); else: ?><a target="_blank" href="<?php echo htmlentities((string) $plugin['install']['document']); ?>"><?php echo htmlentities((string) $plugin['package']); ?></a><?php endif; ?></td><td class="nowrap text-center"><?php echo htmlentities((string) (isset($plugin['install']['version']) && ($plugin['install']['version'] !== '')?$plugin['install']['version']:'unknow')); ?></td><td class="nowrap text-center"><?php if(empty($plugin['install']['license'])): ?> -
                    <?php elseif(is_array($plugin['install']['license'])): ?><?php echo htmlentities((string) join('、',$plugin['install']['license'])); else: ?><?php echo htmlentities((string) (isset($plugin['install']['license']) && ($plugin['install']['license'] !== '')?$plugin['install']['license']:'-')); ?><?php endif; ?></td></tr><?php endforeach; ?></tbody></table></div></div><?php endif; ?><!--<?php endif; ?>--></div></div></div>