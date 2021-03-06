<?php

namespace Sandbox\Cms;

use \Exception;
use Sandbox\Cms\Content\Field\AbstractField;
use Sandbox\Cms\Content\Field\Placeholder;


class CmsHelper
{
    public static function js()
    {
        if (config('zephyr.cms.hot')){
            $port = config('zephyr.cms.port');
            return '<script src="http://localhost:'.$port.'/vendor/zephyr/js/cms.js" type="text/javascript" ></script>';
        } else {
            return '<script src="/vendor/zephyr/js/cms.js" type="text/javascript"></script>';
        }
    }

    public static function css()
    {
        $port = config('zephyr.cms.port');
        $css = '';

        if (!config('zephyr.cms.hot')) {
            $css .= '<link href = "/vendor/zephyr/css/cms.css" rel = "stylesheet" type = "text/css" >';
        }
        $css .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" integrity="sha256-BJ/G+e+y7bQdrYkS2RBTyNfBHpA9IuGaPmf9htub5MQ=" crossorigin="anonymous" />';
        $css .= '<link href="https://unpkg.com/ionicons@4.2.0/dist/css/ionicons.min.css" rel="stylesheet">';

        return $css;
    }
}