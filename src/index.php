<?php
require "../conexion.php";
$usuarios = mysqli_query($conexion, "SELECT * FROM usuario");
$total['usuarios'] = mysqli_num_rows($usuarios);
$ventas = mysqli_query($conexion, "SELECT SUM(total) AS Ventas FROM comanda");
while ($data = mysqli_fetch_array($ventas)){
  $total['ventas'] = "$". $data['Ventas'];
  
}
$menu = mysqli_query($conexion, "SELECT * FROM menu");
$total['menu'] = mysqli_num_rows($menu);
$comandas = mysqli_query($conexion, "SELECT * FROM comanda WHERE fecha > CURDATE()");
$total['comandas'] = mysqli_num_rows($comandas);
session_start();
include_once "includes/header.php";
?>
<!-- Content Row -->
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-user fa-2x"></i>
                </div>
                <a href="usuarios.php" class="card-category text-warning font-weight-bold">
                    Usuarios
                </a>
                <h3 class="card-title"><?php echo $total['usuarios']; ?></h3>
            </div>
            <div class="card-footer bg-warning text-white">
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-dollar-sign fa-2x"></i>
                </div>
                <a href="mesas.php" class="card-category text-success font-weight-bold">
                    Ventas
                </a>
                <h3 class="card-title"><?php echo $total['ventas']; ?></h3>
            </div>
            <div class="card-footer bg-secondary text-white" style="background: linear-gradient(60deg, #66bb6a, #43a047);">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-pepper-hot fa-2x"></i>
                </div>
                <a href="menu.php" class="card-category text-danger font-weight-bold">
                    Platillos
                </a>
                <h3 class="card-title"><?php echo $total['menu']; ?></h3>
            </div>
            <div class="card-footer bg-danger">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-concierge-bell fa-2x"></i>
                </div>
                <a href="comandas.php" class="card-category text-info font-weight-bold">
                    Comandas
                </a>
                <h3 class="card-title"><?php echo $total['comandas']; ?></h3>
            </div>
            <div class="card-footer bg-info text-white">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header card-header-primary">
                <h3 class="title-2 m-b-40">Comandas por Usuario</h3>
            </div>
            <div class="card-body">
                <canvas id="comandasUsuario"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header card-header-primary">
                <h3 class="title-2 m-b-40">Platillos más vendidos</h3>
            </div>
            <div class="card-body">
                <canvas id="PlatillosVendidos"></canvas>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>