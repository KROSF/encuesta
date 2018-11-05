<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../static/bulma.min.css">
    <title>Fin Encuesta</title>
</head>

<body>
    <div class="hero-body">
        <div class="container">
            <h2 class="title has-text-centered">Gracias por realizar la encuesta</h2>
            <div class="intro column is-8 is-offset-2">
                <br>
                <p class="subtitle has-text-centered">
                    Su encuesta ha sido guardada satisfactoriamente. Será redireccionado en unos segundos a la página principal.
                </p>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function () {
        window.location.href= '../index.php';
        }, 8000);
    </script>
</body>
</html>
