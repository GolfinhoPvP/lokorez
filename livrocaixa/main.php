<?php
	$toRoot = "";
	session_start();
	
	if(!$xml = simplexml_load_file($toRoot."configuracao.xml")){
		trigger_error('Erro ao ler o arquivo XML',E_USER_ERROR);
	}
	
	if($xml->status == "offline"){
		header("Location: ".$toRoot."emManutencao.php");
		die();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="scripts/css/main.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" language="javascript" src="scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript">
			window.onload = function(){
				setTimeout('esconder("infos")',5000);
			}
			function carregarNoIframe(nomeFrame, url){
				top.frames['telaSistema'].frames[nomeFrame].location.href = url;
				document.getElementsByTagName("div").style.visibility = "hidden";
			}
		</script>
	</head>
	
<body>
	<div class="texto1" id="desconectar" style="cursor:pointer" onclick="javascript: location.href = 'utils/desconectar.php';">Desconectar<img src="imagens/desconectar.png" /></div>
	<div id="divMenu">
	  <ul id="menu">
		  <li>
			<div alt="Administrar" width="100px" height="100px" title="Administrar">Administrar</div>
			 <div id="nav">Ger&ecirc;ncia
			 	<div id="nav2">
					<div id="niv" onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadCliente.php');">Cadastrar</div>
					<div id="niv" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Alterar</div>
					<div id="niv" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Deletar</div>
					<div id="niv" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Pesquisar</div>
				</div>
			</div>
			<div id="nav">Empresa
			 	<div id="nav2">
					<div id="niv" onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadEmpresa.php');">Cadastrar</div>
					<div id="niv" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Alterar</div>
					<div id="niv" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Deletar</div>
					<div id="niv" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Pesquisar</div>
				</div>
			</div>
			<div id="nav">Livro Caixa
			 	<div id="nav2">
					<div id="niv">Pagamentos
						<div id="nav3">
							<div id="niv1" onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadFormaPagamento.php');">Cadastrar</div>
							<div id="niv1"  onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Alterar</div>
							<div id="niv1"  onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Deletar</div>
							<div id="niv1"  onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Pesquisar</div>
						</div>
					</div>
					<div id="niv">Plano de Conta
						<div id="nav3">
							<div id="niv1" onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadPlanoConta.php');">Cadastrar</div>
							<div id="niv1" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Alterar</div>
							<div id="niv1" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Deletar</div>
							<div id="niv1" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Pesquisar</div>
						</div>
					</div>
					<div id="niv">Produtos
						<div id="nav3">
							<div id="niv1" onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadProduto.php');">Cadastrar</div>
							<div id="niv1" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Alterar</div>
							<div id="niv1" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Deletar</div>
							<div id="niv1" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Pesquisar</div>
						</div>
					</div>
					<div id="niv">Servi&ccedil;os
						<div id="nav3">
							<div id="niv1" onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadServico.php');">Cadastrar</div>
							<div id="niv1" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Alterar</div>
							<div id="niv1" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Deletar</div>
							<div id="niv1" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Pesquisar</div>
						</div>
					</div>
					<div id="niv">Pessoal
						<div id="nav3">
							<div id="niv1">Classe
								<div id="nav4">
									<div id="niv2" onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadClasse.php');">Cadastrar</div>
									<div id="niv2" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Alterar</div>
									<div id="niv2" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Deletar</div>
									<div id="niv2" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Pesquisar</div>
								</div>
							</div>
							<div id="niv1">T&eacute;cnico
								<div id="nav4">
									<div id="niv2" onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadTecnico.php');">Cadastrar</div>
									<div id="niv2" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Alterar</div>
									<div id="niv2" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Deletar</div>
									<div id="niv2" onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Pesquisar</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>
			 <li>
			<div alt="Livro Caixa" width="100px" height="100px" title="Livro Caixa">Check Saida</div>
			 <div id="nav" onclick="javascript: carregarNoIframe('conteudo','cruds/pesquisar/pesCheckout.php');">Gerar</div>
		</li>
		<li>
			<div alt="Livro Caixa" width="100px" height="100px" title="Livro Caixa">Pagamentos</div>
			 	<div id="nav" onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadSolicitacao.php');">Solicitar</div>
				<div id="nav" onclick="javascript: carregarNoIframe('conteudo','cruds/pesquisar/pesSolicitacao.php');">Pagar</div>
		</li>
		<li>
			<div alt="Livro Caixa" width="100px" height="100px" title="Livro Caixa">Livro Caixa</div>
			 <div id="nav">Lan&ccedil;amento
			 	<div id="nav2">
					<div id="niv" onclick="javascript: carregarNoIframe('conteudo','cruds/cadastrar/cadLancamento.php');">Cadastrar</div>
					<div id="niv"  onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Alterar</div>
					<div id="niv"  onclick="javascript: carregarNoIframe('conteudo','emDesenvolvimento.php');">Deletar</div>
					<div id="niv"  onclick="javascript: carregarNoIframe('conteudo','cruds/pesquisar/pesLancamento.php');">Ver Lan&ccedil;amentos</div>
				</div>
			 </div>
			 <div id="nav" onclick="javascript: carregarNoIframe('conteudo','utils/selecionarEmpresa.php');">Selecionar Empresa</div>
		</li>
	  </ul>
</div>
	<div class="texto3" id="infos">Bem vindo: <?php echo($_SESSION["nomeUsuario"]); if(isset($_SESSION["empresaNome"])) echo(". Empresa: ".$_SESSION["empresaNome"]);?></div>
	<div id="ajuda" title="Quem sou eu?" onmouseover="javascript: mostrar('infos');" onmouseout="javascript: esconder('infos');" style="cursor:pointer"></div>
	<?php
		if($_SESSION["solicitacoes"] > 0)
			echo('<div id="alerta" title="Há pedido de pagamento pendente!" onclick="javascript: carregarNoIframe(\'conteudo\',\'cruds/pesquisar/pesSolicitacao.php\');" style="cursor:pointer"></div>');
	?>
	<iframe id="frameConteudo" name="conteudo" width="940" height="550" frameBorder="0"></iframe>
</body>
</html>