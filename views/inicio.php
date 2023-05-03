<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: ../index.php');
}

//$_SESSION['id_pagina'] = 0;
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
    <title>Inicio</title>

</head>

<body>

    <!--nav-->

    <!--<nav>
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
            <li class="centro active"><a href="inicio.php">Inicio</a></li>
            <li class="centro"><a href="libros.php">Libros</a></li>
            <li class="centro"><a href="mangas.php">Mangas</a></li>
            <li class="centro"><a href="videojuegos.php">Videojuegos</a></li>
            <li class="centro"><a href="figuras.php">Figuras</a></li>

        </ul>

    </nav>-->

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
            <li class="centro active"><a href="inicio.php">Inicio</a></li>
            <li class="centro"><a href="libros.php">Libros</a></li>
            <li class="centro"><a href="mangas.php">Mangas</a></li>
            <li class="centro"><a href="videojuegos.php">Videojuegos</a></li>
            <li class="centro"><a href="figuras.php">Figuras</a></li>

        </ul>

        <div class="session">
            <div>¡Hola <?= $_SESSION['user_usuario'] ?>!</div>
            <a href="../controllers/logout.php">Salir</a>
        </div>
    </nav>

    <div>
    <button class="hero__cta">Añadir</button>
    <a class="button" href="#popup">I am a Popup</a>
    <a class="button" href="formulario_crear.php">formulario</a>
    </div>

    <!--elementos-->

    <div class="wrapper">

        <div class="contenedor">

            <?php
            require_once('../controllers/database.php');
            $user_id = $_SESSION['user_id'];
            $db = new Database();
            $conexion = $db->connect();

            $sql = $conexion->prepare("SELECT * FROM inventario WHERE id_usuario = ? ORDER BY id_objeto DESC");
            $sql->execute([$user_id]);
            while ($datos = $sql->fetchObject()) { ?>


                <div class="elemento">
                    <div>
                        <a href="info.php?id_objeto=<?= $datos->id_objeto ?>"> <img id="foto_objeto" src="<?= $datos->foto ?>" alt=""></a>
                    </div>
                    <p><?= $datos->nombre_objeto ?></p>

                    <div class="etiquetas">
                        <span class="badge"><?= $datos->tipo_objeto ?></span>
                        <span class="badge"><?= $datos->estado_objeto ?></span>
                        <span class="badge"><?= $datos->curso ?></span>


                    </div>

                    <div class="editar">
                        <div class="icono">
                            <a href="../controllers/eliminar.php?id_objeto=<?= $datos->id_objeto ?>" ><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                        <div class="icono">
                            <a href="formulario_editar.php?id_objeto=<?= $datos->id_objeto ?>'" ><i class="fa-solid fa-pencil"></i></a>
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


    <?php include '../modales/modal_crear.php'; ?>
    <!--modal añadir-->

    <section class="modal ">
        <div class="modal__container">
            <h2 class="modal__title">Añadir</h2>
            <?php
            include_once("../controllers/modal_crear.php");
            ?>
            <form action="" method="POST" id="modal_crear" enctype="multipart/form-data">

                <div>
                    <label for="nombre">Nombre:</label><br>
                    <input type="text" id="nombre_objeto" name="nombre_objeto" required><br>
                </div>

                <div>
                    <label for="tipo">Tipo de objeto:</label><br>
                    <select id="tipo_objeto" name="tipo_objeto" required>
                        <option selected disabled value="">Elija tipo</option>
                        <option name="tipo_objeto" id="manga" value="manga">Manga</option>
                        <option name="tipo_objeto" id="libro" value="libro">Libro</option>
                        <option name="tipo_objeto" id="videojuego" value="videojuego">Videojuego</option>
                        <option name="tipo_objeto" id="figura" value="figura">Figura</option>
                    </select><br>
                </div>

                <div>
                    <label for="estado">Estado del objeto:</label><br>
                    <select id="estado_objeto" name="estado_objeto" required>
                        <option selected disabled value="">Elija estado</option>
                        <option name="estado_objeto" id="nuevo" value="nuevo">Nuevo</option>
                        <option name="estado_objeto" id="seminuevo" value="seminuevo">Seminuevo</option>
                        <option name="estado_objeto" id="usado" value="usado">Usado</option>
                    </select><br>
                </div>

                <div>
                    <label for="curso">Curso del objeto:</label><br>
                    <select id="curso" name="curso" required>
                        <option selected disabled value="">Elija curso</option>
                        <option name="curso" id="sin_empezar" value="sin_empezar">Sin empezar</option>
                        <option name="curso" id="empezado" value="empezado">Empezado</option>
                        <option name="curso" id="acabado" value="acabado">Acabado</option>
                    </select><br>
                </div>

                <div>
                    <label for="descripcion">Descripción:</label><br>
                    <textarea name="descripcion" id="descripcion" required></textarea>
                </div>

                <div>
                    <label for="foto">Foto:</label><br>
                    <input type="file" name="foto">

                </div>


            </form>

            <div>
                <button type="submit" class="boton" value="crear" name="crear_objeto" form="modal_crear">Añadir</button>
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


    <script src="../js/app.js"></script>

</body>

</html>