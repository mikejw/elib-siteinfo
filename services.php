<?php

use Empathy\ELib\Blog\Util;
use Empathy\ELib\Settings\SiteInfo;
use Empathy\ELib\VCache;
use Empathy\MVC\Config;


return [
    'SiteInfo' => function (\DI\Container $c) {
        return new SiteInfo();
    },
    'SiteInfoSettings' =>  array('title', 'keywords', 'description'),

    'CacheEnabled' => true,
    'Cache' => function (\DI\Container $c) {

        $cacheHost = str_replace('db-', 'cache-', Config::get('DB_SERVER'));
        if ($cacheHost === '') {
          $cacheHost = 'cache';
        }
        return new VCache($cacheHost, 11211, null, $c->get('CacheEnabled')); 
    }
];
