<?php
require_once("IncludeMenuAutenticacao.php");
require_once('Cabecalho.php');
require_once('Conexao.php');

$db = new ConnectionDB();
// $query = 'select * from venda where idEmpresa = '. $autenticacao->getIdEmpresa() . " ORDER BY data ASC;";
// echo $query;
$dados = $db->execute('select * from venda where idEmpresa = '. $autenticacao->getIdEmpresa() . ' ORDER BY data ASC;');
$result = $db->execute('select * from empresa where id = ' . $autenticacao->getIdEmpresa() . ';');
$moeda = strtoupper ($result[0]['moeda']);

$table = "<table class='table mt-5'>
			<thead>
				<tr>
					<th scope='col'>#</th>
					<th scope='col'>Data</th>
					<th scope='col'>Cliente</th>
					<th scope='col'>Valor (".$moeda.")</th>
					<th scope='col'>Valor (USD)</th>
				</tr>
			</thead>
			<tbody>";
$i = 1;
foreach($dados as $dado) {
	$date = new DateTime($dado['data']);
	$data = $date->format('d/m/Y');
	$table .=	"<tr>
					<th scope='row'>".$i."</th>
					<td>".$data."</td>
					<td>".$dado['cliente']."</td>
					<td>".$dado['valor']."</td>
					<td>".$dado['valoruss']."</td>
				</tr>";
	$i++;
}

$table .=		"</tbody>
			</table>";
?>

<div class="row">

	<?=$table?>

</div>


<?php
require_once('Rodape.php');
?>