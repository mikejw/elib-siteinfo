<?php

namespace Empathy\ELib\MVC\Plugin;

use Empathy\MVC\Plugin\PreEvent;
use Empathy\MVC\Plugin;
use Empathy\MVC\DI;
use Empathy\MVC\Config;
use Empathy\ELib\VCache;

class SiteInfo extends Plugin implements PreEvent
{

    public function onPreEvent()
    {
        $cacheHost = str_replace('db-', 'cache-', Config::get('DB_SERVER'));
        if ($cacheHost === "") {
            $cacheHost = 'cache';
        }
        $cache = new VCache($cacheHost, 11211, null, DI::getContainer()->get('CacheEnabled'));
        $this->stash->store('cache', $cache);

        $controller = $this->bootstrap->getController();
        $stash = DI::getContainer()->get('Stash');
        $siteInfoService = DI::getContainer()->get('SiteInfo');
        $cache = DI::getContainer()->get('Stash')->get('cache');
        $info = $cache->cachedCallback('site_info', array($siteInfoService, 'getAll'));
        $controller->assign('site_info', $info);
        $stash->store('site_info', $info);
    }
}

