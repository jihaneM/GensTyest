<?php session_start(); 

include 'connexion_bd.php';

$user = $_SESSION['login'];

if(isset($_POST['submit']) && $_POST['submit'] != NULL)
{
	
	
//On nettoie un peut la requête
$requete = htmlspecialchars(stripcslashes($_POST["gentile"]));
$requete1 = $_POST["pro"];


$query = mysql_query("SELECT * FROM gentilet WHERE gentile LIKE '%$requete%'") 
or die (mysql_error());
$query1 = mysql_query("SELECT * FROM gentilet WHERE gentile LIKE '%$requete1%'") 
or die (mysql_error()); 
 
//On utilise la fonction mysql_num_rows pour compter les résultats
$nb_resultats = mysql_num_rows($query);
$nb_resultats1 = mysql_num_rows($query1); 
//Si le nombre de résultats est différent de 0, on continue
if($nb_resultats != 0 || $nb_resultats1 ==1 || $_POST["pro"] != "default") 
{
	$result1 = mysql_query(" UPDATE joueur SET  nbscore= nbscore+1 WHERE user LIKE '%$user%' ");
 
		//Si il y a une erreur, on crie ^^
		if (!$result1) {
			die('Requ�te invalide : ' . mysql_error());
		}
		else{
		while($do = mysql_fetch_array($result1)) {
				$_SESSION['nbscore'] = $do['nbscore'] ;
	
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
}

//Si il n'y a rien

//On ferme if(isset($_POST['requete'])

//On ferme mysql
 
?>