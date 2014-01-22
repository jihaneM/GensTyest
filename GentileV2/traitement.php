	<?php 
	   include 'connexion_bd.php';
	  
	   if( ! empty($_POST) )
	   {		
			$user_nom = $_POST['nom'];
		    $user_prenom= $_POST['prenom'];	
			$user_user = $_POST['user']; 
			$user_pass = $_POST['password']; 
			$user_email = $_POST['email'];		
			$user_pays = $_POST['pays'];
			
			
			
			
		
			$req = ("INSERT INTO joueur(id_joueur,nom,prenom,user,password,email,pays) VALUES ('','$user_nom','$user_prenom','$user_user','$user_pass','$user_email','$user_pays')"); 		
			$res=mysql_query($req);
			

			
			
			
			?> <script>
					alert('bien enregistre');
					document.location.href = "index2.html"
			</script>
			<?php 
			// verification d' un champ a la base de donnée
			
			/*if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM nombre_tabla LIKE 'nombre_campo' ")) == 1 ) echo "el campo existe" ;
			else echo "el campo no existe" ;*/
			
			
	   }
	   
        ?> 
		