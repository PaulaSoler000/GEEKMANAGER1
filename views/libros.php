<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: ../index.php');
}

require_once('../controllers/database.php');
$user_id = $_SESSION['user_id'];

$buscar = '';
if ($_SESSION['id_pag_act'] === 8) {
    $buscar = $_SESSION['buscador'];
}

$filt_tag = '';
if ($_SESSION['id_pag_act'] === 9) {
    $filt_tag = $_SESSION['tags'];
}

$_SESSION['id_pag_act'] = 2;
$db = new Database();
$conexion = $db->connect();


$registros_por_pagina = 9; /* CON ESTA VARIABLE INDICAREMOS EL NUMERO DE REGISTROS QUE QUEREMOS POR PAGINA*/
$estoy_en_pagina = 1;/* CON ESTA VARIABLE INDICAREMOS la pagina en la que estamos*/

if (isset($_GET["pagina"])) {
    $estoy_en_pagina = $_GET["pagina"];
}

$empezar_desde = ($estoy_en_pagina - 1) * $registros_por_pagina;


$sql_total = "SELECT * FROM inventario WHERE tipo_objeto='libro'";
/* CON LIMIT 0,3 HACE LA SELECCION DE LOS 3 REGISTROS QUE HAY EMPEZANDO DESDE EL REGISTRO 0*/
$sql = $conexion->prepare($sql_total);
$sql->execute(array());

$num_filas = $sql->rowCount(); /* nos dice el numero de registros del reusulset*/
$total_paginas = ceil($num_filas / $registros_por_pagina);

$sql_filt = "SELECT * FROM inventario WHERE id_usuario = ?  AND tipo_objeto = ? AND tags LIKE ? ORDER BY id_objeto DESC LIMIT ?, ?";
$sql_no_filt = "SELECT * FROM inventario WHERE id_usuario = ?  AND tipo_objeto = ? ORDER BY id_objeto DESC LIMIT ?, ?";
$sql_buscar = "SELECT * FROM inventario WHERE id_usuario = ? AND tipo_objeto = ? AND (nombre_objeto LIKE ? OR tags LIKE ?) ORDER BY id_objeto DESC LIMIT ?, ?";


if (!empty($buscar)) {
    $sql = $conexion->prepare($sql_buscar);
    $filtro = "%{$buscar}%";
    $sql->execute([$user_id, "libro", $filtro, $filtro, $empezar_desde, $registros_por_pagina]);
} else {
    if (!is_null($filt_tag)) {
        $sql = $conexion->prepare($sql_filt);
        $filtro = "%{$filt_tag}%";
        $sql->execute([$user_id, "libro", $filtro, $empezar_desde, $registros_por_pagina]);
    } else {
        $sql = $conexion->prepare($sql_no_filt);
        $sql->execute([$user_id, "libro", $empezar_desde, $registros_por_pagina]);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../img/logo_transparente.png">
    <!-- CSS-->
    <link rel="stylesheet" href="../css/style.css">
    <!-- iconos fontawesome-->
    <script src="https://kit.fontawesome.com/4a0af06348.js" crossorigin="anonymous"></script>
    <title>Libros</title>
</head>

<body>

    <nav>
        <div class="logo">
            <a href="inicio.php">
                <img src="../img/logo_con_nombre.png">
            </a>
        </div>
        <div class="hamburger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <ul class="nav-links">
            <li class="centro"><a href="inicio.php">Inicio</a></li>
            <li class="centro active"><a href="libros.php">Libros</a></li>
            <li class="centro"><a href="mangas.php">Mangas</a></li>
            <li class="centro"><a href="videojuegos.php">Videojuegos</a></li>
            <li class="centro"><a href="figuras.php">Figuras</a></li>

        </ul>

        <div class="session">
            <div>¡Hola <?= $_SESSION['user_usuario'] ?>!</div>
            <a href="../controllers/logout.php">Salir</a>
        </div>
    </nav>

    <form action="../controllers/buscador.php" method="GET">
        <div class="centrar_buscar">
            <input type="text" id="texto" value="" name="texto">
            <button type="submit" name="submit">Buscar</button>
        </div>
    </form>

    <!--elementos-->

    <div class="wrapper">

        <div class="contenedor">


            <?php

            while ($datos = $sql->fetchObject()) { ?>


                <div class="elemento">
                    <div>
                        <a href="info.php?id_objeto=<?= $datos->id_objeto ?>"> <img id="foto_objeto" src="<?= $datos->foto ?>" alt=""></a>
                    </div>
                    <p><?= $datos->nombre_objeto ?></p>



                    <div class="etiquetas">
                        <?php

                        foreach (explode(',', $datos->tags) as $tag) {
                            if ($tag != "") {
                        ?>
                                <a href="../controllers/encontar_tag.php?type=tags&valor=<?= $tag ?>" class="badge"><?= $tag ?></a>
                        <?php }
                        }
                        ?>
                    </div>

                    <div class="editar">
                        <div class="icono">
                            <a href="../controllers/eliminar.php?id_objeto=<?= $datos->id_objeto ?>"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                        <div class="icono">
                            <a href="formulario_editar.php?id_objeto=<?= $datos->id_objeto ?>'"><i class="fa-solid fa-pencil"></i></a>
                        </div>
                        <div class="icono">
                            <a href="info.php?id_objeto=<?= $datos->id_objeto ?>"><i class="fa-solid fa-circle-info"></i></a>
                        </div>
                        <div class="icono">
                            <a onclick="copyToClipboard('https://localhost/GEEKMANAGER1/views/compartir.php?variable=<?= $datos->id_objeto ?>')"><i class="fa-sharp fa-solid fa-share-nodes"></i></a>
                        </div>


                        <script>
                            function copyToClipboard(text) {
                                navigator.clipboard.writeText(text)
                                    .then(() => {
                                        alert('Enlace copiado al portapapeles');
                                    })
                                    .catch((error) => {
                                        console.error('Error al copiar el enlace:', error);
                                    });
                            }
                        </script>

                    </div>

                </div>

            <?php }
            ?>

        </div>

    </div>



    <!--eliminar-->

    <section class="modal3 ">
        <div class="modal__container">
            <h2 class="modal__title">¿Seguro que quieres eliminarlo?</h2>

            <p>¿Seguro que quieres eliminar el objeto seleccionado? El cambio será permanente.</p>

            <div>
                <button type="submit" class="eliminar" id="guardar">Eliminar</button>
                <button class="modal__close3">Cerrar</button>
            </div>
        </div>
    </section>

    <div class="paginas">
        <?php
        for ($i = 1; $i <= $total_paginas; $i++) {
            /*		echo "<a href='?pagina=" . $i . "'>" . $i . "</a>  ";*/
            echo "<a href='inicio.php?pagina=" . $i . "'>" . $i . "</a>  ";
        }

        ?>
    </div>

    <a href="formulario_crear.php" class="btn-flotante">Añadir</a>

    <!--footer-->
    <footer class="footer">
        <div class="footer__addr logo">
            <a href="inicio.php">
                <img src="../img/logo_con_nombre.png">
            </a>

        </div>

        <ul class="footer__nav">


            <li class="nav__item nav__item--extra">
                <h2 class="nav__title">Navegar</h2>

                <ul class="nav__ul nav__ul--extra">
                    <li>
                        <a href="inicio.php">Inicio</a>
                    </li>

                    <li>
                        <a href="mangas.php">Mangas</a>
                    </li>

                    <li>
                        <a href="libros.php">Libros</a>
                    </li>

                    <li>
                        <a href="videojuegos.php">Videojuegos</a>
                    </li>

                    <li>
                        <a href="figuras.php">Figuras</a>
                    </li>

                </ul>
            </li>


        </ul>



        <div class="legal">
            <p>Copyright &copy; 2023 GeekManager. All rights reserved.</p>

            <div class="legal__links">
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </footer>

    <script src="../js/app.js"></script>

</body>

</html>