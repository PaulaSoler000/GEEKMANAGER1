<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: ../index.php');
}

require_once('../controllers/database.php');

$user_id = $_SESSION['user_id'];

//Copiar
$buscar = '';
if ($_SESSION['id_pag_act'] === 8) {
    $buscar = $_SESSION['buscador'];
}
//Copiar


$filt_tag = '';
if ($_SESSION['id_pag_act'] === 9) {
    $filt_tag = $_SESSION['tags'];
}


$_SESSION['id_pag_act'] = 0;
$db = new Database();
$conexion = $db->connect();


$registros_por_pagina = 9; /* CON ESTA VARIABLE INDICAREMOS EL NUMERO DE REGISTROS QUE QUEREMOS POR PAGINA*/
$estoy_en_pagina = 1;/* CON ESTA VARIABLE INDICAREMOS la pagina en la que estamos*/

if (isset($_GET["pagina"])) {
    $estoy_en_pagina = $_GET["pagina"];
}

$empezar_desde = ($estoy_en_pagina - 1) * $registros_por_pagina;


$sql_total = "SELECT * FROM inventario";
/* CON LIMIT 0,3 HACE LA SELECCION DE LOS 3 REGISTROS QUE HAY EMPEZANDO DESDE EL REGISTRO 0*/
$sql = $conexion->prepare($sql_total);
$sql->execute(array());

$num_filas = $sql->rowCount(); /* nos dice el numero de registros del reusulset*/
$total_paginas = ceil($num_filas / $registros_por_pagina);

//Copiar
$sql_filt = "SELECT * FROM inventario WHERE id_usuario = ? AND tags LIKE ? ORDER BY id_objeto DESC LIMIT ?, ?";
$sql_no_filt = "SELECT * FROM inventario WHERE id_usuario = ? ORDER BY id_objeto DESC LIMIT ?, ?";
$sql_buscar = "SELECT * FROM inventario WHERE id_usuario = ? AND (nombre_objeto LIKE ? OR tags LIKE ?) ORDER BY id_objeto DESC LIMIT ?, ?";


if (!empty($buscar)) {
    $sql = $conexion->prepare($sql_buscar);
    $filtro = "%{$buscar}%";
    $sql->execute([$user_id, $filtro, $filtro, $empezar_desde, $registros_por_pagina]);
} else {
    if (!is_null($filt_tag)) {
        $sql = $conexion->prepare($sql_filt);
        $filtro = "%{$filt_tag}%";
        $sql->execute([$user_id, $filtro, $empezar_desde, $registros_por_pagina]);
    } else {
        $sql = $conexion->prepare($sql_no_filt);
        $sql->execute([$user_id, $empezar_desde, $registros_por_pagina]);
    }
}
//Copiar




//$_SESSION['id_pagina'] = 0;

//--------------paginación--------------------------------------------------------


//-----------------------------------------------------------------------2
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

    <!--Copiar-->
    <form action="../controllers/buscador.php" method="GET">
        <div class="centrar_buscar">
            <input type="text" id="texto" value="" name="texto">
            <button type="submit" name="submit">Buscar</button>
        </div>
    </form>
    <!--Copiar-->





    <!--elementos-->

    <div class="wrapper">

        <div class="contenedor">

            <?php
            $hayElementos = false; // Variable para verificar si hay elementos

            while ($datos = $sql->fetchObject()) {
                $hayElementos = true; ?>


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

                                <a href="../controllers/encontar_tag.php?type=tags&valor=<?= $tag ?>&tag=<?= $tag ?>" class="badge"><?= $tag ?></a>

                        <?php }
                        }
                        ?>
                    </div>

                    <div class="editar">
                        <div class="icono">
                            <a href="../controllers/eliminar.php?id_objeto=<?= $datos->id_objeto ?>"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                        <div class="icono">
                            <a href="formulario_editar.php?id_objeto=<?= $datos->id_objeto ?>"><i class="fa-solid fa-pencil"></i></a>
                        </div>
                        <div class="icono">
                            <a href="info.php?id_objeto=<?= $datos->id_objeto ?>"><i class="fa-solid fa-circle-info"></i></a>
                        </div>
                        <div class="icono">
                            <a onclick="copyToClipboard('https://localhost/GEEKMANAGER1/views/compartir.php?variable=<?= $datos->id_objeto ?>')"><i class="fa-sharp fa-solid fa-share-nodes"></i>
                            </a>
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

                <section class="modal3">
                    <div class="modal__container" id="modal-<?= $datos->id_objeto ?>">
                        <h2 class="modal__title">¿Seguro que quieres eliminarlo?</h2>

                        <p>¿Seguro que quieres eliminar el objeto seleccionado? El cambio será permanente.</p>

                        <div>
                            <a href="../controllers/eliminar.php?id_objeto=<?= $datos->id_objeto ?>">Eliminar</a>
                            <button class="modal__close3">Cerrar</button>
                        </div>
                    </div>
                </section>

            <?php }


            ?>



        </div>

        <?php if (!$hayElementos) { ?>
            <div class="texto-vacio">
                ¡Añade tu primer elemento!
            </div>
        <?php } ?>

    </div>





    <!--eliminar-->



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
                <a class="hero__cta2" href="#">Privacy Policy</a>
            </div>
        </div>
    </footer>

    <section class="modal2 ">
            <div class="modal__container">
                <h2 class="modal__title">¿Seguro que quieres eliminarlo?</h2>

                <p>Protección de datos de carácter personal según la LOPDDD




        Geekmanager, en aplicación de la normativa vigente en materia de protección de datos de carácter personal, informa que los datos personales que se recogen a través de los formularios del Sitio web: Geekmanager, se incluyen en los ficheros automatizados específicos de usuarios de los servicios de Geekmanager




        La recogida y tratamiento automatizado de los datos de carácter personal tiene como finalidad el mantenimiento de la relación comercial y el desempeño de tareas de información, formación, asesoramiento y otras actividades propias de Geekmanager




        Estos datos únicamente serán cedidos a aquellas entidades que sean necesarias con el único objetivo de dar

        cumplimiento a la finalidad anteriormente expuesta.




        Geekmanager adopta las medidas necesarias para garantizar la seguridad, integridad y confidencialidad de los datos conforme a lo dispuesto en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de los mismos.




        El usuario podrá en cualquier momento ejercitar los derechos de acceso, oposición, rectificación y cancelación

        reconocidos en el citado Reglamento (UE). El ejercicio de estos derechos puede realizarlo el propio usuario a través de email a: geekmanager@gmail.com.




        El usuario manifiesta que todos los datos facilitados por él son ciertos y correctos, y se compromete a mantenerlos

        actualizados, comunicando los cambios a Geekmanager




        Finalidad del tratamiento de los datos personales:




        ¿Con qué finalidad trataremos tus datos personales?

        En Geekmanager, trataremos tus datos personales recabados a través del Sitio Web:

        Geekmanager, con las siguientes finalidades:




        1. En caso de contratación de los bienes y servicios ofertados a través de Geekmanager, para

        mantener la relación contractual, así como la gestión, administración, información, prestación y mejora del

        servicio.




        2. Envío de información solicitada a través de los formularios dispuestos en Geekmanager

        3. Remitir boletines (newsletters), así como comunicaciones comerciales de promociones y/o publicidad de

        Geekmanager y del sector.




        Te recordamos que puedes oponerte al envío de comunicaciones comerciales por cualquier vía y en cualquier momento, remitiendo un correo electrónico a la dirección indicada anteriormente.




        Los campos de dichos registros son de cumplimentación obligatoria, siendo imposible realizar las finalidades expresadas si no se aportan esos datos.




        ¿Por cuánto tiempo se conservan los datos personales recabados?




        Los datos personales proporcionados se conservarán mientras se mantenga la relación comercial o no solicites su

        supresión y durante el plazo por el cuál pudieran derivarse responsabilidades legales por los servicios prestados.

        Legitimación:




        El tratamiento de tus datos se realiza con las siguientes bases jurídicas que legitiman el mismo:




        1. La solicitud de información y/o la contratación de los servicios de Geekmanager, cuyos

        términos y condiciones se pondrán a tu disposición en todo caso, de forma previa a una eventual contratación.




        2. El consentimiento libre, específico, informado e inequívoco, en tanto que te informamos poniendo a tu

        disposición la presente política de privacidad, que tras la lectura de la misma, en caso de estar conforme, puedes

        aceptar mediante una declaración o una clara acción afirmativa, como el marcado de una casilla dispuesta al

        efecto.




        En caso de que no nos facilites tus datos o lo hagas de forma errónea o incompleta, no podremos atender tu solicitud, resultando del todo imposible proporcionarte la información solicitada o llevar a cabo la contratación de los servicios.




        Destinatarios:




        Los datos no se comunicarán a ningún tercero ajeno a Geekmanager, salvo obligación legal.




        Datos recopilados por usuarios de los servicios




        En los casos en que el usuario incluya ficheros con datos de carácter personal en los servidores de alojamiento

        compartido, Geekmanager no se hace responsable del incumplimiento por parte del usuario del RGPD.




        Retención de datos en conformidad a la LSSI




        Geekmanager informa de que, como prestador de servicio de alojamiento de datos y en virtud de lo establecido en la Ley 34/2002 de 11 de julio de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSI), retiene por un periodo máximo de 12 meses la información imprescindible para identificar el origen de los datos alojados y el momento en que se inició la prestación del servicio. La retención de estos datos no afecta al secreto de las comunicaciones y sólo podrán ser utilizados en el marco de una investigación criminal o para la salvaguardia de la seguridad pública, poniéndose a disposición de los jueces y/o tribunales o del Ministerio que así los requiera.




        La comunicación de datos a las Fuerzas y Cuerpos del Estado se hará en virtud a lo dispuesto en la normativa sobre protección de datos personales.




        Derechos propiedad intelectual Geekmanager




        Geekmanager es titular de todos los derechos de autor, propiedad intelectual, industrial, “know how” y cuantos otros derechos guardan relación con los contenidos del sitio web Geekmanager y los servicios ofertados en el mismo, así como de los programas necesarios para su implementación y la información relacionada.




        No se permite la reproducción, publicación y/o uso no estrictamente privado de los contenidos, totales o parciales, del sitio web Geekmanager sin el consentimiento previo y por escrito.




        Propiedad intelectual del software




        El usuario debe respetar los programas de terceros puestos a su disposición por Geekmanager, aun siendo gratuitos y/o de disposición pública.




        Geekmanager dispone de los derechos de explotación y propiedad intelectual necesarios del software.




        El usuario no adquiere derecho alguno o licencia por el servicio contratado, sobre el software necesario para la prestación del servicio, ni tampoco sobre la información técnica de seguimiento del servicio, excepción hecha de los derechos y licencias necesarios para el cumplimiento de los servicios contratados y únicamente durante la duración de los mismos.




        Para toda actuación que exceda del cumplimiento del contrato, el usuario necesitará autorización por escrito por parte de Geekmanager, quedando prohibido al usuario acceder, modificar, visualizar la configuración, estructura y ficheros de los servidores propiedad de Geekmanager, asumiendo la responsabilidad civil y penal derivada de cualquier incidencia que se pudiera producir en los servidores y sistemas de seguridad como consecuencia directa de una actuación negligente o maliciosa por su parte.




        Propiedad intelectual de los contenidos alojados




        Se prohíbe el uso contrario a la legislación sobre propiedad intelectual de los servicios prestados por

        Geekmanager y, en particular de:




        • La utilización que resulte contraria a las leyes españolas o que infrinja los derechos de terceros.

        • La publicación o la transmisión de cualquier contenido que, a juicio de Geekmanager, resulte

        violento, obsceno, abusivo, ilegal, racial, xenófobo o difamatorio.

        • Los cracks, números de serie de programas o cualquier otro contenido que vulnere derechos de la propiedad

        intelectual de terceros.

        • La recogida y/o utilización de datos personales de otros usuarios sin su consentimiento expreso o contraviniendo

        lo dispuesto en Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016,

        relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre

        circulación de los mismos.

        • La utilización del servidor de correo del dominio y de las direcciones de correo electrónico para el envío de

        correo masivo no deseado.




        El usuario tiene toda la responsabilidad sobre el contenido de su web, la información transmitida y almacenada, los enlaces de hipertexto, las reivindicaciones de terceros y las acciones legales en referencia a propiedad intelectual,




        Derechos de terceros y protección de menores.




        El usuario es responsable respecto a las leyes y reglamentos en vigor y las reglas que tienen que ver con el

        funcionamiento del servicio online, comercio electrónico, derechos de autor, mantenimiento del orden público, así como principios universales de uso de Internet.




        El usuario indemnizará a Geekmanager por los gastos que generara la imputación de

        Geekmanager en alguna causa cuya responsabilidad fuera atribuible al usuario, incluidos

        honorarios y gastos de defensa jurídica, incluso en el caso de una decisión judicial no definitiva.




        Protección de la información alojada




        Geekmanager realiza copias de seguridad de los contenidos alojados en sus servidores, sin

        embargo no se responsabiliza de la pérdida o el borrado accidental de los datos por parte de los usuarios. De igual

        manera, no garantiza la reposición total de los datos borrados por los usuarios, ya que los citados datos podrían haber sido suprimidos y/o modificados durante el periodo del tiempo transcurrido desde la última copia de seguridad.




        Los servicios ofertados, excepto los servicios específicos de backup, no incluyen la reposición de los contenidos

        conservados en las copias de seguridad realizadas por Geekmanager, cuando esta pérdida sea imputable al usuario; en este caso, se determinará una tarifa acorde a la complejidad y volumen de la recuperación, siempre previa aceptación del usuario.




        La reposición de datos borrados sólo está incluida en el precio del servicio cuando la pérdida del contenido sea debida a causas atribuibles a Geekmanager




        Comunicaciones comerciales




        En aplicación de la LSSI. Geekmanager no enviará comunicaciones publicitarias o promocionales por correo electrónico u otro medio de comunicación electrónica equivalente que previamente no hubieran sido solicitadas o expresamente autorizadas por los destinatarios de las mismas.




        En el caso de usuarios con los que exista una relación contractual previa, Geekmanager sí está autorizado al envío de comunicaciones comerciales referentes a productos o servicios de

        Geekmanager que sean similares a los que inicialmente fueron objeto de contratación con el cliente.




        En todo caso, el usuario, tras acreditar su identidad, podrá solicitar que no se le haga llegar más información comercial a través de los canales de Atención al Cliente.</p>

                <div>
                    <button class="modal__close2">Cerrar</button>
                </div>
            </div>
        </section>


    <script src="../js/app.js"></script>

</body>

</html>