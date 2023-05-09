<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: ../index.php');
}

require_once('../controllers/database.php');
$user_id = $_SESSION['user_id'];
$db = new Database();
$conexion = $db->connect();


$registros_por_pagina = 9; /* CON ESTA VARIABLE INDICAREMOS EL NUMERO DE REGISTROS QUE QUEREMOS POR PAGINA*/
$estoy_en_pagina = 1;/* CON ESTA VARIABLE INDICAREMOS la pagina en la que estamos*/

if (isset($_GET["pagina"])) {
    $estoy_en_pagina = $_GET["pagina"];
}

$empezar_desde = ($estoy_en_pagina - 1) * $registros_por_pagina;


$sql_total = "SELECT * FROM inventario WHERE tipo_objeto='figura'";
/* CON LIMIT 0,3 HACE LA SELECCION DE LOS 3 REGISTROS QUE HAY EMPEZANDO DESDE EL REGISTRO 0*/
$sql = $conexion->prepare($sql_total);
$sql->execute(array());

$num_filas = $sql->rowCount(); /* nos dice el numero de registros del reusulset*/
$total_paginas = ceil($num_filas / $registros_por_pagina);

$sql = $conexion->prepare("SELECT * FROM inventario WHERE id_usuario = ? and tipo_objeto='figura' ORDER BY id_objeto DESC LIMIT $empezar_desde,$registros_por_pagina");
$sql->execute([$user_id]);
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
    <title>Figuras</title>
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
            <li class="centro"><a href="libros.php">Libros</a></li>
            <li class="centro"><a href="mangas.php">Mangas</a></li>
            <li class="centro"><a href="videojuegos.php">Videojuegos</a></li>
            <li class="centro active"><a href="figuras.php">Figuras</a></li>

        </ul>

        <div class="session">
            <div>¡Hola <?= $_SESSION['user_usuario'] ?>!</div>
            <a href="../controllers/logout.php">Salir</a>
        </div>
    </nav>


    <div class="centrar_boton">

    </div>

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
                        <span class="badge"><?= $datos->año_salida ?></span>
                        <span class="badge"><?= $datos->tipo_objeto ?></span>
                        <span class="badge"><?= $datos->estado_objeto ?></span>
                        <span class="badge"><?= $datos->curso ?></span>
                        <?php if ($datos->edicion != "" && $datos->edicion != null) : ?>
                            <span class="badge"><?= $datos->edicion ?></span>
                        <?php endif; ?>
                        <?php if ($datos->editorial != "") : ?>
                            <span class="badge"><?= $datos->editorial ?></span>
                        <?php endif; ?>
                        <?php if ($datos->volumen != 0) : ?>
                            <span class="badge"><?= $datos->volumen ?></span>
                        <?php endif; ?>
                        <?php if ($datos->autor != "") : ?>
                            <span class="badge"><?= $datos->autor ?></span>
                        <?php endif; ?>
                        <?php if ($datos->genero != "") : ?>
                            <span class="badge"><?= $datos->genero ?></span>
                        <?php endif; ?>
                        <?php if ($datos->altura != "") : ?>
                            <span class="badge"><?= $datos->altura ?></span>
                        <?php endif; ?>
                        <?php if ($datos->marca != "") : ?>
                            <span class="badge"><?= $datos->marca ?></span>
                        <?php endif; ?>
                        <?php if ($datos->plataforma != "") : ?>
                            <span class="badge"><?= $datos->plataforma ?></span>
                        <?php endif; ?>
                        <?php if ($datos->compañia != "" && $datos->compañia != null) : ?>
                            <span class="badge"><?= $datos->compañia ?></span>
                        <?php endif; ?>
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

                    </div>

                </div>

            <?php }
            ?>

        </div>

    </div>

    <!--modal añadir-->

    <section class="modal ">
        <div class="modal__container">
            <h2 class="modal__title">Añadir</h2>

            <form action="">

                <div>
                    <label for="nombre">Nombre:</label><br>
                    <input type="text"><br>
                </div>

                <div>
                    <label for="tipo">Tipo de objeto:</label><br>
                    <select id="tipo" name="tipo">
                        <option selected disabled value="">Elija tipo</option>
                        <option value="manga">Manga</option>
                        <option value="libro">Libro</option>
                        <option value="videojuego">Videojuego</option>
                        <option value="figura">Figura</option>
                    </select><br>
                </div>

                <div>
                    <label for="estado">Estado del objeto:</label><br>
                    <select id="estado" name="estado">
                        <option selected disabled value="">Elija estado</option>
                        <option value="nuevo">Nuevo</option>
                        <option value="seminuevo">Seminuevo</option>
                        <option value="usado">Usado</option>
                    </select><br>
                </div>

                <div>
                    <label for="estado">Curso del objeto:</label><br>
                    <select id="estado" name="estado">
                        <option selected disabled value="">Elija curso</option>
                        <option value="sin_empezar">Sin empezar</option>
                        <option value="empezado">Empezado</option>
                        <option value="acabado">Acabado</option>
                    </select><br>
                </div>

                <div>
                    <label for="">Descripción:</label><br>
                    <textarea name="" id=""></textarea>
                </div>

                <div>
                    <label for="">Foto:</label><br>
                    <input type="file">
                </div>


            </form>

            <div>
                <button type="submit" class="boton" id="guardar">Añadir</button>
                <button class="modal__close">Cerrar</button>
            </div>
        </div>
    </section>

    <!--modal editar-->

    <section class="modal2 ">
        <div class="modal__container">
            <h2 class="modal__title">Editar</h2>

            <form action="">

                <div>
                    <label for="nombre">Nombre:</label><br>
                    <input type="text"><br>
                </div>

                <div>
                    <label for="tipo">Tipo de objeto:</label><br>
                    <select id="tipo" name="tipo">
                        <option selected disabled value="">Elija tipo</option>
                        <option value="manga">Manga</option>
                        <option value="libro">Libro</option>
                        <option value="videojuego">Videojuego</option>
                        <option value="figura">Figura</option>
                    </select><br>
                </div>

                <div>
                    <label for="estado">Estado del objeto:</label><br>
                    <select id="estado" name="estado">
                        <option selected disabled value="">Elija estado</option>
                        <option value="nuevo">Nuevo</option>
                        <option value="seminuevo">Seminuevo</option>
                        <option value="usado">Usado</option>
                    </select><br>
                </div>

                <div>
                    <label for="estado">Curso del objeto:</label><br>
                    <select id="estado" name="estado">
                        <option selected disabled value="">Elija curso</option>
                        <option value="sin_empezar">Sin empezar</option>
                        <option value="empezado">Empezado</option>
                        <option value="acabado">Acabado</option>
                    </select><br>
                </div>

                <div>
                    <label for="">Descripción:</label><br>
                    <textarea name="" id=""></textarea>
                </div>

                <div>
                    <label for="">Foto:</label><br>
                    <input type="file">
                </div>



            </form>

            <div>
                <button type="submit" class="boton" id="guardar">Editar</button>
                <button class="modal__close2">Cerrar</button>
            </div>
        </div>
    </section>


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
                <h2 class="nav__title">Technology</h2>

                <ul class="nav__ul nav__ul--extra">
                    <li>
                        <a href="#">Inicio</a>
                    </li>

                    <li>
                        <a href="#">Mangas</a>
                    </li>

                    <li>
                        <a href="#">Libros</a>
                    </li>

                    <li>
                        <a href="#">Videojuegos</a>
                    </li>

                    <li>
                        <a href="#">Figuras</a>
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