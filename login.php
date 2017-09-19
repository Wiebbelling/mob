<!-- login.php -->
<?php
include "acesso.php";

$acesso = new acesso;
$acesso->conectar();

$acesso->conectar();

session_start();
session_name("adm");

if(isset($_SESSION['validacao']) && isset($_SESSION['codigo']))
{
	if($_SESSION['validacao'] == 1)
		header("Location:listaposts.php");
}


if(isset($_POST['usuario']) && isset($_POST['senha']))
{
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];

	if($acesso->login($usuario,$senha))
	{
		$_SESSION['validacao'] = 1;
    $_SESSION['codigo'] = $usuario;
		header("Location:listaposts.php");
	}
	else
	{
		header("Location:login.php?erro=1");
	}
}


?>

<!DOCTYPE html>
<html lang="en" class="wide wow-animation">
  <head>
    <!-- Site Title-->
    <title>Login</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900,300italic">
    <link rel="stylesheet" href="css/style.css">

	</head>


	<body>
	<!-- Page-->
    <div class="page">
      <!-- Page Header-->
      <!-- Page Content-->
      <main class="page-content">

        <!-- Login form-->
        <section class="section-50 section-sm-bottom-85">
          <div class="shell text-center">
            <div class="range range-xs-center">
              <div class="cell-xs-10 cell-sm-6 cell-lg-4 offset-top-25">
                <div class="inset-sm-left-15 inset-sm-right-25 offset-top-22">
                  <form method="post" action="">
                    <div class="form-group">
                      <label for="usuario" class="form-label-outside">Usuário</label>
                      <input id="usuario" type="text" name="usuario" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="senha" class="form-label-outside">Senha</label>
                      <input id="senha" type="password" name="senha" class="form-control">
                    </div>
                  
                    <div class="form-group">
                      <button class="btn btn-sm btn-curious-blue-variant-2 btn-block" type="submit">Sign In</button>
                    </div>
                  </form>
                  <div class="offset-top-25 alert-succes">
                      <?php 
                      if(isset($_GET['erro']))
                        if($_GET['erro'] == 1)
                          echo "<div class='alert alert-danger offset-top-25' role='alert'>
                            Usuário ou senha incorretos!
                          </div>"

                        ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        

        <!-- Feedback Form-->
        

      </main>
      <!-- Page Footer-->

    </div>
    <!-- Global Mailform Output-->
    <div id="form-output-global" class="snackbars"></div>
    <!-- includes:olark-->
    <!-- Javascript-->
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
        </body>



	</body>