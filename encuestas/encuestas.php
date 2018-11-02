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
                            <select id="profesor" style="width:100%;">
                            <?php foreach ($prof as $p) {print("<option>" . $p[0] . "</option>");} ?>
                            </select>
                            <label for="asignatura">Asignatura</label>
                            <select id="asignatura" style="width:85%;">
                            <?php foreach ($asig as $a) {print("<option>" . $a[0] . "</option>");} ?>
                            </select>
                            <input type="submit" value="Empezar" class="primary rounded" />
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
