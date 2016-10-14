<?php

interface Cadastro {
    
    public function validar (Validavel $obj);
    
    public function salvar ($obj);
    
    public function enviarEmail ($to, $subject, $message);
    
    public function create($data);
    
}

class UserService implements Cadastro {

    public function validar (Validavel $obj) {
        return $obj->isValid();
    }
    
    public function salvar ($obj) {
        $repository = new UserRepository();
        $repository->create($obj);
    }
    
    public function enviarEmail ($to, $subject, $message) {
        $email = new EmailService();
        $email->send($to, $subject, $message);
    }


    public function create($data) {

        $user = new User();
        $user->email = $data["email"];
        $user->password = $data["password"];
        
        if ( !$this->validar($user) )
            return false;

        $this->salvar($user);
        
        $subject = "Bem-vindo ao sistema";
        $message = "Acesse o sistema e seja feliz";
        $this->enviarEmail($user->email, $subject, $message);

        return true;
    }

}

class ProdutoService implements Cadastro {
    
    public function validar (Validavel $obj) {
        return $obj->isValid();
    }
    
    public function salvar ($obj) {
        $repository = new ProdutoRepository();
        $repository->create($obj);
    }
    
    public function create($data) {

        $produto = new Produto();
        $produto->nome = $data["nome"];
        $produto->valor = $data["valor"];
        
        if ( !$this->validar($produto) )
            return false;

        $this->salvar($produto);
        return true;
    }
    
    public function enviarEmail ($to, $subject, $message) {
         /* =====---- E AGORA ???? ----==== */
    }
    
}