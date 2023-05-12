<?php
include('../controllers/database.php');



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

    <link rel="stylesheet" href="../node_modules/trumbowyg/dist/ui/trumbowyg.min.css">

    <link href="../node_modules/tagify-master/dist/tagify.css" rel="stylesheet">
    <title>Formulario editar</title>

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



        <h2 class="heading-secondary">Editar</h2>
        <?php

        include("../controllers/editar.php");

        $id_objeto = $_GET["id_objeto"];
        $db = new Database();
        $conexion = $db->connect();
        $sql = $conexion->prepare("SELECT * FROM inventario WHERE id_objeto = :id_objeto");
        $sql->bindParam(':id_objeto', $id_objeto);
        $sql->execute();

        while ($datos = $sql->fetchObject()) {
        ?>

            <div id="mensaje"></div>
            <form action="" method="POST" id="modal_editar" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="id_objeto" value="<?= $_GET["id_objeto"] ?>">

                <div>
                    <label for="nombre">Nombre:</label><br>
                    <input type="text" id="nombre_objeto" value="<?= $datos->nombre_objeto ?>" name="nombre_objeto" required><br>
                </div>

                <div>
                    <label for="año">Año salida:</label><br>
                    <input type="number" id="año_salida" value="<?= $datos->año_salida ?>" name="año_salida" required><br>
                </div>


                <div>
                    <label for="estado">Estado del objeto:</label><br>
                    <select id="estado_objeto" name="estado_objeto" required>
                        <option selected disabled value="">Elija estado</option>
                        <option name="estado_objeto" <?php if ($datos->estado_objeto == "nuevo") echo "selected"; ?> id="nuevo" value="nuevo">Nuevo</option>
                        <option name="estado_objeto" <?php if ($datos->estado_objeto == "seminuevo") echo "selected"; ?> id="seminuevo" value="seminuevo">Seminuevo</option>
                        <option name="estado_objeto" <?php if ($datos->estado_objeto == "usada") echo "selected"; ?> id="usado" value="usado">Usado</option>
                    </select><br>
                </div>

                <div>
                    <label for="curso">Curso del objeto:</label><br>
                    <select id="curso" name="curso" required>
                        <option selected disabled value="">Elija curso</option>
                        <option name="curso" <?php if ($datos->curso == "sin_empezar") echo "selected"; ?> id="sin_empezar" value="sin_empezar">Sin empezar</option>
                        <option name="curso" <?php if ($datos->curso == "empezado") echo "selected"; ?> id="empezado" value="empezado">Empezado</option>
                        <option name="curso" <?php if ($datos->curso == "terminado") echo "selected"; ?> id="acabado" value="terminado">Terminado</option>
                    </select><br>
                </div>

                <div>
                    <label for="descripcion">Descripción:</label><br>
                    <textarea name="descripcion" id="descripcion" required><?= htmlspecialchars($datos->descripcion) ?></textarea>

                </div>


                <div>
                    <label for="tipo">Tipo de objeto:</label><br>
                    <select id="tipo_objeto" name="tipo_objeto" required>

                        <option value="manga" <?php if ($datos->tipo_objeto == "manga") echo "selected"; ?>>Manga</option>
                        <option value="libro" <?php if ($datos->tipo_objeto == "libro") echo "selected"; ?>>Libro</option>
                        <option value="videojuego" <?php if ($datos->tipo_objeto == "videojuego") echo "selected"; ?>>Videojuego</option>
                        <option value="figura" <?php if ($datos->tipo_objeto == "figura") echo "selected"; ?>>Figura</option>

                    </select><br>

                    <div id="edicionDiv" style="display:'none' ;">
                        <label for="edicion">Edición:</label><br>
                        <input type="text" id="edicion" value="<?= $datos->edicion ?>" name="edicion"><br>
                    </div>

                    <div id="editorialDiv" style="display:'none' ;">
                        <label for="editorial">Editorial:</label><br>
                        <input type="text" id="editorial" value="<?= $datos->editorial ?>" name="editorial"><br>
                    </div>
                    <div id="volumenDiv" style="display:'none' ;">
                        <label for="volumen">Volumen:</label><br>
                        <input type="number" id="volumen" value="<?= $datos->volumen ?>" name="volumen"><br>
                    </div>
                    <div id="autorDiv" style="display:'none' ;">
                        <label for="autor">Autor:</label><br>
                        <input type="text" id="autor" value="<?= $datos->autor ?>" name="autor"><br>
                    </div>
                    <div id="generoDiv" style="display:'none' ;">
                        <label for="genero">Género:</label><br>
                        <input type="text" id="genero" value="<?= $datos->genero ?>" name="genero"><br>
                    </div>
                    <div id="plataformaDiv" style="display: none;">
                        <label for="plataforma">Plataforma:</label><br>
                        <input type="text" id="plataforma" value="<?= $datos->plataforma ?>" name="plataforma"><br>
                    </div>
                    <div id="compañiaDiv" style="display: none;">
                        <label for="compañia">Compañía:</label><br>
                        <input type="text" id="compañia" value="<?= $datos->compañia ?>" name="compañia"><br>

                    </div>
                    <div id="alturaDiv" style="display: none;">
                        <label for="Altura">Altura:</label><br>
                        <input type="text" id="altura" value="<?= $datos->altura ?>" name="altura"><br>
                    </div>
                    <div id="marcaDiv" style="display: none;">
                        <label for="marca">Marca:</label><br>
                        <input type="text" id="marca" value="<?= $datos->marca ?>" name="marca"><br>
                    </div>
                </div>

                <div>
                    <label for="tags">Tags:</label><br>
                    <input type="text" name="tags" value="<?= $datos->tags ?>">
                </div>

                <div>
                    <label for="foto">Foto:</label><br>
                    <input type="file" name="foto" value="<?php echo $datos->foto; ?>">
                </div>


            </form>

            <div>
                <button type="submit" class="boton" value="editar" name="editar_objeto" form="modal_editar">Editar</button>
                <a href="javascript:history.back()" class="button_gray">Cerrar</a>
            </div>

    </div>
<?php }
?>

<script src="../js/opcion.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../node_modules/tagify-master/dist/jQuery.tagify.min.js"></script>
<script src="../node_modules/trumbowyg/dist/trumbowyg.min.js"></script>
<script>
    $('#descripcion').trumbowyg();

    $('tags').tagify();

    $(function() {
        // Inicializa tagify
        $('[name=tags]').tagify({
            duplicates: false
        });

        // Agrega evento para guardar tags en campo oculto antes de enviar el formulario
        $('form').on('submit', function() {
            var tags = $('[name=tags]').tagify('serialize').map(tagData => tagData.value);
            $('#tags').val(tags.join(','));
        });
    });
</script>
</body>

</html>