<?php
	include "acesso.php";
	$acesso = new acesso;
	$acesso->conectar();


	if(isset($_GET['tipo']) && isset($_GET['codigo']))
	{
		$tipo = $_GET['tipo'];
		$id = $_GET['codigo'];

		

		$ret = $acesso->deletaDados($id, $tipo);
		
		switch ($tipo) {
			case '0':
				header("Location: listaposts.php?status=$ret");
				break;

			case '1':
				header("Location: listacategorias.php?status=$ret");
				break;

			case '2':
				header("Location: listatags.php?status=$ret");
				break;

			default:
				header("Location: 404.html");
				break;
		}
	}
	else
		header("Location: 404.html");
?>