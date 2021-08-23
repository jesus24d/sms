<?php

/**
 * crud Pronostico
 */
class Pronostico
{
	
	function __construct()
	{
		//TODO Datos a llenar con metodo _POST
		if(isset($_POST['id'])){
			$this->id = $_POST['id'];
		}else{
			$this->id = " ";
		}

		if(isset($_POST['equipo1'])){
			$this->equipo1 = $_POST['equipo1'];
		}else{
			$this->equipo1 = " ";
		}

		if(isset($_POST['equipo2'])){
			$this->equipo2 = $_POST['equipo2'];
		}else{
			$this->equipo2 = " ";
		}

		if(isset($_POST['equipo_select'])){
			$this->equipo_select = $_POST['equipo_select'];
		}else{
			$this->equipo_select = " ";
		}

		if(isset($_POST['rate'])){
			$this->rate = $_POST['rate'];
		}else{
			$this->rate = " ";
		}

		if(isset($_POST['value'])){
			$this->value = $_POST['value'];
		}else{
			$this->value = " ";
		}

		if(isset($_POST['fecha'])){
			$this->fecha = $_POST['fecha'];
		}else{
			$this->fecha = " ";
		}

		
		if(isset($_POST['liga'])){
			$this->liga = $_POST['liga'];
		}elseif(isset($_GET['liga'])){
			$this->liga = $_GET['liga'];
		}else{
			$this->liga = "";
		}

		if(isset($_POST['buscar'])){
			$this->buscar = $_POST['buscar'];
		}elseif(isset($_GET['buscar'])){
			$this->buscar = $_GET['buscar'];
		}else{
			$this->buscar = "";
		}

		if(isset($_POST['result'])){
			$this->result = $_POST['result'];
		}elseif(isset($_GET['result'])){
			$this->result = $_GET['result'];
		}else{
			$this->result = "0";
		}
		
		if(isset($_POST['sub_liga'])){
			$this->sub_liga = $_POST['sub_liga'];
		}elseif(isset($_GET['sub_liga'])){
			$this->sub_liga = $_GET['sub_liga'];
		}else{
			$this->sub_liga = "null";
		}
		
	}

	function insertar(){
		require_once 'conexion.php';
		$insert = $con -> query("insert into pronostico(equipo1, equipo2, equipo_select, liga, rate, value, fecha, result, sub_liga) VALUES ('$this->equipo1', '$this->equipo2', '$this->equipo_select', '$this->liga','$this->rate', '$this->value', '$this->fecha','0', '$this->sub_liga')");
		if ($insert) {
			echo "<script>
                alert('Pronostico Agregada');
        </script>";
		}
		else{
	    echo "<script>
                alert('El Pronostico No Fue Agregado revisa que los campos esten correctos');
        </script>";
}
	}

	function actualizar(){
		require_once 'conexion.php'; 
        $update = $con -> query("update pronostico set result='$this->result' where id = '$this->id'" );
	    if ($update) {
	    	echo "SI";
	    }
	    else{
	    	echo "NO";
	    }
	}

	function eliminar(){
		require_once 'conexion.php';
		$con -> query("delete from pronostico where id='$this->id'");
   
	}


	function eliminar_todo(){
		require_once 'conexion.php';
		$con -> query("delete from pronostico");
   
	}

	function mostrar(){
		
		require_once 'conexion.php';
    	$sel = $con -> query("select * from pronostico limit 1000");
    	while ($fila = $sel -> fetch_assoc()) {
    		$lista[] = array_map('utf8_encode', $fila);
    	
    	}
    	echo(json_encode($lista));
	}

	function mostrar_result(){
		
		require_once 'conexion.php';
    	$sel = $con -> query("select id, equipo1, equipo2, equipo_select, rate, value, fecha, result, liga, sub_liga from pronostico where liga='$this->liga' order by fecha DESC limit 20");
    	while ($fila = $sel -> fetch_assoc()) {
    		$lista[] = $fila;
    	
    	}
    	
    	echo(json_encode($lista, JSON_UNESCAPED_UNICODE));
	}

	function mostrar_result_futbol(){
		
		require_once 'conexion.php';
    	$sel = $con -> query("select id, equipo1, equipo2, equipo_select, rate, value, fecha, result, liga, sub_liga from pronostico where liga='ligas' order by fecha DESC, sub_liga ASC limit 1000");
    	while ($fila = $sel -> fetch_assoc()) {
    		$lista[] = $fila;
    	
    	}
    	
    	echo(json_encode($lista, JSON_UNESCAPED_UNICODE));
	}
	
	function mostrar_result_futboli(){
		
		require_once 'conexion.php';
    	$sel = $con -> query("select id, equipo1, equipo2, equipo_select, rate, value, fecha, result, liga, sub_liga from pronostico where liga='internacional' order by fecha DESC, sub_liga ASC limit 1000");
    	while ($fila = $sel -> fetch_assoc()) {
    		$lista[] = $fila;
    	
    	}
    	
    	echo(json_encode($lista, JSON_UNESCAPED_UNICODE));
	}
	
		function mostrar_result_caribe(){
		
		require_once 'conexion.php';
    	$sel = $con -> query("select id, equipo1, equipo2, equipo_select, rate, value, fecha, result, liga, sub_liga from pronostico where liga='caribe' order by fecha DESC, sub_liga ASC limit 1000");
    	while ($fila = $sel -> fetch_assoc()) {
    		$lista[] = $fila;
    	
    	}
    	
    	echo(json_encode($lista, JSON_UNESCAPED_UNICODE));
	}

function buscar(){
		
		require_once 'conexion.php';
    	$sel = $con -> query("select id, nombre, cantante, categoria from pronostico where nombre like '%$this->buscar%' or cantante like'%$this->buscar%' limit 1000");
    	while ($fila = $sel -> fetch_assoc()) {
    		$lista[] = array_map('utf8_encode', $fila);
    	
    	}
    	echo(json_encode($lista));
	}
	
	function buscar_video(){
		
		require_once 'conexion.php';
    	$sel = $con -> query("select nombre, cantante, categoria from pronostico where nombre like '%$this->buscar%' or cantante like'%$this->buscar%' and categoria='VIDEO'");
    	while ($fila = $sel -> fetch_assoc()) {
    		$lista[] = array_map('utf8_encode', $fila);
    	
    	}
    	echo(json_encode($lista));
	}
	
	
		public function enviarNotificacion() {
    // Cargamos los datos de la notificacion en un Array
    $notification = array();
    $notification['title'] = $this->equipo1." Vs. ".$this->equipo2;
    $notification['message'] = 	$this->equipo_select." ".$this->rate." ".$this->value;
    $notification['image'] = '';
    $notification['action'] = '';
    $notification['action_destination'] = '';            
    $topic = "pronostico";
    $fields = array(
        'to' => '/topics/' . $topic,
        'data' => $notification,
    );
    // Set POST variables
    $url = 'https://fcm.googleapis.com/fcm/send';
    $headers = array(
                'Authorization: key=AAAAbW_1YW4:APA91bFsPijHDxwv7gUynAcc01JzrTIQW_rswce1wlBjwDvG0-WsESouSu2aIww3dYxq8bUYosR9Yk3eREXzdPVhpiD0qeEZiRuH_pcJZzzjXSBkiaYdbjp05ve1tzoN84F25Q0I8E1p',
                'Content-Type: application/json'
                );
                
    // Open connection
    $ch = curl_init();
    // Set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Disabling SSL Certificate support temporarily
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));       
    
    $result = curl_exec($ch);
    if($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    // Close connection
    curl_close($ch);
}

}
?>