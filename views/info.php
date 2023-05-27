<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: ../index.php');
}
$_SESSION["id_pag_act"] = 1;


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

    <link href="../node_modules/lightbox.js-0.0.6/lightbox/lightbox.min.css" rel="stylesheet">

    <title>Info</title>

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

    <br>
    <div>
        <a href="javascript:history.back()">Volver atrás</a>
    </div>

    <div class="contBlan">

        <?php
        $id_objeto = $_GET["id_objeto"];
        $_SESSION["id_objeto"] = $id_objeto;

        require_once('../controllers/database.php');
        $user_id = $_SESSION['user_id'];
        $db = new Database();
        $conexion = $db->connect();

        $sql = $conexion->prepare("SELECT * FROM inventario WHERE id_objeto = $id_objeto");
        $sql->execute();

        while ($datos = $sql->fetchObject()) { ?>

            <div class="img_info">


                <img id="foto_objeto_info" src="<?= $datos->foto ?>" alt="">


            </div>


            <div class="info_objeto">


                <p><?= $datos->nombre_objeto ?></p>


                <div class="etiqueta_info">
                    <span class="badge"><?= $datos->tipo_objeto ?></span>
                    <span class="badge"><?= $datos->año_salida ?></span>
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

                    <?php


                    foreach (explode(',', $datos->tags) as $tag) {
                        if ($tag != "") {
                    ?>
                            <a href="../controllers/encontar_tag.php?type=tags&valor=<?= $tag ?>" class="badge"><?= $tag ?></a>
                    <?php }
                    }
                    ?>

                    <div>
                        <p><?= $datos->descripcion ?></p>
                    </div>
                    <br>
                    <br>

                    <div class="galeria_objeto">
                        <div class="carrusel">

                            <?php
                            $sql_imagen = $conexion->prepare("SELECT * FROM galeria WHERE id_objeto = $id_objeto");
                            $sql_imagen->execute();
                            while ($dato_imagen = $sql_imagen->fetchObject()) { ?>


                                <div class="imagen_contenedor">
                                    <a id="btn_galeria" href="<?= $dato_imagen->galeria ?>" data-lightbox="gallery" data-image-alt="Descripción de la imagen">
                                        <img id="galeria_objeto" src="<?= $dato_imagen->galeria ?>" alt="Imagen">
                                        <a href="../controllers/eliminar_galeria.php?id_foto=<?= $dato_imagen->id_foto ?>&id_objeto=<?= $id_objeto ?>" class="eliminar_foto">X</a>
                                    </a>

                                </div>

                            <?php } ?>

                        </div>
                        <div class="slider-buttons">
                            <button class="prev-button">&lt;</button>
                            <button class="next-button">&gt;</button>
                        </div>
                    </div>

                    <script>
                        const carrusel = document.querySelector('.carrusel');
                        const prevButton = document.querySelector('.prev-button');
                        const nextButton = document.querySelector('.next-button');

                        prevButton.addEventListener('click', () => {
                            carrusel.scrollBy({
                                left: -carrusel.offsetWidth,
                                behavior: 'smooth'
                            });
                        });

                        nextButton.addEventListener('click', () => {
                            carrusel.scrollBy({
                                left: carrusel.offsetWidth,
                                behavior: 'smooth'
                            });
                        });
                    </script>

                    <form action="../controllers/galeria.php?id_objeto=<?= $id_objeto ?>" method="post" enctype="multipart/form-data">

                        <div>
                            <label for="galeria">Galería:</label><br>
                            <input type="file" name="galeria">
                        </div>

                        <div>
                            <button type="submit" class="boton">Añadir</button>
                        </div>

                    </form>



                </div>




                <div class="editar">
                    <div class="icono_info">
                        <a href="../controllers/eliminar.php?id_objeto=<?= $datos->id_objeto ?>"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                    <div class="icono_info">
                        <a href="formulario_editar.php?id_objeto=<?= $datos->id_objeto ?>"><i class="fa-solid fa-pencil"></i></a>
                    </div>
                    <div class="icono_info">
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


    </div>
<?php }
?>




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
<script src="../node_modules/lightbox.js-0.0.6/lightbox/lightbox.min.js"></script>
<script src="../node_modules/trumbowyg/dist/trumbowyg.min.js"></script>
</body>

</html>