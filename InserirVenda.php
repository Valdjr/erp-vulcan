<?php

require_once('Cabecalho.php');

//verifica por get se tem erro
$erro = isset($_GET['erro']) ? $_GET['erro'] : '';
$mensagem = '';

if($erro == 1) { //tentou salvar com algum campo vazio
	$mensagem = "Preencha todos os campos!";
	$erro = '';
}

?>

<div class="row">
	<div class="col-3"></div>
	<div class="col-6 mt-5">
		<?php if($mensagem != ''){ ?>
			<div class="alert alert-danger"><?=$mensagem?></div>
		<?php } ?>
		<form method="post" action="">
			<div class="form-group">
				<label for="cliente">Cliente</label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-user-alt"></i></div>
					</div>
					<input type="text" class="form-control" id="cliente" name="cliente" placeholder="Nome do cliente">
				</div>
			</div>
			<div class="form-group">
				<label for="data">Data</label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
					</div>
					<input type="date" class="form-control" id="data" name="data" value="<?=date('Y-m-d');?>">
				</div>
			</div>
			<div class="form-group">
				<label for="valor">Valor</label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-money-bill-alt"></i></div>
					</div>
					<input type="number" step="0.01" class="form-control" id="valor" name="valor">
				</div>
			</div>
			<div class="form-group">
				<label for="cotacao">Cotação</label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-exchange-alt"></i></div>
					</div>
					<input type="number" step="0.01" class="form-control" id="cotacao" name="cotacao">
				</div>
			</div>
			<div class="form-group">
				<label for="valoruss">Valor (US$)</label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
					</div>
					<input type="number" step="0.01" class="form-control" id="valoruss" name="valoruss">
				</div>
			</div>
			<div style="text-align: center;">
				<button type="submit" class="btn btn-primary mr-5" name="salvar" value="1">Salvar</button>
				<button type="submit" class="btn btn-secondary" name="cancelar" value="1">Cancelar</button>
			</div>
		</form>
	</div>
	<div class="col-3"></div>
</div>


<?php

require_once('Rodape.php');
require_once('Conexao.php');


$salvar = isset($_POST['salvar']) ? $_POST['salvar'] : '';
$cancelar = isset($_POST['cancelar']) ? $_POST['cancelar'] : '';

if($salvar == 1){ //salvar venda
	$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : '';
	$data = isset($_POST['data']) ? $_POST['data'] : '';
	$valor = isset($_POST['valor']) ? $_POST['valor'] : '';
	$cotacao = isset($_POST['cotacao']) ? $_POST['cotacao'] : '';
	$valoruss = isset($_POST['valoruss']) ? $_POST['valoruss'] : '';

	if($cliente == '' || $data == '' || $valor == '' || $cotacao == '' || $valoruss == '') {
		header('location: InserirVenda.php?erro=1');
	} else {
		$sql = "INSERT INTO venda (cliente, data, valor, cotacao, valoruss) VALUES ('$cliente','$data','$valor','$cotacao','$valoruss'); ";
		$db = new ConnectionDB();
		$db->insert($sql);
	}

} else if ($cancelar == 1) { //cancelar venda
	header('location: InserirVenda.php');
}


?>