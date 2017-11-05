<?php
require_once DBAPI; 
class Usuario {
	/**
   * Nome do banco de dados onde está a tabela de usuários
   */
  var $bancoDeDados = 'continuos';
  /**
   * Nome da tabela de usuários
   */
  var $tabelaUsuarios = 'usuarios';
  /**
   * Nomes dos campos onde ficam o usuário e a senha de cada usuário
   * Formato: tipo => nome_do_campo
   */
  var $campos = array(
    'login' => 'login',
    'senha' => 'senha'
  );
  /**
   * Usa algum tipo de encriptação para codificar uma senha
   *
   * Método protegido: Só pode ser acessado por dentro da classe
   *
   * @param string $senha - A senha que será codificada
   * @return string - A senha já codificada
   */
   /**
   * Nomes dos campos que serão pegos da tabela de usuarios e salvos na sessão,
   * caso o valor seja false nenhum dado será consultado
   * @var mixed
   */
  var $dados = array('id', 'login','senha','admin');
  /**
   * Inicia a sessão se necessário?
   * @var boolean
   */
  var $iniciaSessao = true;
  /**
   * Prefixo das chaves usadas na sessão
   * @var string
   */
  var $prefixoChaves = 'usuario_';
  /**
   * Usa um cookie para melhorar a segurança?
   * @var boolean
   */
  var $cookie = true;
  /**
   * Armazena as mensagens de erro
   * @var string
   */
  var $erro = '';
  function cadastrarUsuario(){
	if (!empty($_POST['usuarios'])) {
		//echo "passou aqui 1";
   
		$usuario = $_POST['usuarios'];
		//$customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
		
		$columns = null;
		$values = null;
		
		//print_r($usuario);
		
		foreach ($usuario as $key => $value) {
			$columns .= trim($key, "'") . ",";
			$values .= "'$value',";
		}
		
		// remove a ultima virgula
		$columns = rtrim($columns, ',');
		$values = rtrim($values, ',');
		
		$query = "INSERT INTO Usuarios" . "($columns)" . " VALUES " . "($values);";
		echo $query;
			
		$connect = mysql_connect('localhost','root','3141323');
		$db = mysql_select_db('continuos');
		try {
		
			
			$insert = mysql_query($query,$connect)  or die(mysql_error());
				if($insert){
					//echo "Status cadastrado com sucesso";
					echo"<script language='javascript' type='text/javascript'>alert('Usuario cadastrado com sucesso!');window.location.href='add.php'</script>";
					}else{
						//echo "Não foi possível cadastrar esse status";
					echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse Usuario');window.location.href='add.php'</script>";
					}
		} catch (Exception $e) {
				echo 'ERROR:'.$e->getMessage();
		}
		//header('location: index.php');
	}//else{echo "passou aqui 2";}
	
	
  }
  function __codificaSenha($senha) {
    // Altere aqui caso você use, por exemplo, o MD5:
    return md5($senha);
	//return sha1($senha);
    //return $senha;
  }
  /**
   * Valida se um usuário existe
   *
   * @param string $usuario - O usuário que será validado
   * @param string $senha - A senha que será validada
   * @return boolean - Se o usuário existe ou não
   function validaUsuario($usuario, $senha) {*/
  function validaUsuario($usuario, $senha) {
    $senha = $this->__codificaSenha($senha);
	
	// Tenta se conectar ao servidor MySQL
	mysql_connect('localhost', 'root', '3141323') or trigger_error(mysql_error());
	
	// Tenta se conectar a um banco de dados MySQL
	mysql_select_db($this->bancoDeDados) or trigger_error(mysql_error());

	// Procura por usuários com o mesmo usuário e senha
    $sql = "SELECT COUNT(*) AS total
        FROM `{$this->bancoDeDados}`.`{$this->tabelaUsuarios}`
        WHERE
          `{$this->campos['login']}` = '{$usuario}'
          AND
          `{$this->campos['senha']}` = '{$senha}'";
    $query = mysql_query($sql);
    if ($query) {
      $total = mysql_result($query, 0, 'total');
      // Limpa a consulta da memória
      mysql_free_result($query);
    } else {
      // A consulta foi mal sucedida, retorna false
      return false;
    }
    // Se houver apenas um usuário, retorna true
    return ($total == 1) ? true : false;
  }
  /**
   * Loga um usuário no sistema salvando seus dados na sessão
   *
   * @param string $usuario - O usuário que será logado
   * @param string $senha - A senha do usuário
   * @return boolean - Se o usuário foi logado ou não
   */
  function logaUsuario($usuario, $senha) {
	  // Verifica se é um usuário válido
    if ($this->validaUsuario($usuario, $senha)) { ECHO 'LOGIN VALIDO';
    } else {
      $this->erro = 'Usuário inválido';
      return false;
    }
	// Inicia a sessão?
      if ($this->iniciaSessao AND !isset($_SESSION)) {
        session_start();
      }
	  
	  // Traz dados da tabela?
      if ($this->dados != false) {
        // Adiciona o campo do usuário na lista de dados
        if (!in_array($this->campos['login'], $this->dados)) {
          $this->dados[] = 'login';
        }
        // Monta o formato SQL da lista de campos
        $dados = '`' . join('`, `', array_unique($this->dados)) . '`';
        // Consulta os dados
        $sql = "SELECT {$dados}
            FROM `{$this->bancoDeDados}`.`{$this->tabelaUsuarios}`
            WHERE `{$this->campos['login']}` = '{$usuario}'";
		echo $sql;
        $query = mysql_query($sql);
        // Se a consulta falhou
        if (!$query) {
          // A consulta foi mal sucedida, retorna false
          $this->erro = 'A consulta dos dados é inválida';
          return false;
        } else {
          // Traz os dados encontrados para um array
          $dados = mysql_fetch_assoc($query);
		  
          // Limpa a consulta da memória
          mysql_free_result($query);
          // Passa os dados para a sessão
          foreach ($dados AS $chave=>$valor) {
            $_SESSION[$this->prefixoChaves . $chave] = $valor;
			echo $this->prefixoChaves . $chave . '=' . $valor . '<br>';
           }
        }
      }
	  // Usuário logado com sucesso
      $_SESSION[$this->prefixoChaves . 'logado'] = true;
      // Define um cookie para maior segurança?
      if ($this->cookie) {
        // Monta uma cookie com informações gerais sobre o usuário: usuario, ip e navegador
        $valor = join('#', array($usuario, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']));
        // Encripta o valor do cookie
        $valor = sha1($valor);
        setcookie($this->prefixoChaves . 'token', $valor, 0, '/');
      }
      // Fim da verificação, retorna true
      return true;
  }
  /**
   * Verifica se há um usuário logado no sistema
   *
   * @return boolean - Se há um usuário logado ou não
   */
  function usuarioLogado() {
    // Inicia a sessão?
    if ($this->iniciaSessao AND !isset($_SESSION)) {
      session_start();
    }
    // Verifica se não existe o valor na sessão
    if (!isset($_SESSION[$this->prefixoChaves . 'logado']) OR !$_SESSION[$this->prefixoChaves . 'logado']) {
      return false;
    }
	 // Faz a verificação do cookie?
    if ($this->cookie) {
      // Verifica se o cookie não existe
      if (!isset($_COOKIE[$this->prefixoChaves . 'token'])) {
        return false;
      } else {
        	// Monta o valor do cookie
			$valor = join('#', array($_SESSION[$this->prefixoChaves . 'login'], $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']));
			// Encripta o valor do cookie
			$valor = sha1($valor);
			// Verifica o valor do cookie
			if ($_COOKIE[$this->prefixoChaves . 'token'] !== $valor) {
			return false;
			}
			// A sessão e o cookie foram verificados, há um usuário logado
			return true;
      }
    }

  }
 
	/**
	* Faz logout do usuário logado
	*
	* @return boolean
	*/
	function logout() {
		// Inicia a sessão?
		if ($this->iniciaSessao AND !isset($_SESSION)) {
		session_start();
		}
		// Tamanho do prefixo
		$tamanho = strlen($this->prefixoChaves);
		// Destroi todos os valores da sessão relativos ao sistema de login
		foreach ($_SESSION AS $chave=>$valor) {
			// Remove apenas valores cujas chaves comecem com o prefixo correto
			if (substr($chave, 0, $tamanho) == $this->prefixoChaves) {
				unset($_SESSION[$chave]);
			}
		}
		// Destrói asessão se ela estiver vazia
		if (count($_SESSION) == 0) {
			session_destroy();
			// Remove o cookie da sessão se ele existir
			if (isset($_COOKIE['PHPSESSID'])) {
				setcookie('PHPSESSID', false, (time() - 3600));
				unset($_COOKIE['PHPSESSID']);
			}
		}
		// Remove o cookie com as informações do visitante
		if ($this->cookie AND isset($_COOKIE[$this->prefixoChaves . 'token'])) {
			setcookie($this->prefixoChaves . 'token', false, (time() - 3600), '/');
			unset($_COOKIE[$this->prefixoChaves . 'token']);
		}
		// Retorna SE não há um usuário logado
		return !$this->usuarioLogado();
	}
	/**
	* Quantidade (em dias) que o sistema lembrará os dados do usuário ("Lembrar minha senha")
	*
	* Usado apenas quando o terceiro parâmetro do método Usuario::logaUsuario() for true
	* Os dados salvos serão encriptados usando base64
	*
	* @var integer
	* @since v1.1
	*/
	var $lembrarTempo = 7;
	/**
	* Salva os dados do usuário em cookies ("Lembrar minha senha")
	*
	* @access public
	* @since v1.1
	*
	* @param string $usuario O usuário que será lembrado
	* @param string $senha A senha do usuário
	* @return void
	*/
	function lembrarDados($usuario, $senha) {
		// Calcula o timestamp final para os cookies expirarem
		$tempo = strtotime("+{$this->lembrarTempo} day", time());
		// Encripta os dados do usuário usando base64
		// O rand(1, 9) cria um digito no início da string que impede a descriptografia
		$usuario = rand(1, 9) . base64_encode($usuario);
		$senha = rand(1, 9) . base64_encode($senha);
		// Cria um cookie com o usuário
		setcookie($this->prefixoChaves . 'lu', $usuario, $tempo, $this->cookiePath);
		// Cria um cookie com a senha
		setcookie($this->prefixoChaves . 'ls', $senha, $tempo, $this->cookiePath);
	}
	/**
	* Verifica os dados do cookie (caso eles existam)
	*
	* @access public
	* @since v1.1
	* @uses Usuario::logaUsuario()
	*
	* @return boolean Os dados são validos?
	*/
	function verificaDadosLembrados() {
		// Os cookies de "Lembrar minha senha" existem?
		if (isset($_COOKIE[$this->prefixoChaves . 'lu']) AND isset($_COOKIE[$this->prefixoChaves . 'ls'])) {
			// Pega os valores salvos nos cookies removendo o digito e desencriptando
			$usuario = base64_decode(substr($_COOKIE[$this->prefixoChaves . 'lu'], 1));
			$senha = base64_decode(substr($_COOKIE[$this->prefixoChaves . 'ls'], 1));
			// Tenta logar o usuário com os dados encontrados nos cookies
			return $this->logaUsuario($usuario, $senha, true);
		}
		// Não há nenhum cookie, dados inválidos
		return false;
		
	}
	/**
	* Limpa os dados lembrados dos cookies ("Lembrar minha senha")
	*
	* @access public
	* @since v1.1
	*
	* @return void
	*/
	function limpaDadosLembrados() {
		// Deleta o cookie com o usuário
		if (isset($_COOKIE[$this->prefixoChaves . 'lu'])) {
			setcookie($this->prefixoChaves . 'lu', false, (time() - 3600), $this->cookiePath);
			unset($_COOKIE[$this->prefixoChaves . 'lu']);
		}
		// Deleta o cookie com a senha
		if (isset($_COOKIE[$this->prefixoChaves . 'ls'])) {
		setcookie($this->prefixoChaves . 'ls', false, (time() - 3600), $this->cookiePath);
		unset($_COOKIE[$this->prefixoChaves . 'ls']);
		}
	}
}
?>