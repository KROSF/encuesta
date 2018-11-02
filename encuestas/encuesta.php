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
            <form action="#" method="post">
                <fieldset>
                    <legend>Informacion personal y acádemica</legend>
                    <div class="input-group">
                        <div class="row">
                        <h4>Edad</h4>
                        <label><input type="radio" name="radio" value="Radio 1"> &#8804; 19 </label>
                        <label><input type="radio" name="radio" value="Radio 1"> 20 - 21</label>
                        <label><input type="radio" name="radio" value="Radio 1"> 22 - 23</label>
                        <label><input type="radio" name="radio" value="Radio 1"> 24 - 25</label>
                        <label><input type="radio" name="radio" value="Radio 1"> &gt; 25</label>
                        </div>
                        <div class="row">
                        <label for="radio2">Sexo</label>
                        <input type="radio" name="radio2" value="Radio 1">
                        <input type="radio" name="radio2" value="Radio 1">
                        </div>
                        <input type="submit" value="Empezar" class="primary rounded" name="empezar" />
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>
