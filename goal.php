<?php

define ('servername' , 'localhost');
define ('username' , 'webuser');
define ('password' , 'webuser2017');
define ('database' , 'repository');

//Creat Connection
$conn = new mysqli(servername, username, password, database);

//Check Connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error());
}

echo "Connected successfully". "<br/>";

$query = "select goals.gName, obs.obsName, obs.obsDetail
from goals, gor, obs
where gor.idgoals=1
and gor.idgoals=goals.idgoals
 and gor.idobs=obs.idobs;" ;
$result = $conn->query($query);

if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
        echo "Obstacle: " . $row["obsName"]. " : " . $row["obsDetail"]. "<br>";
    }
} 

else 
{
    echo "0 results";
}

$conn->close();

?>
