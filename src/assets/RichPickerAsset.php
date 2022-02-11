<?php

namespace Imarc\CraftRichPicker\assets;

use craft\web\AssetBundle;
use craft\web\assets\vue\VueAsset;

class RichPickerAsset extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = "@Imarc/CraftRichPicker/resources";

        $this->css = [
            'css/rich-picker.css',
        ];

        $this->js = [
            'js/rich-picker.js',
        ];

        $this->depends = [
            VueAsset::class,
        ];

        parent::init();
    }
}
