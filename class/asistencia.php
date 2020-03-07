<?php
class asistencia {
    
    
    private $idAsistencia;
    private $fecha;
    private $horaEntrada;
    private $horaSalida;
    private $idEmpleado;
    
    
    
    function getIdAsistencia() {
        return $this->idAsistencia;
    }

    
    
    function getFecha() {
        return $this->fecha;
    }

    
    
    function getHoraEntrada() {
        return $this->horaEntrada;
    }

    
    
    function getHoraSalida() {
        return $this->horaSalida;
    }

    
    
    function getIdEmpleado() {
        return $this->idEmpleado;
    }

    
    
    function setIdAsistencia($idAsistencia) {
        $this->idAsistencia = $idAsistencia;
    }

    
    
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    
    
    function setHoraEntrada($horaEntrada) {
        $this->horaEntrada = $horaEntrada;
    }

    
    function setHoraSalida($horaSalida) {
        $this->horaSalida = $horaSalida;
    }

    
    function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
    }
    
    
    /**
     * Se registra la asistencia por empleado con un procedimiento de almacenado
     * en la base de datos.
     * @param $fechaN se ingresa la fecha que se registrara
     * @param $horaEntradaN recibe la hora de entrada
     * @param $horaSalidaN recibe la hora en que salio.
     * @param $idEmpleadoN Recibe en numero de empleado que va a registrarle la
     * asistencia
     */
    function reg_asistencia($fechaN,$horaEntradaN,$horaSalidaN,$idEmpleadoN){
        $pdo= new conexion();
        $query = $pdo->prepare("call reg_asistencia("
                . "'".$fechaN."',"
                . "'".$horaEntradaN."',"
                . "'".$horaSalidaN."',"
                .$idEmpleadoN.");");
        $query->execute();
    }
    
    
    /**
     * obtiene las horas del empleado
     * @param $idEmpleado recibe el id de un empleado
     * @param $fechaIni recibe una fecha de inicio para calcular las horas extra
     * @param $fechaFin recibe una fecha de fin para calcular las horas extra
     * @return regresa la cantidad de horas extras acumuladas por el empleado
     */
    function horasExtra($idEmpleado, $fechaIni, $fechaFin){
        $pdo = new conexion();
        $query = $pdo->prepare("SELECT SUM(horaExtra) FROM asistencia WHERE "
                . "idEmpleado=".$idEmpleado." AND Fecha BETWEEN '".$fechaIni.
                "' AND '".$fechaFin."';");
        $query->execute();
        $res = $query->fetchColumn();
        return $res;
    }
    
    
    /**
     * Metodo para realizar la paginacion de las asistencias
     * @param $pagina recibe el numero max de resultados que tendra por pagina
     * @param $link recibe a que pagina redireccionara
     */
    function asistenciaT($pagina, $link){
        $pdo = new conexion();
	$sql_registe = $pdo->prepare("SELECT COUNT(*) as total_registro FROM "
                . "asistencia;");
        $sql_registe->execute();
	$result_register = $sql_registe->fetchColumn();
	$por_pagina = 10;
	$desde = ($pagina-1) * $por_pagina;
	$total_paginas = ceil($result_register / $por_pagina);
        $query = $pdo ->prepare("SELECT a.idAsistencia, a.Fecha, a.HoraEntrada,"
                . "a.HoraSalida, e.nombre, e.apellidoPaterno, e.apellidoMaterno"
                . " FROM asistencia a join empleado e on a.idEmpleado = "
                . "e.idEmpleado ORDER BY a.Fecha DESC LIMIT ".$desde
                .",".$por_pagina.";");
        $query->execute();
	$res = $query->fetchAll();
        $cont=0;
        foreach ($res as $value) {
            $cont++;
            $idNom[$cont]=$value['idAsistencia'];
            $fecha[$cont]=$value['Fecha'];
            $fechaEnt[$cont]=$value['HoraEntrada'];
            $fechaSal[$cont]=$value['HoraSalida'];
            $nomEmp[$cont]=$value['nombre'];
            $nomEmpP[$cont]=$value['apellidoPaterno'];
            $nomEmpM[$cont]=$value['apellidoMaterno'];
        }
        $cuerpo="<tbody style='width: 100%;'>";
        for ($i = 1; $i <= $cont ;$i++) {
            $cuerpo.="<tr>";
            $cuerpo.="<td>".$fecha[$i]."</td>";
            $cuerpo.="<td>".$fechaEnt[$i]."</td>";
            $cuerpo.="<td>".$fechaSal[$i]."</td>";
            $cuerpo.="<td>".$nomEmpP[$i]." ".$nomEmpM[$i]
                    ." ".$nomEmp[$i]." "."</td>";
            $cuerpo.="<td><a href='".$link.
                    "/mod_asistencia.php?asis=".$idNom[$i].
                    "' class='btn btn-success btn-lg' "
                    . "name='modNom'><img src='"
                    . "$link/img/nav/icon38.png'> Editar</a>"
                    . "</td>";
            $cuerpo.="</tr>";
                                
        } return "</tbody>".$cuerpo;
    }
    
    /**
     * Realiza la consulta sobre las asistenicas
     * @param $idAsis recibe el numero para consultar sus datos correspondientes
     */
    function datosAsis($idAsis){
        $pdo = new conexion();
        $query = $pdo ->prepare("SELECT a.idAsistencia, a.Fecha, a.HoraEntrada,"
                . "a.HoraSalida, e.nombre, e.apellidoPaterno, e.apellidoMaterno "
                . "FROM asistencia a join empleado e on a.idEmpleado = "
                . "e.idEmpleado WHERE a.idAsistencia = $idAsis;");
        $query->execute();
        $res = $query->fetchAll();
        foreach ($res as $value) {
            $this->idAsistencia=$value['idAsistencia'];
            $this->fecha=$value['Fecha'];
            $this->horaEntrada=$value['HoraEntrada'];
            $this->horaSalida=$value['HoraSalida'];
            $this->idEmpleado=$value['apellidoPaterno']." ".
            $value['apellidoMaterno']." ".$value['nombre'];
        }
    }
    
    
    /**
     * Realiza la actualizacion de una asistencia mediante su numero.
     */
    function actDatos(){
        $pdo = new conexion();
        $query= $pdo->prepare("UPDATE asistencia SET"
                . " HoraEntrada = :HoraEntrada,"
                . " HoraSalida = :HoraSalida WHERE idAsistencia = "
                . ":idAsistencia;");
        $query->bindValue(":HoraEntrada", $this->horaEntrada);
        $query->bindValue(":HoraSalida", $this->horaSalida);
        $query->bindValue(":idAsistencia", $this->idAsistencia);
        $query->execute();
    }
}
