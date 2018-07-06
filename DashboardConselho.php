<?php
require_once("IncludeMenuAutenticacao.php");
require_once('Cabecalho.php');
require_once('Conexao.php');

$db = new ConnectionDB();
$dados = $db->execute('select e.nome, count(v.id) as quantidade, sum(v.valoruss) as valorUss from venda v left join empresa e on v.idEmpresa = e.id group by v.idEmpresa;');

$table = "<table class='table mt-5'>
			<thead>
				<tr>
					<th scope='col'>#</th>
					<th scope='col'>Empresa</th>
					<th scope='col'>Total de Vendas(USS)</th>
					<th scope='col'>Quantidade de Vendas</th>
				</tr>
			</thead>
			<tbody>";
$i = 1;
$totais = 0;
$totaisQuantidade = 0;
foreach($dados as $dado) {
	$table .=	"<tr>
					<th scope='row'>".$i."</th>
					<td>".$dado['nome']."</td>
					<td>".number_format($dado['valorUss'], 2)."</td>
					<td>".$dado['quantidade']."</td>
				</tr>";
	$i++;
	$totais += $dado['valorUss'];
	$totaisQuantidade += $dado['quantidade'];
}
$table .=	"<tr>
				<th scope='row'>-</th>
				<td>Totais</td>
				<td>".number_format($totais, 2)."</td>
				<td>".$totaisQuantidade."</td>
			</tr>";


$table .=		"</tbody>
			</table>";
?>

<div class="row">

	<?=$table?>

</div>


<?php
require_once('Rodape.php');
?>