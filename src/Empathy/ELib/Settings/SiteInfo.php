<?php

namespace Empathy\ELib\Settings;


use Empathy\MVC\DI;

class SiteInfo
{
    public function __construct()
    {
        $this->settings = DI::getContainer()->get('SiteInfoSettings');
    }

    public function loadSettings()
    {
        $settings_o = new \stdClass();
        foreach($this->settings as $s) {
            if($setting = \R::findOne('setting', 'name = ?', array($s))) {
                $settings_o->$s = $setting->value;
            }
        }
        return $settings_o;
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function getAll()
    {
        return $this->loadSettings();
    }
}
