 <?php

class empleado {
    
    
    private $idEmpleado;
    private $nombre;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $nombreUsuario;
    private $password;
    private $email;
    private $direccion;
    private $telefono;
    private $fechaIngreso;
    private $fechaNacimiento;
    private $nss;
    private $rfc;
    private $curp;
    private $foto;
    private $idSucursal;
    private $idTurno;
    private $idPuesto;
    private  $nomPuesto;
    private  $nomSucursal;
    private $direccionSucursal;
    private  $nomTurno;
    private  $nomDepartamento;
    private  $sd;
    private  $idImss;
    private $idDepart;
            
    
    function getIdEmpleado() {
        return $this->idEmpleado;
    }

    
    function getNombre() {
        return $this->nombre;
    }

    
    function getApellidoPaterno() {
        return $this->apellidoPaterno;
    }

    
    function getApellidoMaterno() {
        return $this->apellidoMaterno;
    }

    
    function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    
    function getPassword() {
        return $this->password;
    }

    
    function getEmail() {
        return $this->email;
    }

    
    function getDireccion() {
        return $this->direccion;
    }

    
    function getTelefono() {
        return $this->telefono;
    }

    
    function getFechaIngreso() {
        return $this->fechaIngreso;
    }

    
    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    
    function getNss() {
        return $this->nss;
    }

    
    function getRfc() {
        return $this->rfc;
    }

    
    function getCurp() {
        return $this->curp;
    }

    
    function getFoto() {
        return $this->foto;
    }

    
    function getIdSucursal() {
        return $this->idSucursal;
    }

    
    function getIdTurno() {
        return $this->idTurno;
    }

    
    function getIdPuesto() {
        return $this->idPuesto;
    }

    
    function getNomPuesto() {
        return $this->nomPuesto;
    }

    
    function getNomSucursal() {
        return $this->nomSucursal;
    }

    
    function getDireccionSucursal() {
        return $this->direccionSucursal;
    }

    
    function getNomTurno() {
        return $this->nomTurno;
    }

    
    function getNomDepartamento() {
        return $this->nomDepartamento;
    }

    
    function getSd() {
        return $this->sd;
    }

    
    function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
    }

    
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    
    function setApellidoPaterno($apellidoPaterno) {
        $this->apellidoPaterno = $apellidoPaterno;
    }

    
    function setApellidoMaterno($apellidoMaterno) {
        $this->apellidoMaterno = $apellidoMaterno;
    }

    
    function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    
    function setPassword($password) {
        $this->password = $password;
    }

    
    function setEmail($email) {
        $this->email = $email;
    }

    
    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    
    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    
    function setFechaIngreso($fechaIngreso) {
        $this->fechaIngreso = $fechaIngreso;
    }

    
    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    
    function setNss($nss) {
        $this->nss = $nss;
    }

    
    function setRfc($rfc) {
        $this->rfc = $rfc;
    }

    
    function setCurp($curp) {
        $this->curp = $curp;
    }

    
    function setFoto($foto) {
        $this->foto = $foto;
    }

    
    function setIdSucursal($idSucursal) {
        $this->idSucursal = $idSucursal;
    }

    
    function setIdTurno($idTurno) {
        $this->idTurno = $idTurno;
    }

    
    function setIdPuesto($idPuesto) {
        $this->idPuesto = $idPuesto;
    }

    
    function setNomPuesto($nomPuesto) {
        $this->nomPuesto = $nomPuesto;
    }

    
    function setNomSucursal($nomSucursal) {
        $this->nomSucursal = $nomSucursal;
    }

    
    function setDireccionSucursal($direccionSucursal) {
        $this->direccionSucursal = $direccionSucursal;
    }

    
    function setNomTurno($nomTurno) {
        $this->nomTurno = $nomTurno;
    }

    
    function setNomDepartamento($nomDepartamento) {
        $this->nomDepartamento = $nomDepartamento;
    }

    
    function setSd($sd) {
        $this->sd = $sd;
    }
    
    
    function getIdImss() {
        return $this->idImss;
    }

    
    function setIdImss($idImss) {
        $this->idImss = $idImss;
    }
    
    
    function getIdDepart() {
        return $this->idDepart;
    }

    
    function setIdDepart($idDepart) {
        $this->idDepart = $idDepart;
    }
    
    
    function altaUsuario(){
        $pdo = new conexion();
        $query = $pdo->prepare("INSERT INTO `empleado` (`nombre`, 
            `apellidoPaterno`, `apellidoMaterno`, `nombreUsuario`, `password`, 
            `email`, `direccion`, `telefono`, `fechaNacimiento`, `fechaIngreso`,
            `nss`, `rfc`, `curp`, `idSucursal`, `idTurno`, `idPuesto`, `idImss`)
            VALUES 
            ('$this->nombre',
            '$this->apellidoPaterno',
            '$this->apellidoMaterno',
            '$this->nombreUsuario',
            '$this->password',
            '$this->email',
            '$this->direccion',
            '".$this->telefono."',
            '".$this->fechaNacimiento."',
            '".$this->fechaIngreso."',
            '".$this->nss."',
            '".$this->curp."',
            '".$this->rfc."',
            ".$this->idSucursal.",
            ".$this->idTurno.",
            ".$this->idPuesto.",
            ".$this->idImss.");");
            $query->execute();
    }
    
    
    function consultaDatos ($idEmpleado){
        $pdo = new conexion();
        $query = $pdo->prepare("SELECT * FROM empleado where idEmpleado =".
                $idEmpleado.";");
        $query->execute();
        $res = $query->fetchAll();
        
        foreach ($res as $value) {
            $this->nombre = $value['nombre'];
            $this->apellidoPaterno=$value['apellidoPaterno'];
            $this->apellidoMaterno=$value['apellidoMaterno'];
            $this->nombreUsuario=$value['nombreUsuario'];
            $this->password=$value['password'];
            $this->direccion=$value['direccion'];
            $this->email=$value['email'];
            $this->telefono=$value['telefono'];
            $this->fechaNacimiento=$value['fechaNacimiento'];
            $this->fechaIngreso=$value['fechaIngreso'];
            $this->nss=$value['nss'];
            $this->rfc=$value['rfc'];
            $this->curp=$value['curp'];
            $this->foto=$value['foto'];
            $this->idSucursal=$value['idSucursal'];
            $this->idTurno=$value['idTurno'];
            $this->idPuesto=$value['idPuesto'];
        }
        
    }
    
    
    function DatosLabores($idEmpleado){
        $pdo = new conexion();
        $query = $pdo->prepare("select s.nomSucursal, s.direccionSucursal from "
                . "sucursal s join empleado e on s.idSucursal = e.idSucursal "
                . "where e.idEmpleado = ".$idEmpleado.";");
        $query->execute();
        $res = $query->fetchAll();
        foreach ($res as $value) {
            $this->nomSucursal=$value['nomSucursal'];
            $this->direccionSucursal=$value['direccionSucursal'];
        }
        $query2 = $pdo->prepare("select t.tipo from turno t join empleado e on "
                ."t.idTurno = e.idTurno where e.idEmpleado = ".$idEmpleado.";");
        $query2->execute();
        $res2 = $query2->fetchAll();
        foreach ($res2 as $value) {
            $this->nomTurno=$value['tipo'];
        }
        $query3 = $pdo->prepare("select p.nombrePuest, p.salarioDia from puesto"
                ."p join empleado e on p.idPuesto = e.idPuesto where e.idEmplea"
                . "do = ".$idEmpleado.";");
        $query3->execute();
        $res3 = $query3->fetchAll();
        foreach ($res3 as $value) {
            $this->nomPuesto=$value['nombrePuest'];
            $this->sd=$value['salarioDia'];
        }
        $query4 = $pdo->prepare("select d.nomDepart from departamento d join "
               . "empleadodepartamento ed on ed.idDepart = d.idDepart join "
               . "empleado e on e.idEmpleado = ed.idEmpleado where e.idEmpleado"
               . " = ".$idEmpleado.";");
        $query4->execute();
        $res4 = $query4->fetchAll();
        foreach ($res4 as $value) {
            $this->nomDepartamento=$value['nomDepart'];
        }
        
    }
    
    
    function actDatos($idEmpleado){
        $pdo= new conexion();
        $query = $pdo->prepare("Update empleado"
                ." SET email = :email,"
                ." direccion = :direccion,"
                ." telefono = :telefono where idEmpleado = :idEmpleado;");
        $query->bindValue(":email", $this->email);
        $query->bindValue(":direccion", $this->direccion);
        $query->bindValue(":telefono", $this->telefono);
        $query->bindValue(":idEmpleado", $idEmpleado);
        $query->execute();
        
    }
    
    
    function empleadoT($pagina, $link){
        $pdo = new conexion();
	$sql_registe = $pdo->prepare("SELECT COUNT(*) as total_registro FROM "
                . "empleado;");
        $sql_registe->execute();
	$result_register = $sql_registe->fetchColumn();
	$por_pagina = 10;
	$desde = ($pagina-1) * $por_pagina;
	$total_paginas = ceil($result_register / $por_pagina);
        $query = $pdo ->prepare("SELECT idEmpleado, nombre, apellidoPaterno, "
                . "apellidoMaterno, nombreUsuario, idPuesto FROM empleado WHERE"
                . " activoUsuario = '1' ORDER BY idEmpleado ASC LIMIT ".$desde
                .",".$por_pagina.";");
        $query->execute();
	$res = $query->fetchAll();
        $cont=0;
        
        foreach ($res as $value) {
            $cont++;
            $idEmp[$cont]=$value['idEmpleado'];
            $nombreEmp[$cont]=$value['nombre'];
            $apellidoPa[$cont]=$value['apellidoPaterno'];
            $apellidoMa[$cont]=$value['apellidoMaterno'];
            $usuario[$cont]=$value['nombreUsuario'];
            $puesto[$cont]=$value['idPuesto'];
        }
        
        for ($i = 1; $i <= $cont; $i++) {
            $query2 = $pdo ->prepare("SELECT nombrePuest FROM PUESTO WHERE "
                    . "idPuesto = $puesto[$i];");
            $query2->execute();
            $resT[$i]=$query2->fetchColumn();
        }
        
        $cuerpo="<tbody style='width: 100%;'>";
        for ($i = 1; $i <= $cont ;$i++) {
        $nombreCompleto[$i] = $apellidoPa[$i]." ".$apellidoMa[$i]." ".
                              $nombreEmp[$i];
                              $cuerpo.="<tr>";
                              $cuerpo.="<td>".$nombreCompleto[$i]."</td>";
                              $cuerpo.="<td>".$usuario[$i]."</td>";
                              $cuerpo.="<td>".$resT[$i]."</td>";
                              $cuerpo.="<td><a href='".$link."/mod_usuario.php?"
                                     . "user=".$idEmp[$i]."' class='btn btn-"
                                     . "success btn-lg' name='modNom'>"
                                     . "<img src='$link/img/nav/icon38.png'>"
                                      . " Editar</a></td>";
                              $cuerpo.="<td><a target='_blank' href='".$link.
                                      "/drop_user.php?user=".$idEmp[$i].
                                      "' class='btn btn-danger btn-lg' "
                                      . "name='dropNom'><img src='"
                                      . "$link/img/nav/icon39.png'> Borrar</a>"
                                      . "</a></td>";
                              $cuerpo.="</tr>";
                                
                            }
        return "</tbody>".$cuerpo;
    }
}
