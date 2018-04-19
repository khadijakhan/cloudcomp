<!DOCTYPE>
<html>
<head>
   <title>Home</title>
   <link rel="stylesheet" type="text/css" href="abc.css" />
</head>

<body>
 <div id="wrapper">
   <nav>
	<a href="home.php"> HOME    </a>
	<a href="cloudGoals.php">CLOUD GOALS </a>
	<a href="cloudRisks.php">CLOUD RISKS </a>
	<a href="cloudTactics.php">CLOUD TACTICS </a>
	<a href="migrationType.php">MIGRATION TYPE </a>
	<a href="evidence.php">EVIDENCE </a>
	<a href="autoResolve.php">AUTO RESOLVE </a>
	<a href="qna.php">Q&A </a>
	<a href="contactUs.php">CONTACT US </a>
   </nav>

   <div id="section">

	<h3>The cloud risks are: </h3>

	<?php
	   define ('servername' , 'localhost');
	   define ('username' , 'clouduser');
	   define ('password' , 'clouduser2018');
	   define ('database' , 'repository');

	   // Create connection
	   $conn = new mysqli(servername, username, password, database);
	   // Check connection
	   if ($conn->connect_error) 
	   {
	       die("Connection failed: " . $conn->connect_error);
	   } 
	
	   $sql = "SELECT obstical.obsID, obstical.obsName, obstical.obsDetail, sor.sID FROM repository.obstical LEFT JOIN sor ON obstical.obsID = sor.obsID;";
	   $result = $conn->query($sql);
	   $countobs=-1;  $check=0;  //to keep track of each obstacle

	   if ($result->num_rows > 0) 
	   {
		echo "<table><tr><th>#</th><th>Obstacle</th><th>Definition</th><th>Study</th></tr>";

		
	        // output data of each row
	        while($row = $result->fetch_assoc())
		{

   	           //set check to obs-id so that we know which obstacle is currently being displayed.
		   $check= $row["obsID"];

		   //for first entry
		   if($countobs==-1)
		   {
			echo "<tr><td>O" . $row["obsID"]. "</td><td>" .$row["obsName"]. "</td> <td>" . $row["obsDetail"]. "</td><td>S". $row["sID"];
			$countobs=0;
	  	   }

		   //if obstacle id has changed from the previous iteration, new row of obstacles will be created. Otherwise we'll keep adding sources to the previous row.
		   else if($countobs!=$check) 
		   { 
			//if there is no source, we will not type 'S' in the Study field
			if($row["sID"]!=null)
			{
	           	   echo "</td></tr><tr><td>O" . $row["obsID"]. "</td><td>" .$row["obsName"]. "</td> <td>" . $row["obsDetail"]. "</td><td>S". $row["sID"] ;
			   $countgoal= $row["obsID"];  //to keep count of goal
			}

			//but if there is a source, we will type 'S' in the Study field before sID.
			else
			{
	           	   echo "</td></tr><tr><td>O" . $row["obsID"]. "</td><td>" .$row["obsName"]. "</td> <td>" . $row["obsDetail"]. "</td><td>". $row["sID"] ;
			   $countgoal= $row["obsID"];
			}
		   }

	   	   else
		   {
			echo ", S". $row["sID"];
			
		   }

		   //setting it at the end of loop to see if obstacle ID changes in next iteration
		   $countobs=$row["obsID"];   
		
	        }
		
		echo "</table>";
	   }

	   else 
	   {
		echo "0 results";
	   }

	   $conn->close();	
	?>


   </div>

   <footer>
	<p> Copyrights© CloudExperience. All rights reserved. </p
   </footer>

 </div>
   


</body>


</html>
