<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: formulario.php');
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
    <title>Formulario añadir</title>

</head>

<body>

    <!--nav-->

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
            <li class="centro"><a href="figuras.php">Figuras</a></li>

        </ul>

        <div class="session">
            <div>¡Hola <?= $_SESSION['user_usuario'] ?>!</div>
            <a href="../controllers/logout.php">Salir</a>
        </div>
    </nav>


    <div class="contBlan2">



        <h2 class="heading-secondary">Añadir</h2>
        <?php

        include("../controllers/modal_crear.php");
        ?>

        <div id="mensaje"></div>
        <form action="" method="POST" id="modal_crear" enctype="multipart/form-data" autocomplete="off">

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
                    <option name="curso" id="acabado" value="terminado">Terminado</option>
                </select><br>
            </div>

            <div>
                <label for="descripcion">Descripción:</label><br>
                <textarea name="descripcion" id="descripcion" required></textarea>
            </div>

            <div>
                <select id="mySelect">
                    <option value="option1">Opción 1</option>
                    <option value="option2">Opción 2</option>
                    <option value="option3">Opción 3</option>
                    <option value="option4">Opción 4</option>
                </select>

                <div id="collapse">
                    <div id="option1" class="collapse-content">
                        <label for="">opcion1</label><br>
                        <input type="text">
                    </div>
                    <div id="option2" class="collapse-content">
                        <p>Contenido de la opción 2</p>
                    </div>
                    <div id="option3" class="collapse-content">
                        <p>Contenido de la opción 3</p>
                    </div>
                    <div id="option4" class="collapse-content">
                        <p>Contenido de la opción 4</p>
                    </div>
                    <div id=".tipo-objeto" class="collapse-content">
                        <p> HOLAAAA</p>   
                </div>
                </div>

            </div>



            <div>
                <label for="foto">Foto:</label><br>
                <input type="file" name="foto" required>

            </div>


        </form>

        <div>
            <button type="submit" class="boton" value="crear" name="crear_objeto" form="modal_crear">Añadir</button>
            <a href="javascript:history.back()" class="button_gray">Cerrar</a>
        </div>

    </div>

    <script src="../js/opcion.js"></script>
</body>

</html>