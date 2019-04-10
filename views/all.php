<?php
/**
 * Subscription to all channels in the array
 *
 * @var $this                       yii\web\View
 * @var $this->mode                 yii\web\View
 * @var $widget                     andrij200390\subscribe\Subscribe
 *
 * @author [SC]Smash3r <scsmash3r@gmail.com>
 * @since 1.0
**/

use yii\helpers\Html;
use yii\helpers\Url;

/* Gathering all the used channels */
$services = '';
foreach ($widget->mode as $service) {
    $services .=
        Html::a('', $widget->$service['channelName'], [
            'class' => 'subscribe__icon subscribe__icon--'.$service,
            'target' => '_blank'
        ]);
}

echo
Html::tag('div',
    Html::tag('p', $widget->all['message'], [
        'class' => 'subscribe__header subscribe__header--'.$widget->style['textcolor']
    ]).
    Html::tag('div',
        $services,
    [
        'class' => 'subscribe__form',
    ]).
    Html::tag('div',
        Html::tag('span', '', [
            'class' => 'subscribe__close'
        ]),
    [
        'class' => 'subscribe__wrap_btn'
    ]),
[
    'class' => 'subscribe__wrap subscribe__wrap--'.$widget->style['background']
]);
