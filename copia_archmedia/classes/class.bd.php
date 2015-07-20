<?php

/**
 * Clase para interactuar con bases de datos. Utiliza PDO por lo que
 * puede utilizarse con diversos motores
 * 
 * @author David Mezquíriz
 *
 */

class Bd
{
	/**
	 * Nombre del motor de base de datos por defecto
	 * @var string
	 */
	
	const MOTOR_DEFECTO = "mysql";
	
	/**
	 * Manejador PDO
	 * @var PDO
	 * @access private
	 */
	
	private $pdoHandler = NULL;
	
	/**
	 * Objeto sentencia
	 * @var PDOStatement
	 * @access private
	 */
	
	private $pdoStatement = NULL;
	
	/**
	 * Nombre del motor de base de datos de la instancia
	 * @var string
	 * @access private
	 */
	
	private $motorBd = NULL;
	
	/**
	 * Nombre de la base de datos de la instancia
	 * @var string
	 * @access private
	 */
	
	private $nombreBaseDatos = NULL;
	
	/**
	 * Array con los nombres de las tablas de la base de datos de la instancia
	 * @var array
	 * @access private
	 */
	
	private $arrayTablas = array();
	
	/**
	 * Nombre temporal de la tabla con la que se quiere trabajar en ciertos momentos
	 * @var string
	 * @access private
	 */
	
	private $tabla = NULL;
	
	/**
	 * Flag indicador de transacción en curso
	 * Se usa para versiones de PHP inferiores a 5.3.3
	 * @var boolean
	 * @access private
	 */
	
	private $flagTransaction = false;
		
	/**
	 * Constructor privado para crear la instancia de Bd 
	 * @param string $dsn
	 * @param string $user
	 * @param string $password
	 * @throws PDOException
	 * @access public
	 */
	
	public function __construct($bd, $user, $password, $servidor = "localhost", $motor = NULL)
	{
		if(!$motor){
			$motor = self::MOTOR_DEFECTO;
		}
		
		$dsn = "$motor:dbname=$bd;host=$servidor";
		$this->pdoHandler = new PDO($dsn, $user, $password);
		$this->pdoHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->motorBd = $this->pdoHandler->getAttribute(PDO::ATTR_DRIVER_NAME);
		$this->nombreBaseDatos = $bd;
	}

	/**
	 * Método para ejecutar una consulta SQL 
	 * @param string $query
	 * @return array
	 * @return int
	 * @throws PDOException
	 * @access public
	 */
	
	public function exeQuery($query)
	{
		
		$this->tabla = NULL;
		
		$pdo_statement = $this->pdoHandler->query($query);

		if($pdo_statement instanceof PDOStatement){
			
			if(preg_match('/^(select|show)/i', $pdo_statement->queryString)){
			
				return $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
			
			}else{
				
				return $pdo_statement->rowCount();
			}
		}
	}
	
	/**
	 * Prepara una sentencia para su ejecución
	 * 
	 * @param string $query
	 * @param array $array_opciones
	 * @access public
	 */
	
	public function prepareQuery($query, $array_opciones = array())
	{
		$this->pdoStatement = $this->pdoHandler->prepare($query, $array_opciones);
	}
	
	/**
	 * Ejecuta la sentencia preparada
	 * @param array $array_parametros
	 * @throws Exception
	 * @access public
	 */
	
	public function ejecutarSentencia($array_parametros)
	{
		if(!($this->pdoStatement instanceof PDOStatement)){
			throw new Exception("Hay que preparar primero una sentencia con Bd::prepareQuery()");
		}

		$this->pdoStatement->execute($array_parametros);
	}
	
	/**
	 * Inicia una transacción
	 * @throws PDOException
	 * @access public
	 */
	
	public function beginTransaction()
	{
		if(!$this->isInTransaction()){
				
			$this->pdoHandler->beginTransaction();
			$this->flagTransaction = true;
				
		}
	}
	
	/**
	 * Confirma una transacción
	 * @throws PDOException
	 * @access public
	 */
		
	public function commitTransaction()
	{
		if($this->isInTransaction()){
			$this->pdoHandler->commit();
			$this->flagTransaction = false;
		}
	}
	
	/**
	 * Cancela una transacción
	 * @throws PDOException
	 * @access public
	 */
	
	public function rollBackTransaction()
	{
		if($this->isInTransaction()){
			$this->pdoHandler->rollBack();
			$this->flagTransaction = false;
		}
	}
	
	/**
	 * Comprueba si hay transacción en curso
	 * @return boolean
	 * @throws PDOException
	 * @access public
	 */
	
	public function isInTransaction()
	{
		//Si la versión PHP es 5.3.3 o superior
		if(version_compare(PHP_VERSION, "5.3.3") >= 0){
			return $this->pdoHandler->inTransaction();
		}
		
		return $this->flagTransaction;
	}
	
	/**
	 * Devuelve el último id insertado
	 * @throws PDOException
	 * @access public
	 */
	
	public function getUltimoId()
	{
		return $this->pdoHandler->lastInsertId();
	}
	
	/**
	 * Devuelve una array con los campos de las tablas de la base de datos de la instancia
	 * @param string $tabla
	 * @return array
	 * @throws PDOException
	 * @access public
	 */
	
	public function getCamposTabla($tabla)
	{
		return array_keys($this->getDetallesCamposTabla($tabla));
	}
	
	/**
	 * Devuelve una array con los detalles de los campos de la tabla pasada
	 * @param string $tabla
	 * @return array
	 * @throws PDOException
	 * @access public
	 */
	
	public function getDetallesCamposTabla($tabla)
	{
		$this->comprobarTabla($tabla);
		$this->tabla = $tabla;
		$array = $this->exeQuery($this->getQueryPredefinida("campos_de_tabla"));
		
		if(count($array) > 0){
		
			$array_campos = array();
			foreach($array as $indice => $array_datos){
				switch ($this->motorBd){
		
					case "mysql":
		
						$array_campos[$array_datos["Field"]] = array(	"tipo" => $array_datos["Type"],
																		"null" => $array_datos["Null"],
																		"default" => $array_datos["Default"]);
						break;
					case "pgsql":
		
						$array_campos[$array_datos["column_name"]] = array(	"tipo" => $array_datos["data_type"],
																			"null" => $array_datos["is_nullable"],
																			"default" => $array_datos["column_default"]);
						break;
				}
			}
		}
		
		return $array_campos;
	}
	
	/**
	 * Devuelve un array de la tablas de la base de datos de la instancia
	 * @return array
	 * @throws PDOException
	 * @access public
	 */
	
	public function getTablas()
	{
		if(count($this->arrayTablas) == 0){
			
			$array = $this->exeQuery($this->getQueryPredefinida("tablas"));
			if(count($array) > 0){
				
				$array_temp = array();
				
				foreach($array as $indice => $array_datos){
					switch ($this->motorBd){
					
						case "mysql":

							$this->arrayTablas[] = $array_datos["Tables_in_".$this->nombreBaseDatos];
							break;
						case "pgsql":
							
							$this->arrayTablas[] = $array_datos["table_name"];
							break;
					}
				}
			}
		}
			
		return $this->arrayTablas;
	}
	
	/**
	 * Devuelve el total de registros que en la tabla pasada
	 * @param string $tabla
	 * @return int
	 * @throws PDOException
	 * @access public
	 */
	
	public function totalRegistrosTabla($tabla)
	{
		$this->comprobarTabla($tabla);
		$array = $this->exeQuery("SELECT count(*) FROM $tabla");
		return $array[0]["count"];
	}
	
	/**
	 * Comprueba si la tabla pasada existe en la base de datos de la instancia
	 * @param string $tabla
	 * @throws Exception
	 * @throws PDOException
	 * @access private
	 */
	
	private function comprobarTabla($tabla)
	{
		if(count($this->arrayTablas) == 0){
			$this->getTablas();
		}
		
		if(!in_array($tabla, $this->arrayTablas)){
			
			throw new Exception("La tabla $tabla no existe en la base de datos 
													{$this->nombreBaseDatos}");
		}
	}
	
	/**
	 * Devuelve la query predefinidas para ciertas consultas dependiendo del motor de la 
	 * base de datos de la instancia
	 * @param string $accion
	 * @throws Exception
	 * @throws PDOException
	 * @access private
	 */
	
	private function getQueryPredefinida($accion)
	{
		$array_acciones = array();
		
		switch ($this->motorBd){
			
			case "mysql":

				$array_acciones["tablas"] = "SHOW TABLES FROM {$this->nombreBaseDatos}";
				$array_acciones["campos_de_tabla"] = "SHOW COLUMNS FROM {$this->tabla}";
				
				break;
				
			case "pgsql":
				
				$array_acciones["tablas"] =  "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public';";
				$array_acciones["campos_de_tabla"] = "SELECT column_name, data_type, is_nullable, column_default FROM 
							information_schema.columns WHERE table_name='{$this->tabla}'";
					
				break;
		
			case "Oracle":
				
				$array_acciones["tablas"] = "SELECT * FROM dba_tables";
				
				break;

			case "MSSQL":
				
				$array_acciones["tablas"] = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE
				TABLE_TYPE = 'BASE TABLE'";
				
				break;
		}
		
		if(!isset($array_acciones[$accion])){
			throw new Exception("No se puede ejecutar la acci�n de $accion para {$this->motorBd}");
		}
		
		return $array_acciones[$accion];
	}
	
	/**
	 * Devuelve el nombre del motor de la base de datos
	 * @return string
	 * @access public
	 */
	
	public function getMotorBd()
	{
		return $this->motorBd;
	}
	
	/**
	 * Entrecomilla una cadena de caracteres para usarla en una consulta 
	 * @param string $string
	 * @access public
	 */
	
	public function quote($string)
	{
		return $this->pdoHandler->quote($string);
	}
	
	/**
	 * Destructor
	 * @access public
	 */
	
	public function __destruct()
	{
		//$this->pdoHandler = NULL;
	}
}
