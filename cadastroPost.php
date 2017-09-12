<?php
include "acesso.php";
$acesso = new acesso;
$acesso->conectar();



if(isset($_POST['titulo']) && isset($_POST['texto']) && isset($_POST['categoria']) && isset($_POST['categoria']))






?>



<!DOCTYPE html>
<html lang="en" class="wide wow-animation">
  <head>
    <!-- Site Title-->
    <title>Cadastro de Posts</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900,300italic">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

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
              <div class="cell-xs-10 cell-sm-6 offset-top-25">
                <div class="inset-sm-left-15 inset-sm-right-25 offset-top-22">
                  <form method="post" action="" id="cadastroPostForm">
                    <div class="form-group">
                      <label for="foto" class="form-label-outside">Foto:</label>
                      <input id="foto" type="file" name="foto">
                    </div>
                    <div class="form-group">
                      <label for="titulo" class="form-label-outside">Título</label>
                      <input id="titulo" type="text" name="titulo" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="texto" class="form-label-outside">Texto</label>
                      <textarea name="texto" form="cadastroPostForm" class="form-control"></textarea>
                    </div>
                  	<div class="form-group">
                      <label for="categoira" class="form-label-outside">Categoria</label>
                      <select id="categoira" name="categoria">
                      	<?php 
                      	$acesso->buscaSelectCategorias();
                      	?>
                      	<option>Selecione uma categoria</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="fotoPreview" class="form-label-outside">Foto Preview:</label>
                      <input id="fotoPreview" type="file" name="fotoPreview">
                    </div>
                    <div class="form-group">
                      <label for="textoPreview" class="form-label-outside">Texto de Preview</label>
                      <textarea name="textoPreview" form="cadastroPostForm" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-sm btn-curious-blue-variant-2 btn-block" type="submit"><i class="material-icons">face</i></button>
                    </div>
                  </form>
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