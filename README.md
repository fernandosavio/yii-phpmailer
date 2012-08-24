Yii-PHPMailer-Wrapper
=====================

Wrapper for PHPMailer in YII

Example of component config in main/config.php:
```php
return array(
    ...
    'components' => array(
        ...
        'email'=>array(
            'class' => 'ext.yii-phpmailer.YiiMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.layouts.email',
            'From' => 'belly@massivedynamic.com',
            'FromName' => 'William Bell - Massive Dynamic',
            'delivery' => 'gmail', // local, gmail or custom
            'Username' => 'belly@massivedynamic.com',
            'Password' => 'swordfish',
        ),
    ),
)
```