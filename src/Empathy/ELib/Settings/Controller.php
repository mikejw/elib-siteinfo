<?php

namespace Empathy\ELib\Settings;
use Empathy\ELib\AdminController;



class Controller extends AdminController
{

    private static $settings = array('title', 'keywords', 'description');

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
