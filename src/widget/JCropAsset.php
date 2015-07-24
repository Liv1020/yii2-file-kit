<?php
/**
 * User: Liv <523260513@qq.com>
 * Date: 15/7/24
 * Time: 上午7:26
 */

namespace trntv\filekit\widget;


use yii\web\AssetBundle;

class JCropAsset extends AssetBundle
{
    public $sourcePath = '@bower/jcrop';

    public $css = [
        'css/Jcrop.min.css'
    ];

    public $js = [
        'js/Jcrop.min.js',
        'js/jquery.color.js'
    ];
}