<?php
Yii::import('ext.yii-phpmailer.PHPMailer.PHPMailer');

/**
 * YiiMailer is a wrapper for the PHPMailer 5.2.1 library.
 * @see https://github.com/fernandosavio/Yii-PHPMailer
 *
 * @author Fernando Savio
 * @package extensions
 * @subpackage yii-phpmailer
 * @since 1.0
 * 
 */
class YiiMailer extends CApplicationComponent {

    public $pathViews   = 'application.views.email';
    public $pathLayouts = 'application.views.layouts.email';
    public $delivery    = 'local';

    /**
     *
     * @var PHPMailer
     */
    private $_mailer;
    
    /**
     * The PHPMailer user settings.
     * 
     * <b>General settings</b>:
     * <ul>
     * <li><b>Priority</b>: Email priority (1=High, 3=Normal, 5=Low). Default: 3.</li>
     * <li><b>CharSet</b>: Sets the CharSet of the message. Default: 'utf-8'.</li>
     * <li><b>ContentType</b>: Sets the Content-type of the message. Default: 'text/html'.</li>
     * <li><b>Encoding</b>: Sets the Encoding of the message. Options for this are "8bit", "7bit", "binary", "base64", and "quoted-printable". Default: '8bit'.</li>
     * <li><b>From</b>: Sets the From email address for the message. Default: 'root@localhost'.</li>
     * <li><b>FromName</b>: Sets the From name of the message. Default: 'Root User'.</li>
     * <li><b>Sender</b>: Sets the Sender email (Return-Path) of the message. If not empty, will be sent via -f to sendmail or as 'MAIL FROM' in smtp mode. Default: ''.</li>
     * <li><b>Subject</b>: Sets the Subject of the message. Default: ''.</li>
     * <li><b>Body</b>: Sets the Body of the message. This can be either an HTML or text body. If HTML then run IsHTML(true). Default: ''.</li>
     * <li><b>WordWrap</b>: Sets word wrapping on the body of the message to a given number of characters. Default: 0.</li>
     * <li><b>Mailer</b>: Method to send mail: ("mail", "sendmail", or "smtp"). Default: 'mail'.</li>
     * <li><b>Sendmail</b>: Sets the path of the sendmail program. Default: '/usr/sbin/sendmail'.</li>
     * <li><b>PluginDir</b>: Path to PHPMailer plugins. This is now only useful if the SMTP class is in a different directory than the PHP include path. Default: ''.</li>
     * <li><b>ConfirmReadingTo</b>: Sets the email address that a reading confirmation will be sent. Default: ''.</li>
     * <li><b>Hostname</b>: Sets the hostname to use in Message-Id and Received headers and as default HELO string. If empty, the value returned by SERVER_NAME is used or 'localhost.localdomain'. Default: ''.</li>
     * <li><b>MIMEBody</b>: Stores the complete compiled MIME message body. Default: ''.</li>
     * <li><b>MIMEHead</b>: Stores the complete compiled MIME message headers. Default: ''.</li>
     * <li><b>SentMIMEMessage</b>: Stores the complete sent MIME message (Body and Headers). Default: ''.</li>
     * <li><b>MessageID</b>: Sets the message ID to be used in the Message-Id header. If empty, a unique id will be generated. Default: ''.</li>
     * </ul>
     * 
     * <b>SMTP settings</b>:
     * <ul>
     * <li><b>Host</b>: Sets the SMTP hosts. All hosts must be separated by a semicolon. You can also specify a different port for each host by using this format: [hostname:port] (e.g. "smtp1.example.com:25;smtp2.example.com"). Hosts will be tried in order. Default: ''.</li>
     * <li><b>Port</b>: Sets the default SMTP server port. Default: 25.</li>
     * <li><b>Helo</b>: Sets the SMTP HELO of the message. Default: $options['Hostname'].</li>
     * <li><b>SMTPAuth</b>: Sets SMTP authentication. Utilizes the Username and Password variables. Default: false.</li>
     * <li><b>Username</b>: Sets SMTP username. Default: ''.</li>
     * <li><b>Password</b>: Sets SMTP password. Default: ''.</li>
     * <li><b>Timeout</b>: Sets the SMTP server timeout in seconds. This function will not work with the win32 version. Default: 10.</li>
     * <li><b>SMTPDebug</b>: Sets SMTP class debugging on or off. Default: false.</li>
     * <li><b>SMTPKeepAlive</b>: Prevents the SMTP connection from being closed after each mail sending. If this is set to true then to close the connection requires an explicit call to SmtpClose(). Default: false.</li>
     * <li><b>SingleTo</b>: Provides the ability to have the TO field process individual emails, instead of sending to entire TO addresses. Default: false.</li>
     * <li><b>SMTPSecure</b>: Sets connection prefix. Options are "", "ssl" or "tls". Default: ''.</li>
     * <li><b>SingleToArray</b>: If SingleTo is true, this provides the array to hold the email addresses. Default: array().</li>
     * <li><b>LE</b>: Provides the ability to change the line ending. Default: '\n'.</li>
     * <li><b>DKIM_selector</b>: Used with DKIM DNS Resource Record. Default: 'phpmailer'.</li>
     * <li><b>DKIM_identity</b>: Used with DKIM DNS Resource Record (optional), in format of email address 'you@yourdomain.com'. Default: ''.</li>
     * <li><b>DKIM_passphrase</b>: Used with DKIM DNS Resource Record. Default: ''.</li>
     * <li><b>DKIM_domain</b>: Used with DKIM DNS Resource Record (optional), in format of email address 'you@yourdomain.com'. Default: ''.</li>
     * <li><b>DKIM_private</b>: Used with DKIM DNS Resource Record (optional), in format of email address 'you@yourdomain.com'. Default: ''.</li>
     * <li><b>action_function</b>: Callback Action function name the function that handles the result of the send email action. <br>
     * Parameters:
     * <ul>
     *  <li>bool    <b>$result</b>       result of the send action</li>
     *  <li>string  <b>$to</b>            email address of the recipient</li>
     *  <li>string  <b>$cc</b>            cc email addresses</li>
     *  <li>string  <b>$bcc</b>           bcc email addresses</li>
     *  <li>string  <b>$subject</b>       the subject</li>
     *  <li>string  <b>$body</b>          the email body. Default: ''.</li>
     * </ul>
     * </li>
     * <li><b>XMailer</b>: What to use in the X-Mailer header. Default: ''.</li>
     * </ul>
     * 
     * @var array 
     */
    private $settings = array(
        'default' => array(
            'CharSet' => 'utf-8',
            'ContentType' => 'text/html',
            //'Hostname' => '',
        ),
        'delivery' => array(
            'local' => array(
                'WordWrap' => 70,
                'Mailer' => 'mail',
            ),
            'gmail' => array(
                'Mailer'     => 'smtp',
                'Host'       => 'smtp.gmail.com',
                'Port'       => '465',
                'SMTPAuth'   => true,
                'SMTPSecure' => 'ssl',
            ),
            'custom' => array(),
        ),
    );
    
    public function init() {
        if(!isset($this->settings['delivery'][$this->delivery])) {
            throw new CException(Yii::t('YiiMailer', 'Delivery must be valid'));
        }

        foreach (array_merge($this->settings['default'], $this->settings['delivery'][$this->delivery]) as $key => $value) {
            $this->_mailer->set($key, $value);
        }
        
        $this->_mailer->SetFrom($this->_mailer->From,$this->_mailer->FromName);
        
        parent::init();
    }

    public function setEmailContent($view, $vars = array(), $layout = false) {
        $body = Yii::app()->controller->renderPartial($this->pathViews . '.' . $view, $vars, true);

        if (!$layout) {
            $this->_mailer->MsgHTML($body);
        } else {
            $this->_mailer->MsgHTML(Yii::app()->controller->renderPartial($this->pathLayouts . '.' . $layout, array('content' => $body), true));
        }
    }
    
    public function makeAndSend($to, $subject, $view, $vars) {
        $this->_mailer->AddAddress($to);
        $this->_mailer->Subject = $subject;
        $this->setEmailContent($view, $vars, 'main');
        
        $return = $this->_mailer->Send();
        
        $this->_mailer->ClearAllRecipients();
        $this->_mailer->ClearAttachments();
        
        return $return;
    }
    
    // MAGIC Methods
    
    public function __construct() {
         $this->_mailer = new PHPMailer();
    }
    
    public function __call($name, $parameters) {
        if(method_exists($this->_mailer, $name)) {
            return call_user_func_array(array($this->_mailer, $name), $parameters);
        } else {
            throw new CException('erro 1');
        }
        
        //parent::__call($name, $parameters);
    }
    
    public function __set($name, $value) {
        $this->_mailer->set($name, $value);
        
        //parent::__set($name, $value);
    }
    
    public function __get($name) {
        if(isset($this->_mailer->$name)) {
            return $this->_mailer->$name;
        } else {
            throw new CException('erro 2');
        }
        
        //parent::__get($name);
    }
}