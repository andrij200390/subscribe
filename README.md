yii2-subscribe
==============
Subscription extension in yii2. Send data in google spreadsheet

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


Usage
-----
Go to the Google APIs Console(https://console.developers.google.com/).
Create a new project.
Click Enable API. Search for and enable the Google Drive API.
Create credentials for a Web Server to access Application Data.
Name the service account and grant it a Project Role of Editor.
Download the JSON file.

Copy the JSON file to your app directory and rename it to client_secret.json 

On the way /vendor/andrij200390/yii2-subscribe replace the file client_secret.json with yours. 

Here is the entry in Google table called 'Subscribe'(variable spreadsheetTitle)
To change, go to the file Subscribe.php
The field 'email' in which I write also there varies in file Subscribe.php

The inscriptions also change in the corresponding changes(submitWidget, descWidget, placeholderWidget)


Once the extension is installed, simply use it in your code by  :

```php
<?= \andrij200390\subscribe\Subscribe::widget(); ?>```


If you want to delete fields in the table, change the information here (https://www.twilio.com/blog/2017/03/google-spreadsheets-and-php.html). Complete the functionality and send it to me.
PS, This is the first development, if you find how you can optimize the application, write to me)))

