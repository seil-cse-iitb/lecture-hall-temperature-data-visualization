

<title>view.php</title>


<?php
$page = $_SERVER['PHP_SELF'];
$sec = "5";
?>



<html>
    <head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
    <style>
    table
{
    text-align: center;
}
img
{
  height: 80%;
    width: 100%;
}


    </style>
    <body>
<?php





$epoch=time()+19800-600;
$dt = new DateTime("@$epoch"); 
$timee=$dt->format('Y-m-d H:i:s');


$servername = "10.129.23.161";
$username = "reader";
$password = "datapool";
$dbname = "cooling";

$room_name_in_table="LH"; // LH or SCC_305 or SCC_205

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cooling.temperature_analysis WHERE room_name=\"".$room_name_in_table."\" and timestamp>\"".$timee."\" order by timestamp desc";

$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "<b>Something went wrong! Plz contact page admin.</b><br>";
}

else {
// echo "s";
    echo "<center><h1>Last 10 minutes data of sensor nodes placed in Lecture Hall</h1>";
echo "<center><h3>Sensor nodes placement is given in below image</center></h3>";

echo "<img src=\"lh.jpg\" >";
$nw=array();
$nodes=array(1,2,4,5,6,7,8,9,10,11,12,13,15,16,17,18,19,20,21,22,23,24,25,26,28,29,31,32,33,34);
$arr=array();
    echo "<table style=\"font-size:25px;\" border=\"2\"><tr><th>Timestamp</th><th>Node id</th><th>Temperature</th><th>Humidity</th><th>Voltage</th>";
    while($row = $result->fetch_assoc()) {                         
        echo "<tr><td>" . $row["timestamp"]. "</td><td>" . $row["node_id"]. "</td><td>" . $row["temperature"]. "</td><td>" . $row["humidity"]. "</td><td>" . $row["voltage"]."</td></tr>";
		array_push($arr,$row["node_id"]);
	}
	$ans=array();
	foreach($nodes as $nww)
	{
		$f=0;
		foreach($arr as $aa)
		{	
			if($nww==$aa)$f=1;
		}
		if($f==0)
			array_push($ans,$nww);
	}
	echo "<h2>Nodes which are not working: ";
		foreach($ans as $nww)
		echo " ".$nww.", ";
			echo"</h2>";
    echo "</table></center>";
}

?>



   
    </body>
</html>
