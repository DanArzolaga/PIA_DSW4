<?php
if (empty($_SESSION['active'])) {
    header('Location: ../');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Inicio</title>
    <link href="../assets/css/material-dashboard.css" rel="stylesheet" />
    <link href="../assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/js/jquery-ui/jquery-ui.min.css">
    <script src="../assets/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper ">
        <div class="sidebar" style="background: white;">
            <div class="logo bg-primary"><a href="./" class="simple-text logo-normal" style="color: white;">
                    El Buen Sazón Mexicano
                </a></div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="usuarios.php">
                            <i class="fas fa-user mr-2 fa-2x"></i>
                            <p> Usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="categorias.php">
                            <i class=" fas fa-tags mr-2 fa-2x"></i>
                            <p> Categoria</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="menu.php">
                            <i class="fas fa-pepper-hot mr-2 fa-2x"></i>
                            <p> Menú</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="mesas.php">
                            <i class=" fas fa-chair mr-2 fa-2x"></i>
                            <p> Mesas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="nuevaComanda.php">
                            <i class="fas fa-plus mr-2 fa-2x"></i>
                            <p> Nueva Comanda</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="comandas.php">
                            <i class="fas fa-concierge-bell mr-2 fa-2x"></i>
                            <p> Comandas</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top" >
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand" href="javascript:;">Sistema de Comandas</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">

                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user"></i>
                                    <p class="d-lg-none d-md-block">
                                        Cuenta
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#nuevo_pass">Perfil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="salir.php">Cerrar Sesión</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content bg">
                <div class="container-fluid">