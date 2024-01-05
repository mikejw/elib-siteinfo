<?php

namespace Empathy\ELib\MVC\Plugin;

use Empathy\MVC\Plugin\PreEvent;
use Empathy\MVC\Plugin as Plugin;
use Empathy\MVC\DI;

class SiteInfo extends Plugin implements PreEvent
{

    public function onPreEvent()
    {
        $controller = $this->bootstrap->getController();
        $stash = DI::getContainer()->get('Stash');
        $siteInfoService = DI::getContainer()->get('SiteInfo');
        $cache = DI::getContainer()->get('Stash')->get('cache');
        $info = $cache->cachedCallback('site_info', array($siteInfoService, 'getAll'));
        $controller->assign('site_info', $info);
        $stash->store('site_info', $info);
    }
}

