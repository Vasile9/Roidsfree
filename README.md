SPECIFICHE:
	- chiamata ad index.php:
		- giocare(name="gioca")
		- effettuare il logout(chiamata vuota e $_SESSION distrutto)
		- modificare dati utente(name="modificaDati")
	- requisiti di $_SESSION:
		- indice "utente" contenente un vettore con informazioni dell'utente
		- indice "partite" contente un vettore con "vinte" e "perse"
		- !!!!!! per grafici su vincite e perdite è necessario fare una struttura dati su file complicata e lunga da processare (A nostro rischio e pericolo)
		- esempio di $_SESSION
			$_SESSION=[
				"utente"=>[
					"nickname"=>"Bovo",
					"email"=>"nik@gmail.com",
					"nome"=>"nicola",
					"cognome"=>"bovolato",
					"password"=>"boh",
					"eta"=>"5",	
					"sesso"=>"M",
					"denaro"=>"100000"
				],
				"partite"=>[
					"vinte"=>10,
					"perse"=>5
				]
			];
	- requisiti grafici:
		- la pagina è completamente dipendente da un css per il suo funzionamento
		- statistiche e modifica dati compaiono e scompaiono con Javascript
		- ho utilizzato l'immagine cross.png per chiudere statistiche e modifica dati (da modificare)
