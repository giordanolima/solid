<?php
class User {

    public $id;
    public $email;
    public $password;

    public function isValid() {

        if ( !filter_var($this->email, FILTER_VALIDATE_EMAIL) ) {
            return false;
        }

        if ( $this->password != "" ) {
            return false;
        }

        return true;

    }

}

class BaseRepository {

    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=myapp","root","pass");
    }

    public function run($sql) {
        $statement = $this->db->prepare($sql);
        $statement->execute();
    }

}

class UserRepository extends BaseRepository {

    public function create(User $user) {

        $sql = "INSERT INTO users(email, password)";
        $sql .= "VALUES ('" .$user->email. "','" .md5($user->password). "')";
        $this->run($sql);

    }

}

class EmailService {

    public function send($to, $subject, $message) {

        $transport = Swift_SmtpTransport::newInstance()
                        ->setHost(EMAIL_HOST)
                        ->setPort(EMAIL_PORT)
                        ->setEncryption(EMAIL_SECURE)
                        ->setUsername(EMAIL_USER)
                        ->setPassword(EMAIL_PASS);
        $mailer = Swift_Mailer::newInstance($transport);

        $message = Swift_Message::newInstance()
            ->setFrom([ EMAIL_FROM => EMAIL_NAME ])
            ->setTo($to)
            ->setBody($message,'text/html')
            ->setSubject($subject);
        $mailer->send($message);

    }

}

class UserService {

    public function create($email, $password) {

        $user = new User();
        $user->email = $email;
        $user->password = $password;
        if ( !$user->isValid() )
            return false;

        $repository = new UserRepository();
        $repository->create($user);

        $to = $user->password;
        $subject = "Bem-vindo ao sistema";
        $message = "Acesse o sistema e seja feliz";
        $email = new EmailService();
        $email->send($to, $subject, $message);

        return true;
    }

}
