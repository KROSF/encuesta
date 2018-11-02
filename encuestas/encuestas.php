<?php
$db = include "../config/db.php";
try {
    $base = new PDO("mysql:host=" . $db['host'] . "; dbname=" . $db['name'], $db['user'], $db['pass']);
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT nombre FROM PROFESOR ";
    $rslt = $base->prepare($query);
    $rslt->execute();
    $prof = $rslt->fetchAll(\PDO::FETCH_NUM);
    $query = "SELECT nombre FROM ASIGNATURA";
    $rslt = $base->prepare($query);
    $rslt->execute();
    $asig = $rslt->fetchAll(\PDO::FETCH_NUM);
} catch (Exception $e) {
    exit("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../static/mini-nord.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="card" style="margin: auto;">
                <form action="#" method="post">
                    <fieldset>
                        <legend>Seleccione Encuesta</legend>
                        <div class="input-group">
                            <label for="profesor">Profesor</label>
                            <select id="profesor" style="width:100%;" name="profesor">
                                <?php foreach ($prof as $p) {print("<option>" . $p[0] . "</option>\n");} ?>
                            </select>
                            <label for="asignatura">Asignatura</label>
                            <select id="asignatura" style="width:85%;" name="asignatura">
                                <?php foreach ($asig as $a) {print("<option>" . $a[0] . "</option>\n");} ?>
                            </select>
                            <input type="submit" value="Empezar" class="primary rounded" name="empezar" />
                        </div>
                    </fieldset>
                </form>
                <?php if (@$_GET['error'] == true): ?>
                <div class="card error">
                    <p><span class="icon-alert"></span>
                        <?php print($_GET['error']) ?>
                    </p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if (isset($_POST['empezar'])) {
    try {
        $query = "SELECT * FROM IMPARTE WHERE id_profesor=(SELECT id_profesor FROM PROFESOR WHERE nombre= :prof ) AND id_asignatura=(SELECT id_asignatura FROM ASIGNATURA WHERE nombre= :asig)";
        $rslt = $base->prepare($query);
        $prof = $_POST['profesor'];
        $asig = $_POST['asignatura'];
        $rslt->bindValue(":prof", $prof);
        $rslt->bindValue(":asig", $asig);
        $rslt->execute();
        if ($rslt->rowCount() != 0) {
            header("location:encuesta.php");
        } else {
            header("location:encuestas.php?error=El profesor " . $prof . " no imparte " . $asig);
        }
    } catch (Exception $e) {
        exit("Error: " . $e->getMessage());
    }
}
?>