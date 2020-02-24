<?php
class vacaciones {
    
    
    private $idVacaciones;
    private $FechaIni;
    private $FechaFin;
    private $cantidad;
    private $Estado;
    private $idEmpleado;
    
    
    function getIdVacaciones() {
        return $this->idVacaciones;
    }

    
    function getFechaIni() {
        return $this->FechaIni;
    }

    
    function getFechaFin() {
        return $this->FechaFin;
    }

    
    function getCantidad() {
        return $this->cantidad;
    }

    
    function getEstado() {
        return $this->Estado;
    }

    
    function getIdEmpleado() {
        return $this->idEmpleado;
    }

    
    function setIdVacaciones($idVacaciones) {
        $this->idVacaciones = $idVacaciones;
    }

    
    function setFechaIni($FechaIni) {
        $this->FechaIni = $FechaIni;
    }

    
    function setFechaFin($FechaFin) {
        $this->FechaFin = $FechaFin;
    }

    
    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    
    function setEstado($Estado) {
        $this->Estado = $Estado;
    }

    
    function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
    }
    
    /**
     * Crear una nueva solicitud de vacaciones por empleado
     * @param $idEmpleado numero de empleado al cual realiza la solicitud
     */
    function solicita($idEmpleado){
        $pdo = new conexion();
        $query = $pdo ->prepare("INSERT INTO vacaciones (FechaInicial, "
                 . "FechaFinal, cantidad, Estado, idEmpleado) VALUES ("
                 . " '".$this->FechaIni."',"
                 . " '".$this->FechaFin."',"
                 . " '".$this->cantidad."',"
                 . " '".$this->Estado."',"
                 . " '".$idEmpleado."');");
        $query ->execute();
    }
    
    /**
     * consulta las solicitudes realizadas por el empleado
     * @param $idEmpleado numero del empleado
     */
    function solicitudes ($idEmpleado){
        $pdo = new conexion();
        $query = $pdo->prepare("SELECT * FROM vacaciones where Estado "
                 . "= '1' and idEmpleado = ".$idEmpleado.";");
        $query->execute();
        $res = $query->fetchAll();
        $cont = 0;
        $resultado="";
        $cuerpo="";
        if($res){
            foreach ($res as $value) {
            $cont++;
            $fechaIni [$cont] = $value['FechaInicial'];
            $fechaFin [$cont] = $value['FechaFinal'];
            $cantidad [$cont] = $value['cantidad'];
            $estado [$cont] = $value['Estado'];
        }
        for ($i = 1; $i <= $cont; $i++) {
            $cuerpo .= "<tr>";
            $cuerpo .= "<td>".$fechaIni[$i]."</td>";
            $cuerpo .= "<td>".$fechaFin[$i]."</td>";
            $cuerpo .= "<td class='proceso'>PROCESO</td>";
            $cuerpo .= "</tr>";
            $resultado=$cuerpo;
        }
        return $resultado;
        }else{
            $resultado = "<div class='cancelada text-center'>"
                         . "No tienes solicitudes</div>";
        }return $resultado;
        
    }
    
    /**
     * Consulta las solicitudes aprovadas para el empleado
     * @param $idEmpleado numero del empleado para filtrar sus solicitudes
     * @return regresa una tabla en html con los datos correspondientes a al 
     * numero de empleado
     */
    function solicitudAprobada ($idEmpleado){
        $pdo = new conexion();
        $query = $pdo->prepare("SELECT * FROM vacaciones where idEmpleado = "
                 . "$idEmpleado and Estado = '2' or Estado = '3';");
        $query->execute();
        $res = $query->fetchAll();
        $cont = 0;
        $resultado = "";
        $cuerpo = "";
        foreach ($res as $value) {
            $cont++;
            $fechaIni[$cont] = $value['FechaInicial'];
            $fechaFin[$cont] = $value['FechaFinal'];
            $cantidad[$cont] = $value['cantidad'];
            $estado[$cont] = $value['Estado'];
        }
        for ($i = 1; $i <= $cont; $i++) {
            $cuerpo.="<tr>";
            $cuerpo.="<td>".$fechaIni[$i]."</td>";
            $cuerpo.="<td>".$fechaFin[$i]."</td>";
            if($estado[$i] == 2){
                $cuerpo.="<td class='aprovada'>APROBADA</td>";
            }elseif($estado[$i]==3){
               $cuerpo.="<td class='cancelada'>RECHAZADA</td>";
            }
            $cuerpo.="</tr>";
            $resultado=$cuerpo;
            if($estado[$i] == 2 || $estado[$i] == 3){
                $resultado=$cuerpo;
            }else{
                $resultado="";
            }
        }
        return $resultado;
    }
    
    
    /**
     * Consulta los dias de vacacionales del empleado mediante la fecha de 
     * ingreso
     * @param $idEmpleado numero de empleado para consultar sus vacaciones
     * @param $diasVacaciones  numero de dias de la solicitud
     * @return regresa el numero de dias disponibles
     */
    function diasP($idEmpleado, $diasVacaciones){
        $pdo = new conexion();
        $query = $pdo->prepare("SELECT SUM(cantidad) 'Total' FROM vacaciones "
                 . "WHERE idEmpleado=".$idEmpleado." AND Estado = '2';");
        $query->execute();
        $con = $query->fetchColumn();
        $resultado=0;
        if($con){
            $resultado = $diasVacaciones - $con;
            return $resultado;
        }else{
            $resultado=$diasVacaciones;
        }return $resultado;
        
    }
    
    
    /**
     * Consulta de las vacaciones solicitadas en el sistema mediante una tabla 
     * en html.
     * @param $pagina numero de pagina para aplicar un limit y consultar una 
     * cierta cantidad de datos.
     * @param $link redirreción de enlace a donde se modificar la solicitud.
     * @return codigo html con los datos limitados por pagina.
     */
    function vacacionesT($pagina, $link){
        $pdo = new conexion();
	$sql_registe = $pdo->prepare("SELECT COUNT(*) as total_registro "
                       . "FROM vacaciones;");
        $sql_registe->execute();
	$result_register = $sql_registe->fetchColumn();
	$por_pagina = 10;
	$desde = ($pagina-1) * $por_pagina;
	$total_paginas = ceil($result_register / $por_pagina);
        $query = $pdo ->prepare("SELECT v.idVacation, v.FechaInicial, "
                 . "v.FechaFinal, v.Estado, e.nombre, e.apellidoPaterno, "
                 . "e.apellidoMaterno FROM vacaciones v join empleado e on "
                 . "v.idEmpleado = e.idEmpleado ORDER BY v.idVacation DESC "
                 . "LIMIT ".$desde.",".$por_pagina.";");
        $query->execute();
	$res = $query->fetchAll();
        $cont = 0;
        
        foreach ($res as $value) {
            $cont++;
            $idNom[$cont] = $value['idVacation'];
            $fechaIni[$cont] = $value['FechaInicial'];
            $fechaFin[$cont] = $value['FechaFinal'];
            $estado[$cont] = $value['Estado'];
            $nomEmp[$cont] = $value['nombre'];
            $nomEmpP[$cont] = $value['apellidoPaterno'];
            $nomEmpM[$cont] = $value['apellidoMaterno'];
        }
        $cuerpo = "";
        for ($i = 1; $i <= $cont ;$i++) {
            $cuerpo .= "<tr>";
            $cuerpo .= "<td>".$fechaIni[$i]."</td>";
            $cuerpo .= "<td>".$fechaFin[$i]."</td>";
            if( $estado[$i] == 1){
                $cuerpo .= "<td class='proceso'>PROCESO</td>";
            }elseif($estado[$i] == 2){
                $cuerpo .= "<td class='aprovada'>APROBADA</td>";
            }elseif($estado[$i] == 3){
                $cuerpo .= "<td class='cancelada'>CANCELADA</td>";
            }
            $cuerpo .= "<td>".$nomEmpP[$i]." ".$nomEmpM[$i]." ".$nomEmp[$i].
                       " "."</td>";
            $cuerpo .= "<td><a href='".$link."/mod_vacaciones.php?nom="
                       .$idNom[$i]."' class='btn btn-success btn-lg' name="
                       . "'modNom'><img src='$link/img/nav/icon38.png'> "
                       . "Editar</a></td>";
            $cuerpo .= "</tr>";
        }return "</tbody>".$cuerpo;
    }
    
    
    /**
     * Consulta de los datos de las vacaciones
     * @param $idVacaciones numero de solicitud para consultar sus datos
     */
    function datosVac($idVacaciones){
        $pdo = new conexion();
        $query = $pdo->prepare("SELECT v.idVacation, v.FechaInicial, "
                 . "v.FechaFinal, v.cantidad, v.Estado, e.nombre, "
                 . "e.apellidoPaterno, e.apellidoMaterno FROM vacaciones v "
                 . "join empleado e on e.idEmpleado = v.idEmpleado WHERE "
                 . "idVacation = $idVacaciones;");
        $query ->execute();
        $res = $query->fetchAll();
        foreach ($res as $value) {
            $this->idVacaciones=$value['idVacation'];
            $this->FechaIni = $value['FechaInicial'];
            $this->FechaFin = $value['FechaFinal'];
            $this->cantidad = $value['cantidad'];
            $this->Estado = $value['Estado'];
            $this->idEmpleado = $value['apellidoPaterno']." ".
                                $value['apellidoMaterno']." ".$value['nombre'];
        }
        
    }
    
    
    /**
     * Actualizar la solicitud de las vacaciones para modificar el estado de la 
     * misma
     */
    function actVac(){
        $pdo= new conexion();
        $query = $pdo ->prepare("UPDATE vacaciones"
                . " SET FechaInicial = :FechaInicial,"
                . " FechaFinal = :FechaFinal,"
                . " Estado = :Estado WHERE idVacation = :idVacation;");
        $query->bindValue(":FechaInicial", $this->FechaIni);
        $query->bindValue(":FechaFinal", $this->FechaFin);
        $query->bindValue(":Estado", $this->Estado);
        $query->bindValue(":idVacation", $this->idVacaciones);
        $query->execute();
        
    }
    
}
