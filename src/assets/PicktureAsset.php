<?php

namespace Imarc\Pickture\assets;

use craft\web\AssetBundle;

class PicktureAsset extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = "@Imarc/Pickture/resources";

        $this->css = [
            'css/pickture.css',
        ];

        $this->js = [
            'js/pickture.js',
        ];

        parent::init();
    }
}
