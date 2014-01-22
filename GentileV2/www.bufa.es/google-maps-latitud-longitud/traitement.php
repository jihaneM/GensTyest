	
	   <?php 
	   
	  
	   if( ! empty($_POST) )
	   {
	   	 
		    
			// on se connecte à MySQL
			$db = mysql_connect('localhost','root','');
				
			// on sélectionne la base
			mysql_select_db('gentile',$db);
			
			
			$user_nom = $_POST['nom'];
		    $user_prenom= $_POST['prenom'];
		    $user_email = $_POST['email'];
			$user_user = $_POST['user']; 
			$user_pass = $_POST['password']; 
			$user_ville = $_POST['ville'];
			$user_pays = $_POST['pays'];
			
			
		
			$req = ("INSERT INTO joueur(id_joueur,nom,prénom,email,user,password,ville,pays) VALUES ('','$user_nom','$user_prenom','$user_email','$user_user','$user_pass','$user_ville','$user_pays')"); 
				
			mysql_query($req);
              
			

 } 
	   
	/*   if( ! empty($_POST) )
	   {
	   	
	   	$query  =  $_POST['nom'];
	  
	   	$connexion = mysql_connect("localhost", "root", "");

	   	mysql_select_db("gentile", $connexion);
	  
	   	$sql4 = "INSERT INTO joueur(id_joueur,nom) VALUES ('','.$user_nom.')";
	   
	   	$resultats = mysql_query($sql4);
	   
			
	   }*/
        ?> 
		