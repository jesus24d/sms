<?php

/**
 * crud canciones
 */
class Clave
{
	
	function __construct()
	{
		//TODO Datos a llenar con metodo _POST
		if(isset($_POST['buscar'])){
			$this->buscar = $_POST['buscar'];
		}elseif(isset($_GET['buscar'])){
			$this->buscar = $_GET['buscar'];
		}else{
			$this->buscar = "NONE";
		}
		
	}

function insertar(){
	    
		require_once 'conexion.php';
		$insert = $con -> query("insert into passwdp(clave) VALUES ( '$this->buscar')");
		if ($insert) {
			echo "<script>
                alert('Dj Agregado');
        </script>";
		}
		else{
	    echo "<script>
                alert('El Dj No Fue Agregado revisa que los campos esten correctos');
        </script>";
        }
	}


	function eliminar_todo(){
		require_once 'conexion.php';
		$con -> query("delete from passwdp");
		$con -> query("insert into passwdp(clave) VALUES ( '$this->buscar')");
   
	}

	function mostrar(){
		
		require_once 'conexion.php';
    	$sel = $con -> query("select * from passwdp");
    	while ($fila = $sel -> fetch_assoc()) {
    		$lista[] = array_map('utf8_encode', $fila);
    	
    	}
    	echo(json_encode($lista));
	}

}
?>