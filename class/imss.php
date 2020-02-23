<?php
class imss {
    
    
    private $idImss;
    private $clase;
    private $porcentajeE;
    private $porcentajeP;
    
    
    function getIdImss() {
        return $this->idImss;
    }

    
    function getClase() {
        return $this->clase;
    }

    
    function getPorcentajeE() {
        return $this->porcentajeE;
    }

    
    function getPorcentajeP() {
        return $this->porcentajeP;
    }

    
    function setIdImss($idImss) {
        $this->idImss = $idImss;
    }

    
    function setClase($clase) {
        $this->clase = $clase;
    }

    
    function setPorcentajeE($porcentajeE) {
        $this->porcentajeE = $porcentajeE;
    }

    
    function setPorcentajeP($porcentajeP) {
        $this->porcentajeP = $porcentajeP;
    }
    
    
    /**
     * Metodo para seleccionar los tipos de clase disponibles en el imss 
     * @return regresa un select con las clases dispobibles en codigo html
     */
    function imssDisp(){
        $pdo = new conexion();
        $query = $pdo ->prepare("SELECT * FROM imssclass;");
        $query->execute();
        $res = $query->fetchAll();
        $cont = 0;
        foreach ($res as $value) {
            $cont++;
            $idTurno[$cont]=$value['idImss'];
            $nombreTurno[$cont]=$value['clase'];
        }
        
        $cuerpo='<select class="form-control" style="height: 35px;" id="iDimss"'
                . 'name="claseImss">';
        $cuerpo.='<option value="0" selected disabled>Secciona una...</option>';
        for ($i = 1; $i <= $cont; $i++) {
            $cuerpo.='<option value="'.$idTurno[$i].'" >'.$nombreTurno[$i].
                     '</option>';
        }
        $cuerpo.='</select>';
        return $cuerpo;
    }
}
