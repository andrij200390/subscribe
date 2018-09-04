<?php

namespace andrij200390\subscribe;

use yii\web\AssetBundle;

/**
 * CropperAsset
 *
 * @url https://github.com/fengyuanchen/cropper
 * @author Ivan Orlov <orlov_mail@mail.ru>
 */
class SubscribeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/andrij200390/yii2-subscribe/';
    public $css = [
        'assets/subscribe.css',
    ];
    public $js = [
      'assets/subscribe.js'
    ];
}
