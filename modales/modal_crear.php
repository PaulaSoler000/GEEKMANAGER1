
<div class="popup" id="popup">
    <div class="popup__content">
        <h2 class="heading-secondary">Start booking now</h2>
        <?php
        
            include("../controllers/modal_crear.php");
            ?>
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
                <a href="#" class="button_gray">Cerrar</a>
            </div>
       
    </div>
</div>