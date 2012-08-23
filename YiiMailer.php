<?php
/**
 * YiiMailer class file.
 *
 * @author Fernando Savio
 * @version 1.0
 * @link https://github.com/fernandosavio/yii-phpmailer
 *
 * 	This program is free software: you can redistribute it and/or modify
 * 	it under the terms of the GNU Lesser General Public License as published by
 * 	the Free Software Foundation, either version 1.0 of the License, or
 * 	(at your option) any later version.
 *
 * 	This program is distributed in the hope that it will be useful,
 * 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 	GNU Lesser General Public License for more details.
 *
 * 	You should have received a copy of the GNU Lesser General Public License
 * 	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * For third party licenses and copyrights, please see phpmailer/LICENSE
 *
 */

/**
 * Include the the PHPMailer class.
 */
//require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'phpmailer'.DIRECTORY_SEPARATOR.'class.phpmailer.php');
Yii::import('ext\\yii-phpmailer\\PHPMailer\\class.phpmailer');

/**
 * EMailer is a wrapper for the PHPMailer 5.2.1 library.
 * @see https://github.com/fernandosavio/Yii-PHPMailer
 *
 * @author Fernando Savio
 * @package application.extensions.yii-phpmailer
 * @since 1.0
 */
class YiiMailer extends CApplicationComponent {
   //***************************************************************************
   // Configuration
   // Protected properties
   //***************************************************************************

   /**
    * The path to the directory where the view for getView is stored. Must not
    * have ending dot.
    *
    * @var string
    */
   protected $pathViews = 'application.views.email';

   
   /**
    * The PHPMailer user settings.
    * 
    * The properties are:
    * <ul>
    * <li><b>Priority</b>: Email priority (1=High, 2=Normal, 5=Low). Default: 3.</li>
    * <li><b>CharSet</b>: Sets the CharSet of the message. Default: 'utf-8'.</li>
    * <li><b>ContentType</b>: Sets the Content-type of the message. Default: 'text/plain'.</li>
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
    * <li><b>MIMEBody</b>: Stores the complete compiled MIME message body. Default: ''.</li>
    * <li><b>MIMEHead</b>: Stores the complete compiled MIME message headers. Default: ''.</li>
    * <li><b>SentMIMEMessage</b>: Stores the complete sent MIME message (Body and Headers). Default: ''.</li>
    * <li><b>MessageID</b>: Sets the message ID to be used in the Message-Id header. If empty, a unique id will be generated. Default: ''.</li>
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
   
   protected $settings = array();
   
   /**
    * The default PHPMailer options.
    * @var array 
    */
   
   private $_settings = array(
        
            // General Properties
            'Priority' => 3,
            'CharSet' => 'utf-8',
            'ContentType' => 'text/plain',
            'Encoding' => '8bit',
            'From' => 'root@localhost',
            'FromName' => 'Root User',
            'Sender' => '',
            'Subject' => '',
            'Body' => '',
            'AltBody' => '',
            'WordWrap' => 0,
            'Mailer' => 'mail',
            'SendMail' => '/usr/sbin/sendmail',
            'PluginDir' => '',
            'ConfirmReadingTo' => '',
            'Hostname' => '',
       
            // Properties for SMTP
            'Host' => 'localhost',
            'Port' => 25,
            'Helo' => '',
            'SMTPAuth' => false,
            'Username' => '',
            'Password' => '',
            'Timeout' => 10,
            'SMTPDebug' => false,
            'SMTPKeepAlive' => false,
            'SingleTo' => false,
       
            // Non-documented properties - General (v5.0.0 Docs)
            'MIMEBody' => '',
            'MIMEHead' => '',
            'SentMIMEMessage' => '',
            'MessageID' => '',
       
            // Non-documented properties - SMTP (v5.0.0 Docs)
            'SMTPSecure' => '',
            'SingleToArray' => array(),
            'LE' => '\n',
            'DKIM_selector' => 'phpmailer',
            'DKIM_identity' => '',
            'DKIM_passphrase' => '',
            'DKIM_domain' => '',
            'DKIM_private' => '',
            'action_function' => '',
            'XMailer' => '',
    );
   
   //***************************************************************************
   // Private properties
   //***************************************************************************

   /**
    * The internal PHPMailer object.
    *
    * @var object PHPMailer
    */
   private $_mailer;

   //***************************************************************************
   // Initialization
   //***************************************************************************

   /**
    * Init method for the application component mode.
    */
   public function init() {
       parent::init();
   }

   
   /**
    * Constructor. Here the instance of PHPMailer is created.
    */
    public function __construct()
    {
            $this->_myMailer = new PHPMailer();
    }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Setter
    *
    * @param string $value pathLayouts
    */
   public function setPathLayouts($value)
   {
      if (!is_string($value) && !preg_match("/[a-z0-9\.]/i"))
         throw new CException(Yii::t('EMailer', 'pathLayouts must be a Yii alias path'));
      $this->pathLayouts = $value;
   }

   /**
    * Getter
    *
    * @return string pathLayouts
    */
   public function getPathLayouts()
   {
      return $this->pathLayouts;
   }

   /**
    * Setter
    *
    * @param string $value pathViews
    */
   public function setPathViews($value)
   {
      if (!is_string($value) && !preg_match("/[a-z0-9\.]/i"))
         throw new CException(Yii::t('EMailer', 'pathViews must be a Yii alias path'));
      $this->pathViews = $value;
   }

   /**
    * Getter
    *
    * @return string pathViews
    */
   public function getPathViews()
   {
      return $this->pathViews;
   }

   //***************************************************************************
   // Magic
   //***************************************************************************

   /**
    * Call a PHPMailer function
    *
    * @param string $method the method to call
    * @param array $params the parameters
    * @return mixed
    */
	public function __call($method, $params)
	{
		if (is_object($this->_myMailer) && get_class($this->_myMailer)==='PHPMailer') return call_user_func_array(array($this->_myMailer, $method), $params);
		else throw new CException(Yii::t('EMailer', 'Can not call a method of a non existent object'));
	}

   /**
    * Setter
    *
    * @param string $name the property name
    * @param string $value the property value
    */
	public function __set($name, $value)
	{
	   if (is_object($this->_myMailer) && get_class($this->_myMailer)==='PHPMailer') $this->_myMailer->$name = $value;
	   else throw new CException(Yii::t('EMailer', 'Can not set a property of a non existent object'));
	}

   /**
    * Getter
    *
    * @param string $name
    * @return mixed
    */
	public function __get($name)
	{
	   if (is_object($this->_myMailer) && get_class($this->_myMailer)==='PHPMailer') return $this->_myMailer->$name;
	   else throw new CException(Yii::t('EMailer', 'Can not access a property of a non existent object'));
	}

	/**
	 * Cleanup work before serializing.
	 * This is a PHP defined magic method.
	 * @return array the names of instance-variables to serialize.
	 */
	public function __sleep()
	{
	}

	/**
	 * This method will be automatically called when unserialization happens.
	 * This is a PHP defined magic method.
	 */
	public function __wakeup()
	{
	}

   //***************************************************************************
   // Utilities
   //***************************************************************************

   /**
    * Displays an e-mail in preview mode. 
    *
    * @param string $view the class
    * @param array $vars
    * @param string $layout
    */
   public function getView($view, $vars = array(), $layout = null)
   {
      $body = Yii::app()->controller->renderPartial($this->pathViews.'.'.$view, array_merge($vars, array('content'=>$this->_myMailer)), true);
      if ($layout === null) {
         $this->_myMailer->Body = $body;
      }
      else {
         $this->_myMailer->Body = Yii::app()->controller->renderPartial($this->pathLayouts.'.'.$layout, array('content'=>$body), true);
      }
   }
}