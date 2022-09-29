<?php

namespace Imarc\Pickture\assets;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class PicktureAsset extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = "@Imarc/Pickture/resources";

        $this->depends = [
            CpAsset::class,
        ];

        $this->css = [
            'css/pickture.css',
        ];

        $this->js = [
            'js/pickture.js',
        ];

        parent::init();
    }
}
