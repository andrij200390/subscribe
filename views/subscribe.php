<?php
use yii\helpers\Html;
use yii\helpers\Url;

echo Html::beginTag('div',['class' => 'subscribe__wrap']);
    echo Html::beginTag('p',['class' => 'subscribe__header']);
        echo $widget->descWidget;
    echo Html::endTag('p');
    echo Html::beginTag('form',[
        'class' => 'subscribe__form',
        'name' => 'subscribe__form',
        'method' => 'post',
        'action' => Url::current()
        ]
        );
        echo Html::hiddenInput('_csrf-frontend', yii::$app->request->getCsrfToken());
        echo Html::tag('input','',[
            'name'=>'subscribe__email',
            'type'=>'email',
            'class'=>'subscribe__email',
            'placeholder'=> $widget->placeholderWidget
        ]);
        echo Html::tag('input','',[
            'type'=>'submit',
            'class'=>'subscribe__send',
            'value'=> $widget->submitWidget
        ]);
    echo Html::endTag('form');
echo Html::endTag('div');