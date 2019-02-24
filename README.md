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
This plugin has two working modes so far (and one utility):
- email
- telegram
- disabled

> NOTE: In order to sync your data with Google Spreadsheets, follow the guide [here](https://www.twilio.com/blog/2017/03/google-spreadsheets-and-php.html). You will need to generate your `client_secret.json` file and store it in your environment for later usage.

**Email** mode can store user input data in Google Spreadsheet.<br>**Telegram** mode simply shows predefined link to your channel.<br>**Disabled** mode allows not to render subscription panel without actual plugin removal (i.e. if you need to disable panel temporary).

Usage
-----
Once the extension is installed, simply put this code in desired view (full list of parameters included):

```php
use andrij200390\subscribe\Subscribe;

echo Subscribe::widget([
    'mode' => 'email', /* 'email' or 'telegram'. Default: 'disabled  */
    'cookie' => [
        'name' => 'subscribe', /* NOT IMPLEMENTED YET */
        'max-age' => 0, /* NOT IMPLEMENTED YET */
    ],
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
