<!DOCTYPE html>
<html>
	<head>
		<title>Texas Holden</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="Style/login-style.css">
		<link rel="stylesheet" type="text/css" href="Style/fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css">
		<meta name="viewport" content="width=device-width">
	</head>
	<body>
		<?php
			insDati();
			controllo();
		?>
	</body>
</html>

<?php
	function insDati(){
		echo "   
				<form class=\"#\" action=\"Index.php\" method=\"POST\">
					<h2>Login</h2>
					<input class=\"#\" type=\"text\" name=\"nickname\" placeholder=\"Username\" required/>
					<input class=\"#\" type=\"password\" name=\"password\" placeholder=\"Password\" required/>
					<input class=\"#\" type=\"submit\" name=\"login\" value=\"Login\"/>
				</form>
				<p class=\"#\">Non hai un acount? <a href=\"Pages/Registrazione.php\">Registrati</a></p>
		";
	}


	function controllo(){
		session_start();
		if(isset($_REQUEST['login'])){
			if(file_exists("Data/Utenti/".hash('md5',$_REQUEST['nickname'],false).".json")){
				$_SESSION["utente"] = json_decode(lettura("Data/Utenti/".hash('md5',$_REQUEST['nickname'],false), ".json"),true);
			}			
			if(isset($_SESSION['utente']) && ($_SESSION['utente']['password'] === hash('md5',$_REQUEST['password'],false))){
					header("location: Pages/paginaUtente.php");
			}
		}
	}

	function lettura($nomeFile, $tipo){
		$f = fopen($nomeFile.$tipo, "r");
		$dati = fread($f, filesize($nomeFile.$tipo));
		fclose($f);
		return $dati;
	}
?>