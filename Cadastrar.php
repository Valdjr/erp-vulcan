<?php

require_once("IncludeMenuAutenticacao.php");
require_once("Cabecalho.php");

//verifica por get se tem erro
$erro = isset($_GET['erro']) ? $_GET['erro'] : '';
$sucesso = isset($_GET['sucesso']) ? $_GET['sucesso'] : '';
$mensagem = '';

if($erro == 1) { //tentou salvar com algum campo vazio
	$mensagem = "<div class='alert alert-danger'>Preencha os campos!</div>";
	$erro = '';
} else if($sucesso == 1){
	$mensagem = "<div class='alert alert-success'>Venda inserida com sucesso!</div>";
	$sucesso = '';
}

?>

<div class="row">
	<div class="col-3"></div>
	<div class="col-6 mt-5">
		<?php if($mensagem != ''){ ?>
			<?=$mensagem?>
		<?php } ?>
		<form method="post" action="">
			<div class="form-group">
				<label for="cliente">Empresa</label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-briefcase"></i></div>
					</div>
					<input type="text" class="form-control" id="nomeEmpresa" name="nomeEmpresa" placeholder="Nome da empresa">
				</div>
			</div>
			<div class="form-group">
				<label for="cliente">Moeda (Código ISO)</label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
					</div>
					<input type="text" class="form-control" id="moedaEmpresa" name="moedaEmpresa" placeholder="USD">
				</div>
			</div>
			<div class="form-group">
				<label for="cliente">Login</label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-user-alt"></i></div>
					</div>
					<input type="text" class="form-control" id="loginEmpresa" name="loginEmpresa" placeholder="Fantasia da empresa">
				</div>
			</div>
			<div class="form-group">
				<label for="cliente">Senha</label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-lock"></i></div>
					</div>
					<input type="password" class="form-control" id="senhaEmpresa" name="senhaEmpresa" placeholder="******">
				</div>
			</div>
			<div style="text-align: center;">
				<button type="submit" class="btn btn-primary mr-5" name="salvar" id="btnSalvarCadastro" value="1">Salvar</button>
				<button type="submit" class="btn btn-secondary" name="cancelar" value="1">Cancelar</button>
			</div>
		</form>
	</div>
	<div class="col-3"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<?php
// require_once('Rodape.php');
require_once('Conexao.php');

$salvar = isset($_POST['salvar']) ? $_POST['salvar'] : '';
$cancelar = isset($_POST['cancelar']) ? $_POST['cancelar'] : '';

if($salvar == 1){ //salvar cadastro
	$nomeEmpresa = isset($_POST['nomeEmpresa']) ? $_POST['nomeEmpresa'] : '';
	$moedaEmpresa = isset($_POST['moedaEmpresa']) ? $_POST['moedaEmpresa'] : '';
	$loginEmpresa = isset($_POST['loginEmpresa']) ? $_POST['loginEmpresa'] : '';
	$senhaEmpresa = isset($_POST['senhaEmpresa']) ? $_POST['senhaEmpresa'] : '';

	if($nomeEmpresa == '' || $moedaEmpresa == '' || $loginEmpresa == '' || $senhaEmpresa == '') {
		header('location: Cadastrar.php?erro=1');
	} else {
		$db = new ConnectionDB();

		$sql = "INSERT INTO empresa (nivel, nome, moeda) VALUES ('0','$nomeEmpresa','$moedaEmpresa'); ";
		$db->insert($sql);

		$sql = "select id from empresa order by id desc;";
		$dados = $db->execute($sql);
		$idEmpresa = $dados[0]['id'];

		$sql = "INSERT INTO usuario (idEmpresa, usuario, senha) VALUES ('$idEmpresa','$loginEmpresa','$senhaEmpresa'); ";
		$db->insert($sql);
		
		header('location: Cadastrar.php?sucesso=1');
	}
} else if ($cancelar == 1) { //cancelar cadastro
	header('location: Cadastrar.php');
}

?>