<?php

require_once("IncludeMenuAutenticacao.php");
require_once('Cabecalho.php');
require_once('Conexao.php');

$db = new ConnectionDB();

$dados = $db->execute('select * from venda where idEmpresa = '.$autenticacao->getIdEmpresa().' ORDER BY id DESC LIMIT 1');
$cotacao = $dados[0]['cotacao'];

$dadosEmpresa = $db->execute('select moeda from empresa where id = '.$autenticacao->getIdEmpresa());
$moeda = $dadosEmpresa[0]['moeda'];

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
				<label for="valor">Valor (<?= strtoupper($moeda) ?>)</label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-money-bill-alt"></i></div>
					</div>
					<input type="number" step="0.01" class="form-control" id="valor" name="valor" value="0">
				</div>
			</div>
			<div class="form-group">
				<label for="cotacao">Cotação</label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-exchange-alt"></i></div>
					</div>
					<input type="number" step="0.001" class="form-control" id="cotacao" name="cotacao" value="<?= $cotacao ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="valoruss">Valor (USD)</label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
					</div>
					<input type="number" step="0.01" class="form-control" readonly="readonly" id="valoruss" name="valoruss" value="0">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$('#cotacao').blur(function(){
		var vUss = $('#valor').val() * $('#cotacao').val();
		$('#valoruss').val( parseFloat(vUss.toFixed(2)));
	});
	$('#valor').blur(function(){
		var vUss = $('#valor').val() * $('#cotacao').val();
		$('#valoruss').val( parseFloat(vUss.toFixed(2)));
	});
	$('#valoruss').blur(function(){
		var vUss = $('#valor').val() * $('#cotacao').val();
		$('#valoruss').val( parseFloat(vUss.toFixed(2)));
	});
</script>


<?php
// require_once('Rodape.php');
require_once('Conexao.php');


$salvar = isset($_POST['salvar']) ? $_POST['salvar'] : '';
$cancelar = isset($_POST['cancelar']) ? $_POST['cancelar'] : '';

if($salvar == 1){ //salvar venda
	$idEmpresa = $autenticacao->getIdEmpresa();
	$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : '';
	$data = isset($_POST['data']) ? $_POST['data'] : '';
	$valor = isset($_POST['valor']) ? $_POST['valor'] : '';
	$cotacao = isset($_POST['cotacao']) ? $_POST['cotacao'] : '';
	$valoruss = isset($_POST['valoruss']) ? $_POST['valoruss'] : '';

	if($cliente == '' || $data == '' || $valor == '' || $cotacao == '' || $valoruss == '') {
		header('location: InserirVenda.php?erro=1');
	} else {
		$sql = "INSERT INTO venda (idEmpresa,cliente, data, valor, cotacao, valoruss) VALUES ('$idEmpresa','$cliente','$data','$valor','$cotacao','$valoruss'); ";
		$db = new ConnectionDB();
		$db->insert($sql);
		header('location: InserirVenda.php?sucesso=1');
	}
} else if ($cancelar == 1) { //cancelar venda
	header('location: InserirVenda.php');
}


?>