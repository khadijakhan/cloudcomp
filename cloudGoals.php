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

	<h3>The quality goals are: </h3>

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
	
	   $sql = "SELECT goal.gID, goal.gName, goal.gDetail, sgr.sID FROM repository.goal LEFT JOIN sgr ON goal.gID = sgr.gID;";
	   $result = $conn->query($sql);
	   $countgoal=-1;  $check=0;  //to keep track of each goal

   	   if ($result->num_rows > 0) 
	   {
		echo "<table><tr><th>Goal ID</th><th>Quality Goal</th><th>Explaination (from cloud service consumer perspective) </th><th>Study</th></tr>";

		
	        // output data of each row
	        while($row = $result->fetch_assoc())
		{
		   //set check to goal-id so that we know which goal is currently being displayed.
		   $check= $row["gID"];

		   //for first entry
		   if($countgoal==-1)
		   {
			echo "<tr><td>G" . $row["gID"]. "</td><td>" .$row["gName"]. "</td> <td>" . $row["gDetail"]. "</td><td>S". $row["sID"];
			$countgoal=0;
	  	   }

		   //if goal id has changed from the previous iteration, new row of goal will be created. Otherwise we'll keep adding sources to the previous row.
		   else if($countgoal!=$check) 
		   { 
			//if there is no source, we will not type 'S' in the Study field
			if($row["sID"]!=null)
			{
	           	   echo "</td></tr><tr><td>G" . $row["gID"]. "</td><td>" .$row["gName"]. "</td> <td>" . $row["gDetail"]. "</td><td>S". $row["sID"] ;
			   $countgoal= $row["gID"];  //to keep count of goal
			}

			//but if there is a source, we will type 'S' in the Study field before sID.
			else
			{
	           	   echo "</td></tr><tr><td>G" . $row["gID"]. "</td><td>" .$row["gName"]. "</td> <td>" . $row["gDetail"]. "</td><td>". $row["sID"] ;
			   $countgoal= $row["gID"];
			}
		   }

	   	   else
		   {
			echo ", S". $row["sID"];
			
		   }

		   //setting it at the end of loop to see if goal ID changes in next iteration
		   $countgoal=$row["gID"];   
		
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
