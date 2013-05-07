<?php

/**
 * YiiMailerLogRoute class file.
 * 
 * YiiMailerLogRoute sends selected log messages to email addresses using PHPMailer.
 * The target email addresses may be specified via {@link setEmails emails} property.
 * Optionally, you may set the email {@link setSubject subject}, the
 * {@link setSentFrom sentFrom} address and any additional {@link setHeaders headers}.
 *
 * @property array $emails List of destination email addresses.
 * @property string $subject Email subject.
 * 
 * @author Tonin De Rosso Bolzan <admin@tonybolzan.com>
 * @package extensions
 * @subpackage yii-phpmailer
 * @version 5.2.6-1
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class YiiMailerLogRoute extends CEmailLogRoute {

    /**
     * Sends an email.
     * @param string $email single email address
     * @param string $subject email subject
     * @param string $message email content
     */
    protected function sendEmail($email, $subject, $message) {
        if (Yii::app()->email instanceof YiiMailer) {

            Yii::app()->email->AddAddress($email);
            Yii::app()->email->Subject = $subject;
            Yii::app()->email->MsgHTML($message);

            Yii::app()->email->Send();

            Yii::app()->email->ClearAllRecipients();
            Yii::app()->email->ClearAttachments();
        } else {
            parent::sendEmail($email, $subject, $message);
        }
    }

    /**
     * Formats a log message given different fields.
     * @param string $message message content
     * @param integer $level message level
     * @param string $category message category
     * @param integer $time timestamp
     * @return string formatted message
     */
    protected function formatLogMessage($message, $level, $category, $time) {
        $ip = Yii::app()->request->userHostAddress;
        $user = Yii::app()->user;

        if ($ip and $user) {
            $return = @date('Y/m/d H:i:s', $time) . "[user:{$user->id}:{$user->name}] [ip:{$ip}] [{$level}] [{$category} {$message}\n";
        } else {
            $return = parent::formatLogMessage($message, $level, $category, $time);
        }

        return '<pre>' . $return . '</pre>';
    }

}