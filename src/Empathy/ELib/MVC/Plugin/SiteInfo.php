<?php

namespace Empathy\ELib\MVC\Plugin;

use Empathy\MVC\Plugin\PreDispatch;
use Empathy\MVC\Plugin\PreEvent;
use Empathy\MVC\Plugin;
use Empathy\MVC\DI;
use Empathy\MVC\Config;
use Empathy\ELib\VCache;

class SiteInfo extends Plugin implements PreDispatch, PreEvent
{
    public function onPreDispatch()
    {
        $stash = DI::getContainer()->get('Stash');
        $cacheHost = str_replace('db-', 'cache-', Config::get('DB_SERVER'));
        if (strpos('db', $cacheHost) === 0) {
            $cacheHost = 'cache';
        }
        $cache = new VCache($cacheHost, 11211, null, DI::getContainer()->get('CacheEnabled'));
        $stash->store('cache', $cache);
        $siteInfoService = DI::getContainer()->get('SiteInfo');
        $stash->store('site_info', $cache->cachedCallback('site_info', array($siteInfoService, 'getAll')));
    }
    
    public function onPreEvent()
    {
        $controller = $this->bootstrap->getController();
        $controller->assign('site_info', DI::getContainer()->get('Stash')->get('site_info'));
    }
}

