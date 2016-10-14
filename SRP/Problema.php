<?php

class User {

    public $id;
    public $email;
    public $password;

    public function create(){

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if ($this->password != ""){
            return false;
        }

        $db = new PDO("mysql:host=localhost;dbname=myapp","root","pass");
        $sql = "INSERT INTO users(email, password)";
        $sql .= "VALUES ('" .$this->email. "','" .md5($this->password). "')";
        $statement = $db->prepare($sql);
        $statement->execute();

        $transport = Swift_SmtpTransport::newInstance()
                        ->setHost(EMAIL_HOST)
                        ->setPort(EMAIL_PORT)
                        ->setEncryption(EMAIL_SECURE)
                        ->setUsername(EMAIL_USER)
                        ->setPassword(EMAIL_PASS);
        $mailer = Swift_Mailer::newInstance($transport);

        $message = Swift_Message::newInstance()
            ->setFrom([ EMAIL_FROM => EMAIL_NAME ])
            ->setTo($this->email)
            ->setBody("Acesse o sistema e seja feliz!",'text/html')
            ->setSubject("Bem-vindo ao sistema!");
        $mailer->send($message);

        return true;
    }

}