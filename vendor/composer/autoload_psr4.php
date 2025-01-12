<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'think\\view\\driver\\' => array($vendorDir . '/topthink/think-view/src'),
    'think\\migration\\' => array($vendorDir . '/topthink/think-migration/src'),
    'think\\admin\\install\\' => array($vendorDir . '/zoujingli/think-install/src'),
    'think\\admin\\' => array($vendorDir . '/zoujingli/think-library/src'),
    'think\\' => array($vendorDir . '/topthink/framework/src/think', $vendorDir . '/topthink/think-helper/src', $vendorDir . '/topthink/think-orm/src', $vendorDir . '/topthink/think-template/src'),
    'app\\wechat\\' => array($vendorDir . '/zoujingli/think-plugs-wechat/src'),
    'app\\admin\\' => array($vendorDir . '/zoujingli/think-plugs-admin/src'),
    'app\\' => array($baseDir . '/app'),
    'WePay\\' => array($vendorDir . '/zoujingli/wechat-developer/WePay'),
    'WePayV3\\' => array($vendorDir . '/zoujingli/wechat-developer/WePayV3'),
    'WeMini\\' => array($vendorDir . '/zoujingli/wechat-developer/WeMini'),
    'WeChat\\' => array($vendorDir . '/zoujingli/wechat-developer/WeChat'),
    'Symfony\\Polyfill\\Php80\\' => array($vendorDir . '/symfony/polyfill-php80'),
    'Symfony\\Component\\Process\\' => array($vendorDir . '/symfony/process'),
    'Psr\\SimpleCache\\' => array($vendorDir . '/psr/simple-cache/src'),
    'Psr\\Log\\' => array($vendorDir . '/psr/log/Psr/Log'),
    'Psr\\Http\\Message\\' => array($vendorDir . '/psr/http-message/src'),
    'Psr\\Container\\' => array($vendorDir . '/psr/container/src'),
    'Phinx\\' => array($vendorDir . '/topthink/think-migration/phinx'),
    'Endroid\\QrCode\\' => array($vendorDir . '/zoujingli/qrcode/src'),
    'DASPRiD\\Enum\\' => array($vendorDir . '/dasprid/enum/src'),
    'BaconQrCode\\' => array($vendorDir . '/bacon/bacon-qr-code/src'),
    'AliPay\\' => array($vendorDir . '/zoujingli/wechat-developer/AliPay'),
);
