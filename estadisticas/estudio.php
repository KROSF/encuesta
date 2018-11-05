<?php
if (!isset($_POST['encuesta'])) {
    session_start();
    $db = include "../config/db.php";
    $queries = include "./filtros.php";
    require "./funciones.php";
    $conexion = new PDO("mysql:host=" . $db['host'] . "; dbname=" . $db['name'], $db['user'], $db['pass']);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $ciudades = getQueryArray($conexion, $queries['ciudad'], array(array()));
}
$title = "Selección de Encuesta";include "../template/head.php" ?>
<body>
    <div calss="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <div class="box">
                    <form action="estadisticas.php" method="post">
                            <h3 class="title has-text-centered has-text-grey">Seleccione Ciudad</h3>
                            <div class="field">
                                <label class="label">Ciudad</label>
                                <div class="control has-text-centered">
                                    <div class="select">
                                        <select id="ciudad" name="ciudad">
                                                <?php foreach ($ciudades as $c) {print("<option value='$c[0]'>" . $c[1] . "</option>\n");} ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Siguiente" class="button is-link" name="encuesta" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>