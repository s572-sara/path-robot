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
<link rel="stylesheet" href="a3.css"> 
 </head>
 <body>
 <p>
 <img class="img" src="8.png" Width="150" height="150" ></p>
 <form  method="post" class="but"  >
 

 <p> <label> FORWARD: 
           <input name="forward" type="number"  >
	</label></p>
	<p> <label> RIGHT: 
           <input name="right" type="number"   >
	</label></p>
	<p> <label>BACKWARD: 
           <input name="backward" type="number"   >
	</label></p>
 <p> <label>LEFT: 
           <input name="left" type="number" size="25"  >
		   </label></p>


         <button type="sumbit" class="but1" name="Save"  >Save </button>        
     <button  type="sumbit"  class="but2" name="Delete" >Delete</button>
	 <button type="sumbit"  class="but3" name="Start"    >Start  </button>
	 

 </form>
 

<script>
var c = document.getElementById("myCanvas");
var ctx = c.getContext("2d");
ctx.moveTo(0,0);
ctx.lineTo(200,100);
ctx.stroke();
</script>

 </body>
 </html>
 <?php 
 if($_SERVER['REQUEST_METHOD']=== 'POST'){
 $right=(int) $_POST['right'] ;
  $forward=(int) $_POST['forward'] ;
  $backward=(int) $_POST['backward'] ;
  $left=(int) $_POST['left'] ;
   
   if (isset($_POST["Save"])){
	    
    $sql ="INSERT INTO `path` (`right`, `forward`, `backward`, `left`) VALUES ('$right','$forward','$backward','$left')";
	
	  if(mysqli_query($mysqli, $sql)){
            // Add this line to check if recorde is insert or not 
			echo "";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
        }
		  
		$result="SELECT * FROM `path` ";
		echo "<center><h2  class='center'>Robot Tracking</h2>";
		echo "<center> <table border='1' class='table'>
		
		<tr> 
		<th>right</th> 
        <th>forward</th> 
		<th>backward</th> 
        <th>left</th>
		</tr>";
		
		if ($result= $mysqli->query($result)){
			while($row= $result->fetch_assoc())
			{
				 echo "<tr>";
				 echo "<td>" . $row['right']."</td>";
				 echo "<td>" . $row['forward']."</td>";
				 echo "<td>" . $row['backward']."</td>";
				 echo "<td>" . $row['left']."</td>";
			echo "</tr>";
			}
			echo "</table>";
			
		}
		 mysqli_close($mysqli);  
}
elseif(isset($_POST["Delete"])){
	
	 $right='';			 
     $forward='';
	 $backward='';
	 $left='';
}
elseif(isset($_POST["Start"])){
	echo '<svg class="border" width="200" height="200" >
	<path  d="M 100,100 L 50,'.$forward.' h '.$right.' h '.$backward.' h '.$left.',50 z strke-width:5"/>
	
	</svg>';
	
}
 }
?>