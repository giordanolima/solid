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
 
    public function setAltura($value) {
        $this->largura = $value;
        $this->altura = $value;
    }
 
    public function setLargura($value) {
        $this->largura = $value;
        $this->altura = $value;
    }
    
}

$quadrado = new Quadrado();
$quadrado->setAltura(10);
echo $quadrado->area(); // 100

$retangulo = new Retangulo();
$retangulo->setAltura(10);
$retangulo->setLargura(5);
echo $retangulo->area(); // 50

$quadrado = new Quadrado();
$quadrado->setAltura(10);
$quadrado->setLargura(5);
echo $quadrado->area(); // 25

class TestRetangulo {
    
    public static function test(Retangulo $retangulo){
        
        $retangulo->setWidth(10);
        $retangulo->setHeight(5);
        if($retangulo->area() != 50)
            return false;
        
        return true;        
    }
    
}

$quadrado = new Quadrado();
if( TestRetangulo::test($quadrado) ) {
    echo "OK!";
} else {
    echo "Ooops... Alguma coisa deu errado!";
}