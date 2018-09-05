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
Click Enable API. 
Search for and enable the Google Drive API.
Create credentials for a Web Server to access Application Data.
Name the service account and grant it a Project Role of Editor.
Download the JSON file.

Copy the file to the desired directoryю (example '/frontend/web/assets')

The widget has a list of parameters:
clientSecret - the path to the json file 
descWidget - Text in the bar
submitWidget - Button text
placeholderWidget -Text in the email field
spreadsheetTitle - Table name on Google disk
spreadsheetCol - The name of the field in which we add data



If you want to delete fields in the table, change the information here (https://www.twilio.com/blog/2017/03/google-spreadsheets-and-php.html). Complete the functionality and send it to me.
PS, This is the first development, if you find how you can optimize the application, write to me)))


Once the extension is installed, simply use it in your code by  :

```php
<?= \andrij200390\subscribe\Subscribe::widget([
        'descWidget' => 'textDescripton',
        'submitWidget' => 'Send',
        'clientSecret' => '/path/to/file_secret',
        'spreadsheetTitle' => 'title_in_table',
        'spreadsheetCol' => 'col_in_table'

    ]); ?>```


