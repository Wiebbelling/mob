<?php


class Acesso {

	private static $con;

	public $id;
	public $categoria;

	function conectar()
	{

		global $con;

		//$con = mysqli_connect("mysql.hostinger.com.br","u580826224_admin","Digo3001","u580826224_df") or die ("erro".mysqli_error($con));

		$con = mysqli_connect("localhost","root","123456","mob") or die ("erro".mysqli_error($con));

		return $con;

	}
	function buscaCategoriaById($id)
	{
		global $con;

		$query ="SELECT nome FROM categorias WHERE id='$id'";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));


		while(($linha=mysqli_fetch_assoc($resultado)))
		{
			
			$nome = $linha['nome'];

			echo $nome;
		}
	}

	function buscaUserById($id)
	{
		global $con;

		$query ="SELECT nome FROM usuarios WHERE id='$id'";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));


		while(($linha=mysqli_fetch_assoc($resultado)))
		{
			
			$nome = $linha['aplido'];

			echo $nome;
		}
	}

	function login($usuario, $senha)
	{

		global $con;

		$query ="SELECT password FROM usuarios WHERE user = '$usuario'";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));

		$linha=mysqli_fetch_assoc($resultado);

		$senha_banco = $linha['password'];

		if($senha == $senha_banco)

			return 1;

		else

			return 0;
	}

	function buscaFirstsCases()
	{
	global $con;
	$count = 0;
	$query ="SELECT posts.id, titulo, foto, data, apelido, categorias.nome,textoPreview
			FROM posts 
			LEFT JOIN categorias ON categorias.id = posts.categoria 
			LEFT JOIN usuarios ON usuarios.id = posts.user  
			ORDER BY data DESC;";

	$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));


	while(($linha=mysqli_fetch_assoc($resultado)) && ($count < 2))
	{
		$codigo = $linha['id'];
		$titulo = $linha['titulo'];
		$foto = $linha['foto'];
		$data = $linha['data'];
		$user = $linha['apelido'];
		$categoria = $linha['nome'];
		$texto = $linha['textoPreview'];


		echo "
					<article class='post'>
	                  <div class='post-image'>
	                    <figure><img src='$foto' alt='' width='870' height='412'/> 
	                    </figure>
	                  </div>
	                  <div class='post-heading'>
	                    <h3><a href='blog-post.html'>$titulo</a></h3>
	                  </div>
	                  <div class='post-meta'>
	                    <ul class='list-meta'>
	                      <li>
	                        <dl class='list-terms-inline'>
	                          <dt>Date</dt>
	                          <dd>
	                            <time datetime='2016-01-22'>$data</time>
	                          </dd>
	                        </dl>
	                      </li>
	                      <li>
	                        <dl class='list-terms-inline'>
	                          <dt>Posted by</dt>
	                          <dd>$user</dd>
	                        </dl>
	                      </li>
	                      <li>
	                        <dl class='list-terms-inline'>
	                          <dt>Comments</dt>
	                          <dd>2</dd>
	                        </dl>
	                      </li>
	                      <li>
	                        <dl class='list-terms-inline'>
	                          <dt>Category</dt>
	                          <dd>$categoria</dd>
	                        </dl>
	                      </li>
	                    </ul>
	                    <hr class='hr-gray-lighter'>
	                  </div>
	                  <div class='post-body'>
	                    <p>
	                      $texto</p><a href='blog-post.php?codigo=$codigo' class='btn btn-sm btn-curious-blue-outline'>Read More</a>
	                  </div>
	                </article> ";

	        $count = $count + 1;
	}

	return 1;


	//faz alguma coisa

	}

	function buscaCaseById($id)
	{

		global $con;

		$query ="SELECT posts.id, texto, titulo, foto, data, apelido, categorias.nome,textoPreview
			FROM posts 
			LEFT JOIN categorias ON categorias.id = posts.categoria 
			LEFT JOIN usuarios ON usuarios.id = posts.user 
			WHERE posts.id='$id'";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));


		while(($linha=mysqli_fetch_assoc($resultado)))
		{
			$codigo = $linha['id'];
			$titulo = $linha['titulo'];
			$foto = $linha['foto'];
			$data = $linha['data'];
			$user = $linha['apelido'];
			$categoria = $linha['nome'];
			$texto = $linha['texto'];

			echo "
						<article class='post'>
		                  <div class='post-image'>
		                    <figure><img src='$foto' alt='' width='870' height='412'/> 
		                    </figure>
		                  </div>
		                  <div class='post-heading'>
		                    <h3><a href='blog-post.html'>$titulo</a></h3>
		                  </div>
		                  <div class='post-meta'>
		                    <ul class='list-meta'>
		                      <li>
		                        <dl class='list-terms-inline'>
		                          <dt>Date</dt>
		                          <dd>
		                            <time datetime='2016-01-22'>$data</time>
		                          </dd>
		                        </dl>
		                      </li>
		                      <li>
		                        <dl class='list-terms-inline'>
		                          <dt>Posted by</dt>
		                          <dd>$user</dd>
		                        </dl>
		                      </li>
		                      <li>
		                        <dl class='list-terms-inline'>
		                          <dt>Comments</dt>
		                          <dd>2</dd>
		                        </dl>
		                      </li>
		                      <li>
		                        <dl class='list-terms-inline'>
		                          <dt>Category</dt>
		                          <dd>$categoria</dd>
		                        </dl>
		                      </li>
		                    </ul>
		                    <hr class='hr-gray-lighter'>
		                  </div>
		                  <div class='post-body'>
		                    <p>
		                      $texto</p>
		                  </div>
		                </article> ";


		}
	}

	function buscaTituloById($id)
	{
		global $con;

		$query ="SELECT titulo FROM posts WHERE id='$id'";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));

		$linha=mysqli_fetch_assoc($resultado);

		echo $linha['titulo'];
	}

	function buscaCategorias()
	{
		global $con;

		$query ="SELECT * FROM categorias";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));


		while(($linha=mysqli_fetch_assoc($resultado)))
		{
			$id = $linha['id'];
			$nome = $linha['nome'];

			echo "<li><a href='blog.php?categoria=$id'>$nome</a></li>";
		}
	}

	function buscaTags()
	{
		global $con;

		$query ="SELECT * FROM tags";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));


		while(($linha=mysqli_fetch_assoc($resultado)))
		{
			$id = $linha['id'];
			$nome = $linha['nome'];

			echo "<li><a href='#'>$nome</a></li>";
		}
	}

	function buscaCasesByCategory($categoria)
	{
		global $con;

		$query ="SELECT posts.id, titulo, foto, data, apelido, categorias.nome,textoPreview
			FROM posts 
			LEFT JOIN categorias ON categorias.id = posts.categoria 
			LEFT JOIN usuarios ON usuarios.id = posts.user
			WHERE categoria = '$categoria'";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));

		while($linha=mysqli_fetch_assoc($resultado))
		{
			$codigo = $linha['id'];
			$titulo = $linha['titulo'];
			$foto = $linha['foto'];
			$data = $linha['data'];
			$user = $linha['apelido'];
			$categoria = $linha['nome'];
			$texto = $linha['textoPreview'];


			echo "
						<article class='post'>
		                  <div class='post-image'>
		                    <figure><img src='$foto' alt='' width='870' height='412'/> 
		                    </figure>
		                  </div>
		                  <div class='post-heading'>
		                    <h3><a href='blog-post.html'>$titulo</a></h3>
		                  </div>
		                  <div class='post-meta'>
		                    <ul class='list-meta'>
		                      <li>
		                        <dl class='list-terms-inline'>
		                          <dt>Date</dt>
		                          <dd>
		                            <time datetime='2016-01-22'>$data</time>
		                          </dd>
		                        </dl>
		                      </li>
		                      <li>
		                        <dl class='list-terms-inline'>
		                          <dt>Posted by</dt>
		                          <dd>$user</dd>
		                        </dl>
		                      </li>
		                      <li>
		                        <dl class='list-terms-inline'>
		                          <dt>Comments</dt>
		                          <dd>2</dd>
		                        </dl>
		                      </li>
		                      <li>
		                        <dl class='list-terms-inline'>
		                          <dt>Category</dt>
		                          <dd>$categoria</dd>
		                        </dl>
		                      </li>
		                    </ul>
		                    <hr class='hr-gray-lighter'>
		                  </div>
		                  <div class='post-body'>
		                    <p>
		                      $texto</p><a href='blog-post.php?codigo=$codigo' class='btn btn-sm btn-curious-blue-outline'>Read More</a>
		                  </div>
		                </article> ";


		}
	}

	function buscaPreviewCases()
	{
		global $con;

		$query ="SELECT posts.id, titulo, foto, data, apelido, texto, categorias.nome,textoPreview,fotoPreview
			FROM posts 
			LEFT JOIN categorias ON categorias.id = posts.categoria 
			LEFT JOIN usuarios ON usuarios.id = posts.user ORDER BY data DESC";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));


		while(($linha=mysqli_fetch_assoc($resultado)))
		{
			$codigo = $linha['id'];
			$titulo = $linha['titulo'];
			$foto = $linha['foto'];
			$data = $linha['data'];
			$user = $linha['apelido'];
			$categoria = $linha['nome'];
			$texto = $linha['texto'];
			$imagePreview = $linha['fotoPreview'];
			$textoPreview = $linha['textoPreview'];

			echo "<li>
                            <article class='post-preview'>
                              <div class='unit unit-horizontal unit-spacing-sm'>
                                <div class='unit-left'>
                                  <div class='post-preview-image'>
                                    <figure><img src='$imagePreview' alt='' width='70'/>
                                    </figure>
                                  </div>
                                </div>
                                <div class='unit-body'>
                                  <p class='post-preview-heading'><a href='blog-post.php?codigo=$codigo'>
                                      $titulo
                                      </a></p>
                                  <div class='post-preview-meta'>
                                    <time datetime='2016-02-04'>$data</time><span>4 Comments</span>
                                  </div>
                                </div>
                              </div>
                            </article>
                          </li>";
		}
	}

	

}

?>