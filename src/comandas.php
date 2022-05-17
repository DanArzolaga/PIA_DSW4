<?php
session_start();
require_once "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "Comandas";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header('Location: permisos.php');
}
$query = mysqli_query($conexion, "SELECT c.*, m.IdMesa, m.Descrip as mesa, u.idusuario, u.nombre as usuario FROM comanda c INNER JOIN mesa m ON c.id_mesa = m.IdMesa INNER JOIN usuario u ON c.id_usuario = u.idusuario");
include_once "includes/header.php";
?>
<div class="card">
    <div class="card-header">
        Comandas
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-light" id="tbl">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Mesa</th>
                        <th>Usuario</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['mesa']; ?></td>
                            <td><?php echo $row['usuario']; ?></td>
                            <td><?php echo '$'.$row['total']; ?></td>
                            <td><?php echo $row['fecha']; ?></td>
                            <td>
                            <a href="pdf/generar.php?cl=<?php echo $row['idusuario'] ?>&v=<?php echo $row['id'] ?>" target="_blank" class="btn btn-danger"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>