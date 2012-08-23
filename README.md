Yii-PHPMailer-Wrapper
=====================

Wrapper for PHPMailer in YII

Exemplo:

 'email'=>array(
  'class' => 'ext.phpmailer.YiiMailer',
  'pathViews' => 'application.views.email',
  'pathLayouts' => 'application.views.layouts.email',
  'From' => 'naoresponda@grupoadvis.com.br',
  'FromName' => 'SGCS - Grupo ADVIS',
  'delivery' => 'local', // local, gmail or custom
  //'Username' => '',
  //'Password' => '',
  ),