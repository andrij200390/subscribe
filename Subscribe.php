<?php

namespace andrij200390\subscribe;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\Cookie;
/**
 * This is just an example.
 */
class Subscribe extends Widget
{
    public $descWidget = 'Подпишитесь и будь в курсе всех Хип-Хоп новостей!';
    public function run()
    {
        $my_subscribe = \Yii::$app->getRequest()->getCookies()->getValue('my_subscribe');
         /**
         * If is cookies - hide form
         */
        if(!$my_subscribe){
            $subscribe_cookie = new Cookie([
                'name' => 'my_subscribe',
                'value' => '1',
                'expire' => time() + 86400 * 3,
            ]);
            Yii::$app->getResponse()->getCookies()->add($subscribe_cookie);

            $content = $this->getContent();
        }
        else{
            $content = '';
            $content = $this->getContent();
        }
        return $content;
    }

    public function getContent(){
        echo Html::beginTag('div',['class' => 'subscribe__wrap']);
        echo Html::beginTag('p',['class' => 'subscribe__header']);
        echo $this->descWidget;
        echo Html::endTag('p');
        echo Html::beginTag('form',['class' => 'subscribe__form', 'name' => 'subscribe__form', 'method' => 'post']);
        echo Html::tag('input','',[
            'name'=>'subscribe__email',
            'type'=>'text',
            'class'=>'subscribe__email',
            'placeholder'=>'введите  Ваш e-mail'
        ]);
        echo Html::tag('input','',[
            'name'=>'subscribe__send',
            'type'=>'button',
            'class'=>'subscribe__send',
            'value'=>'Подписаться'
        ]);
        echo Html::endTag('form');
        echo Html::endTag('div');
    }
}
