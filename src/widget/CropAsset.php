<?php
/**
 * User: Liv <523260513@qq.com>
 * Date: 15/7/24
 * Time: 上午7:44
 */

namespace trntv\filekit\widget;


use yii\web\AssetBundle;

class CropAsset extends AssetBundle
{
    public $sourcePath = '@trntv/filekit/widget/assets';

    public $js = [
        'js/crop-kit.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'trntv\filekit\widget\JCropAsset'
    ];
}