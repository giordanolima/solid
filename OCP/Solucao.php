<?php
abstract class Boletos {
    
    protected $view;
    protected $arquivo;
    abstract protected function tratarDados(Array $dados);
    protected function cadastrarDados(Array $dados) {
        BoletosRepository::save($dados);
    }
    protected function gerarPDF(Array $dados) {
        ob_start();
        extract($dados);
        require __DIR__ . "/views/" . $this->view . ".php";
        $data = ob_get_clean();
        ob_end_clean();
        return $data;
    }
    protected function salvarPDF($data) {
        $path = __DIR__ . "/resouces/boletos/" . $this->arquivo . ".pdf";
        file_put_contents($path, $data);
    }
    public function gerarBoleto(Array $dados) {
        $dados = $this->tratarDados($dados);
        $this->cadastrarDados($dados);
        $data = $this->gerarPdf($dados);
        $this->salvarPDF($data);
    }
    
}

class Itau extends Boletos {
 
    protected $view = "itau";
    protected $arquivo = "itau";
 
    protected function tratarDados(Array $dados){
        // (...)
    }
    
}

class Sicredi extends Boletos {
 
    protected $view = "sicredi";
    protected $arquivo = "sicredi";
 
    protected function tratarDados(Array $dados){
        // (...)
    }
    
}

class Banrisul extends Boletos {
 
    protected $view = "banrisul";
    protected $arquivo = "banrisul";
 
    protected function tratarDados(Array $dados){
        // (...)
    }
    protected function cadastrarDados(Array $dados){
        $dados = array_flip($dados);
        parent::cadastrarDados($dados);
    }
}

$itau = new Itau();
$itau->gerarBoletos($dados);

$sicredi = new Sicredi();
$sicredi->gerarBoletos($dados);

$banrisul = new Banrisul();
$banrisul->gerarBoletos($dados);