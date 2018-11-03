<?PHP

$db = include "../config/db.php";

session_start();

if (isset($_SESSION['tipoencuesta'])) {
    try {
        $conexion = new PDO("mysql:host=" . $db['host'] . "; dbname=" . $db['name'], $db['user'], $db['pass']);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM PREGUNTAS WHERE id_preguntas IN(SELECT id_preguntas FROM TIPOENCUESTA WHERE id_tipoencuesta= :tipoen)";
        $resultado = $conexion->prepare($query);
        $tipoen = $_SESSION['tipoencuesta'];
        $resultado->bindValue(":tipoen", $tipoen);
        $resultado->execute();
        $preg = $resultado->fetchAll(\PDO::FETCH_NUM)[0];
        $query = "SELECT * FROM OPCIONESPREGUNTAS WHERE id_opcionespreguntas IN(SELECT id_opcionespreguntas FROM TIPOENCUESTA WHERE id_tipoencuesta= :tipoen)";
        $resultado = $conexion->prepare($query);
        $resultado->execute();
        $opc = $resultado->fetchAll(\PDO::FETCH_NUM)[0];
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
    <title>Encuesta</title>
</head>
<body>
<div class="container">
    <div class="row">
                <form action="#" method="post" style="margin: auto;">
                    <fieldset>
                        <legend><h2>Informacion personal y acádemica</h2></legend>
                        <div class="input-group">
                            <div class="row">
                             <h4> $preg[1] </h4>




</div>
</body>
</html>

<?PHP
} else {
    header("Location:encuestas.php");
}
?>