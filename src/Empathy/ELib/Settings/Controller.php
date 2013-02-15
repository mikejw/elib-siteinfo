<?php

namespace Empathy\ELib\Settings;
use Empathy\ELib\AdminController,
    Empathy\MVC\VCache;



class Controller extends AdminController
{

    private static $settings = array('title', 'keywords', 'description');


    public function clear_cache()
    {
        $cache = $this->stash->get('cache');
        $cache->clear();
        $this->redirect('admin/settings/cache');
    }

    public function cache()
    {
        $cache = $this->stash->get('cache');
        $cache_data = $cache->getAllCacheData();

        $this->assign('cache_data', $cache_data);
        $this->setTemplate('elib://admin/siteinfo/cache.tpl');
    }

    public static function loadSettings()
    {
        $settings_o = new \stdClass();

        foreach(self::$settings as $s) {

            if($setting = \R::findOne('setting', 'name = ?', array($s))) {
                $settings_o->$s = $setting->value;
            }
        }
        
        return $settings_o;
    }


    public function default_event()
    {        
        if(isset($_POST['cancel'])) {
            $this->redirect('admin');
        } elseif(isset($_POST['save'])) {

            foreach(self::$settings as $s) {

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
        
        $this->assign('settings', self::loadSettings());
        $this->setTemplate('elib:/admin/siteinfo/settings.tpl');
    }
}
