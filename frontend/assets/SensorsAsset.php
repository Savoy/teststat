<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Sensors frontend application asset bundle.
 */
class SensorsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/sensors.js',
    ];
}
