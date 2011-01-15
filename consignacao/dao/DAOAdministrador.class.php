<?php
	class DAOAdministrador{
		private $administrador;
		private $conexao;
		
		function __construct($nCod, $n, $nU, $s, $toRoot){
			include_once($toRoot."beans/Administrador.class.php");
			include_once($toRoot."utils/ConectarMySQL.class.php");
			$this->administrador = new Administrador(NULL, $pCod, $nCod, $nU, $s);
			$this->conexao = new ConectarMySQL();
		}
		
		public function cadastrar(){
			$sql = "INSERT INTO administradores (pes_codigo, niv_codido, adm_nome_usuario, adm_senha) VALUES (".$this->administrador->getPesCodigo().", ".$this->administrador->getNivCodigo().", '".$this->administrador->getNomeUsuario()."', '".$this->administrador->getSenha()."')";
			if(!$this->conexao->executar($sql)){
				die("Não foi possivel salvar: ".$this->administrador->getNomeUsuario());
			}
		}
		
		public function alterar($valRef){
			$sql = "UPDATE administradores SET pes_codigo=".$this->administrador->getPesCodigo().", niv_codido=".$this->administrador->getNivCodigo().", adm_nome_usuario='".$this->administrador->getNomeUsuario()."' , adm_senha='".$this->administrador->getSenha()."' WHERE adm_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				die("Não foi possivel alterar: ".$this->administrador->getNomeUsuario());
			}
		}
		
		public function deletar($valRef){
			$sql = "DELETE FROM administradores WHERE adm_codigo=".$valRef;
			if(!$this->conexao->executar($sql)){
				die("Não foi possivel deletar: ".$this->administrador->getNomeUsuario());
			}
		}
		
		public function pesquisar($atributo, $valRef){
			switch($atributo){
				case "cod" : $sql = "SELECT * FROM administradores WHERE adm_codigo=".$valRef; break;
				case "nomUsu" : $sql = "SELECT * FROM administradores WHERE adm_nome_usuario='".$valRef."'"; break;
			}
			$resultado = $this->conexao->selecionar($sql);
			if(!$resultado){
				die("Não foi possivel selecionar: ".$this->administrador->getNomeUsuario());
			}
			return $resultado;
		}
	}
?>