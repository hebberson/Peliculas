<?php
include 'DB.php';
$db = new DB();
$tabla = 'pelicules';
$condiciones = array();
if(!empty($_POST['busqueda']) && !empty($_POST['valor'])){
    if($_POST['busqueda'] == 'search'){
        $condiciones['search'] = array('nombre'=>$_POST['valor'],'any'=>$_POST['valor']);
        $condiciones['order_by'] = 'id DESC';
    }elseif($_POST['busqueda'] == 'sort'){
        $ValorOrden = $_POST['valor'];
        $ArrOrdenado = array(
            'new' => array(
                'order_by' => 'any DESC'
            ),
            'old' => array(
                'order_by' => 'any ASC'
            ),
            'asc'=>array(
                'order_by'=>'nombre ASC'
            ),
            'desc'=>array(
                'order_by'=>'nombre DESC'
            )
        );
        $sortKey = key($ArrOrdenado[$ValorOrden]);
        $condiciones[$sortKey] = $ArrOrdenado[$ValorOrden][$sortKey];
    }
}else{
    $condiciones['order_by'] = 'id DESC';
}
$pelis = $db->getRows($tabla,$condiciones);
if(!empty($pelis)){
    $count = 0;
    foreach($pelis as $pelicula): $count++;
        echo '<tr>';
        echo '<td>'.$pelicula['nombre'].'</td>';
        echo '<td>'.$pelicula['any'].'</td>';
        echo '<td><a href="guardar_pelicula.php?pelicula_id='. $pelicula['id'] .'">Editar</td>';
        echo '<td><a href="eliminar_pelicula.php?pelicula_id='. $pelicula['id'] .'">Eliminar</td>';
        echo '</tr>';
    endforeach;
}else{
    echo '<tr><td colspan="5">No se han encontrado Peliculas</td></tr>';
}
exit;

?>