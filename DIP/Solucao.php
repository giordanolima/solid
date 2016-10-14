<?php

interface Cadastro {
    
    public function validar (Validavel $obj);
    
    public function salvar ($obj);
    
    public function create($data);
    
}

interface IProdutoService extends Cadastro {
    
}

class ProdutoService implements IProdutoService {
    
    private $_produto;
    private $_produtoRepository;
    
    public function __construct(IProduto $p, IProdutoRepository $pR) {
        $this->_produto = $p;
        $this->_produtoRepository = $pR;
    }
    
    public function validar (Validavel $obj) {
        return $obj->isValid();
    }
    
    public function salvar ($obj) {
        $this->_produtoRepository->create($obj);
    }
    
    public function create($data) {

        $this->_produto->nome = $data["nome"];
        $this->_produto->valor = $data["valor"];
        
        if ( !$this->validar($this->_produto) )
            return false;

        $this->salvar($this->_produto);
        return true;
    }
    
}

interface Validavel {
    
    public function validar();
    
}

interface IProduto extends Validavel{
    
}

class Produto implements IProduto {
    
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

interface IProdutoRepository extends Database {
    
}

class ProdutoRepository implements IProdutoRepository {
    
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