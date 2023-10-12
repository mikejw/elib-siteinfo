<?php

namespace Empathy\ELib\Settings;

use Empathy\MVC\DI;

class SiteInfo
{
    private $vendorId = 0;

    public function __construct()
    {
        $this->settings = DI::getContainer()->get('SiteInfoSettings');
        $vendor = DI::getContainer()->get('Stash')->get('vendor');
        if ($vendor) {
            $this->vendorId = $vendor['id'];
        }
    }

    public function loadSettings()
    {
        $settings_o = new \stdClass();
        foreach($this->settings as $s) {
            $queryParams = array();
            array_push($queryParams, $s);
            $sql = 'name = ?';
            if ($this->vendorId) {
                $sql .= ' and vendor_id = ?';
                array_push($queryParams, $this->vendorId);
            } else {
                $sql .= ' and vendor_id is null';
            }
            if($setting = \R::findOne('setting', $sql, $queryParams)) {
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
