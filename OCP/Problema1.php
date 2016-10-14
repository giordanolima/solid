<?php

class Boletos {
    
    public function gerarBoleto(Array $dados) {
        
        // Tratando dados
       /* 
        * (...)
        */
        $dados = array_filter($dados);
        
        // Cadastrando Dados
        /*
         * (...)
         */
        BoletosRepository::save($dados);
        
        // Gerando PDF
        ob_start();
        require __DIR__ . "/views/boleto.php";
        $data = ob_get_clean();
        ob_end_clean();
        
        // Salvando PDF
        $path = __DIR__ . "/resouces/boletos/" . $dados["nosso_numero"] . ".pdf";
        file_put_contents($path, $data);
        
    }
    
}