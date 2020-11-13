<?php
class Lcd {

	const BRANCO = '&nbsp;';
	const ESPACO = ' ';
	const LINHA = '-';
	const COLUNA = '|';
	const PULAR_LINHA = PHP_EOL;
	
	private $tamLinha;
	
	private $tamColuna;
	
	private $entrada;
	
	private $lcd;
	
	private $digito = array();
	
	private $num_func = array(
		0 => 'zero',
		1 => 'um',
		2 => 'dois',
		3 => 'tres',
		4 => 'quatro',
		5 => 'cinco',
		6 => 'seis',
		7 => 'sete',
		8 => 'oito',
		9 => 'nove'
	);
	
	public function __construct($s, $n) {
		
		$this->setTamanhoDigito($s);
		$this->setEntrada($n);
	}
	
	public function imprimir($arquivo=false) {
		
		try {
			$cont = strlen($this->entrada);
			for($x=0; $x <= $cont-1; $x++) {
				$funcNum = $this->num_func[$this->entrada[$x]];
				call_user_func(array($this, $funcNum), $x);
			}
			
			for($x=0; $x < $this->tamLinha; $x++) {
				for($n = 0; $n < $cont; $n++) {
					for($y = 0; $y < $this->tamColuna; $y++) {
						echo $this->lcd[$n][$x][$y];
					}
					if($n <= $cont-1) echo self::BRANCO;
				}
				echo '<br />';
			}
			
			if($arquivo)
				$this->imprimirNoArquivo();
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function imprimirNoArquivo() {
		
		$file = fopen('lcd.txt', 'w');
		if(false === $file)
			throw new Exception('O arquivo não pode ser criado');

		$cont = strlen($this->entrada);
		for($x=0; $x < $this->tamLinha; $x++) {
			for($n = 0; $n < $cont; $n++) {
				for($y = 0; $y < $this->tamColuna; $y++) {
					 if($this->lcd[$n][$x][$y] == self::BRANCO)
					 	fwrite($file, self::ESPACO);
					 else fwrite($file, $this->lcd[$n][$x][$y]);
				}
				if($n <= $cont-1) fwrite($file,self::ESPACO);
			}
			fwrite($file,self::PULAR_LINHA);
		}
		
		fclose($file);
	}
	
	public function imprimirLinha($num) {
		for($x = 1; $x < $this->tamColuna - 1; $x++) {
			$this->digito[$num][$x] = self::LINHA;
		}
	}
	
	public function imprimirColunaCima($num) {
		for($x = 1; $x < $this->tamLinha/2-1; $x++)
			$this->digito[$x][$num] = self::COLUNA;
	}
	
	public function imprimirColunaBaixo($num) {
		for($x = ($this->tamLinha/2)+1; $x < $this->tamLinha - 1; $x++)
			$this->digito[$x][$num] = self::COLUNA;
	}
	
	public function printA() {
		$this->imprimirLinha(0);
	}
	
	public function printD() {
		$this->imprimirLinha($this->tamLinha - 1);
	}
	
	public function printG() {
		$this->imprimirLinha($this->tamLinha / 2);
	}
	
	public function printF() {
		$this->imprimirColunaCima(0);
	}
	
	public function printE() {
		$this->imprimirColunaBaixo(0);
	}
	
	public function printB() {
		$this->imprimirColunaCima($this->tamColuna - 1);
	}
	
	public function printC() {
		$this->imprimirColunaBaixo($this->tamColuna - 1);
	}
	
	public function enviarLcd($pos) {
		
		for($x = 0; $x < $this->tamLinha; $x++) {
			for($y = 0; $y < $this->tamColuna; $y++) {
				$this->lcd[$pos][$x][$y] = $this->digito[$x][$y];
			}
		}
	}
	
	public function zero($pos) {
		$this->iniciarDigito();
		$this->printA();
		$this->printB();
		$this->printC();
		$this->printD();
		$this->printE();
		$this->printF();
		
		$this->enviarLcd($pos);
	}
	
	public function um($pos) {
		$this->iniciarDigito();
		$this->printB();
		$this->printC();
		
		$this->enviarLcd($pos);
	}
	
	public function dois($pos) {
		$this->iniciarDigito();
		$this->printA();
		$this->printB();
		$this->printG();
		$this->printE();
		$this->printD();
		
		$this->enviarLcd($pos);
	}
	
	public function tres($pos) {
		$this->iniciarDigito();
		
		$this->printA();
		$this->printB();
		$this->printC();
		$this->printD();
		$this->printG();
		
		$this->enviarLcd($pos);
		
	}
	
	public function quatro($pos) {
		$this->iniciarDigito();

		$this->printB();
		$this->printC();
		$this->printF();
		$this->printG();
		
		$this->enviarLcd($pos);
	}
	
	public function cinco($pos) {
		$this->iniciarDigito();
		$this->printA();
		$this->printC();
		$this->printD();
		$this->printF();
		$this->printG();
		
		$this->enviarLcd($pos);
	}
	
	public function seis($pos) {
		$this->iniciarDigito();
		
		$this->printA();
		$this->printC();
		$this->printD();
		$this->printE();
		$this->printF();
		$this->printG();
		
		$this->enviarLcd($pos);
	}
	
	public function sete($pos) {
		$this->iniciarDigito();
		$this->printA();
		$this->printB();
		$this->printC();
		
		$this->enviarLcd($pos);
	}
	
	public function oito($pos) {
		$this->iniciarDigito();
		$this->printA();
		$this->printB();
		$this->printC();
		$this->printD();
		$this->printE();
		$this->printF();
		$this->printG();
		
		$this->enviarLcd($pos);
		
	}
	
	public function nove($pos) {
		$this->iniciarDigito();
		$this->printA();
		$this->printB();
		$this->printC();
		$this->printF();
		$this->printG();
		
		$this->enviarLcd($pos);
	}
	
	public function iniciarDigito() {
		
		$this->digito = array();
		for($x = 0; $x < $this->tamLinha; $x++)
			for($y = 0; $y < $this->tamColuna; $y++ )
				$this->digito[$x][$y] = self::BRANCO;
			
	}
	
	public function setEntrada($entrada) {
	
		if(null === $entrada)
			throw new Exception('Nenhuma entrada foi definida');
	
		//Limpa tudo que não for digito
		preg_replace('/[^0-9]/', '', $entrada);
	
		if(!($entrada >= 0 && $entrada <= 99999999))
			throw new Exception('Informe um número positivo até 99.999.999');
	
		$this->entrada = $entrada;
	
	}
	
	public function setTamanhoDigito($s) {
	
		if(null === $s)
			throw new Exception('Nenhum valor foi definido');
	
		$s = (int) $s;
		if(!($s >= 1 && $s <= 10))
			throw new Exception('Informe um valor maior que 0 e menor ou igual a 10. (1<= $s <= 10)');
	
		$this->tamLinha = (2 * $s) + 3;
		$this->tamColuna = $s + 2;
	
	}
	
}