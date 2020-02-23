<?php
class puesto {
    
    
    private $idPuesto;
    private $nombrePuest;
    private $descripcion;
    private $salarioDia;
    
    
    function getIdPuesto() {
        return $this->idPuesto;
    }

    
    function getNombrePuest() {
        return $this->nombrePuest;
    }

    
    function getDescripcion() {
        return $this->descripcion;
    }

    
    function getSalarioDia() {
        return $this->salarioDia;
    }

    
    function setIdPuesto($idPuesto) {
        $this->idPuesto = $idPuesto;
    }

    
    function setNombrePuest($nombrePuest) {
        $this->nombrePuest = $nombrePuest;
    }

    
    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    
    function setSalarioDia($salarioDia) {
        $this->salarioDia = $salarioDia;
    }

    
    /**
     * Consulta los puestos disponibles para generar un select en html
     * @return regresa un select con los datos consultados.
     */
    function puestosDisp(){
        $pdo = new conexion();
        $query = $pdo ->prepare("SELECT * FROM puesto;");
        $query->execute();
        $res = $query->fetchAll();
        $cont = 0;
        foreach ($res as $value) {
            $cont++;
            $idTurno[$cont]=$value['idPuesto'];
            $nombreTurno[$cont]=$value['nombrePuest'];
        }
        $cuerpo='<select class="form-control" style="height: 35px;" id="areaEmp" name="areaEmp">';
        $cuerpo.='<option value="0" selected disabled>Secciona una...</option>';
        for ($i = 2; $i <= $cont; $i++) {
            $cuerpo.='<option value="'.$idTurno[$i].'" >'.$nombreTurno[$i].'</option>';
        }
        $cuerpo.='</select>';
        return $cuerpo;
    }
    
    
    /**
     * consulta los puestos disponibles para generar una tabla con paginacion
     * de los puestos disponibles 
     * @param $pagina recibe en numero de pagina para filtrar los datos
     * @param $link recibe la direccion para realizar acciones mediante un boton
     */
    function puestoT($pagina, $link){
        $pdo = new conexion();
	$sql_registe = $pdo->prepare("SELECT COUNT(*) as total_registro FROM puesto;");
        $sql_registe->execute();
	$result_register = $sql_registe->fetchColumn();
	$por_pagina = 10;
	$desde = ($pagina-1) * $por_pagina;
	$total_paginas = ceil($result_register / $por_pagina);
        $query = $pdo ->prepare("SELECT * FROM puesto;");
        $query->execute();
	$res = $query->fetchAll();
        $cont=0;
        foreach ($res as $value) {
            $cont++;
            $idP[$cont]=$value['idPuesto'];
            $nombreP[$cont]=$value['nombrePuest'];
            $descripcionP[$cont]=$value['descripcion'];
            $salario[$cont]=$value['salarioDia'];
        }
        $cuerpo="<tbody style='width: 100%;'>";
        for ($i = 2; $i <= $cont ;$i++) {
                                $cuerpo.="<tr>";
                                $cuerpo.="<td>".$nombreP[$i]."</td>";
                                $cuerpo.="<td>".$descripcionP[$i]."</td>";
                                $cuerpo.="<td><a href='".$link."/mod_salario.php?sal=".$idP[$i]."' class='btn btn-success btn-lg' name='modNom'><img src='$link/img/nav/icon38.png'> Editar</a></td>";
                                $cuerpo.="</tr>";
                                
                            }
        return "</tbody>".$cuerpo;
    }
    
    
    /**
     * metodo para consultar los datos por puesto
     * @param $idPuesto numero de puesto para buscar sus datos correspondientes
     */
    function puestoDatos($idPuesto){
        $pdo = new conexion();
        $query = $pdo->prepare("SELECT * FROM puesto WHERE idPuesto = $idPuesto;");
        $query->execute();
        $res = $query->fetchAll();
        
        foreach ($res as $value) {
            $this->idPuesto=$value['idPuesto'];
            $this->nombrePuest=$value['nombrePuest'];
            $this->descripcion=$value['descripcion'];
            $this->salarioDia=$value['salarioDia'];
        }
    }
    
    
    /**
     * actualizar los datos del puesto
     * @param $idPuesto numero de puesto
     * 
     */
    function actPuestoDatos($idPuesto){
        $pdo = new conexion();
        $query = $pdo->prepare("UPDATE puesto"
                . " SET nombrePuest = :nombrePuest, "
                . " descripcion = :descripcion, "
                . " salarioDia = :salarioDia WHERE idPuesto = :idPuesto; ");
        $query->bindValue(":nombrePuest", $this->nombrePuest);
        $query->bindValue(":descripcion", $this->descripcion);
        $query->bindValue(":salarioDia", $this->salarioDia);
        $query->bindValue(":idPuesto", $idPuesto);
        $query->execute();
        
    }
    
    /**
     * creacion de puestos
     */
    function crearPuesto(){
        $pdo = new conexion();
        $query = $pdo ->prepare("INSERT INTO `puesto` (`nombrePuest`, `descripcion`, `salarioDia`) VALUES ("
                . " '$this->nombrePuest', "
                . " '$this->descripcion',"
                . " $this->salarioDia);");
        $query->execute();
    }
}
