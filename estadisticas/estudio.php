<?php
session_start();
$db = include "../config/db.php";
$queries = include "./filtros.php";
require "./funciones.php";
$conexion = new PDO("mysql:host=" . $db['host'] . "; dbname=" . $db['name'], $db['user'], $db['pass']);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['encuesta'])) {
    $profesores = getQueryArray($conexion, $queries['profesor'], array(array()));
    $asignatura = getQueryArray($conexion, $queries['asignatura'], array(array()));

} else {
    $ciudades = getQueryArray($conexion, $queries['ciudad'], array(array()));
}
$title = "Selección de Encuesta";include "../template/head.php" ?>
<body>
    <div calss="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <div class="box">
                    <?php if (isset($_POST['encuesta'])): ?>
                    <form action="#" method="post">
                        <h3 class="title has-text-centered has-text-grey">Seleccione Encuesta</h3>
                        <div class="field">
                            <label class="label">Profesor</label>
                            <div class="control has-text-centered">
                                <div class="select">
                                    <select id="profesor" name="profesor">
                                        <?php foreach ($prof as $p) {print("<option value='$p[0]'>$p[1]</option>\n");} ?>
                                    </select>
                                </div>
                            </div>
                            <label class="label">Asignatura</label>
                            <div class="control has-text-centered">
                                <div class="select">
                                    <select id="asignatura" name="asignatura">
                                        <?php foreach ($asig as $a) {print("<option value='$a[0]'>$a[1]</option>\n");} ?>
                                    </select>
                                </div>
                            </div>
                            <?php if (isset($_GET['error'])): ?>
                                <div class="control has-text-centered">
                                    <div class="notification is-danger has-text-grey-dark">
                                        <p><?php print($_GET['error']) ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <input type="submit" value="Atras" class="button is-link" name="atras" />
                            <input type="submit" value="Empezar" class="button is-link" name="consultar" />
                        </div>
                    </form>
                    <?php else: ?>
                    <form action="#" method="post">
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if (isset($_POST['atras'])) {
    session_destroy();
    header("location:../index.php");
} elseif (isset($_POST['consultar'])) {
    try {
        $query = "SELECT * FROM IMPARTE WHERE id_profesor= :prof AND id_asignatura :asig)";
        $resultado = $conexion->prepare($query);
        $prof = $_POST['profesor'];
        $asig = $_POST['asignatura'];
        $resultado->bindValue(":prof", $prof);
        $resultado->bindValue(":asig", $asig);
        $resultado->execute();
        if ($resultado->rowCount() != 0) {
            $_SESSION['profesor'] = $prof;
            $_SESSION['asignatura'] = $asig;
            header("location:estadisticas.php");
        } else {
            header("location:estudio.php?error=El profesor elegido no imparte la asignatura");
        }
    } catch (Exception $e) {
        exit("Error: " . $e->getMessage());
    }
} elseif (isset($_POST['encuesta'])) {
    $_SESSION['encuesta'] = $_POST['ciudad'];
    header("location:estudio.php");
}