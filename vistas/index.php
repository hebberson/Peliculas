<?php if (!defined('CONTROLADOR')) exit; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title> Lista de Peliculas </title>
    </head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estil.css">
    <body>
    <script type="text/javascript">
        function getPelis(busqueda,valor){
            $.ajax({
                type: 'POST',
                url: 'getData.php',
                data: 'busqueda='+busqueda+'&valor='+valor,
                success:function(html){
                    $('#ListaPelis').html(html);
                }
            });
        }
    </script>

        <div class="container">
        <h2>Buscador de Peliculas</h2>
        <div class="form-group pull-left">
            <input type="text" class="search form-control" id="searchInput" placeholder="Nombre o Año" onkeyup="getPelis('search',$('#searchInput').val())">
        </div>
        <div class="form-group pull-right">
            <select class="form-control" onchange="getPelis('sort',this.value);">
              <option value="">Ordenar Por</option>
              <option value="new">Recientes</option>
              <option value="old">Antiguas</option>
              <option value="asc">A - Z</option>
              <option value="desc">Z - A</option>
            </select>
        </div>
        <div class="loading-overlay" style="display: none;"><div class="overlay-content">Cargando...</div></div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Año</th>
                        <th><a href="guardar_pelicula.php"> Añadir nueva Pelicula </a></th>
                    </tr>
                </thead>
                <tbody id="ListaPelis">
                    <?php
                        include 'DB.php';
                        $db = new DB();
                        $peliculas = $db->getRows('pelicules',array('order_by'=>'id DESC'));
                        if(!empty($peliculas)){ $count = 0;
                            foreach($peliculas as $peli){ $count++;
                    ?>
                    <tr>
                        <td><?php echo $peli['nombre']; ?></td>
                        <td><?php echo $peli['any']; ?></td>
                        <td><a href="guardar_pelicula.php?pelicula_id=<?php echo $peli['id'] ?>"> Editar </a> </td>
                        <td><a href="eliminar_pelicula.php?pelicula_id=<?php echo $peli['id'] ?>"> Eliminar </a> </td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="5">No se han encontrado Peliculas.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
