<?php
	include_once("utils/Connect.class.php");
	include_once("beans/Variables.class.php");
	
	$variables = new Variables();
	$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
	$connect->start();
	
	session_start();
	
	if((isset($_SESSION["usuario"]) == NULL) && (isset($_SESSION["senha"]) == NULL) && (isset($_SESSION["nivel"]) > 2)){
		header("Location: admin.php");
		die();
	}
	
	$cadastrar = isset($_GET["cadastrar"]) ? $_GET["cadastrar"] : NULL;	 		
	
	if($cadastrar == "sim"){
		foreach($_POST as $nomeCampo => $valor){
			$comando = "\$".$nomeCampo."= antiSQL(isset(\$_POST['$nomeCampo']) ? '".$valor."' : NULL);";
			eval($comando);
		}
		
		include_once("utils/ConectarMySQL.class.php");
		
		$conexao = new ConectarMySql();
//-------------------------------------------------------------------------------------------------------------------------------------------------
		$sqlSEL = "select 
						car_con_codigo, 
						car_con_descricao
					from 
						contrachequeonline.cargo_contratado
					where
						car_con_descricao='".$tfCargCont."'";
		$resultado = $conexao->executar($sqlSEL);
		if($conexao->numeroLinhas($resultado) > 0){
			$linha = mysqli_fetch_array(resultado);
			$cargContCODIGO = $linha["car_con_codigo"];
		}else{
			$sqlINS = "insert into contrachequeonline.cargo_contratado 
							(car_con_descricao)
						values
							('".$tfCargCont."')";
			$conexao->executar($sqlINS);
			$resultado = $conexao->executar($sqlSEL);
			$linha = mysqli_fetch_array(resultado);
			$cargContCODIGO = $linha["car_con_codigo"];
		}
//-------------------------------------------------------------------------------------------------------------------------------------------------		
		$sqlSEL = "select 
						dis_codigo, 
						dis_descricao
					from 
						contrachequeonline.disposicao
					where
						dis_descricao='".$$tfDispos."'";
		$resultado = $conexao->executar($sqlSEL);
		if($conexao->numeroLinhas($resultado) > 0){
			$linha = mysqli_fetch_array(resultado);
			$disposicaoCODIGO = $linha["dis_codigo"];
		}else{
			$sqlINS = "insert into contrachequeonline.disposicao 
							(dis_descricao)
						values
							('".$tfDispos."')";
			$conexao->executar($sqlINS);
			$resultado = $conexao->executar($sqlSEL);
			$linha = mysqli_fetch_array(resultado);
			$disposicaoCODIGO = $linha["dis_codigo"];
		}
//-------------------------------------------------------------------------------------------------------------------------------------------------	
		$sqlSEL = "select 
						gra_ins_codigo, 
						gra_ins_descricao
					from 
						contrachequeonline.grau_instrucao
					where
						gra_ins_descricao='".$slGrauInst."'";
		$resultado = $conexao->executar($sqlSEL);
		if($conexao->numeroLinhas($resultado) > 0){
			$linha = mysqli_fetch_array(resultado);
			$grauInstCODIGO = $linha["gra_ins_codigo"];
		}else{
			$sqlINS = "insert into contrachequeonline.grau_instrucao 
								(gra_ins_descricao)
							values
								('".$slGrauInst."')";
			$conexao->executar($sqlINS);
			$resultado = $conexao->executar($sqlSEL);
			$linha = mysqli_fetch_array(resultado);
			$grauInstCODIGO = $linha["gra_ins_codigo"];
		}
//-------------------------------------------------------------------------------------------------------------------------------------------------	
		$sqlSEL = "select 
						for_codigo, 
						gra_ins_codigo, 
						for_descricao
					from 
						contrachequeonline.formacao
					where
						for_descricao='".$tfFormac."'";
		$resultado = $conexao->executar($sqlSEL);
		if($conexao->numeroLinhas($resultado) > 0){
			$linha = mysqli_fetch_array(resultado);
			$formacaoCODIGO = $linha["for_codigo"];
		}else{
			$sqlINS = "insert into contrachequeonline.formacao 
								(gra_ins_codigo, for_descricao)
							values
								(".$grauInstCODIGO.", '".$tfFormac."')";
			$conexao->executar($sqlINS);
			$resultado = $conexao->executar($sqlSEL);
			$linha = mysqli_fetch_array(resultado);
			$formacaoCODIGO = $linha["for_codigo"];
		}
//-------------------------------------------------------------------------------------------------------------------------------------------------	
		$sqlSEL = "select 
						fun_codigo, 
						fun_descricao 
					from 
						contrachequeonline.funcao
					where
						fun_descricao='".$tfFuncExer."'";
		$resultado = $conexao->executar($sqlSEL);
		if($conexao->numeroLinhas($resultado) > 0){
			$linha = mysqli_fetch_array(resultado);
			$funcaoCODIGO = $linha["fun_codigo"];
		}else{
			$sqlINS = "insert into contrachequeonline.funcao 
								(fun_descricao)
							values
								('".$tfFuncExer."')";
			$conexao->executar($sqlINS);
			$resultado = $conexao->executar($sqlSEL);
			$linha = mysqli_fetch_array(resultado);
			$funcaoCODIGO = $linha["fun_codigo"];
		}
//-------------------------------------------------------------------------------------------------------------------------------------------------
		$sqlSEL = "select 
						vin_codigo, 
						vin_descricao
					from 
						contrachequeonline.vinculo 
					where
						vin_descricao='".$tfVincFund."'";
		$resultado = $conexao->executar($sqlSEL);
		if($conexao->numeroLinhas($resultado) > 0){
			$linha = mysqli_fetch_array(resultado);
			$vinculoCODIGO = $linha["vin_codigo"];
		}else{
			$sqlINS = "insert into contrachequeonline.vinculo 
								(vin_descricao)
							values
								('".$tfVincFund."')";
			$conexao->executar($sqlINS);
			$resultado = $conexao->executar($sqlSEL);
			$linha = mysqli_fetch_array(resultado);
			$vinculoCODIGO = $linha["vin_codigo"];
		}
//-------------------------------------------------------------------------------------------------------------------------------------------------		
		$sqlSEL = "select 
						ser_codigo, car_con_codigo, dis_codigo, est_civ_codigo, est_codigo, for_codigo, fun_codigo, cid_codigo, sex_codigo, vin_codigo, ser_nome, ser_cpf, ser_data_nascimento, ser_nome_pai, ser_nome_mae, ser_nome_conjuge, ser_data_cadastro
					from 
						contrachequeonline.servidor  
					where
						ser_nome='".$tfNomeServ."' AND ser_cpf='".$tfCPF."'";
		$resultado = $conexao->executar($sqlSEL);
		if($conexao->numeroLinhas($resultado) > 0){
			$linha = mysqli_fetch_array(resultado);
			$servidorCODIGO = $linha["ser_codigo"];
		}else{
			$hoje = date("Y-m-d H:i:s");
			$sqlINS = "insert into contrachequeonline.servidor 
								(car_con_codigo, dis_codigo, est_civ_codigo, est_codigo, for_codigo, fun_codigo, cid_codigo, sex_codigo, vin_codigo, ser_nome, ser_cpf, ser_data_nascimento, ser_nome_pai, ser_nome_mae, ser_nome_conjuge, ser_data_cadastro)
							values
								(".$cargContCODIGO.", ".$disposicaoCODIGO.", ".$slEstadCivi.", ".$slTitEleitUF.", ".$formacaoCODIGO.", ".$funcaoCODIGO.", ".$slDatNascNatural.", ".$slSexo.", ".$vinculoCODIGO.", '".$tfNomeServ."', '".$tfCPF."', '".$tfDatNasc."', '".$tfNomePai."', '".$tfNomeMae."', '".$tfNomeConj."', '".$hoje."')";
			$conexao->executar($sqlINS);
			$resultado = $conexao->executar($sqlSEL);
			$linha = mysqli_fetch_array(resultado);
			$servidorCODIGO = $linha["ser_codigo"];
		}
//-------------------------------------------------------------------------------------------------------------------------------------------------	
		$sqlINS = "insert into contrachequeonline.titulo_eleitoral 
						(est_codigo, ser_codigo, tit_ele_numero, tit_ele_zona_sessao)
					values
						(".$slTitEleitUF.", ".$servidorCODIGO.", '".$tfTitEleit."', '".$tfTitEleitZonSec."')";
		$conexao->executar($sqlINS);
//-------------------------------------------------------------------------------------------------------------------------------------------------	
		$sqlINS = "insert into contrachequeonline.carteira_habilitacao 
						(car_hab_numero, cat_categoria, ser_codigo)
					values
						('".$tfCartAbilit."', '".$slCartAbilitCat."', ".$servidorCODIGO.")";
		$conexao->executar($sqlINS);
//-------------------------------------------------------------------------------------------------------------------------------------------------	
		$sqlINS = "insert into contrachequeonline.registro_profissional 
						(reg_pro_codigo, ser_codigo, reg_pro_sigla, reg_pro_regiao)
					values
					('".$tfRegProf."', ".$servidorCODIGO.", '".$tfRegProfSigla."', '".$tfRegProfRegi."');";
		$conexao->executar($sqlINS);
//-------------------------------------------------------------------------------------------------------------------------------------------------
		$sqlSEL = "select 
						ban_codigo, 
						ban_nome
					from 
						contrachequeonline.banco 
					where
						ban_nome='".$tfBanc."'";
		$resultado = $conexao->executar($sqlSEL);
		if($conexao->numeroLinhas($resultado) > 0){
			$linha = mysqli_fetch_array(resultado);
			$bancoCODIGO = $linha["ban_codigo"];
		}else{
			$sqlINS = "insert into contrachequeonline.banco 
							(ban_nome)
						values
							('".$tfBanc."')";
			$conexao->executar($sqlINS);
			$resultado = $conexao->executar($sqlSEL);
			$linha = mysqli_fetch_array(resultado);
			$bancoCODIGO = $linha["ban_codigo"];
		}
//-------------------------------------------------------------------------------------------------------------------------------------------------	
		$sqlINS = "insert into contrachequeonline.conta 
						(ser_codigo, ban_codigo, con_conta, con_agencia)
					values
						(".$servidorCODIGO.", ".$bancoCODIGO.", '".$tfBancCont."', '".$tfBancAgen."')";
		$conexao->executar($sqlINS);
//-------------------------------------------------------------------------------------------------------------------------------------------------
		$sqlINS = "insert into contrachequeonline.certidao_civil 
						(cer_civ_codigo, ser_codigo, cer_civ_termo, cer_civ_folha, cer_civ_livro)
					values
						('".$tfCertCiv."', ".$servidorCODIGO.", '".$tfCertCivTermo."', '".$tfCertCivFolha."', '".$tfCertCivLivro."')";
		$conexao->executar($sqlINS);
//-------------------------------------------------------------------------------------------------------------------------------------------------
		
		//$, $, $tfEndereco, $, $, , , $, $tfUnid, $, $tfCartTrabSerie, $tfCartResRM, $tfCartResCSM, $, $tfEndTipLog, $tfEndQuad, $tfEndBairro, $, $, $, $tfUnidMicAre, $tfUnidPSF, $tfCartTrab, $tfNIT, $tfRGOrgExep, $, $tfCartRes, $, $, $, $, $, $, $, $, , $tfEndCEP, $tfRG, $, $tfEndFone, $slCartTrabUf, $, $slEstadCivi, $, $slDatNascUF, $, $slEndUF, $slEndCida, $slEndResDesMes, $, $tfCartTrabDatEmis, $tfNITDatEmis, $tfRGDatEmis, $, $tfEndNumCas, $tfEndResDesAno;
	}
?>