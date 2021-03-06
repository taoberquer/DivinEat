<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

abstract class Mail extends PHPMailer
{
    public function __construct($exceptions = null)
    {
        parent::__construct($exceptions);

        $this->isSMTP();
        $this->isHTML();
        $this->setMailCredentialsWithEnv();
    }

    protected function setMailCredentialsWithEnv(): void
    {
        if (ENV === 'local')
            $this->SMTPDebug = SMTP::DEBUG_SERVER;

        $this->Host       = SMTP_HOST;
        $this->Username   = SMTP_USER;
        $this->Password   = SMTP_PASS;
        $this->Port       = SMTP_PORT;

        if (! empty(SMTP_PASS) && ! empty(SMTP_USER))
        {
            $this->SMTPAuth = true;
            $this->SMTPSecure = 'tls';
        }
    }

    protected function htmlTemplate(string $templateName, array $params = []): void
    {
        if (! file_exists(ROOT . '/ressources/mails/' . $templateName . '.php'))
            throw new \Exception('Impossible d\'include le template pour le mail');

        $this->msgHTML(
            file_get_contents(ROOT . '/ressources/mails/' . $templateName . '.php')
        );
    }

    protected abstract function initiateSender(): void;

    protected abstract function initiateSubject(string $subject = null): void;

    protected abstract function initiateBody(string $body = null): void;

    public static function sendMail(string $email, string $subject = null, string $body = null): void
    {
        $className = static::class;
        $mail = new $className();

        $mail->addAddress($email);

        $mail->initiateSender();
        $mail->initiateSubject($subject);
        $mail->initiateBody($body);

        $mail->send();
    }
}