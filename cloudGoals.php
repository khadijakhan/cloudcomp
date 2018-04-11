<!DOCTYPE>
<html>
<head>
   <title>Home</title>
   <link rel="stylesheet" type="text/css" href="mystyle.css" />
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
	
	   $sql = "SELECT gName, gDetail FROM repository.goal;";
	   $result = $conn->query($sql);


   	   if ($result->num_rows > 0) 
	   {
		echo "<table><tr><th>Quality Goal</th><th>Explaination (from cloud service consumer perspective) </th></tr>";

	        // output data of each row
	        while($row = $result->fetch_assoc())
		{
	           echo "<tr><td>" . $row["gName"]. "</td> <td>" . $row["gDetail"]. "</td></tr>";
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