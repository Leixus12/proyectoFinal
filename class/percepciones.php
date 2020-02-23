<?php
class percepciones {
    
    
    private $idPercepciones;
    private $idNomina;
    private $sueldo;
    private $horaExtra;
    private $subsidio;
    private $montoPercepciones;
    
    
    function getIdPercepciones() {
        return $this->idPercepciones;
    }

    
    function getIdNomina() {
        return $this->idNomina;
    }

    
    function getSueldo() {
        return $this->sueldo;
    }

    
    function getHoraExtra() {
        return $this->horaExtra;
    }

    
    function getSubsidio() {
        return $this->subsidio;
    }

    
    function getMontoPercepciones() {
        return $this->montoPercepciones;
    }

    
    function setIdPercepciones($idPercepciones) {
        $this->idPercepciones = $idPercepciones;
    }

    
    function setIdNomina($idNomina) {
        $this->idNomina = $idNomina;
    }

    
    function setSueldo($sueldo) {
        $this->sueldo = $sueldo;
    }

    
    function setHoraExtra($horaExtra) {
        $this->horaExtra = $horaExtra;
    }

    
    function setSubsidio($subsidio) {
        $this->subsidio = $subsidio;
    }

    
    function setMontoPercepciones($montoPercepciones) {
        $this->montoPercepciones = $montoPercepciones;
    }

    /**
     * Consulta las perciciones por cada nomina mendiante su numero
     * @param $idNom numera de nomina
     */
    function datosPer($idNom){
        $pdo = new conexion();
        $query = $pdo->prepare("SELECT * FROM percepciones WHERE idNomina = '".$idNom."';");
        $query->execute();
        $res = $query->fetchAll();
        foreach ($res as $value) {
            $this->idPercepciones = $value['idPercepciones'];
            $this->idNomina = $value['idNomina'];
            $this->sueldo = $value['sueldo'];
            $this->horaExtra = $value['horaExtra'];
            $this->subsidio = $value['subsidio'];
            $this->montoPercepciones = $value['montoPercepciones'];
        }
    }
}
