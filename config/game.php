<?php

/**
 * 全局配置
 */
use Gaaarfild\LaravelConf\Conf;
$conf = new Conf();

return [
    'version' => $conf->get('website_version','1.0'),
    'release' => '20160625',
    'user_cache_time' => $conf->get('website_cache_time',1), //用户数据缓存时间单位分钟
    'admin' => [
        'page_size' => $conf->get('website_admin_page',15),  //后台分页列表显示数目
    ],
    'admin_permission'=>true,//后台权限控制开关

];