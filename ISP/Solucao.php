<?php

interface Cadastro {
    
    public function validar (Validavel $obj);
    
    public function salvar ($obj);
        
    public function create($data);
    
}

interface NotificacaoEmail {
    
    public function enviarEmail ($to, $subject, $message);
    
}

class UserService implements Cadastro, NotificacaoEmail {

    public function validar (Validavel $obj) {
        // (...)
    }

    public function salvar ($obj) {
        // (...)
    }

    public function enviarEmail ($to, $subject, $message) {
        // (...)
    }

    public function create($data) {
        // (...)
    }

}

class ProdutoService implements Cadastro {

    public function validar (Validavel $obj) {
        // (...)
    }

    public function salvar ($obj) {
        // (...)
    }

    public function create($data) {
        // (...)
    }

}