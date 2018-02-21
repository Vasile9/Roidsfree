<!DOCTYPE html>
<html>
	<head>
		<title>Registrazione!</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../Style/">
		<link rel="stylesheet" type="text/css" href="../Style/fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css">
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
		echo	"
			<form class=\"#\" action=\"registrazione.php\" method=\"POST\">
				<h2 class=\"#\">Registrazione</h2>
				<p>Inserisci e-mail:</p>
				<input class=\"#\" type=\"email\" name=\"email\" placeholder=\" E-mail\" required>	
				<p>Inserisci il Nickname</p>
				<input class=\"#\" type=\"text\" name=\"nickname\" placeholder=\"Nickname\" required>
				<p>Inserisci Nome:</p>
				<input class=\"#\" type=\"text\" name=\"nom\" placeholder=\" Nome\" required>
				<p>Inserisci Cognome:</p>
				<input class=\"#\" type=\"text\" name=\"cogn\" placeholder=\" Cognome\" required>
				<p>Inserisci Pasword:</p>
				<input class=\"#\" type=\"password\" name=\"pas1\" placeholder=\" Password\" required>
				<p>Conferma Password:</p>
				<input class=\"#\" type=\"password\" name=\"pas2\" placeholder=\" Conferma Password\" required>
				<p>Data di nascita: </p>
				<input class=\"#\" type=\"date\" name=\"data\" required><br/><br/>
				<label for=\"sesso\">Inserisci Sesso:</label><br/><br/>
				<input type=\"radio\" name=\"gender\" value=\"M\">M
				<input type=\"radio\" name=\"gender\" value=\"F\">F
				<input type=\"radio\" name=\"gender\" value=\"Altro\">Altro
				<input class=\"#\" type=\"submit\" name=\"reg\" value=\"Registrati\">				
			</form>
		";
	}

	function controllo(){
		if(isset($_REQUEST['reg'])){
			$utentiReg = explode("\n", lettura("../Data/Utenti/utentiRegistrati", ".txt"));
			foreach($utentiReg as $key => $value) {
				$emailvalida = true;
				if($value ==  $_REQUEST['email']){
					$emailvalida = false;
					break;
				}
			}
			if(!file_exists("../Data/Utenti".hash('md5',$_REQUEST['nickname'],false).".json") && ($_REQUEST['pas1'] === $_REQUEST['pas2']) && $emailvalida == true){
				$utente = [
					'nickname' => $_REQUEST['nickname'],
					'email' => $_REQUEST['email'],
					'nome' => $_REQUEST['nom'],
					'cognome' => $_REQUEST['cogn'],
					'password' => hash('md5',$_REQUEST['pas1'],false),
					'eta' => $_REQUEST['data'],
					'sesso' => $_REQUEST['gender'],
					'denaro' => 10000,
					'partite' => [
						'vinte' => 0,
						'perse' => 0
					]
				];			
				creazione("../Data/Utenti/utentiRegistrati",".txt");
				inserimento("../Data/Utenti/utentiRegistrati",".txt", "a", $_REQUEST['email']."\n");
				creazione("../Data/Utenti/".hash('md5',$_REQUEST['nickname'],false), ".json");
				inserimento("../Data/Utenti/".hash('md5',$_REQUEST['nickname'],false), ".json", "w", json_encode($utente, JSON_PRETTY_PRINT));
				header("location: RegCompl.php");
			}
		}
	}

	function creazione($nomeFile, $tipo){
		if(!file_exists($nomeFile.$tipo)){
			$f = fopen($nomeFile.$tipo, 'w');
			fclose($f);
		}
	}

	function inserimento($nomeFile, $tipo, $modalita, $contenuto){
		$f = fopen($nomeFile.$tipo, $modalita);
		fwrite($f, $contenuto);
		fclose($f);
	}

	function lettura($nomeFile, $tipo){
		$f = fopen($nomeFile.$tipo, "r");
		$dati = fread($f, filesize($nomeFile.$tipo));
		fclose($f);
		return $dati;
	}
?>