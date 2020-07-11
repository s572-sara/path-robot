<?php
$connection = [
'host'=> 'localhost',
'user' => 'root',
'database' => 'sara'];
$mysqli=mysqli_connect($connection['host'],
$connection['user'],"",$connection['database']);

if(mysqli_connect_error()){
	die("cannot connect to database" .mysqli_connect_error());

}
?>
<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="a2.css">
 </head>
 <body>
 <p>
 <img class="img" src="333.jpg" Width="150" height="150" ></p>
 <form action="" method="post">
 
 <p> <label> RIGHT: 
           <input name="right" type="number" size="25"     >
	</label></p>
 <p> <label> FORWARD: 
           <input name="forward" type="number" size="25"  >
	</label></p>
 
         <button type="sumbit" class="but1" name="Save"  >Save </button>        
     <button  type="sumbit"  class="but2" name="Delete" >Delete</button>
	 <button type="sumbit"  class="but3" name="Start"   >Start  </button>
	 

 </form>


 </body>
 </html>
 <?php 
 if($_SERVER['REQUEST_METHOD']=== 'POST'){
 $right=(int) $_POST['right'] ;
  $forward=(int) $_POST['forward'] ;
   
   
   if (isset($_POST["Save"])){
	    
    $sql ="INSERT INTO `robots` (`right`, `forward`) VALUES ('$right','$forward')";
	
	  if(mysqli_query($mysqli, $sql)){
            // Add this line to check if recorde is insert or not 
			echo "";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
        }
		  
		$result="SELECT * FROM robots ";
		echo "<center><h2>Robot Tracking</h2>";
		echo "<center> <table border='1'>
		
		<tr> 
		<th>right</th> 
        <th>forward</th> 
       
		</tr>";
		
		if ($result= $mysqli->query($result)){
			while($row= $result->fetch_assoc())
			{
				 echo "<tr>";
				 echo "<td>" . $row['right']."</td>";
				 echo "<td>" . $row['forward']."</td>";

			echo "</tr>";
			}
			echo "</table>";
			
		}
		 mysqli_close($mysqli);  
}
elseif(isset($_POST["Delete"])){
	
	 $right='';			 
     $forward='';
     
}
elseif(isset($_POST["Start"])){
	echo '<svg class="border" width="300" height="300">
	<path  d="M 50,50 L 0, '.$forward.' h '.$right.',0 z strke-width:5"/>
	</svg>';
	

}
 }
?>