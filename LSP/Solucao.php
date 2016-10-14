<?php
class Retangulo {
 
    private $largura;
    private $altura;
 
    public function setAltura($altura) {
        $this->altura = $altura;
    }
 
    public function setLargura($largura) {
        $this->largura = $largura;
    }
 
    public function area() {
        return $this->altura * $this->largura;
    }
}

class Quadrado extends Retangulo {
 
    private $lado;
    
    public function setLado($value) {
        $this->lado = $value;
    }
 
    public function area() {
        return $this->lado * $this->lado;
    }
    
}

class TestRetangulo {
    
    public static function test(Retangulo $retangulo){
        
        $retangulo->setWidth(10);
        $retangulo->setHeight(5);
        if($retangulo->area() != 50)
            return false;
        
        return true;        
    }
    
}

class TestQuadrado {
    
    public static function test(Quadrado $quadrado){
        
        $quadrado->setLado(10);
        if($quadrado->area() != 100)
            return false;
        
        return true;        
    }
    
}