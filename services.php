<?php

use Empathy\ELib\Blog\Util;
use Empathy\ELib\Settings\SiteInfo;


return [
    'SiteInfo' => function (\DI\Container $c) {
        return new SiteInfo();
    },
    'SiteInfoSettings' =>  array('title', 'keywords', 'description')
];
