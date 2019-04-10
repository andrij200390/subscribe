yii2-subscribe
==============
This is a simple bottom slide-in panel subscription module for Yii2. Can send data into Google Spreadsheets.


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist andrij200390/yii2-subscribe "*"
```

or add

```
"andrij200390/yii2-subscribe": "*"
```

to the require section of your `composer.json` file.


Documentation
-----
This plugin has 3 working modes so far (and one utility):
- *as array:* `['telegram', 'instagram', 'vk']`
- *as string:* `email`
- *as string:* `telegram`
- *as string:* `disabled`

> NOTE: In order to sync your data with Google Spreadsheets, follow the guide [here](https://www.twilio.com/blog/2017/03/google-spreadsheets-and-php.html). You will need to generate your `client_secret.json` file and store it in your environment for later usage.

**[]** array mode shows links to all services.<br>**email** mode can store user input data in Google Spreadsheet.<br>**telegram** mode simply shows predefined link to your channel.<br>**disabled** mode allows not to render subscription panel without actual plugin removal (i.e. if you need to disable panel temporary).

Usage
-----
Once the extension is installed, simply put this code in desired view (full list of parameters included):

```php
use andrij200390\subscribe\Subscribe;

echo Subscribe::widget([
    'mode' => 'email', /* 'email' or 'telegram' or ['telegram', 'instagram']. Default: 'disabled' */
    'cookie' => [
        'name' => 'subscribe', /* NOT IMPLEMENTED YET - hardcoded in JS */
        'max-age' => 0, /* NOT IMPLEMENTED YET - hardcoded in JS */
    ],
    'style' => [
        'background' => 'dark', /* `green`, `blue`, `dark` - applies as a modifier to class name */
        'textcolor' => 'white' /* `black`, `white` - applies as a modifier to class name  */
    ]
    'email' => [
        'message' => '', /* Main text for email subscription */
        'submitButtonText' => '', /* Text for send button */
        'placeholderText' => '', /* Text inside input placeholder */
    ],
    'telegram' => [
        'message' => '', /* Main text for Telegram subscription */
        'submitButtonText' => '', /* Text for subscription button */
        'channelName' => '', /* i.e. `outstyle` */
    ],
    'instagram' => [
        'message' => '', /* Main text for Instagram subscription */
        'submitButtonText' => '', /* Text for subscription button */
        'channelName' => '', /* i.e. `outstyle` */
    ],
    'vk' => [
        'message' => '', /* Main text for VK subscription */
        'submitButtonText' => '', /* Text for subscription button */
        'channelName' => '', /* i.e. `outstyle` */
    ],
    'all' => [
        'message' => '' /* General message for all services */
    ],
    'provider' => [
        'google' => [
            'spreadsheet' => [
                'title' => '',
                'column' => '',
            ],
            'clientSecretJSON' => '' /* To be documented yet */
        ]
    ]
]);

```
