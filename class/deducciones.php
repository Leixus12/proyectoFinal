<?php
class deducciones {
    
    
    private $idDeducciones;
    private $idNomina;
    private $NSS;
    private $ISTP;
    private $montoDeducciones;
    
    
    function getIdDeducciones() {
        return $this->idDeducciones;
    }
    

    function getIdNomina() {
        return $this->idNomina;
    }
    

    function getNSS() {
        return $this->NSS;
    }
    

    function getISTP() {
        return $this->ISTP;
    }
    

    function getMontoDeducciones() {
        return $this->montoDeducciones;
    }
    

    function setIdDeducciones($idDeducciones) {
        $this->idDeducciones = $idDeducciones;
    }
    

    function setIdNomina($idNomina) {
        $this->idNomina = $idNomina;
    }
    

    function setNSS($NSS) {
        $this->NSS = $NSS;
    }

    
    function setISTP($ISTP) {
        $this->ISTP = $ISTP;
    }

    
    function setMontoDeducciones($montoDeducciones) {
        $this->montoDeducciones = $montoDeducciones;
    }
    
    /**
     * consulta los datos de la base de datos para actualizar la clase con los
     * datos correspondientes a las deducciones
     * @param $idNom ingresa el numero de la nomina para consultar
     */
    function datosDec($idNom){
        $pdo = new conexion();
        $query = $pdo->prepare("SELECT * FROM deducciones WHERE idNomina = '".
                $idNom."';");
        $query->execute();
        $res = $query->fetchAll();
        foreach ($res as $value) {
            $this->idDeducciones = $value['idDeducciones'];
            $this->idNomina = $value['idNomina'];
            $this->NSS = $value['NSS'];
            $this->ISTP = $value['ISTP'];
            $this->montoDeducciones = $value['montoDeducciones'];
        }
    }
}
