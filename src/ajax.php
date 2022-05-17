<?php
require_once "../conexion.php";
session_start();
if (isset($_GET['q'])) {
    $datos = array();
    $descrip = $_GET['q'];
    $mesa = mysqli_query($conexion, "SELECT * FROM mesa WHERE Descrip LIKE '%$descrip%'");
    while ($row = mysqli_fetch_assoc($mesa)) {
        $data['id'] = $row['IdMesa'];
        $data['label'] = $row['Descrip'];
        array_push($datos, $data);
    }
    echo json_encode($datos);
    die();
}else if (isset($_GET['pro'])) {
    $datos = array();
    $nombre = $_GET['pro'];
    $hoy = date('Y-m-d');
    $producto = mysqli_query($conexion, "SELECT * FROM menu WHERE descripcion LIKE '%" . $nombre . "%'");
    while ($row = mysqli_fetch_assoc($producto)) {
        $data['id'] = $row['IdMenu'];
        $data['label'] = $row['IdMenu'] . ' - ' .$row['descripcion'];
        $data['value'] = $row['descripcion'];
        $data['precio'] = $row['precio'];
        array_push($datos, $data);
    }
    echo json_encode($datos);
    die();
}else if (isset($_GET['detalle'])) {
    $id = $_SESSION['idUser'];
    $datos = array();
    $detalle = mysqli_query($conexion, "SELECT d.*, m.IdMenu, m.descripcion FROM detalle_temp d INNER JOIN menu m ON d.id_menu = m.IdMenu WHERE d.id_usuario = $id");
    while ($row = mysqli_fetch_assoc($detalle)) {
        $data['id'] = $row['id'];
        $data['descripcion'] = $row['descripcion'];
        $data['cantidad'] = $row['cantidad'];
        $data['precio_venta'] = $row['precio_venta'];
        $data['sub_total'] = $row['total'];
        array_push($datos, $data);
    }
    echo json_encode($datos);
    die();
} else if (isset($_GET['delete_detalle'])) {
    $id_detalle = $_GET['id'];
    $query = mysqli_query($conexion, "DELETE FROM detalle_temp WHERE id = $id_detalle");
    if ($query) {
        $msg = "ok";
    } else {
        $msg = "Error";
    }
    echo $msg;
    die();
} else if (isset($_GET['procesarVenta'])) {
    $id_mesa = $_GET['id'];
    $id_user = $_SESSION['idUser'];
    $consulta = mysqli_query($conexion, "SELECT total, SUM(total) AS total_pagar FROM detalle_temp WHERE id_usuario = $id_user");
    $result = mysqli_fetch_assoc($consulta);
    $total = $result['total_pagar'];
    $insertar = mysqli_query($conexion, "INSERT INTO comanda(id_mesa, total, id_usuario) VALUES ($id_mesa, '$total', $id_user)");
    if ($insertar) {
        $id_maximo = mysqli_query($conexion, "SELECT MAX(id) AS total FROM comanda");
        $resultId = mysqli_fetch_assoc($id_maximo);
        $ultimoId = $resultId['total'];
        $consultaDetalle = mysqli_query($conexion, "SELECT * FROM detalle_temp WHERE id_usuario = $id_user");
        while ($row = mysqli_fetch_assoc($consultaDetalle)) {
            $id_menu = $row['id_menu'];
            $cantidad = $row['cantidad'];
            $precio = $row['precio_venta'];
            $total = $row['total'];
            $insertarDet = mysqli_query($conexion, "INSERT INTO comanda_detalle (id_menu, id_comanda, cantidad, precio, total) VALUES ($id_menu, $ultimoId, $cantidad, '$precio', '$total')");
        } 
        if ($insertarDet) {
            $eliminar = mysqli_query($conexion, "DELETE FROM detalle_temp WHERE id_usuario = $id_user");
            $msg = array('id_mesa' => $id_mesa, 'id_comanda' => $ultimoId);
        } 
    }else{
        $msg = array('mensaje' => 'error');
    }
    echo json_encode($msg);
    die();
}else if(isset($_GET['editarMesa'])){
    $idMesa = $_GET['id'];
    $sql = mysqli_query($conexion, "SELECT * FROM mesa WHERE IdMesa = $idMesa");
    $data = mysqli_fetch_array($sql);
    echo json_encode($data);
    exit;
} else if (isset($_GET['editarUsuario'])) {
    $idusuario = $_GET['id'];
    $sql = mysqli_query($conexion, "SELECT * FROM usuario WHERE idusuario = $idusuario");
    $data = mysqli_fetch_array($sql);
    echo json_encode($data);
    exit;
} else if (isset($_GET['editarMenu'])) {
    $idMenu = $_GET['id'];
    $sql = mysqli_query($conexion, "SELECT * FROM menu WHERE IdMenu = $idMenu");
    $data = mysqli_fetch_array($sql);
    echo json_encode($data);
    exit;
} else if (isset($_GET['editarCategoria'])) {
    $idCategoria = $_GET['id'];
    $sql = mysqli_query($conexion, "SELECT * FROM categoria WHERE IdCategoria = $idCategoria");
    $data = mysqli_fetch_array($sql);
    echo json_encode($data);
    exit;
}
if (isset($_POST['regDetalle'])) {
    $id = $_POST['id'];
    $cant = $_POST['cant'];
    $precio = $_POST['precio'];
    $id_user = $_SESSION['idUser'];
    $total = $precio * $cant;
    $verificar = mysqli_query($conexion, "SELECT * FROM detalle_temp WHERE id_menu = $id AND id_usuario = $id_user");
    $result = mysqli_num_rows($verificar);
    $datos = mysqli_fetch_assoc($verificar);
    if ($result > 0) {
        $cantidad = $datos['cantidad'] + $cant;
        $total_precio = ($cantidad * $total);
        $query = mysqli_query($conexion, "UPDATE detalle_temp SET cantidad = $cantidad, total = '$total_precio' WHERE id_menu = $id AND id_usuario = $id_user");
        if ($query) {
            $msg = "actualizado";
        } else {
            $msg = "Error al ingresar";
        }
    }else{
        $query = mysqli_query($conexion, "INSERT INTO detalle_temp(id_usuario, id_menu, cantidad ,precio_venta, total) VALUES ($id_user, $id, $cant,'$precio', '$total')");
        if ($query) {
            $msg = "registrado";
        }else{
            $msg = "Error al ingresar";
        }
    }
    echo json_encode($msg);
    die();
}else if (isset($_POST['cambio'])) {
    if (empty($_POST['actual']) || empty($_POST['nueva'])) {
        $msg = 'Los campos estan vacios';
    } else {
        $id = $_SESSION['idUser'];
        $actual = md5($_POST['actual']);
        $nueva = md5($_POST['nueva']);
        $consulta = mysqli_query($conexion, "SELECT * FROM usuario WHERE clave = '$actual' AND idusuario = $id");
        $result = mysqli_num_rows($consulta);
        if ($result == 1) {
            $query = mysqli_query($conexion, "UPDATE usuario SET clave = '$nueva' WHERE idusuario = $id");
            if ($query) {
                $msg = 'ok';
            }else{
                $msg = 'error';
            }
        } else {
            $msg = 'dif'; 
        }
        
    }
    echo $msg;
    die();
    
}

