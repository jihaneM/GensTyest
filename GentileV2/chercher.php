<?php session_start(); 

//include 'connexion_bd.php';

$connexion = mysql_connect("localhost", "root", "");

//Selection de la base de donn�es
mysql_select_db("gentile", $connexion);



$user = $_SESSION['login'];

if(isset($_POST['submit']) && $_POST['submit'] != NULL)
{
	
	
	
//On nettoie un peut la requête
$requete = htmlspecialchars(stripcslashes($_POST["gentile"]));
$requete1 = $_POST["pro"];


$query = mysql_query("SELECT * FROM commune WHERE nom_gentile LIKE '%$requete%'") or die (mysql_error());
$query1 = mysql_query("SELECT * FROM commune WHERE nom_gentile LIKE '%$requete1%'") or die (mysql_error()); 
 
//On utilise la fonction mysql_num_rows pour compter les résultats
$nb_resultats = mysql_num_rows($query);
$nb_resultats1 = mysql_num_rows($query1); 


//Si le nombre de résultats est différent de 0, on continue
		if($nb_resultats != 0 || $nb_resultats1 ==1 || $_POST["pro"] != "default") 
		{
			$res = mysql_query("UPDATE joueur SET nbscore= nbscore+1 WHERE user LIKE '%$user%'");
	 	
			/*if (!$result1) {
				die('Requ�te invalide : ' . mysql_error());
			}
			else{*/
			
			while($do = mysql_fetch_array($res)) {
				echo 	$_SESSION['nbscore'] = $do['nbscore'] ;
				}
		
		}
		?>
	<script>
		alert('Bonne reponse !!!');
		document.location.href = 'index.php';
	</script>
	<?php 
	
	 
	
}
else {
	?>
	<script>
		alert('Mauvaise reponse !!!');
		document.location.href = 'index.php';
	</script>
	
	
	
	<?php 
}
//}

  mysql_close($connexion); 
?>