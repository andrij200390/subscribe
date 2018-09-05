<?php

namespace andrij200390\subscribe;
use Google\Spreadsheet\ServiceRequestFactory;
use Yii;
use yii\base\Widget;
use Google\Spreadsheet\SpreadsheetService;



/**
 * This is just an example.
 */
class Subscribe extends Widget
{

    public $descWidget = 'Подпишитесь и будь в курсе всех Хип-Хоп новостей!';
    public $submitWidget = 'Подписаться';
    public $placeholderWidget = 'введите  Ваш e-mail';
    public $spreadsheetTitle = 'Subscribe';
    public $spreadsheetCol = 'email';
    public $clientSecret = '';



    public function run()
    {

        $my_subscribe = \Yii::$app->getRequest()->getCookies()->getValue('my_subscribe');
         /**
         * If is cookies - hide form
         */
        if(!$my_subscribe){
            $content = $this->render('subscribe', ['widget' => $this]);
            $this->checkPost();
        }
        else{
            $this->checkPost();
            $content='';
        }
        $this->registerAsset();
        return $content;
    }


    public function registerAsset(){
        $view = $this->getView();
        SubscribeAsset::register($view);
    }


    public function checkPost(){
        $request = Yii::$app->request;
        $email = $request->post('subscribe__email');
        if(!empty($email)){
            /*send in google spreadsheet*/
            putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $this->clientSecret);
            $client = new \Google_Client();
            $client->useApplicationDefaultCredentials();
            $client->setApplicationName("Something to do with my representatives");
            $client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);

            if ($client->isAccessTokenExpired()) {
                $client->refreshTokenWithAssertion();
            }

            $accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
            \Google\Spreadsheet\ServiceRequestFactory::setInstance(
                new \Google\Spreadsheet\DefaultServiceRequest($accessToken)
            );

            $spreadsheet = (new SpreadsheetService)
                ->getSpreadsheetFeed()
                ->getByTitle($this->spreadsheetTitle);
            $worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
            $worksheet = $worksheets[0];
            $listFeed = $worksheet->getListFeed();
            $listFeed->insert([
                $this->spreadsheetCol =>  $email
            ]);
            /*send in google spreadsheet*/
        }
    }
}
