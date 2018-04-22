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

		$sql = "SELECT COUNT(*) AS 'C' FROM repository.tactic;";
	   	$result = $conn->query($sql);

		if ($result->num_rows > 0) 
	   	{    // output data of each row
	             while($row = $result->fetch_assoc())
		     {	$max= $row["C"];   }
		}
	   ?>

	   <tr><th>#</th><th>Resolution Tactic</th><th>Definition </th><th>Relation to obstacle</th><th>Source</th><th>Category</th></tr></tr>

	   <?php for($x=1; $x <= $max; $x++) { ?>
	     <tr>

		<td> 

		     <?php  echo "T". $x ; ?> 

		</td>

		<td>
		     <?php

			$sql = "SELECT tName FROM repository.tactic WHERE tID = ". $x .";";
	   		$result = $conn->query($sql);

			if ($result->num_rows > 0) 
	   		{    // output data of each row
	             	     while($row = $result->fetch_assoc())
		             {	echo $row["tName"];   }
			}
 
		     ?>
		</td>

		<td>

		     <?php

			$sql = "SELECT tDetail FROM repository.tactic WHERE tID = ". $x .";";
	   		$result = $conn->query($sql);

			if ($result->num_rows > 0) 
	   		{    // output data of each row
	             	     while($row = $result->fetch_assoc())
		             {	echo $row["tDetail"];   }
			}

		     ?>

		</td>

		<td>

		     <?php
			
			$sql = "SELECT obsID FROM ( repository.tactic LEFT JOIN repository.tor ON tactic.tID=tor.tID ) WHERE tactic.tID = ". $x .";";
	   		$result = $conn->query($sql);

			if ($result->num_rows > 0) 
	   		{    // output data of each row
	             	     while($row = $result->fetch_assoc())
		             {	echo "O". $row["obsID"] .", ";   }
			}

		     ?>

		</td>

		<td>

		     <?php

			$sql = "SELECT sID FROM ( repository.tactic LEFT JOIN repository.str ON tactic.tID=str.tID ) WHERE tactic.tID = ". $x .";";
	   		$result = $conn->query($sql);

			if ($result->num_rows > 0) 
	   		{    // output data of each row
	             	     while($row = $result->fetch_assoc())
		             {	if($row["sID"] != NULL ) {  echo "S". $row["sID"] .", ";   } }
			}

		     ?>

		</td>

		<td>

		     <?php

			$sql = "SELECT cName 
				FROM (( repository.tactic 
				LEFT JOIN repository.tcr ON tactic.tID = tcr.tID ) 
				LEFT JOIN repository. category ON tcr.cID = category. cID) 
				WHERE tactic.tID = ". $x .";";

	   		$result = $conn->query($sql);

			if ($result->num_rows > 0) 
	   		{    // output data of each row
	             	     while($row = $result->fetch_assoc())
		             {	echo $row["cName"] .", ";    }
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
