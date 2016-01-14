<?php
defined('WEB_URL') or define('WEB_URL','http://admin.shop.com/');
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING'=>array(
        '__CSS__'=>WEB_URL.'Public/Admin/css',
        '__JS__'=>WEB_URL.'Public/Admin/js',
        '__IMG__'=>WEB_URL.'Public/Admin/images',
        '__LAYER__'=>WEB_URL.'Public/Admin/layer/layer.js',
        '__UPLOADIFY__'=>WEB_URL.'Public/Admin/uploadify',
        '__TREEGRID__'=>WEB_URL.'Public/Admin/treegrid',
        '__ZTREE__'=>WEB_URL.'Public/Admin/zTree',
        '__BRAND__'=>'http://brand-logo.b0.upaiyun.com/'
    ),
'UPLOAD_CONFIG'=>array(
    //'rootPath'     => './Uploads/', //保存根路径
    'rootPath'     => './', //保存到upyun的根路径
    //'savePath'     => $dir.'/', //保存路径
    'driver'       => 'Upyun', // 文件上传驱动
    'driverConfig' => array(
        'host'     => 'v0.api.upyun.com', //又拍云服务器
        'username' => 'itsource', //又拍操作员用户
        'password' => 'itsource', //又拍云操作员密码
        'bucket'   => $dir, //空间名称
        'timeout'  => 90, //超时时间
    ) // 上传驱动配置
));