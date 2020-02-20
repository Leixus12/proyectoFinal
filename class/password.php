<?php
  class password {
    private $idPass;
    private $codigo;
    private $tiempoCreacion;
    private $tiempoExpiracion;
    private $estado;
    private $idEmpleado;
    
    
    function getIdPass() {
        return $this->idPass;
    }

    
    function getCodigo() {
        return $this->codigo;
    }

    
    function getTiempoCreacion() {
        return $this->tiempoCreacion;
    }

    
    function getTiempoExpiracion() {
        return $this->tiempoExpiracion;
    }

    
    function getEstado() {
        return $this->estado;
    }

    
    function getIdEmpleado() {
        return $this->idEmpleado;
    }

    
    function setIdPass($idPass) {
        $this->idPass = $idPass;
    }

    
    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    
    function setTiempoCreacion($tiempoCreacion) {
        $this->tiempoCreacion = $tiempoCreacion;
    }

    
    function setTiempoExpiracion($tiempoExpiracion) {
        $this->tiempoExpiracion = $tiempoExpiracion;
    }

    
    function setEstado($estado) {
        $this->estado = $estado;
    }

    
    function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
    }
    
    
    function inserCode(){
        $pdo = new conexion();
        $query = $pdo->prepare("INSERT INTO password (codigo, timeNew, timeEnd, "
                . "estado, idEmpleado) VALUES ("
                ."'".$this->codigo."', "
                ."'".$this->tiempoCreacion."', "
                ."'".$this->tiempoExpiracion."', "
                ."'".$this->estado."', "
                .$this->idEmpleado."); ");
        $query->execute();
    }
}
