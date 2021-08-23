<?php
require_once 'crud_clave.php';
$clave = new Clave();
if(isset($_POST['buscar'])){
    echo("SI");
    $clave->eliminar_todo();
}
?>