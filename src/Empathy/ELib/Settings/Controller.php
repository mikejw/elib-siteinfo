<?php

namespace Empathy\ELib\Settings;
use Empathy\ELib\AdminController;



class Controller extends AdminController
{
    public function default_event()
    {
        $settings_o = new \stdClass();

        $settings_o->title = TITLE;
        $settings_o->keywords = "mike michael whiting web developer programmer php lamp mysql javascript css perl linux";

        $settings_o->description = "Michael Whiting is a web programmer from West Sussex, England.  With ten years experience of the web, some of his work has powered the Bestival website and also adorned eBay UK.";
      
        $this->assign('settings', $settings_o);
        $this->setTemplate('elib:/admin/siteinfo/settings.tpl');
    }
}
