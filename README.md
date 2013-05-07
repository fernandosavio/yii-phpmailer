Yii-PHPMailer-Wrapper
=====================

YiiMailer component is a wrapper for the PHPMailer 5.2.6 library.

Example of component config in config/main.php:
```php
return array(
    ...
    'components' => array(
        ...
        'email'=>array(
            'class'       => 'ext.yii-phpmailer.YiiMailer',
            'pathViews'   => 'application.views.email',
            'pathLayouts' => 'application.views.layouts.email',
            'From'        => 'belly@massivedynamic.com',
            'FromName'    => 'William Bell - Massive Dynamic',
            'delivery'    => 'gmail', // local, gmail or custom
            'Username'    => 'belly@massivedynamic.com',
            'Password'    => 'swordfish',
        ),
        ...
        'log' => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                ...
                'email' => array(
                    'class'   => 'ext.yii-phpmailer.YiiMailerLogRoute',
                    'levels'  => 'error, warning',
                    'except'  => 'exception.CHttpException.404',
                    'emails'  => array('support@developer.com'),
                    'subject' => 'Wanning LOG APPLICATION',
                    'enabled' => true,
                ),
                ...
            ),
        ),
        ...
    ),
    ...
);
```