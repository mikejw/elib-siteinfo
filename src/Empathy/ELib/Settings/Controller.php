<?php

namespace Empathy\ELib\Settings;

use App\Http\Controllers\Api\Data\PaladinNetworkController;
use Empathy\ELib\AdminController;
use Empathy\MVC\RequestException;
use Empathy\MVC\VCache;
use Empathy\MVC\DI;



class Controller extends AdminController
{


    public function __construct($boot)
    {
        parent::__construct($boot);
        $vendor = $this->stash->get('vendor');
        if ($vendor) {
            $this->stash->store('vendorId', $vendor['id']);
        }
    }


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
        $vendorId = $this->stash->get('vendorId');
        $service = DI::getContainer()->get('SiteInfo');
        $settings = $service->getSettings();

        if (isset($_POST['cancel'])) {
            $this->redirect('admin');
        } elseif (isset($_POST['save'])) {
            if ($vendorId) {
                $vendorBean = \R::load('vendor', $vendorId);
            }

            foreach ($settings as $s) {
                if (!isset($_POST[$s])) {
                  break;
                }

                $sql = 'name = ?';
                $queryParams = array($s);
                if (isset($vendorBean) && $vendorBean->id) {
                    $sql .= ' and vendor_id = ?';
                    array_push($queryParams, $vendorId);
                } else {
                    $sql .= ' and vendor_id is null';
                }

                if ($setting = \R::findOne('setting', $sql, $queryParams)) {
                    $setting->value = $_POST[$s];
                    if (isset($vendorBean) && $vendorBean->id) {
                        $setting->vendor = $vendorBean;
                    }
                    \R::store($setting);
                } else {
                    $setting = \R::dispense('setting');
                    $setting->name = $s;
                    $setting->value = $_POST[$s];
                    if (isset($vendorBean) && $vendorBean->id) {
                        $setting->vendor = $vendorBean;
                    }
                    \R::store($setting);
                }
            }
            $this->redirect('admin/settings');
        }
        
        $this->assign('settings', $service->loadSettings());
        $this->assign('settings_available', $settings);
        $this->setTemplate('elib:/admin/siteinfo/settings.tpl');
    }
}
