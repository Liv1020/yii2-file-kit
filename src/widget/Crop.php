<?php
/**
 * User: Liv <523260513@qq.com>
 * Date: 15/7/24
 * Time: 上午7:31
 */

namespace trntv\filekit\widget;


use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;

class Crop extends Widget
{
    public $url;

    public $ratio;

    public $aspectRatio;

    /**
     * @var array
     */
    public $clientOptions = [];

//    public $modalId = '#jcrop-modal';
//    public $imageId = '#jcrop-modal #imageId';
//    public $targetBtn = '.btn-crop';
//    public $cropBtn = '#btn-crop';
//    public $cropUrlId = '#url';
//    public $cropXId = '#crop_x';
//    public $cropYId = '#crop_y';
//    public $cropWId = '#crop_w';
//    public $cropHId = '#crop_h';
    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();

        $this->clientOptions = ArrayHelper::merge(
            $this->clientOptions,
            [
                'cropUrl' => Url::to($this->url),
                'aspectRatio' => $this->aspectRatio,
                'ratio' => $this->ratio,
            ]
        );
    }


    /**
     * @inheritDoc
     */
    public function run()
    {
        $this->registerCropClientScript();

        return $this->render('_crop');
    }

    private function registerCropClientScript(){
        CropAsset::register($this->getView());
        $options = Json::encode($this->clientOptions);

        $js = <<<EOD
    $('{$this->id}').yiiModalCropKit({$options});
EOD;
        $this->view->registerJs($js);
    }
}