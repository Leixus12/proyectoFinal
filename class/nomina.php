<?php
  class nomina {
      
      
    private $idNomina;
    private $fechaInicial;
    private $fechaFinal;
    private $periodo;
    private $diasTrabajados;
    private $pagoTotal;
    private $idEmpleado;
    
    
    function getIdNomina() {
        return $this->idNomina;
    }

    
    function getFechaInicial() {
        return $this->fechaInicial;
    }

    
    function getFechaFinal() {
        return $this->fechaFinal;
    }

    
    function getPeriodo() {
        return $this->periodo;
    }

    
    function getDiasTrabajados() {
        return $this->diasTrabajados;
    }

    
    function getPagoTotal() {
        return $this->pagoTotal;
    }

    
    function getIdEmpleado() {
        return $this->idEmpleado;
    }

    
    function setIdNomina($idNomina) {
        $this->idNomina = $idNomina;
    }

    
    function setFechaInicial($fechaInicial) {
        $this->fechaInicial = $fechaInicial;
    }

    
    function setFechaFinal($fechaFinal) {
        $this->fechaFinal = $fechaFinal;
    }

    
    function setPeriodo($periodo) {
        $this->periodo = $periodo;
    }

    
    function setDiasTrabajados($diasTrabajados) {
        $this->diasTrabajados = $diasTrabajados;
    }

    
    function setPagoTotal($pagoTotal) {
        $this->pagoTotal = $pagoTotal;
    }

    
    function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
    }

    
    function crearNom($id, $fechaIni, $fechaFin, $idEmpleado){
        $pdo = new conexion();
        $query = $pdo->prepare("call generar_nom ('".$id."', '".$fechaIni
                . "', '".$fechaFin."', ".$idEmpleado.");");
        $query->execute();
    }
    
    
    function datosNomina($idNomina){
        $pdo = new conexion();
        $query = $pdo->prepare("SELECT * FROM nomina WHERE idNomina = '"
                .$idNomina."';");
        $query->execute();
        $res = $query->fetchAll();
        foreach ($res as $value) {
            $this->idNomina = $value['idNomina'];
            $this->fechaInicial = $value['fechaInicial'];
            $this->fechaFinal = $value['fechaFinal'];
            $this->periodo = $value['periodo'];
            $this->diasTrabajados = $value['DiasTrabajados'];
            $this->pagoTotal = $value['pagoTotal'];
            $this->idEmpleado = $value['idEmpleado'];
        }
    }
    
    
    function nominaE($idEmpleado, $pagina, $link){
        $pdo = new conexion();
	$sql_registe = $pdo->prepare("SELECT COUNT(*) as total_registro FROM"
                       . " nomina;");
        $sql_registe->execute();
	$result_register = $sql_registe->fetchColumn();
	$por_pagina = 10;
	$desde = ($pagina-1) * $por_pagina;
	$total_paginas = ceil($result_register / $por_pagina);
        $query = $pdo ->prepare("SELECT idNomina, fechaInicial, fechaFinal, "
                 . "periodo, DiasTrabajados FROM nomina WHERE idEmpleado =" . 
                 $idEmpleado." ORDER BY periodo ASC LIMIT " . $desde . "," . 
                 $por_pagina.";");
        $query->execute();
	$res = $query->fetchAll();
        $cont=0;
        foreach ($res as $value) {
            $cont++;
            $idNom[$cont]=$value['idNomina'];
            $fechaIni[$cont]=$value['fechaInicial'];
            $fechaFin[$cont]=$value['fechaFinal'];
            $perido[$cont]=$value['periodo'];
            $diasTrab[$cont]=$value['DiasTrabajados'];
        }
        $cuerpo="<tbody style='width: 100%;'>";
        for ($i = 1; $i <= $cont ;$i++) {
            $cuerpo.= "<tr>";
            $cuerpo.= "<td>".$idNom[$i]."</td>";
            $cuerpo.= "<td>".$fechaIni[$i]."</td>";
            $cuerpo.= "<td>".$fechaFin[$i]."</td>";
            $cuerpo.= "<td>".$perido[$i]."</td>";
            $cuerpo.= "<td>".$diasTrab[$i]."</td>";
            $cuerpo.= "<td><a target='_blank' href='".$link.
                      "/ver_nomina.php?nom=".$idNom[$i].
                      "' class='btn btn-success btn-lg'>"
                      . "Ver</a></td>";
            $cuerpo.="</tr>";
        }return "</tbody>".$cuerpo;
    }
    
    
    function nominaT($pagina, $link){
        
        $pdo = new conexion();
	$sql_registe = $pdo->prepare("SELECT COUNT(*) as total_registro FROM nomina;");
        $sql_registe->execute();
	$result_register = $sql_registe->fetchColumn();
	$por_pagina = 10;
	$desde = ($pagina-1) * $por_pagina;
	$total_paginas = ceil($result_register / $por_pagina);
        $query = $pdo ->prepare("SELECT idNomina, fechaInicial, fechaFinal, periodo, DiasTrabajados, idEmpleado FROM nomina ORDER BY periodo ASC LIMIT ".$desde.",".$por_pagina.";");
        $query->execute();
	$res = $query->fetchAll();
        $cont=0;
        
        foreach ($res as $value) {
            $cont++;
            $idNom[$cont]=$value['idNomina'];
            $fechaIni[$cont]=$value['fechaInicial'];
            $fechaFin[$cont]=$value['fechaFinal'];
            $perido[$cont]=$value['periodo'];
            $diasTrab[$cont]=$value['DiasTrabajados'];
            $idEmp[$cont]=$value['idEmpleado'];
        }
        
        for ($i = 1; $i <= $cont; $i++) {
            $query2 = $pdo ->prepare("SELECT nombre, apellidoPaterno, apellidoMaterno FROM Empleado WHERE idEmpleado = $idEmp[$i];");
            $query2->execute();
            $resT[$i]=$query2->fetchAll();
            
            foreach ($resT[$i] as $value) {
                $nombreCompleto[$i]=$value['apellidoPaterno']." ".$value['apellidoMaterno']." ".$value['nombre'];
            }
        }
        
        $cuerpo="<tbody style='width: 100%;'>";
        for ($i = 1; $i <= $cont ;$i++) {
            $cuerpo.="<tr>";
            $cuerpo.="<td>".$idNom[$i]."</td>";
            $cuerpo.="<td>".$fechaIni[$i]."</td>";
            $cuerpo.="<td>".$fechaFin[$i]."</td>";
            $cuerpo.="<td>".$perido[$i]."</td>";
            $cuerpo.="<td>".$diasTrab[$i]."</td>";
            $cuerpo.="<td>".$nombreCompleto[$i]."</td>";
            $cuerpo.="<td><a target='_blank' href='".$link.
                    "/ver_nomina.php?nom=".$idNom[$i].
                    "' class='btn btn-success btn-lg' name='verNom'> <img src='"
                    . "$link/img/nav/icon40.png'> Ver</a></td>";
            $cuerpo.="</tr>";
        } return "</tbody>".$cuerpo;
    }
}