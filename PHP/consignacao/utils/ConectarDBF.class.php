<?php
	class ConectarDBF{
		private $caminho;
		private $modo;
		private $conexao;
		
		function __construct($cam, $mod){
			$this->caminho 	= $cam;
			$this->modo 	= $mod;
		}
		
		public function conectar(){
			$this->conexao = dbase_open($this->caminho, $this->modo);
			if($this->conexao == false){
				return false;
			}
			return $this->conexao;
		}
		
		public function criar($array){	
			$this->conexao = dbase_create($this->caminho, $array);
			if($this->conexao == false){
				return false;
			}
			return $this->conexao;
		}
		
		public function adicionar($array){
			if(dbase_add_record($this->conexao, $array))
				return true;
			else
				return false;
		}
		
		public function alterar($array, $id){
			if(dbase_replace_record($this->conexao, $array, $id))
				return true;
			else
				return false;
		} 
		
		public function remover($id){
			if(dbase_delete_record($this->conexao, $id))
				return true;
			else
				return false;
		}
		
		public function organizar(){
			if(dbase_pack($this->conexao))
				return true;
			else
				return false;
		}
		
		public function getNumeroCampos(){
			$num = dbase_numfields($this->conexao);
			if($num != false)
				return $num;
			else
				return false;
		}
		
		public function getNumeroRegistros(){
			$num = dbase_numrecords($this->conexao);
			if($num != false)
				return $num;
			else
				return false;
		}
		
		public function getColunasInfo(){
			return dbase_get_header_info($this->conexao);
		}
		
		public function buscar($id){
			return dbase_get_record($this->conexao, $id);
		}
		
		public function fechar(){
			dbase_close($this->conexao);
			$this->conexao = NULL;
		}
		
		public function destruir(){
			$this->fechar();
			unlink($this->caminho);
		}
	}
?>