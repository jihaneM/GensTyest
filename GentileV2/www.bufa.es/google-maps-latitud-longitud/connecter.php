<?php session_start(); ?>
<?php

ob_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password="root"; // Mysql password 
$db_name="gentile"; // Database name 
$tbl_name="joueur"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$login=$_POST['login']; 
$password=$_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
$login = stripslashes($login);
$password = stripslashes($password);
$login = mysql_real_escape_string($login);
$password = mysql_real_escape_string($password);
$sql="SELECT * FROM $tbl_name WHERE user='$login' and password='$password'";
$result=mysql_query($sql);

while($do = mysql_fetch_array($result)) {
	$_SESSION['email'] = $do['email'] ;
	$_SESSION['pays'] = $do['pays'] ;
	$_SESSION['nbscore'] = $do['nbscore'] ;
	
}
// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"

header("location:index.php");
}
else {
header("location:error.php");
}
ob_end_flush();

?>
<?php $_SESSION['login'] = $login ;  ?>