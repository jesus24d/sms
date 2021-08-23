<?php

/**
 * clase para mostrar los porcentajes de acierto y desaciertos
 */
class Estadistica
{
	
	function __construct()
	{
		$this->total=0;
		$this->aciertos=0;
		$this->desaciertos=0;
		$this->suspendidos=0;
		$this->por_jugar=0;
		
		if(isset($_POST['liga'])){
			$this->liga = $_POST['liga'];
		}elseif(isset($_GET['liga'])){
			$this->liga = $_GET['liga'];
		}else{
			$this->liga = "";
		}
	}

	function mostrar_result(){
		
		require_once 'conexion.php';
    	$sel = $con -> query("select result from pronostico");
    	while ($fila = $sel -> fetch_assoc()) {
    		$this->total=$this->total + 1;
    		if($fila['result'] == '1'){
    		    $this->aciertos=$this->aciertos + 1;
    		}else if($fila['result'] == '2'){
    		    $this->desaciertos=$this->desaciertos + 1;
    		}else if($fila['result'] == '3'){
    		    $this->suspendidos=$this->suspendidos + 1;
    		}else if($fila['result'] == '0'){
    		    $this->por_jugar=$this->por_jugar + 1;
    		}
    		
    		//$lista[] = $fila;
    	
    	}
    	$porcentaje_acierto = ($this->aciertos/($this->total - $this->suspendidos - $this->por_jugar))*100;
    	$porcentaje_acierto = round($porcentaje_acierto, 2);
    	$porcentaje = strval($porcentaje_acierto)."%";
    	$array = array(
    "total"  => $this->total,
    "aciertos"  => $this->aciertos,
    "desaciertos"  => $this->desaciertos,
    "suspendidos"  => $this->suspendidos,
    "porcentaje_acierto" => $porcentaje
);
        
    	$lista[] = $array;
    	echo(json_encode($lista, JSON_UNESCAPED_UNICODE));
	}

}
?>