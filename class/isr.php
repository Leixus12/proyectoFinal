<?php
class isr {
    
    
    private $idIsr;
    private $monto;
    private $montoPorcentaje;
    
    
    function getIdIsr() {
        return $this->idIsr;
    }

    
    function getMonto() {
        return $this->monto;
    }

    
    function getMontoPorcentaje() {
        return $this->montoPorcentaje;
    }

    
    function setIdIsr($idIsr) {
        $this->idIsr = $idIsr;
    }

    
    function setMonto($monto) {
        $this->monto = $monto;
    }

    
    function setMontoPorcentaje($montoPorcentaje) {
        $this->montoPorcentaje = $montoPorcentaje;
    }

    
    /**
     * Filtrar cantidad de datos por tabla.
     * @param $pagina cantidad de datos que va consultar sobre la base de datos
     * para asi poder hacer la paginacion en la tabla.
     * @param $link enlace a donde mandara para realizar acciones sobre el dato
     * consultado.
     * @return regresa el codigo de la tabla en html con los datos previos de la
     * base de datos
     */
    function isrT($pagina, $link){
        $pdo = new conexion();
	$sql_registe = $pdo->prepare("SELECT COUNT(*) as total_registro FROM "
                       . "isr;");
        $sql_registe->execute();
	$result_register = $sql_registe->fetchColumn();
	$por_pagina = 10;
	$desde = ($pagina-1) * $por_pagina;
	$total_paginas = ceil($result_register / $por_pagina);
        $query = $pdo ->prepare("SELECT * FROM isr;");
        $query->execute();
	$res = $query->fetchAll();
        $cont=0;
        foreach ($res as $value) {
            $cont++;
            $idP[$cont] = $value['idISR'];
            $nombreP[$cont] = $value['monto'];
            $descripcionP[$cont] = $value['montoPorcentaje'];
        }
        $cuerpo="<tbody style='width: 100%;'>";
        for ($i = 1; $i <= $cont ;$i++) {
            $cuerpo.= "<tr>";
            $cuerpo.= "<td>".$idP[$i]."</td>";
            $cuerpo.= "<td>"."% ".$descripcionP[$i]."</td>";
            $cuerpo.= "<td><a href='" . $link
                      . "/mod_isr.php?id="
                      . $idP[$i]."' class='btn btn-success "
                      . "btn-lg' name='modNom'><img src='"
                      . "$link/img/nav/icon38.png'> Editar"
                      . "</a></td>";
            $cuerpo.= "</tr>";
        } return "</tbody>".$cuerpo;
    }
    
    
    /**
     * Consulta los datos de la tabla isr y los almacena mediante objetos para 
     * cuando se genera la nomina hacer las deducciones correspodientes mediante
     * el salario base.
     */
    function datosIsr($idIsr){
        $pdo = new conexion();
        $query = $pdo ->prepare("SELECT * FROM isr WHERE idISR = $idIsr;");
        $query->execute();
        $res = $query->fetchAll();
        
        foreach ($res as $value) {
            $this->idIsr=$value['idISR'];
            $this->monto=$value['monto'];
            $this->montoPorcentaje=$value['montoPorcentaje'];
        }
    }
    
    
    /**
     * Metodo para actualizar los porcentajes de descuento en base a la cantidad
     * que proporciona el sat
     */
    function actISR($idIsr){
        $pdo = new conexion();
        $query = $pdo ->prepare("UPDATE isr "
                . " SET monto = :monto,"
                . " montoPorcentaje = :montoPorcentaje WHERE idISR = :idISR;");
        $query->bindValue(":monto", $this->monto);
        $query->bindValue(":montoPorcentaje", $this->montoPorcentaje);
        $query->bindValue(":idISR", $idIsr);
        $query->execute();
        
    }
}
