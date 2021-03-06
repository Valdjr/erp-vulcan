<html>
<?php
require_once("Sessao.php");
$uri_origem = isset($_GET['uri_origem'])? $_GET['uri_origem']: "index.php";
?>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>
<body class="bg-light">
	<div class="container">
		<div class="row justify-content-center" style="margin-top: 10%">
			<div class="border p-5 bg-white rounded">
				<form action="" method="POST">

					<h3 class="text-center">Login</h3>
					<div class="form-group mt-5">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text octicon octicon-clippy" id="basic-addon1"><i class="fas fa-user"></i></span>
							</div>
							<input name="id_usuario" type="text" class="form-control" id="user" placeholder="User">
						</div>
					</div>

					<div class="form-group mt-4">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text octicon octicon-clippy" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
							</div>
							<input name="senha" type="password" class="form-control" id="password" placeholder="Password">
						</div>
					</div>
					<div class="text-center mt-5">
						<input type="hidden" name="uri_origem" value="<?= $uri_origem ?>">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script type="package/index.js"></script>
</body>
<?php 
    require_once("Autenticador.php");

    if (isset($_POST["id_usuario"]) && isset($_POST["senha"])){

        $idUsuario = $_POST["id_usuario"];
        $senha = $_POST["senha"];
        $uri_origem = $_POST["uri_origem"];
        $aut = new Autenticador();
        $ret = $aut->autenticar($idUsuario, $senha);
        if($ret->getTemErros()){
            foreach ($ret->getErros() as $erro) {
                echo 
                "<div class='row justify-content-center' style='margin-top: 25px'>
                	<div class='alert-danger p-3 rounded'>$erro<div>
                </div>";
            }
        }
        else{
            $sessao = Sessao::getInstance();
            $sessao->salvar("AUTENTICACAO", $ret->getAutenticacao());
            $a = $ret->getAutenticacao();
            if($a->getIdEmpresa() == 1) {
            	header("location: DashboardConselho.php");
            }else{
            	header("location: Dashboard.php");
            }
        }
    }
?>
</html>