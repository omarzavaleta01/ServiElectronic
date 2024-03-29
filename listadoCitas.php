<?php
session_start();
error_reporting(0);

date("H:i:s");

$varsesion = $_SESSION['correo'];
if ($varsesion == null || $varsesion = '') {
    header("location:inicioSesion.php");
    die();
}
?>

<?php
include("conexion.php");
$conn = conectar();

$sql = "SELECT * FROM citas where status = 1";
$query = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Citas</title>
    <link rel="stylesheet" href="resources/bootstrap-4.6.1-dist/bootstrap-4.6.1-dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="resources/dataTables/DataTables-1.12.1/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="resources/estylos-css/fontawesome/css/all.css">
    <link rel="stylesheet" href="resources/estylos-css/general.css">
    <link rel="stylesheet" href="resources/estylos-css/menuBurger.css">
    <link rel="stylesheet" href="resources/estylos-css/extras.css">
    <script src="https://use.fontawesome.com/d1da709de7.js"></script>
</head>

<header class="col-md-12 cabeza">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">

                    <a class="nav-link">Bienvenido: <?= $_SESSION["correo"] ?><span class="sr-only"></span></a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="seguridad.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="col-sm-4 logo">
        <img class="rounded-circle" alt="100x100" src="resources/img/logo1.jpg">
    </div>
</header>

<body>



    <div class="container lateral-menu col-md-12">

        <nav class="nav">
            <ul class="nav-menu">
                <li class="nav-menu-item">
                    <i class="fas fa-home fa-2x"></i>
                    <a href="index.php" class="nav-menu-link nav-link">Inicio</a>
                </li>
                <li class="nav-menu-item">
                    <i class="fas fa-calendar-alt fa-2x"></i>
                    <a href="listadoCitas.php" class="nav-menu-link nav-link">Citas</a>
                </li>
                <li class="nav-menu-item">
                    <a href="listadoTecnicos.php" class="nav-menu-link nav-link">Tecnicos</a>
                    <i class="fa-solid fa-gear fa-2x"></i>
                </li>
                <li class="nav-menu-item">
                    <a href="listadoUsuarios.php" class="nav-menu-link nav-link">Usuarios</a>
                    <i class="fa-solid fa-users fa-2x"></i>
                </li>
                <li class="nav-menu-item ultimo">
                    <a href="listadoServicios.php" class="nav-menu-link nav-link">Servicios</a>
                    <i class="fa fa-wrench fa-2x" aria-hidden="true"></i>
                </li>
                <li class="nav-menu-item ultimo">
                    <a href="listadoDispositivos.php" class="nav-menu-link nav-link">Dispositivos</a>
                    <i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
                </li>
            </ul>
        </nav>
        <div class="bars__menu">
            <i class="fa-solid fa-bars fa-3x"></i>
        </div>
    </div>
    <div class="container2 cuerpoCard col-md-12 justify-content-center">
        <div class="titulo ">
            <h1 class="tabs">
                Citas
            </h1>
        </div>
        <div class="input-group busquda col-sm-12">
            <div id="search-autocomplete" class="form-outline">
                <input type="search" id="form1" class="form-control input filtrado" placeholder="Buscar registro" />
                <p class="titBusca">Buscar registro</p>
            </div>
            <button type="button" class="btn btn-primary icoBusca rounded-circle" data-title="Buscar regirsto" onclick="desplega()">
                <i class="fas fa-search fa-1x ico" onclick="desplega1()"></i>
            </button>
        </div>
        <div class="tabla col-md-12">
            <table id="example" class="table table-striped table-bordered ">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id Cita</th>
                        <th scope="col">Descripcion del problema</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>

                        <th scope="col" id="centrarLetras">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <?php while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <th><?php echo $row['idCita'] ?></th>
                        <th><?php echo $row['problemaDescripcion'] ?></th>
                        <th><?php echo $row['fechaCita'] ?></th>
                        <th><?php echo $row['horaCita'] ?></th>

                        <!-- <td class="ab" id="centrarLetras"><i class="fa fa-trash fa-2x"data-toggle="modal"  data-target="#exampleModalCenter" data-title="Eliminar cita"></i></td> -->

                        <!--  -->

                        <th><a type="button" href="back/borradoLogicoC.php?id=<?php echo $row['idCita'] ?>" class="btn btn-danger" title="Eliminar campus" onclick="return confirm(fntDelPersona())">Eliminar</button></th>

                        <!-- <th><a href="back/borradoLogicoC.php?id=<?php echo $row['idCita'] ?>" class="btn btn-danger" title="Eliminar campus" onclick="return confirm('¿Se encuentra seguro de eliminar el registro')">Eliminar</a></th> -->

                    </tr>
                <?php
                        }
                ?>




                </tr>
                </tbody>
            </table>
            <!-- <div class="agregar">
            <i class="fa fa-plus-circle fa-3x" aria-hidden="true" data-title="Agregar cita"  onclick="location.href='agregarCita.html';"></i>
        </div> -->
        </div>
    </div>


    <div class="col-sm-12 footerr bg-dark text-white justify-content-center">
        <footer class="abajo">
            <p>
                &copy; 2022 Company ServiElectronic, Inc
            </p>

        </footer>
    </div>

</body>


<!-- ************************************************************************************************************************-->
<!-- POPUP-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Actualizar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body">
                ¿Seguro de Eliminar este registro?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="can" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" a href="back/borradoLogicoC.php?id=<?php echo $row['idCita'] ?>" onclick="location.href='back/borradoLogicoC.php';">Aceptar</button>
            </div> -->
        </div>
    </div>
</div>
<!-- POPUP-->
<!-- ************************************************************************************************************************-->


<!-- Bootstrap -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="resources/bootstrap-4.6.1-dist/bootstrap-4.6.1-dist/js/bootstrap.min.js" js/bootstrap.min.js integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

<!-- Bootstrap -->

<!-- Data tables-->
<script type="text/javascript" src="resources/dataTables/datatables.min.js"></script>
<script type="text/javascript" src="resources/dataTables/DataTables-1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="resources/dataTables/DataTables-1.12.1/js/dataTables.bootstrap4.js"></script>
<!-- Data tables-->


<!-- Custom JS-->
<script src="resources/js/animaciones.js"></script>
<script src="resources/js/paginadoTabs.js"></script>
<script src="resources/js/filtradoTabs.js"></script>
<!-- Custom JS-->

</html>