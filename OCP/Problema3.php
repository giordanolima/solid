<?php

class Boletos {
    
    public function gerarBoleto(Array $dados, $banco = "ITAÚ") {
        
        // Tratando dados
        switch ($banco) {
            case "SICREDI":
            case "BANRISUL":
                // (...)
                break;
            case "CEF":
                // (...)
                break;
            // (...)
            // (...)
            // (...)
            case "ITAÚ":
            default:
                // (...)
                break;
        }
        $dados = array_filter($dados);
        
        // Cadastrando Dados
        /*
         * (...)
         */
        if($banco == "BANRISUL")
            $dados = array_flip ($dados);
        BoletosRepository::save($dados);
        
        // Gerando PDF
        switch ($banco) {
            case "SICREDI":
                $view_banco = "sicredi";
                break;
            case "BANRISUL":
                $view_banco = "banrisul";
                break;
            case "CEF":
                $view_banco = "cef";
                break;
            case "ITAÚ":
            default:
                $view_banco = "itau";
                break;
        }
        
        ob_start();
        require __DIR__ . "/views/" . $view_banco . ".php";
        $data = ob_get_clean();
        ob_end_clean();
        
        // Salvando PDF
        switch ($banco) {
            case "SICREDI":
            case "BANRISUL":
                $arquivo = $dados["id"] . "-" . $dados["nosso_numero"];
                break;
            case "CEF":
            case "ITAÚ":
            default:
                $arquivo = $dados["nosso_numero"];
                break;
        }
        
        $path = __DIR__ . "/resouces/boletos/" . $arquivo . ".pdf";
        file_put_contents($path, $data);
        
    }
    
}