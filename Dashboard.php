<?php
require_once("IncludeMenuAutenticacao.php");
require_once('Cabecalho.php');
require_once('Conexao.php');
require_once('Sessao.php');

// $session = Sessao::getInstance();

// $autenticacao = $session->recuperar("AUTENTICACAO");

$db = new ConnectionDB();
$dados = $db->execute('select * from venda where idEmpresa = '.$autenticacao->getIdEmpresa());
$empresa = $db->execute('select moeda from empresa where id = '.$autenticacao->getIdEmpresa());

$moeda = $empresa[0]['moeda'];

$totalVendas = 0;
$totalVendasuss = 0;
$ticketMedio = 0;
$quantidadeVendas = 0;

foreach($dados as $dado) {
	$totalVendas += $dado['valor'];
	$totalVendasuss += $dado['valoruss'];
	$quantidadeVendas++;
}

$ticketMedio = $totalVendas / $quantidadeVendas;

$totalVendas = number_format($totalVendas, 2);
$totalVendasuss = number_format($totalVendasuss, 2);
$ticketMedio = number_format($ticketMedio, 2);
$quantidadeVendas = number_format($quantidadeVendas, 2);
?>

<div class="row mt-5">
	<div class="col-2"></div>
	<div class="col-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Total de Vendas (<?=strtoupper($moeda)?>)</h5>
				<p class="card-text" id="totalVendas"><?php echo $totalVendas ?></p>
			</div>
		</div>
	</div>
	<div class="col-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Total de Vendas (US$)</h5>
				<p class="card-text" id="totalVendasuss"><?php echo $totalVendasuss ?></p>
			</div>
		</div>
	</div>
	<div class="col-2"></div>
</div>
<div class="row mt-5">
	<div class="col-2"></div>
	<div class="col-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Ticket Médio</h5>
				<p class="card-text" id="ticketMedio"><?php echo $ticketMedio ?></p>
			</div>
		</div>
	</div>
	<div class="col-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Quantidade de Vendas</h5>
				<p class="card-text" id="quantidadeVendas"><?php echo $quantidadeVendas ?></p>
			</div>
		</div>
	</div>
	<div class="col-2"></div>
</div>


<?php

require_once('Rodape.php');

?>
