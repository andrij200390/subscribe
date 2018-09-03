<?php

namespace andrij200390\subscribe;
use Yii;
use yii\base\Widget;
use yii\web\Cookie;
use yii\helpers\Url;
/**
 * This is just an example.
 */
class Subscribe extends Widget
{

    public $descWidget = 'Подпишитесь и будь в курсе всех Хип-Хоп новостей!';
    public $submitWidget = 'Подписаться';
    public $placeholderWidget = 'введите  Ваш e-mail';

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

            $content = $this->render('subscribe', ['widget' => $this]);
            $this->checkPost();

        }
        else{

            $content = $this->render('subscribe',['widget' => $this]);
            $this->checkPost();

        }

        $this->registerAsset();
        return $content;
    }


    public function registerAsset(){

        $this_Url = Url::current();
        $view = $this->getView();
        SubscribeAsset::register($view);
        $view->registerJs(<<<JS
        jQuery('.subscribe__send').on(function(){
            var data = $('.subscribe__form').serialize();
            $.ajax({
                url: '$this_Url',
                type: 'POST',
                data: data,
                success: function(res){
                    //console.log(res);
                    alert('Ok!');
                },
                error: function(){
                    alert('Error!');
                }
            });
            //return false;
        });
JS
                );

        $view->registerCss('
        ');
    }


    public function checkPost(){
        $request = Yii::$app->request;
        $email = $request->post('subscribe__email');
        if(!empty($email)){
            //echo $email;
        }
    }
}
