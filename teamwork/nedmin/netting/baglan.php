
<?php 


try {

	$db=new PDO("mysql:host=localhost;dbname=teamwork;charset=utf8",'root','Muhammed.5716321453');
 	
 	// echo "baglantı kuruldu";


 } catch (PDOExpception $e) {

 	echo $e->getMessage();
 	
 } 
 ?>