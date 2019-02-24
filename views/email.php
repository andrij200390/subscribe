<?php
/**
 * Email subscription panel view
 *
 * @var $this                       yii\web\View
 * @var $widget                     andrij200390\subscribe\Subscribe
 *
 * @author andrij200390 <andrij200390@gmail.com>
 * @since 1.0
**/

use yii\helpers\Html;
use yii\helpers\Url;

echo
Html::tag('div',
    Html::tag('p', $widget->email['message'], [
        'class' => 'subscribe__header'
    ]).
    Html::tag('form',
        Html::hiddenInput('_csrf-frontend', yii::$app->request->getCsrfToken()).
        Html::tag('input', '', [
            'name' => 'subscribe__email',
            'type' => 'email',
            'class' => 'subscribe__email',
            'placeholder' => $widget->email['placeholderText']
        ]).
        Html::tag('input', '', [
            'type' => 'button',
            'class' => 'subscribe__send',
            'value' => $widget->email['submitButtonText']
        ]),
    [
        'class' => 'subscribe__form',
        'name' => 'subscribe__form',
        'method' => 'post',
    ]).
    Html::tag('div',
        Html::tag('span', '', [
            'class' => 'subscribe__close'
        ]),
    [
        'class' => 'subscribe__wrap_btn'
    ]),
[
    'class' => 'subscribe__wrap subscribe__wrap--green'
]);
