<?php

interface Cadastro {
    
    public function validar (Validavel $obj);
    
    public function salvar ($obj);
    
    public function create($data);
    
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
    
}

interface Validavel {
    
    public function validar();
    
}

class Produto implements Validavel {
    
    public $nome;
    public $valor;
    
    public function isValid() {
        // (...)
    }
}

interface Database {
    
    public function run($sql);
    
    public function create($obj);
    
}

class ProdutoRepository implements Database {
    
    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=myapp","root","pass");
    }

    public function run($sql) {
        $statement = $this->db->prepare($sql);
        $statement->execute();
    }
    
    public function create($obj) {

        $sql = "INSERT INTO products(name, price)";
        $sql .= "VALUES ('" .$obj->nome. "'," . $obj->valor . ")";
        $this->run($sql);

    }
    
}

