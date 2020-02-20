<?php
class departamento {
    
    
    private $nombreDepart;
    private $descDepart;
    private $gerente;
    
    
    function getNombreDepart() {
        return $this->nombreDepart;
    }

    
    function getDescDepart() {
        return $this->descDepart;
    }

    
    function getGerente() {
        return $this->gerente;
    }

    
    function setNombreDepart($nombreDepart) {
        $this->nombreDepart = $nombreDepart;
    }

    
    function setDescDepart($descDepart) {
        $this->descDepart = $descDepart;
    }

    
    function setGerente($gerente) {
        $this->gerente = $gerente;
    }
    
    
    function departDisp(){
        $pdo = new conexion();
        $query = $pdo ->prepare("SELECT * FROM departamento;");
        $query->execute();
        $res = $query->fetchAll();
        $cont = 0;
        foreach ($res as $value) {
            $cont++;
            $idTurno[$cont]=$value['idDepart'];
            $nombreTurno[$cont]=$value['nomDepart'];
        }
        
        $cuerpo='<select class="form-control" style="height: 35px;" '
                . 'id="idDepart" name="idDepart">';
        $cuerpo.='<option value="0" selected disabled>Secciona una...</option>';
        for ($i = 1; $i <= $cont; $i++) {
            $cuerpo.='<option value="'.$idTurno[$i].'" >'.$nombreTurno[$i].
                    '</option>';
        }
        $cuerpo.='</select>';
        return $cuerpo;
    }
}
