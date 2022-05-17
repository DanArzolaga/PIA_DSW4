<?php
include("../conexion.php");
if ($_POST['action'] == 'sales') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT u.idusuario, u.nombre, COUNT(c.id_usuario) as Comandas FROM usuario u INNER JOIN comanda c WHERE u.idusuario = c.id_usuario group by c.id_usuario ORDER BY 3 DESC;");
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}
if ($_POST['action'] == 'polarChart') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT m.IdMenu, m.descripcion, d.id_menu, d.cantidad, SUM(d.cantidad) as total FROM menu m INNER JOIN comanda_detalle d WHERE m.IdMenu = d.id_menu group by d.id_menu ORDER BY d.cantidad DESC LIMIT 5");
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}
//
?>
