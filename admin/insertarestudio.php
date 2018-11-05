<?php

require "funciones.php";
$db = include "../config/db.php";

session_start();
if (isset($_SESSION['user'])) {
    try {
        $conexion = new PDO("mysql:host=" . $db['host'] . "; dbname=" . $db['name'], $db['user'], $db['pass']);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query1 = ""SELECT PREGUNTAS.*, TIPOENCUESTA.id_tipoencuesta FROM PREGUNTAS INNER JOIN TIPOENCUESTA ON PREGUNTAS.id_preguntas = TIPOENCUESTA.id_preguntas";
        $pregs = getArrayQuery($conexion, $query1, array(array()));

    } catch (Exception $e) {
        exit("error" . $e->getMessage());
    }
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../static/bulma.min.css">
    <title>Insertar Estudio </title>
</head>
<body>
<div class="container">
<table class="hoverable">
  <thead>
    <tr>
      <th>Id Preguntas</th>
      <th>Preguntas</th>
    </tr>
  </thead>
  <tbody>
    <?php for ($i = 0; $i < count($pregs); $i++) {
        print("<tr>");
        print("<td data-label=\"Id TipoEncuesta\">{$pregs[$i][0]}</td>");
        print("<td data-label=\"Preguntas\">");
        print("<ol>");
        for ($j = 1; $j < count($pregs[$i]); $j++) {
            if ($pregs[$i][$j] != "") {
                print("<li>{$pregs[$i][$j]}</li>");
            }
        }
        print("</ol></td></tr>");
    } ?>
  </tbody>
</table>
<form action="insertarest.php" method="post">
<div class="field">
  <label class="label">Introduzca Id TipoEncuesta , Fecha y Ciudad  </label>
</div>
<div class="control">
<label>Id TipoEncuesta</label>
<input type="text" class="input is-primary" name='tipo'></textarea>
<label>Fecha</label>
<input type="date" class="input is-primary" name='date'>
<label>Ciudad</label>
<input type="text" class="input is-primary" name='city'></textarea>
</div>
<div class="field is-grouped">
  <div class="control">

    <button class="button is-link" name="aceptar">Aceptar</button>
    <button class="button is-link" name="atras">Atras</button>
  </div>
</div>
</form>
</div>
</body>
</html>
<?php
} else {
    header("location:../login/login.php");
}
?>
