 <?php

 class Model
 {
 	public $db = null; //nuestro objeto de la conexion PDO.
 	function __construct()
	{
		try
		{
			$this->db = $this->getConnection(); //obtenemos la conexión
		}
		catch(PDOException $ex)
		{
			die("No se pudo conectar a la base de datos.");
		}
	}

	//método para conectarnos via PDO
	private function getConnection()
	{
		$host = "localhost";
		$user = "root";
		$pass = "123456";
		$database = "codestack";
		$charset = "utf8";
		$opt = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
		$pdo = new pdo("mysql:host={$host};dbname={$database};charset={$charset}", $user, $pass, $opt);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	}
 }
