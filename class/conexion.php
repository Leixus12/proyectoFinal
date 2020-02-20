<?php
//Manera 1era
class conexion extends PDO{
    
    
    private $tipoBase = 'mysql';
    private $host = 'localhost';
    private $database = 'clinica';
    private $user = 'root';
    private $password = '';
    private $puerto='3308';
    
    
    public function __construct() {
        try {
            parent::__construct($this->tipoBase.':host='.$this->host.';port='.
                   $this->puerto.';dbname='.$this->database, $this->user, 
                   $this->password, 
                   array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
         
        } catch (Exception $exc) {
           echo 'Error al conectarse con la base de datos: '.$exc->getMessage();
           exit;
        }
    }
}

?>
