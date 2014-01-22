<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>S'inscrire à Gentile</title>
        <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="styleInscrire.css" />
        <script src="js/modernizr.custom.63321.js"></script>
        <!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>
			body {
				background: #e1c192 url(images/3.jpg);
			}
		</style>
    </head>
    <body>
        <div class="container">
		
			
			
			<section class="main">
				<form class="form-2" action="traitement.php" method="post">
				
				
					<h1> <span class="sign-up">S'inscrire</span></h1>
					
					<p class="float">
						<label>Nom</label>
						<input type="text" name="nom" placeholder="nom">
					</p>
				
				
				
					<p class="float">
						<label>Prénom</label>
						<input type="text" name="prenom" placeholder="prenom" >
					</p>
					
					
				
				    <p class="float">
						<label>User</label>
						<input type="text" name="user" placeholder="user">
					</p>
			     	
				
					
					
				    <p class="float">
						<label for="password"><i class="icon-lock"></i>Mot de passe</label>
						<input type="password" name="password" placeholder="Password" class="showpassword">
					</p>
				
			
				  <p class="float">
						<label >email</label>
						<input type="text" name="email" placeholder="email">
					</p>
					
				
			
					
				   <p class="float">
						<label>pays</label>
						<input type="text" name="pays" placeholder="pays">
					</p>
					
									
					<p class="clearfix"> 
					   
						
							
					<script>
					   
					</script>
					<input type="submit" value="S'inscrire" onclick="return show_confirm();">
						
						<a href="index2.html" class="log-twitter">Retourner</a>  
					</p>
					
					 
					
				
					
				</form>
			</section>
			
        </div>
		<!-- jQuery if needed -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(function(){
			    $(".showpassword").each(function(index,input) {
			        var $input = $(input);
			        $("<p class='opt'/>").append(
			            $("<input type='checkbox' class='showpasswordcheckbox' id='showPassword' />").click(function() {
			                var change = $(this).is(":checked") ? "text" : "password";
			                var rep = $("<input placeholder='Password' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
			             })
			        ).append($("<label for='showPassword'/>").text("Voir mot de passe")).insertAfter($input.parent());
			    });

			    $('#showPassword').click(function(){
					if($("#showPassword").is(":checked")) {
						$('.icon-lock').addClass('icon-unlock');
						$('.icon-unlock').removeClass('icon-lock');    
					} else {
						$('.icon-unlock').addClass('icon-lock');
						$('.icon-lock').removeClass('icon-unlock');
					}
			    });
			});
		</script>
		






	
	

	
		
		
		
		
		
    </body>
</html>