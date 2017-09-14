<?php
include "acesso.php";
$acesso = new acesso;
$acesso->conectar();

session_start();
session_name("adm");

if(isset($_SESSION['validacao']))
{
  if($_SESSION['validacao'] != 1 || !isset($_SESSION['codigo']))
    header("Location:login.php");
}
else
{
  header("Location:login.php"); 
}

if(    isset($_POST['titulo']) 
    && isset($_POST['texto']) 
    && isset($_POST['categoria']) 
    && isset($_POST['categoria']) 
    && isset($_POST['textoPreview']) 
    && isset($_FILES['foto']) 
    && isset($_FILES['fotoPreview']))
{


  $imagemPrincipal = "images/".$_FILES["foto"]["name"];
  $imagemPreview = "images/".$_FILES['fotoPreview']['name'];

  move_uploaded_file($_FILES["foto"]["tmp_name"], $imagemPrincipal);
  move_uploaded_file($_FILES['fotoPreview']["tmp_name"], $imagemPreview);

  $acesso->cadastraNovoCase($imagemPrincipal, $_POST['titulo'], $_POST['categoria'], $_POST['texto'], $_SESSION['codigo'], $imagemPreview, $_POST['textoPreview']);





  echo "Vai cadastrar:<br>";
  echo "Titulo: ".$_POST['titulo'];
  echo "<br>Texto: ".$_POST['texto'];
  echo "<br>Categoria: ".$_POST['categoria'];
  echo "<br>Texto Preview: ".$_POST['textoPreview'];
  echo "<br>Usuário: ".$_SESSION['codigo'];
  echo "Foto Principal: ".$_FILES['foto']['name'];
  echo "Foto Preview: ".$_FILES['fotoPreview']['name'];
}

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
                  <form method="post" action="" id="cadastroPostForm" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="foto" class="form-label-outside"><h6>Foto(870x412):</h6></label><br>
                      <label class="btn btn-default btn-file btn-curious-blue-variant-2">
                          Selecionar Arquivo <input type="file" id="foto" name="foto" style="display: none;">
                      </label>
                    </div>
                    <div class="form-group">
                      <label for="titulo" class="form-label-outside"><h6>Título:</h6></label>
                      <input id="titulo" type="text" name="titulo" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="texto" class="form-label-outside"><h6>Texto:</h6></label>
                      <textarea name="texto" form="cadastroPostForm" class="form-control"></textarea>
                    </div>
                  	<div class="form-group">
                      <label for="categoira" class="form-label-outside"><h6>Categoria:</h6></label>
                      <select id="categoira" name="categoria">
                      	<?php 
                      	$acesso->buscaSelectCategorias();
                      	?>
                      	<option>Selecione uma categoria</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="fotoPreview" class="form-label-outside"><h6>Foto Preview(70x70):</h6></label><br>
                      <label class="btn btn-default btn-file btn-curious-blue-variant-2">
                          Selecionar Arquivo <input type="file" id="fotoPreview" name="fotoPreview" style="display: none;">
                      </label>

                    </div>
                    <div class="form-group">
                      <label for="textoPreview" class="form-label-outside"><h6>Texto de Preview:</h6></label>
                      <textarea name="textoPreview" form="cadastroPostForm" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-sm btn-curious-blue-variant-2" type="submit">Publicar</button> 
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- <i class="material-icons">save</i> -->

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