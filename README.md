Yii-PHPMailer-Wrapper
=====================

Wrapper for PHPMailer in YII

Exemplo:

 'email'=>array(
  'class' => 'ext.phpmailer.YiiMailer',
  'pathViews' => 'application.views.email',
  'pathLayouts' => 'application.views.layouts.email',
  'From' => 'noreply@yourdomain.com',
  'FromName' => 'William Bell - Massive Dynamic',
  'delivery' => 'local', // local, gmail or custom
  //'Username' => '',
  //'Password' => '',
  ),