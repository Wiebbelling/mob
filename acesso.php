<?php


class Acesso {

	private static $con;

	public $id;
	public $usuario;
	public $cat;
	public $categoria;
	public $foto; 
	public $titulo; 
	public $texto; 
	public $fotoPreview; 
	public $page;
	public $textoPreview;

	function conectar()
	{

		global $con;

		$con = mysqli_connect("mysql.hostinger.com.br","u580826224_mob","123456","u580826224_mob") or die ("erro".mysqli_error($con));

		//$con = mysqli_connect("localhost","root","","mob") or die ("erro".mysqli_error($con));

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

	function listaPosts()
	{

		global $con;

		$query ="SELECT posts.id, titulo, foto, data_publicacao, apelido, categorias.nome,textoPreview
				FROM posts 
				LEFT JOIN categorias ON categorias.id = posts.categoria 
				LEFT JOIN usuarios ON usuarios.id = posts.usuario";
		
		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));

		while(($linha=mysqli_fetch_assoc($resultado)))
		{
			$codigo = $linha['id'];
			$titulo = $linha['titulo'];
			$data = $linha['data_publicacao'];
			$user = $linha['apelido'];
			$categoria = $linha['nome'];

			echo "<tr>
	                        <td>$codigo</td>
	                        <td>$titulo</td>
	                        <td>$user</td>
	                        <td>$categoria</td>
	                        <td>$data</td>
	                        <td style='text-align: right;'><a href='carregaPost.php?codigo=$codigo'><i class='material-icons'>mode_edit</i></a></td>
	                        <td style='text-align: right;'><a href='deletaDados.php?tipo=0&codigo=$codigo'><i class='material-icons'>delete_forever</i></a></td>
	                      </tr>";
	    }
	}

	function carregaPostById($id)
	{
		global $con;

		$query ="SELECT posts.id, posts.categoria, texto, titulo, foto, data_publicacao, apelido, categorias.nome,textoPreview, fotoPreview
			FROM posts 
			LEFT JOIN categorias ON categorias.id = posts.categoria 
			LEFT JOIN usuarios ON usuarios.id = posts.usuario 
			WHERE posts.id='$id'";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));

		$linha=mysqli_fetch_assoc($resultado);

		return $linha;
	}

	function salvaCase($id, $foto, $titulo, $cat, $texto, $usuario, $fotoPreview, $textoPreview)
	{
		global $con;
		$titulo =  str_replace("'","&#39;",$titulo);
		$titulo = str_replace("\"","&#34;",$titulo);
		$texto =  str_replace("'","&#39;",$texto);
		$texto = str_replace("\"","&#34;",$texto);
		$textoPreview =  str_replace("'"," ",$textoPreview);

		$query = "UPDATE posts SET foto='$foto',titulo='$titulo',texto='$texto',categoria='$cat',usuario='$usuario',data_publicacao=CURDATE(),fotoPreview='$fotoPreview',textoPreview='$textoPreview' WHERE id='$id'";

		$resultado = mysqli_query($con,$query) or die("erro efetuando update de post".mysqli_error($con));

		return 3;
	}
	
	function listaCategorias()
	{

		global $con;

		$query ="SELECT * FROM categorias";
		
		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));

		while(($linha=mysqli_fetch_assoc($resultado)))
		{
			$codigo = $linha['id'];
			$titulo = $linha['nome'];

			echo "<tr>
	                        <td>$codigo</td>
	                        <td>$titulo</td>
	                        <td style='text-align: right;'></td>
	                        <td style='text-align: right;'><a href='deletaDados.php?tipo=1&codigo=$codigo'><i class='material-icons'>delete_forever</i></a></td>
	                      </tr>";
	    }
	}

	function listaTags()
	{

		global $con;

		$query ="SELECT * FROM tags";
		
		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));

		while(($linha=mysqli_fetch_assoc($resultado)))
		{
			$codigo = $linha['id'];
			$titulo = $linha['nome'];

			echo "<tr>
	                        <td>$codigo</td>
	                        <td>$titulo</td>
	                        <td style='text-align: right;'></td>
	                        <td style='text-align: right;'><a href='deletaDados.php?tipo=2&codigo=$codigo'><i class='material-icons'>delete_forever</i></a></td>
	                      </tr>";
	    }
	}

	function cadastraTag($titulo)
	{
		global $con;

		$titulo = str_replace("'", "&#39;", $titulo);
		$titulo = str_replace("\"", "&#34;", $titulo);

		$query ="INSERT INTO tags (nome) VALUES ('$titulo')";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));

		return 1;
	}

	function cadastraCategoria($titulo)
	{
		global $con;

		$query ="INSERT INTO categorias (nome) VALUES ('$titulo')";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));

		return 1;
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

	function deletaDados($id, $tipo)
	{
		global $con;

		switch($tipo)
		{
			case '0':
					$query ="DELETE  FROM posts WHERE id='$id'";
					break;
			case '1':
					$query ="DELETE  FROM categorias WHERE id='$id'";
					break;
			case '2':
					$query ="DELETE  FROM tags WHERE id='$id'";
					break;
		}

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));

		return 1;

	}

	function buscaApelidoByCode($id)
	{
		global $con;

		$query ="SELECT nome FROM usuarios WHERE usuario='$id'";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));


		while(($linha=mysqli_fetch_assoc($resultado)))
		{
			
			$nome = $linha['aplido'];

			return $nome;
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

	function montaPagination($page, $numeroPaginas)
	{
		 echo "<nav aria-label='...'><ul class='pagination'>";
		 $next = $page+1;
		 $previous = $page-1;


             if($numeroPaginas == 2)
             {
             	
             	if($page == 1)
             	{
             		echo "<li class='page-item disabled'><a class='page-link' href='blog.php?pagina=1' tabindex='-1'>Previous</a></li>";
             		echo "<li class='page-item active'><a class='page-link' href='blog.php?pagina=1'>1</a></li>";
             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=2'>2</a></li>";
             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=2'>Next</a></li>";
               	}
               	else
               	{
               		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=1' tabindex='-1'>Previous</a></li>";
             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=1'>1</a></li>";
             		echo "<li class='page-item active'><a class='page-link' href='blog.php?pagina=2'>2</a></li>";
             		echo "<li class='page-item disabled'><a class='page-link' href='blog.php?pagina=2'>Next</a></li>";
               	}
             }
             else
             {
	             if($numeroPaginas == 3)
	             {
	             	
	             	if($page == 1)
	             	{
	             		echo "<li class='page-item disabled'><a class='page-link' href='blog.php?pagina=1' tabindex='-1'>Previous</a></li>";
	             		echo "<li class='page-item active'><a class='page-link' href='blog.php?pagina=1'>1</a></li>";
	             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=2'>2</a></li>";
	             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=3'>3</a></li>";
	             		echo "<li class='page-item normal'> <a class='page-link' href='blog.php?pagina=2'>Next</a></li>";
	               	}
	               	else 
	               	{
		               	if($page = 2)
		               	{
		               		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=1' tabindex='-1'>Previous</a></li>";
		             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=1'>1</a></li>";
		             		echo "<li class='page-item active'><a class='page-link' href='blog.php?pagina=2'>2</a></li>";
		             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=3'>3</a></li>";
		             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=3'>Next</a></li>";
		               	}
		               	else
		               	{
		               		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=2' tabindex='-1'>Previous</a></li>";
		             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=1'>1</a></li>";
		             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=2'>2</a></li>";
		             		echo "<li class='page-item active'><a class='page-link' href='blog.php?pagina=3'>3</a></li>";
		             		echo "<li class='page-item disabled'><a class='page-link' href='blog.php?pagina=3'>Next</a></li>";
		               	}
		            }
	             }
	             else
	             {
		            if($numeroPaginas > 3)
		            {
		             	if($page == 1) //primeira página
		             	{
		             		echo "<li class='page-item disabled'><a class='page-link' href='blog.php?pagina=".$page."' tabindex='-1'>Previous</a></li>";
		             		echo "<li class='page-item active'><a class='page-link' href='blog.php?pagina=1'>1</a></li>";
		             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=2'>2</a></li>";
		             		echo "<li class='page-item disabled'><a class='page-link' href='#'>...</a></li>";
		             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=".$numeroPaginas."'>".$numeroPaginas."</a></li>";
		             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=".$next."'>Next</a></li>";
		             	}
		             	else
		             	{
			             	if($page == $numeroPaginas) //ultima página
			             	{
			             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=".$previous."' tabindex='-1'>Previous</a></li>";
			             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=1'>1</a></li>";
			             		echo "<li class='page-item disabled'><a class='page-link' href='#'>...</a></li>";
			             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=".$previous."'>".$previous."</a></li>";
			             		echo "<li class='page-item active'><a class='page-link' href='blog.php?pagina=".$page."'>".$page."</a></li>";
			             		echo "<li class='page-item disabled'><a class='page-link' href='blog.php?pagina=".$next."'>Next</a></li>";
			             	}
			             	else
			             	{
			             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=".$previous."' tabindex='-1'>Previous</a></li>";
			             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=".$previous."'>".$previous."</a></li>";
			             		echo "<li class='page-item active'><a class='page-link' href='blog.php?pagina=".$page."'>".$page."</a></li>";
			             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=".$next."'>".$next."</a></li>";
			             		echo "<li class='page-item normal'><a class='page-link' href='blog.php?pagina=".$next."'>Next</a></li>";
			             	}
			            }
		            }
		        }
		    }

        echo "</ul></nav>";

	}


	function buscaCasesByPage($page)
	{
		global $con;

		$page--;
		$offset = $page*4;
		$query ="SELECT posts.id, titulo, foto, data_publicacao, apelido, categorias.nome,textoPreview
				FROM posts 
				LEFT JOIN categorias ON categorias.id = posts.categoria 
				LEFT JOIN usuarios ON usuarios.id = posts.usuario  
				ORDER BY data_publicacao DESC LIMIT 4 OFFSET $offset;";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));


		while(($linha=mysqli_fetch_assoc($resultado)))
		{
			$codigo = $linha['id'];
			$titulo = $linha['titulo'];
			$foto = $linha['foto'];
			$data = $linha['data_publicacao'];
			$user = $linha['apelido'];
			$categoria = $linha['nome'];
			$texto = $linha['textoPreview'];


			echo "
						<article class='post'>
		                  <div class='post-image'>
		                    <figure><img src='$foto' alt='' widtd='870' height='412'/> 
		                    </figure>
		                  </div>
		                  <div class='post-heading'>
		                    <h3><a href='blog-post.php?codigo=$codigo'>$titulo</a></h3>
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

		$query = "SELECT COUNT(id) FROM posts";
		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));
		$linha=mysqli_fetch_assoc($resultado);

		$retorno = (int) ($linha['COUNT(id)']/4);
	
		if($linha['COUNT(id)']%4)
			$retorno = $retorno + 1;
		return $retorno;
	}

	function buscaFirstsCases()
	{
	global $con;
	$count = 0;
	$query ="SELECT posts.id, titulo, foto, data_publicacao, apelido, categorias.nome,textoPreview
			FROM posts 
			LEFT JOIN categorias ON categorias.id = posts.categoria 
			LEFT JOIN usuarios ON usuarios.id = posts.usuario  
			ORDER BY data_publicacao DESC;";

	$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));


	while(($linha=mysqli_fetch_assoc($resultado)) && ($count < 2))
	{
		$codigo = $linha['id'];
		$titulo = $linha['titulo'];
		$foto = $linha['foto'];
		$data = $linha['data_publicacao'];
		$user = $linha['apelido'];
		$categoria = $linha['nome'];
		$texto = $linha['textoPreview'];


		echo "
					<article class='post'>
	                  <div class='post-image'>
	                    <figure><img src='$foto' alt='' widtd='870' height='412'/> 
	                    </figure>
	                  </div>
	                  <div class='post-heading'>
	                    <h3><a href='blog-post.php?codigo=$codigo'>$titulo</a></h3>
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

		$query ="SELECT posts.id, texto, titulo, foto, data_publicacao, apelido, categorias.nome,textoPreview
			FROM posts 
			LEFT JOIN categorias ON categorias.id = posts.categoria 
			LEFT JOIN usuarios ON usuarios.id = posts.usuario 
			WHERE posts.id='$id'";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));


		while(($linha=mysqli_fetch_assoc($resultado)))
		{
			$codigo = $linha['id'];
			$titulo = $linha['titulo'];
			$foto = $linha['foto'];
			$data = $linha['data_publicacao'];
			$user = $linha['apelido'];
			$categoria = $linha['nome'];
			$texto = $linha['texto'];

			echo "
						<article class='post'>
		                  <div class='post-image'>
		                    <figure><img src='$foto' alt='' widtd='870' height='412'/> 
		                    </figure>
		                  </div>
		                  <div class='post-heading'>
		                    <h3><a href='blog-post.php?codigo=$codigo'>$titulo</a></h3>
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

	function buscaSelectCategorias($codigo = -1)
	{
		global $con;

		$query ="SELECT * FROM categorias";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));


		while(($linha=mysqli_fetch_assoc($resultado)))
		{
			$id = $linha['id'];
			$nome = $linha['nome'];

			if(($codigo > -1) && ($codigo == $id))
				echo "<option selected value='$id'>$nome</option>";
			else
				echo "<option value='$id'>$nome</option>";
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

	function buscaCasesByCategory($categoria, $page)
	{
		global $con;
		$page--;
		$offset = $page*4;
		$query ="SELECT posts.id, titulo, foto, data_publicacao, apelido, categorias.nome,textoPreview
			FROM posts 
			LEFT JOIN categorias ON categorias.id = posts.categoria 
			LEFT JOIN usuarios ON usuarios.id = posts.usuario
			WHERE categoria = '$categoria' LIMIT 4 OFFSET $offset;";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));

		while($linha=mysqli_fetch_assoc($resultado))
		{
			$codigo = $linha['id'];
			$titulo = $linha['titulo'];
			$foto = $linha['foto'];
			$data = $linha['data_publicacao'];
			$user = $linha['apelido'];
			$categoria = $linha['nome'];
			$texto = $linha['textoPreview'];


			echo "
						<article class='post'>
		                  <div class='post-image'>
		                    <figure><img src='$foto' alt='' widtd='870' height='412'/> 
		                    </figure>
		                  </div>
		                  <div class='post-heading'>
		                    <h3><a href='blog-post.php?codigo=$codigo'>$titulo</a></h3>
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

		$query = "SELECT COUNT(id) FROM posts WHERE categoria = '$categoria'";
		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));
		$linha=mysqli_fetch_assoc($resultado);



		$retorno = (int) ($linha['COUNT(id)']/4);

		if($linha['COUNT(id)']%4)
			$retorno = $retorno + 1;
		


		return $retorno;

	}

	function buscaPreviewCases()
	{

		global $con;
		$count = 0;
		$query ="SELECT posts.id, titulo, foto, data_publicacao, apelido, texto, categorias.nome,textoPreview,fotoPreview
			FROM posts 
			LEFT JOIN categorias ON categorias.id = posts.categoria 
			LEFT JOIN usuarios ON usuarios.id = posts.usuario ORDER BY data_publicacao DESC";

		$resultado = mysqli_query($con,$query) or die("erro de consulta".mysqli_error($con));


		while(($linha=mysqli_fetch_assoc($resultado)) && $count < 3)
		{
			$codigo = $linha['id'];
			$titulo = $linha['titulo'];
			$foto = $linha['foto'];
			$data = $linha['data_publicacao'];
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
                                    <figure><img src='$imagePreview' alt='' widtd='70'/>
                                    </figure>
                                  </div>
                                </div>
                                <div class='unit-body'>
                                  <p class='post-preview-heading'><a href='blog-post.php?codigo=$codigo'>
                                      $titulo
                                      </a></p>
                                  <div class='post-preview-meta'>
                                    <time datetime='2016-02-04'>$data</time>
                                  </div>
                                </div>
                              </div>
                            </article>
                          </li>";
                   $count++;
		}
	}

	function cadastraNovoCase($foto, $titulo, $cat, $texto, $usuario, $fotoPreview, $textoPreview)
	{
		global $con;

		$query ="INSERT INTO posts(foto, titulo, texto, categoria, usuario, data_publicacao, fotoPreview, textoPreview) VALUES ('$foto','$titulo','$texto','$cat','$usuario',CURDATE(),'$fotoPreview','$textoPreview')";

		$resultado = mysqli_query($con,$query) or die("erro efetuando cadastro de post".mysqli_error($con));

		return 2;
	}

}

?>