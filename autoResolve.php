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

	
	<h3>Choose your goals: </h3>


	<form name="goals_form" action="goals_action.php" method=post >

	    <input type="checkbox" name="goal[]" value="1" />Availability</br>
	    <input type="checkbox" name="goal[]" value="2" />Scalability</br>
	    <input type="checkbox" name="goal[]" value="3" />Security</br>
	    <input type="checkbox" name="goal[]" value="4" />Performance</br>
	    <input type="checkbox" name="goal[]" value="5" />Customizability</br>
	    <input type="checkbox" name="goal[]" value="6" />Interoperability</br>
	    <input type="checkbox" name="goal[]" value="7" />Portability</br>
	    <input type="checkbox" name="goal[]" value="8" />Testability</br>
	    <input type="checkbox" name="goal[]" value="9" />Consistency</br>
	    <input type="checkbox" name="goal[]" value="10" />Reduced IT Cost</br></br>

	    <input type="submit" name="SubmitGoal" value="SUBMIT" />
	</form>	

   </div>

   <footer>
	<p> Copyrights© CloudExperience. All rights reserved. </p
   </footer>

 </div>
   


</body>


</html>
