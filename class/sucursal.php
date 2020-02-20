<?php
class sucursal {
    
    
    private $idSuc;
    private $nomSuc;
    private $direcSuc;
    
    
    function getIdSuc() {
        return $this->idSuc;
    }

    
    function getNomSuc() {
        return $this->nomSuc;
    }

    
    function getDirecSuc() {
        return $this->direcSuc;
    }

    
    function setIdSuc($idSuc) {
        $this->idSuc = $idSuc;
    }

    
    function setNomSuc($nomSuc) {
        $this->nomSuc = $nomSuc;
    }

    
    function setDirecSuc($direcSuc) {
        $this->direcSuc = $direcSuc;
    }

    
    function sucDisp(){
        $pdo = new conexion();
        $query = $pdo ->prepare("SELECT * FROM sucursal;");
        $query->execute();
        $res = $query->fetchAll();
        $cont = 0;
        foreach ($res as $value) {
            $cont++;
            $idTurno[$cont]=$value['idSucursal'];
            $nombreTurno[$cont]=$value['nomSucursal'];
        }
        
        $cuerpo='<select class="form-control" style="height: 35px;" id="sucEmp" name="sucEmp">';
        $cuerpo.='<option value="0" selected disabled>Secciona una...</option>';
        for ($i = 1; $i <= $cont; $i++) {
            $cuerpo.='<option value="'.$idTurno[$i].'" >'.$nombreTurno[$i].'</option>';
        }
        $cuerpo.='</select>';
        return $cuerpo;
    }
    
}
