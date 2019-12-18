<?php

class Iscrizioni {
	
	
	
	# metodo per l'autenticazione
	public function verifica_login($user, $password) {
		  
	# cifratura della password
	$password = @md5($password);
	# confronto degli input con i dati contenuti in tabella
	//$query = @mysql_query("SELECT id_utente FROM iscritti WHERE email = '$email_o_nome_utente' OR nome_utente='$email_o_nome_utente' and password = '$password'") or die('Errore: ' . mysql_error());
	
	$mysqli = new mysqli(DATA_HOST, DATA_UTENTE, DATA_PASS, DATA_DB);
	
	$query = "SELECT * FROM crm_utenti WHERE NomeUtente = '$user' AND Password = '$password'";
	
	//echo $query;
	
	$result = $mysqli->query($query);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	
	// conteggio dei record restituiti dalla query
	if($result->num_rows > 0) {
		
	$_SESSION['login'] = true;
	$_SESSION['idUtente'] = $row['idUtente'];
	$_SESSION['idRuolo'] = $row['idRuolo'];
	$_SESSION['NomeUtente'] = $row['NomeUtente'];

	header("location: amministrazione.php");
	return TRUE;
	
	} else {
	echo "Nome utente e password errati";
	return FALSE;
	}
	
	}
  
	public function verifica_sessione() 
	{
	  if(isset($_SESSION['login']))
	  {
		return $_SESSION['login'];
	  }else{
		header("location: error.php");  
		return FALSE;
	  }
	} 	
	
	public function esci()
	{
	  $_SESSION['login'] = FALSE;
	  header("location: index.php");
	  @session_destroy();
	}	
	 	 
}


?>