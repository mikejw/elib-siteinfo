<?php

namespace Empathy\ELib\Settings;

use Empathy\ELib\AdminController;
use Empathy\MVC\VCache;
use Empathy\MVC\DI;



class Controller extends AdminController
{
    public function clear_cache()
    {
        $cache = $this->stash->get('cache');
        $cache->clear();
        $this->redirect('admin/settings/cache');
        return false;
    }

    public function cache()
    {
        $cache = $this->stash->get('cache');
        $cache_data = $cache->getAllCacheData();

        $this->assign('cache_data', $cache_data);
        $this->setTemplate('elib://admin/siteinfo/cache.tpl');
    }


    public function default_event()
    {
        $service = DI::getContainer()->get('SiteInfo');
        $settings = $service->getSettings();

        if(isset($_POST['cancel'])) {
            $this->redirect('admin');
        } elseif(isset($_POST['save'])) {
            foreach($settings as $s) {
                if($setting = \R::findOne('setting', 'name = ?', array($s))) {
                    $setting->value = $_POST[$s];
                    \R::store($setting);
                } else {
                    $setting = \R::dispense('setting');
                    $setting->name = $s;
                    $setting->value = $_POST[$s];
                    \R::store($setting);
                }
            }
            $this->redirect('admin/settings');
        }
        
        $this->assign('settings', $service->loadSettings());
        $this->setTemplate('elib:/admin/siteinfo/settings.tpl');
    }
}
