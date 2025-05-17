<?php

/**
* Use this plugin for automatically caching site info data and assigning to Smarty.
* Also for making the cache generally abailable through the stash object.
*/

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
	    $cache = DI::getContainer()->get('Cache');
        $stash->store('cache', $cache);
        
        $siteInfoService = DI::getContainer()->get('SiteInfo');
        $stash->store('site_info', $cache->cachedCallback('site_info', array($siteInfoService, 'getAll')));
    }
    
    public function onPreEvent()
    {
        $controller = DI::getContainer()->get('Controller');
        $controller->assign('site_info', DI::getContainer()->get('Stash')->get('site_info'));
    }
}

