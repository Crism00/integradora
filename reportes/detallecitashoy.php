<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo.jpg">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../js/bootstrap.bundle.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Classic Cuts</title>
</head>
<?php

use barber\Query\Select;

require("../vendor/autoload.php");
session_start();
if ($_SESSION['tipo_cuenta'] == 'Administrador') {
    $query = new Select();

    $cadena = "SELECT cuenta.nombre, concat(cuenta.nombre,' ',cuenta.ap_paterno,' ',cuenta.ap_materno)as completo,
         cuenta.direccion,cuenta.telefono,cuenta.correo FROM cuenta where cuenta.nombre_usuario='XxMarcelaXX'";

    $tabla = $query->seleccionar($cadena);

    foreach ($tabla as $row) {
        $nombre = $row->nombre;
        $completo = $row->completo;
        $direccion = $row->direccion;
        $telefono = $row->telefono;
        $email = $row->correo;
    }
?>

    <body>
        <?php
        $fecha = date('Y-m-d');
        ?>
        <!--Seccion de Encabezado-->
        <header id="header">
            <div class="d-flex flex-column">
                <div class="profile">
                    <img src="../img/07d7a69e-0614-43d5-b6fe-294787c72b22.jfif" alt="" class="img-fluid rounded-circle mt-3">
                    <h1 class="text-light"><a href="#"></a></h1>
                    <div class="social-links mt-3 text-center">
                        <a href="https://www.facebook.com/profile.php?id=100063500375166" class="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/Classic.Cuts_Barberia/?fbclid=IwAR3gMkl_NnnES0o54LZS4fWnokOArjdW6ZnlnB3OPtGaO_Nc1Md9iKvevKE" class="Instagram"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <!--Menu de Navegacion-->
                <nav class="nav-menu" id="men">
                    <ul>
                        <li><a href="../views/vistaadmin.php"><i class="bi bi-house-door-fill"></i><span>citas</span></a></li>
                        <li><a href="../views/Usuario.php"><i class="bi bi-person-fill"></i><span>Usuarios</span></a></li>
                        <li><a href="../views/Servicios.php"><i class="bi bi-bookmarks-fill"></i><span>Servicios</span></a></li>
                        <li><a href="../views/verCat.php"><i class="bi bi-tags-fill"></i><span>Categoria</span></a></li>
                        <li><a href="../views/Sugerencias.php"><i class="bi bi-chat-left-fill"></i><span>Sugerencias</span></a></li>
                        <li><a href="../views/verPro.php"><i class="bi bi-bag-fill"></i></i><span>Productos</span></a></li>
                        <li><a href="../views/pedidos.php"><i class="bi bi-list-ul"></i><span>Pedidos</span></a></li>
                        <li><a href="../views/ventas.php"><i class="bi bi-currency-dollar"></i><span>ventas</span></a></li>
                        <li><a href="../views/registrar.php"><i class="bi bi-card-checklist"></i><span>Registrar Venta</span></a></li>
                        <li><a class="dropdown-item" href="../views/scripts/cerrarsesion.php">Cerrar Session</a></li>
                    </ul>
                </nav>
                <!--fine de menu de navegacion-->
                <div class="container mt-2 d-lg-none mobile-nav-toggle">

                    <div class="dropdown dropend">
                        <button type="button" class="btn  dropdown-toggle btn-outline-dark " data-bs-toggle="dropdown">
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../views/vistaadmin.php">citas</a></li>
                            <li><a class="dropdown-item " href="../views/Usuario.php">Usuarios</a></li><a class="dropdown-item " href="../views/Sugerencias.php">Sugerencias</a></li>
                            <li><a class="dropdown-item " href="../views/Servicios.php">Servicios</a></li>
                            <li><a class="dropdown-item " href="../views/verCat.php">Categoria</a></li>
                            <li><a class="dropdown-item" href="../views/verPro.php">Productos</a></li>
                            <li><a class="dropdown-item" href="../views/pedidos.php">Pedidos</a></li>
                            <li><a class="dropdown-item" href="../views/ventas.php">Ventas</a></li>
                            <li><a class="dropdown-item" href="../views/registrar.php">Registrar venta</a></li>
                            <li><a class="dropdown-item" href="scripts/cerrarsesion.php">Cerrar Session</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </header>
        <!--Fin de menu de navegacion-->
        <!--Hero Section-->
        <!--Tienda-->
        <br>
        <main id="main">

            <div class="container">
                <h1>Detalles de la cita</h1>
                <div class="row">
                    <?php
                    $id = $_GET['id'];
                    require "../vendor/autoload.php";
                    
                    $query = new select();
                    
                    $cadena = "SELECT CI.cliente,CI.fecha,CI.horario,CI.servicio,CI.des,Ci.iva,CI.subtotal,CI.total
            FROM
            (SELECT servicio_cita.dt_cita, CONCAT(cuenta.nombre,' ',cuenta.ap_paterno,' ',cuenta.ap_materno) 'cliente',
            citas.fecha 'fecha', horarios.horarios 'horario', servicios.nombre_servicio 'servicio',servicios.descripcion 'des',
            ((servicios.costo)*0.16) 'iva',
            ((servicios.costo)*1.16) 'total',
            servicios.costo 'subtotal'
            FROM cuenta
            INNER JOIN citas ON cuenta.nombre_usuario = citas.Usuario_C
            INNER JOIN horarios ON horarios.id_horario = citas.hora_cita
            INNER JOIN servicio_cita ON servicio_cita.dt_cita = citas.id_citas
            INNER JOIN servicios ON servicios.id_servicio = servicio_cita.servicio_sc
            WHERE servicio_cita.dt_cita = $id) as CI";
                    $tabla = $query->seleccionar($cadena);
                    ?>
                    <table class='table-hover table'>
                        <thead class='table-dark'>
                            <tr>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>horario</th>
                                <th>servicio</th>
                                <th>desripcion</th>
                                <th>iva</th>
                                <th>subtotal</th>
                                <th>total</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php
                            foreach ($tabla as $registro) {
                            ?>
                                <tr>
                                    <td><?php echo $registro->cliente ?></td>
                                    <td><?php echo $registro->fecha ?></td>
                                    <td><?php echo $registro->horario ?></td>
                                    <td><?php echo $registro->servicio ?></td>
                                    <td><?php echo $registro->des ?></td>
                                    <td><?php echo $registro->iva ?></td>
                                    <td><?php echo $registro->subtotal ?></td>
                                    <td><?php echo $registro->total ?></td>

                                </tr>
                            <?php
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>



        </main>
        <br>
    <?php
} else {
    echo "<h1>No se meta donde no le llaman perro</h1>";
  header("refresh:3;../views/scripts/cerrarsesion.php");
}

    ?>
    </body>

</html>