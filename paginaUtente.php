<html>
	<head>
		<script src="Chart.bundle.js"></script>
	</head>
	<body>
		<script>
			function mostraModificaDati(){document.getElementById("modificaDati").style.cssText="display:inline";}
			function nascondiModificaDati(){document.getElementById("modificaDati").style.cssText="display:none";}
			function mostraStatistiche(){
				document.getElementById("statistiche").style.cssText="display:block";
				grafico.render();
			}
			function nascondiStatistiche(){document.getElementById("statistiche").style.cssText="display:none";}
		</script>	
		<?php
			if(isset($_SESSION["logout"])){
				session_destroy();
				header("Location: index.php");

			}
			if(isset($_SESSION["utente"])){
				stampaHeader();
				stampaPagina();
				stampaFormModifica();
				stampaStatistiche();
				echo "";
			}
			else echo "<p>Non hai il permesso di accedere a quest'area</p>\n
					<a href=\"index.php\">Torna alla pagina principale</a>\n";
							
			function stampaHeader(){
				echo "<ul>\n
						<li><p>".$_SESSION["utente"]["nickname"]."</p></li>\n
						<li>\n
							<table>\n
								<tr>\n
									<td><img src=\"images/fiche.png\"/></td>\n
									<td><p>".$_SESSION["utente"]["denaro"]."</p></td>\n
								</tr>\n
							</table>\n
						</li>\n
					</ul>\n";
			}
			function stampaFormModifica(){
				echo "<div id=\"modificaDati\" style=\"display:none\">\n
						<ul>\n
							<li><p>INFORMAZIONI UTENTE</p></li>\n
							<li><img src=\"images/cross.png\" onclick=\"nascondiModificaDati()\"/></li>\n
						</ul>\n
						<form action=\"index.php\" method=\"POST\">\n";
				
				foreach($_SESSION["utente"] as $index => $value){
						if($index!="password") echo "<p>$index</p>\n
							<input type=\"text\" name=\"$index\" value=\"$value\"placeholder=\"$index\"></input>\n";
						else echo "<p>Password</p>\n
									<input type=\"password\" name=\"password\"></input>\n
									<p>conferma Password</p>\n
									<input type=\"password\" name=\"confermaPassword\"></input>\n";
					}
				echo "<input type=\"submit\" name=\"modificaDati\"></input>\n
					</form>\n
				</div>\n";
			}
			function stampaStatistiche(){
				echo "<div id=\"statistiche\" style=\"display:none\">\n
					<ul>\n
						<li><p>STATISTICHE</p></li>\n
						<li><img src=\"images/cross.png\" onclick=\"nascondiStatistiche()\"/></li>\n
					</ul>\n
					<canvas id=\"graficoStatistiche\" width=\"100\" height=\"100\"></canvas>\n
				</div>\n";
			}
			function stampaPagina(){
				echo "<img src=\"images/logo.png\"/>\n
					<form action=\"index.php\" method=\"POST\">\n
						<input type=\"submit\" name=\"gioca\" value=\"Gioca\"></input>\n
					</form>\n
					<button onclick=\"mostraModificaDati()\">MODIFICA DATI</button>\n
					<button onclick=\"mostraStatistiche()\">STATISTICHE</button>\n
					<form action=\"paginaUtente.php\" method=\"POST\">\n
						<input type=\"submit\" name=\"logout\" value=\"Logout\"></input>\n
					</form>\n";
			}

		?>
		<script>
			var vinte=<?=$_SESSION["partite"]["vinte"]?>;
			var perse=<?=$_SESSION["partite"]["perse"]?>;
			var totale=vinte+perse;

			var grafico=new Chart(document.getElementById("graficoStatistiche"),{
				type: "pie"	,
				data:{
					labels:["Vittorie","Sconfitte"],
					datasets:[{
						label:"grafico",
						backgroundColor:["Green","Red"],
						data: [vinte,perse]
					}]
				},
				options:{
					title:{
						display:true,
						text: "partite totali: "+totale	
					}
				}
			});

		</script>
	</body>
</html>
