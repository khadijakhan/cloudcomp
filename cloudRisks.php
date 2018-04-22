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

	<table>

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

		$sql = "SELECT COUNT(*) AS 'C' FROM repository.obstical;";
	   	$result = $conn->query($sql);

		if ($result->num_rows > 0) 
	   	{    // output data of each row
	             while($row = $result->fetch_assoc())
		     {	$max= $row["C"];   }
		}
	   ?>

	   <tr><th>#</th><th>Obstacle</th><th>Definition </th><th>Quality Goals</th><th>Migration Type</th><th>Study</th></tr></tr>

	   <?php for($x=1; $x <= $max; $x++) { ?>
	     <tr>

		<td> 

		     <?php  echo "O". $x ; ?> 

		</td>

		<td>
		     <?php

			$sql = "SELECT obsName FROM repository.obstical WHERE obsID = ". $x .";";
	   		$result = $conn->query($sql);

			if ($result->num_rows > 0) 
	   		{    // output data of each row
	             	     while($row = $result->fetch_assoc())
		             {	echo $row["obsName"];   }
			}
 
		     ?>
		</td>

		<td>

		     <?php

			$sql = "SELECT obsDetail FROM repository.obstical WHERE obsID = ". $x .";";
	   		$result = $conn->query($sql);

			if ($result->num_rows > 0) 
	   		{    // output data of each row
	             	     while($row = $result->fetch_assoc())
		             {	echo $row["obsDetail"];   }
			}

		     ?>

		</td>

		<td>

		     <?php
			
			$sql = "SELECT gName 
				FROM (( repository.obstical 
				LEFT JOIN repository.gor ON obstical.obsID = gor.obsID ) 
				LEFT JOIN repository.goal ON gor.gID = goal.gID)
				WHERE obstical.obsID = ". $x .";";

	   		$result = $conn->query($sql);

			if ($result->num_rows > 0) 
	   		{    // output data of each row
	             	     while($row = $result->fetch_assoc())
		             {	echo $row["gName"] .", ";   }
			}

		     ?>

		</td>

		<td>

		     <?php

			$sql = "SELECT mName 
				FROM (( repository.obstical 
				LEFT JOIN repository.mor ON obstical.obsID = mor.obsID ) 
				LEFT JOIN repository.migration ON mor.mID = migration.mID)
				WHERE obstical.obsID = ". $x .";";

	   		$result = $conn->query($sql);

			if ($result->num_rows > 0) 
	   		{    // output data of each row
	             	     while($row = $result->fetch_assoc())
		             {	echo $row["mName"] .", ";   }
			}

		     ?>

		</td>

		<td>

		     <?php

			$sql = "SELECT sID FROM ( repository.obstical LEFT JOIN repository.sor ON obstical.obsID = sor.obsID ) WHERE obstical.obsID = ". $x .";";
	   		$result = $conn->query($sql);

			if ($result->num_rows > 0) 
	   		{    // output data of each row
	             	     while($row = $result->fetch_assoc())
		             {	if($row["sID"] != NULL ) {  echo "S". $row["sID"] .", ";   } }
			}

		     ?>

		</td>

	     </tr>
	   <?php } $conn->close(); ?>

	</table>

   </div>

   <footer>
	<p> Copyrights© CloudExperience. All rights reserved. </p
   </footer>

 </div>
   


</body>


</html>
