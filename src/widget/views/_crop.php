<?php
/* @var $this View */
use yii\helpers\Html;
use yii\web\View;

$css = <<<CSS
    #jcrop-modal > .modal-dialog{ overflow: hidden;}
CSS;

$this->registerCss($css);
?>
<div id="jcrop-modal" class="modal fade" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4><?=Yii::t('backend','Corp image')?></h4>
            </div>

            <div class="modal-body">
                <img src="" alt="Crop This Image" id="imageId">
            </div>

            <div class="modal-footer" data-action="" id="crop-form">
                <input type="hidden" id="url" name="url"/>
                <input type="hidden" id="crop_x" name="crop_x"/>
                <input type="hidden" id="crop_y" name="crop_y"/>
                <input type="hidden" id="crop_w" name="crop_w"/>
                <input type="hidden" id="crop_h" name="crop_h"/>
                <p>
                    <?= Html::button(Yii::t('backend', 'confirm'),[
                        'id'=>'btn-crop',
                        'class'=>'btn btn-primary'
                    ])?>
                </p>
            </div>
        </div>
    </div>
</div>