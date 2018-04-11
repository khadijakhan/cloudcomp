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


	<?php
	
	define ('servername' , 'localhost');
	define ('username' , 'clouduser');
	define ('password' , 'clouduser2018');
	define ('database' , 'repository');

	$the_goal = "";

	//Activated when submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
  
	    if(!empty($_POST['obs']))
	    {
		echo "<h3>Tactics to resolve each obstacle: </h3> <h4>[Select the one you want to use]</h4> ";

		//Connecting to Database
		$conn = new mysqli(servername, username, password, database);

		//Checking for errors
		if ($conn->connect_error) 
		{
		    die("Connection failed: " . $conn->connect_error());
		}

		
		//Listing Tactics
		echo "<form name=\"tactics_form \" method=post  action=\"tactics_action.php\" > ";


		$o=1;   //variable to make different sets of radio buttons for tactics of different obticals.

		foreach($_POST['obs'] as $the_obs)
		{
		    
		    $the_obs=test_input($the_obs);

		    //Displaying Obstical Name
		    $query = "SELECT obsName
				FROM obstical
				WHERE obsID=".$the_obs."; " ;

		    $result = $conn->query($query);

		    if ($result->num_rows > 0) 
		    {    			
    			while($row = $result->fetch_assoc()) 
    			{
        			echo " <h5> " . $row["obsName"]. "</h5>";
    			}
		    } 

		    //Displaying Tactics for each Obstical
		    
		    $query =  " SELECT tactic.tID, tactic.tName, tactic.tDetail 
				FROM tor, tactic 
				WHERE tor.obsID=".$the_obs." 
				AND tor.tID=tactic.tID; " ;

		    $result = $conn->query($query);

		    if ($result->num_rows > 0) 
		    {
    			// output data of each row
    			while($row = $result->fetch_assoc()) 
    			{
        			echo " <input type= \"radio\" name= \"tactic" .$o. "\" value= \"" .$row["tID"]. " \" /> " . $row["tName"]. " : " . $row["tDetail"]. "<br>";
    			}
		    } 

		    else 
		    {
    			echo "No Obstacles ";
		    }

		    $o += 1;    //incrementing to change radiobutton name for tactics of next obstical

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
