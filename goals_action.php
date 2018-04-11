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

	<?php
	
	define ('servername' , 'localhost');
	define ('username' , 'clouduser');
	define ('password' , 'clouduser2018');
	define ('database' , 'repository');

	$the_goal = "";

	//Activated when submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
  
	    if(!empty($_POST['goal']))
	    {
		echo "<h3>Obstacles for selected goals: </h3> <h4>[Select the ones you want to resolve]</h4> ";

		//Connecting to Database
		$conn = new mysqli(servername, username, password, database);

		//Checking for errors
		if ($conn->connect_error) 
		{
		    die("Connection failed: " . $conn->connect_error());
		}

		
		//Listing Ostacles
		echo "<form name=\"obs_form \" method=post  action=\"obs_action.php\" > ";

		foreach($_POST['goal'] as $the_goal)
		{
		    $the_goal=test_input($the_goal);

		    //Displaying Goal Name
		    $query = "SELECT gName
				FROM goal
				WHERE gID=".$the_goal."; " ;

		    $result = $conn->query($query);

		    if ($result->num_rows > 0) 
		    {    			
    			while($row = $result->fetch_assoc()) 
    			{
        			echo " <h5> " . $row["gName"]. "</h5>";
    			}
		    } 

		    //Displaying Obtacles for each goal
		    
		    $query =  " SELECT obstical.obsID, obstical.obsName, obstical.obsDetail 
				FROM gor, obstical 
				WHERE gor.gID=".$the_goal." 
				AND gor.obsID=obstical.obsID; " ;

		    $result = $conn->query($query);

		    if ($result->num_rows > 0) 
		    {
    			// output data of each row
    			while($row = $result->fetch_assoc()) 
    			{
        			echo " <input type= \"checkbox\" name= \"obs[] \" value= \"". $row["obsID"]. "\" /> " . $row["obsName"]. " : " . $row["obsDetail"]. "<br>";
    			}
		    } 

		    else 
		    {
    			echo "No Obstacles ";
		    }

		}

		echo "<br/> <input type=\"submit\" name = \"SubmitObs\" value= \"SUBMIT\" /> </form>";
		
		$conn->close();
	    }

  
	}


	function test_input($data) 
	{
  	   $data = trim($data);
  	   $data = stripslashes($data);
  	   $data = htmlspecialchars($data);
  	   return $data;
	}

	?>

   </div>

   <footer>
	<p> Copyrights© CloudExperience. All rights reserved. </p
   </footer>

 </div>
   


</body>


</html>