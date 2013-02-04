<?php

namespace Empathy\ELib\Settings;


class SiteInfo
{

    public static function getAll()
    {
        return Controller::loadSettings();
    }


}
