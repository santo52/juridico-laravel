 <?php

    try{
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
        $dotenv->load();
    } catch(Exception $e) {}

    $dsn = 'mysql:dbname=' . env('DB_DATABASE') .';host=' . env('DB_HOST');
    $usuario = env('DB_USERNAME');
    $contraseña = env('DB_PASSWORD');

    DEFINE('dsn',$dsn);
    DEFINE('USER',$usuario);
    DEFINE('CONTRASENA',$contraseña);

    class DataBase{
        private $dsn=dsn;
        private $user=USER;
        private $pass=CONTRASENA;
        private $bd;
        private $consulta;
        public function __construct(){

            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            try{
                $this->bd = new PDO($this->dsn, $this->user, $this->pass,$opciones);
				$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
                exit;
            }

        }

        public function query($query){
            $this->consulta = $this->bd->prepare($query);
            return $this;
        }

        public function execute() {
            return $this->consulta->execute();
        }

        public function resultset(){
            $this->consulta->execute();
            return $registro = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        public function single(){
            $this->consulta->execute();
            return $registro = $this->consulta->fetch(PDO::FETCH_ASSOC);
        }

        public function lastInsertId(){
            return $this->bd->lastInsertId();
        }

        public function rowCount(){
            $this->consulta->execute();
        	return $this->consulta->rowCount();
        }
    }
?>
