<?php
/**
 * Scarawler Mailer Service
 *
 * @package: Scrawler
 * @author: Pranjal Pandey
 */

namespace Scrawler\Service;

use Scrawler\Scrawler;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

Class Mailer extends PHPMailer{

    function __construct($exception){
        parent::__construct($exception);
        $this->SMTPDebug = SMTP::DEBUG_SERVER;                                              // Enable verbose debug output
        $this->isSMTP();                                                                    // Send using SMTP
        $this->Host = Scrawler::engine()->config['mailer']['host'];                         // Set the SMTP server to send through
        $this->SMTPAuth = true;                                                             // Enable SMTP authentication
        $this->Username = Scrawler::engine()->config['mailer']['username'];                 // SMTP username
        $this->Password = Scrawler::engine()->config['mailer']['password'];                 // SMTP password
        if (Scrawler::engine()->config['mailer']['secure']) {
        $this->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                                 // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        }
        $this->Port = Scrawler::engine()->config['mailer']['port'];                         // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    }

    function __set($key,$value){
        if($key == 'from'){
            $this->setFrom($value);
        }
        if($key == 'to'){
            $this->addAddress($value);
        }
        if($key == 'reply'){
            $this->addReplyTo($value);
        }
        if($key == 'cc'){
            $this->addCC($value);
        }
        if($key == 'bcc'){
            $this->addBCC($value);
        }
        if($key == 'attachement'){
            $this->addAttachment($value);
        }
        // idk how you found this but give yourself a cookie #6095 for this
    }
    

}