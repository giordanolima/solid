<?php

class Boletos {
    
    public function gerarBoleto(Array $dados, $banco = "ITAÚ") {
        
        // Tratando dados
        if($banco == "ITAÚ"){
            // (...)
        }
        if($banco == "SICREDI"){
            // (...)
        }
        $dados = array_filter($dados);
        
        // Cadastrando Dados
        /*
         * (...)
         */
        BoletosRepository::save($dados);
        
        // Gerando PDF
        if($banco == "ITAÚ")
            $view_banco = "itau";
        if($banco == "SICREDI")
            $view_banco = "sicredi";
        
        ob_start();
        require __DIR__ . "/views/" . $view_banco . ".php";
        $data = ob_get_clean();
        ob_end_clean();
        
        // Salvando PDF
        if($banco == "ITAÚ")
            $arquivo = $dados["nosso_numero"];
        if($banco == "SICREDI")
            $arquivo = $dados["id"] . "-" . $dados["nosso_numero"];
        
        $path = __DIR__ . "/resouces/boletos/" . $arquivo . ".pdf";
        file_put_contents($path, $data);
        
    }
    
}