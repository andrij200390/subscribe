<?php

namespace andrij200390\subscribe;

use Yii;
use yii\base\Widget;

use Google\Spreadsheet\SpreadsheetService;
use Google\Spreadsheet\ServiceRequestFactory;

/**
 * Subscribe is a widget that adds sticked-to-bottom line with custom suggestion/message/link/etc.
 * User is prompted to subscribe once. After that certain cookie is set to prevent message appearance.
 * This plugin also relies on Google Spreadsheet dependency for emails storage.
 *
 * @author andrij200390 <andrij200390@gmail.com>
 * @author [SC]Smash3r <scsmash3r@gmail.com>
 * @since 1.0
 */
class Subscribe extends Widget
{
    /**
     * Subscription mode
     * @var string|array
     */
    public $mode;

    /**
     * Subscription parameters for email mode
     * @var array
     */
    public $email;

    /**
     * Subscription parameters for Telegram messenger mode
     * @var array
     */
    public $telegram;

    /**
     * Subscription parameters for Instagram mode
     * @var array
     */
    public $instagram;

    /**
     * Subscription parameters for VKontakte mode
     * @var array
     */
    public $vk;

    /**
     * Subscription parameters for all services
     * @var array
     */
    public $all;

    /**
     * Settings for thirdparty providers/services, like Google Spreadsheets
     * @var array
     */
    public $provider;

    /**
     * Settings for controlling cookies
     * @var array
     */
    public $cookie;


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!$this->mode) {
            $this->mode = 'disabled';
        }

        /* Defaults for email mode */
        $this->email['message'] = $this->email['message'] ?? 'Subscribe to keep up with our latest news!';
        $this->email['submitButtonText'] = $this->email['submitButtonText'] ?? 'Subscribe';
        $this->email['placeholderText'] = $this->email['placeholderText'] ?? 'Enter your e-mail';

        /* Defaults for Telegram mode */
        $this->telegram['message'] = $this->telegram['message'] ?? 'Subscribe to our Telegram channel!';
        $this->telegram['submitButtonText'] = $this->telegram['submitButtonText'] ?? 'Subscribe';
        $this->telegram['channelName'] = 'https://t.me/'.$this->telegram['channelName'] ?? 'UNNAMED';

        /* Defaults for Instagram mode */
        $this->instagram['message'] = $this->instagram['message'] ?? 'Subscribe to our Instagram channel!';
        $this->instagram['submitButtonText'] = $this->instagram['submitButtonText'] ?? 'Subscribe';
        $this->instagram['channelName'] = 'https://instagram.com/'.$this->instagram['channelName'] ?? 'UNNAMED';

        /* Defaults for VK mode */
        $this->vk['message'] = $this->vk['message'] ?? 'Subscribe to our VKontakte channel!';
        $this->vk['submitButtonText'] = $this->vk['submitButtonText'] ?? 'Subscribe';
        $this->vk['channelName'] = 'https://vk.com/'.$this->vk['channelName'] ?? 'UNNAMED';

        /* Defaults for showing all subscription channels mode */
        if (is_array($this->mode)) {
            $this->all['message'] = $this->all['message'] ?? 'Subscribe to our channels: ';
        }

        /* Defaults for provider */
        if ($this->provider === 'google') {
            $this->provider['google']['spreadsheet']['title'] = 'Subscribe';
            $this->provider['google']['spreadsheet']['column'] = 'email';
            $this->provider['google']['clientSecretJSON'] = '';
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        /* If you want to temporary hide message bar */
        if ($this->mode == 'disabled') {
            return;
        }

        $view = $this->mode;

        if (is_array($this->mode)) {
            $view = 'all';
        }

        $cookieCheck = \Yii::$app->getRequest()->getCookies()->getValue('my_subscribe');

        if ($cookieCheck) {
            return;
        }

        $this->_checkPost();
        $this->_registerAsset();
        return $this->render($view, ['widget' => $this]);
    }


    private function _registerAsset()
    {
        $view = $this->getView();
        SubscribeAsset::register($view);
    }


    private function _checkPost()
    {
        $request = Yii::$app->request;
        $email = $request->post('subscribe__email');
        if (!empty($email)) {
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
