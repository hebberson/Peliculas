<?php if (!defined('CONTROLADOR')) exit; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title> Guardar Pelicula </title>
    </head>
    <link rel="stylesheet" type="text/css" href="estil.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <body>
    <div class="container">
        <h1> Guardar pelicula </h1>
        <form method="post" action="guardar_pelicula.php">
            <label for="nombre"> Nombre </label>
            <br />
            <input type="text" name="nombre" id="nombre" value="<?php echo $pelicula->getNombre() ?>" required />
            <br />
            <label for="any"> Any </label>
            <br />
            <input type="text" name="any" id="any" value="<?php echo $pelicula->getAny() ?>" required />
            <br />            
            <?php if ($pelicula->getId()): ?>
                <input type="hidden" name="pelicula_id" value="<?php echo $pelicula->getId() ?>" />
            <?php endif; ?>
            <input type="submit" value="Guardar" />
            <a href="index.php"> Cancelar </a>
        </form>
        </div>
    </body>
</html>