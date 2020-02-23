<?php
class turno {
    
    
    private $idTurno;
    private $tipo;
    private $horaEntrada;
    private $horaSalida;
    
    
    function getIdTurno() {
        return $this->idTurno;
    }

    
    function getTipo() {
        return $this->tipo;
    }

    
    function getHoraEntrada() {
        return $this->horaEntrada;
    }

    
    function getHoraSalida() {
        return $this->horaSalida;
    }

    
    function setIdTurno($idTurno) {
        $this->idTurno = $idTurno;
    }

    
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    
    function setHoraEntrada($horaEntrada) {
        $this->horaEntrada = $horaEntrada;
    }

    
    function setHoraSalida($horaSalida) {
        $this->horaSalida = $horaSalida;
    }

     /**
     * consulta los turnos disponibles
     * @return regresa un select en html
     */
    function turnodisp(){
        $pdo = new conexion();
        $query = $pdo ->prepare("SELECT * FROM turno;");
        $query->execute();
        $res = $query->fetchAll();
        $cont = 0;
        foreach ($res as $value) {
            $cont++;
            $idTurno[$cont]=$value['idTurno'];
            $nombreTurno[$cont]=$value['tipo'];
        }
        
        $cuerpo='<select class="form-control" style="height: 35px;" id="turnoEmp" name="turnoEmp">';
        $cuerpo.='<option value="0" selected disabled>Secciona una...</option>';
        for ($i = 1; $i <= $cont; $i++) {
            $cuerpo.='<option value="'.$idTurno[$i].'" >'.$nombreTurno[$i].'</option>';
        }
        $cuerpo.='</select>';
        return $cuerpo;
    }
}
