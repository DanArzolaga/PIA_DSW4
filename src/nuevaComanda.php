<?php
session_start();
require("../conexion.php");
$id_user = $_SESSION['idUser'];
$permiso = "nuevaComanda";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header('Location: permisos.php');
}
include_once "includes/header.php";
?>
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
            <div class="form-group">
            <h3 class="text-center">Nueva Comanda</h3>
        </div>
                <form method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" id="idmesa" value="1" name="idmesa" required>
                                <label>Descripción</label>
                                <input type="text" name="des_mesa" id="des_mesa" class="form-control" placeholder="Ingrese la mesa" required>
                            </div>
                        </div>
                    </div>
                </form>

        <div class="card">
            <div class="card-header bg-primary text-black text-center">
                <h4 class="text-center" style="color: #fff;">Platillos</h4> 
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="des_menu">Descripción</label>
                            <input id="des_menu" class="form-control" type="text" name="des_menu" placeholder="Ingrese el platillo">
                            <input id="id" type="hidden" name="id">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input id="cantidad" class="form-control" type="text" name="cantidad" placeholder="Cantidad" onkeyup="calcularPrecio(event)">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input id="precio" class="form-control" type="text" name="precio" placeholder="precio" disabled>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="sub_total">Sub Total</label>
                            <input id="sub_total" class="form-control" type="text" name="sub_total" placeholder="Sub Total" disabled>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="tblDetalle">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Precio Total</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody id="comanda_detalle">

                </tbody>
                <tfoot>
                    <tr class="font-weight-bold">
                        <td>Total Pagar</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <div class="col-md-6">
        <a href="#" class="btn btn-primary" id="btn_generar"><i class="fas fa-save"></i> Generar Comanda</a>
    </div>
</div>
</div>
        </div>
<?php include_once "includes/footer.php"; ?>