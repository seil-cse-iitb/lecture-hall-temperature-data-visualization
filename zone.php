


<title>zone.php</title>

<?php


function lineargradient($ra,$ga,$ba,$rz,$gz,$bz,$iterationnr) {
  $colorindex = array();
  for($iterationc=1; $iterationc<=$iterationnr; $iterationc++) {
     $iterationdiff = $iterationnr-$iterationc;
     $colorindex[] = '#'.
        dechex(intval((($ra*$iterationc)+($rz*$iterationdiff))/$iterationnr)).
        dechex(intval((($ga*$iterationc)+($gz*$iterationdiff))/$iterationnr)).
        dechex(intval((($ba*$iterationc)+($bz*$iterationdiff))/$iterationnr));
  }
  return $colorindex;
}


function findmedian($arr){

    return array_sum($arr)/count($arr);


	// $count = count($arr); //total numbers in array
 //    $middleval = floor(($count-1)/2); // find the middle value, or the lowest middle value
 //    if($count % 2) { // odd number, middle is the median
 //        $median1 = $arr[$middleval];
 //    } else { // even number, calculate avg of 2 medians
 //        $low = $arr[$middleval];
 //        $high = $arr[$middleval+1];
 //        $median1 = (($low+$high)/2);
 //    }
 //    return $median1;
	
	
}


// ----------------------- Details need to be change ------------------------------------------------------

// experiment details

$room_name="Lecture Hall";



$epoch=time()+19800-7200; 
$dt = new DateTime("@$epoch"); 
$experiment_start_time=$dt->format('Y-m-d H:i:s');

$epoch=time()+19800; 
$dt = new DateTime("@$epoch"); 
$experiment_end_time=$dt->format('Y-m-d H:i:s');
	
$occupancy_precentage ="0%";

$total_hvacs="7";
$on_hvacs="5 --> AC1,AC3,AC5,AC6,AC7(AC2 and AC4 are not working)";

$set_point_of_hvacs="18";
$ac_swing="OFF";


$lights_status="ON";
$fans_status="OFF";

$event_name=" -- ";
$ambient_temp="No Record";


$hvac_turn_on_time="2017-08-11 21:05:00";
$hvac_turn_off_time="2017-08-11 22:58:00";

$thermal_comfort="No occupancy";
$other_comments="";


$servername = "10.129.23.161";
$username = "reader";
$password = "datapool";
$dbname = "cooling";

$room_name_in_table="LH"; // LH or SCC_305 or SCC_205

$rows=5;
$cols=36;

$rows_with_zero_nodes=array();

// $rows_with_zero_nodes[2]=1; //row 2 having 0 nodes
// $rows_with_zero_nodes[4]=1; //row 4 having 0 nodes

// -2 Seat is not present
// 0 Seat is present but no sensor node
// -1 Lobby space
// Othrewise put Node ID

// LH sensor node placement
$nodes = array(
    // (col 1,col 2,col 3)
    array(-2,-2,-2,-2,-2,-2,-2,-2,0,13,0,0,0,20,0,0,0,0,5,-1,0,0,28,0,0,0,26,0,-2,-2,-2,-2,-2,-2,-2,-2),// row 1
    array(-2,-2,-2,-2,-2,-2,12,0,0,0,4,0,0,0,0,2,0,0,0,-1,34,0,0,0,0,18,0,0,0,0,21,-2,-2,-2,-2,-2),// row 2
    array(-2,-2,-2,0,0,0,1,0,0,0,0,24,0,0,0,0,0,11,0,-1,0,0,32,0,0,0,0,0,0,33,0,0,0,25,-2,-2),// row 3
    array(17,0,0,0,0,0,16,0,0,0,0,0,0,0,15,0,0,0,0,-1,9,0,0,0,29,0,0,0,23,0,0,0,31,0,22,0),// row 4
   array(0,6,0,0,0,0,7,0,0,0,0,10,0,0,0,0,0,0,8,-1,-2,-2,-2,-2,-2,-2,-2,-2,-2,-2,-2,-2,-2,-2,-2,-2)// row 5
);



$zone[1]=array( 18,34,11, 2,5,20,28);
$zone[2]=array( 1, 4,12,13);
$zone[3]=array( 25,26, 21);
$zone[4]=array(  29,32,9);
$zone[5]=array(  22,31,33);
$zone[6]=array( 6,7,8,10,15,16,17,24 );

// SCC_205 sensor node placement
// $nodes = array(
//     // (col 1,col 2,col 3)
//     array(0,32,-1,0,23,-1,0,22),// row 1
//     array(0,0,-1,0,0,-1,0,0),// row 2
//     array(0,35,-1,0,34,-1,0,33),// row 3
//     array(0,0,-1,0,0,-1,0,0),// row 4
//     array(0,46,-1,0,44,-1,0,39),// row 5
//     array(0,0,-1,0,0,-1,0,0)// row 6
// );

// SCC_305 sensor node placement
// $nodes = array(
//     // (col 1,col 2,col 3)
//     array(0,29,-1,0,25,-1,0,21),// row 1
//     array(0,0,-1,0,0,-1,0,0),// row 2
//     array(0,38,-1,0,31,-1,0,36),// row 3
//     array(0,0,-1,0,0,-1,0,0),// row 4
//     array(0,45,-1,0,42,-1,0,41),// row 5
//     array(0,0,-1,0,0,-1,0,0)// row 6
// );


// ----------------------------------------------------------------------------------------------------------------


echo "<center><h1>Lecture hall last 2 hrs data</center></h1>";
echo "<center><h3>Sensor nodes placement is given in below image</center></h3>";

echo "<img src=\"lh.jpg\" >";
// echo "<p style=\"font-size: large;\"><b>Room Name: </b>".$room_name."<br>";
// echo "<b>Experiment start time: </b>".$experiment_start_time."<br>";
// echo "<b>Experiment end time: </b>".$experiment_end_time."<br>";
// echo "<b>Occupancy: </b>".$occupancy_precentage."<br>";
// echo "<b>Total HVACs: </b>".$total_hvacs."<br>";
// echo "<b>ON HVACs: </b>".$on_hvacs."<br>";
// echo "<b>Set Point of HVACs: </b>".$set_point_of_hvacs."<br>";
// echo "<b>AC Swing: </b>".$ac_swing."<br>";
// echo "<b>Lights Status: </b>".$lights_status."<br>";
// echo "<b>Fans Status: </b>".$fans_status."<br>";
// echo "<b>Event Name: </b>".$event_name."<br>";
// echo "<b>Ambient Temperature: </b>".$ambient_temp."<br>";
// echo "<b>HVAC Turn ON Time: </b>".$hvac_turn_on_time."<br>";
// echo "<b>HVAC Turn OFF Time: </b>".$hvac_turn_off_time."<br>";
// echo "<b>Thermal comfort attained (Collect through user feedback): </b>".$thermal_comfort."<br>";
// echo "<b>Other Comments: </b>".$other_comments."<br></p>";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $sql = "INSERT INTO event (event_date, start_time, end_time,description) VALUES ('$d', '$st','$et','$de')";

// if ($conn->query($sql) === TRUE) {
//     echo "<b>Event ID : ".$conn->insert_id." created successfully</b><br>";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }
// $conn->close();
// echo "<button onclick=\"history.go(-1);\">Back </button>";
// }
// else if($an=="deleteevent")
// {
// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// $id=$_POST["eventid"];




// room_name = LH or SEIL 

// -2 Seat is not present
// 0 Seat is present but no sensor node
// -1 Lobby space
// Othrewise put Node ID

// Suggestion: Try to place nodes in such a way that Any seat is covered by some nodes in all 4 directions so that we can estimate temp of such particular seat based on other nodes values




$temperature=[];
$temperature1=[];

$humidity=[];


// SELECT * FROM cooling.temperature_analysis WHERE room_name="LH" and timestamp<"2017-08-12 22:50:00" and timestamp>"2017-08-12 22:47:00" order by timestamp DESC


// $sql = "SELECT node_id,temperature,humidity FROM cooling.temperature_analysis WHERE room_name=\"".$room_name_in_table."\" and timestamp<\"1502578200\" GROUP BY (node_id) order by timestamp DESC";
$experiment_start_time1=$experiment_start_time;
if(isset($_POST['timee'])){
$epoch=strtotime($experiment_start_time1);

$epoch=$epoch+19800;
$epoch=$epoch+($_POST['timee'])*60;
$dt = new DateTime("@$epoch");  

// convert UNIX timestamp to PHP DateTime
$experiment_start_time1=$dt->format('Y-m-d H:i:s');
}


$epoch=strtotime($experiment_start_time1);
$epoch=$epoch+19800; // to set GMT + 5:30 IST time
$epoch=$epoch+240;
$dt = new DateTime("@$epoch"); 
$experiment_start_time_plus_three=$dt->format('Y-m-d H:i:s');


// $experiment_start_time_plus_three="2017-08-12 23:35:00";


// echo $experiment_start_time_plus_three;







$sql = "SELECT node_id,temperature,humidity FROM cooling.temperature_analysis WHERE room_name=\"".$room_name_in_table."\" and timestamp>\"".$experiment_start_time1."\" and timestamp<\"".$experiment_start_time_plus_three."\"";

// $sql = "SELECT node_id,temperature,humidity FROM cooling.temperature_analysis WHERE room_name=\"".$room_name_in_table."\" and timestamp<\"".$experiment_end_time."\" and timestamp>\"2017-08-13 01:40:00\"";

// echo $sql;
// SELECT DISTINCT node_id,temperature,humidity FROM temperature_analysis WHERE room_name=\"LH\" ORDER BY timestamp DESC";

$result = $conn->query($sql);
if ($result->num_rows == 0) { 	

    echo "<b>Something went wrong! Plz contact page admin.</b><br>";
}

else{
// echo"<html><body>";
	// echo"<table style=\"width:100%\">
 //  <tr>
 //    <th>Firstname</th>
 //    <th>Lastname</th> 
 //    <th>Age</th>
 //  </tr>
 //  <tr>
 //    <td>Jill</td>
 //    <td>Smith</td> 
 //    <td>50</td>
 //  </tr>
 //  <tr>
 //    <td>Eve</td>
 //    <td>Jackson</td> 
 //    <td>94</td>
 //  </tr>
// ";

	// echo $sql;


    // 3 row
    // 34 col
    $nodetotemp =[];
    $nodetohum =[];


    echo "<style>


    #table1
{
    table-layout: fixed;
    width: 1250px;
    height: 10px;
    text-align:center;
}
    table
{
    table-layout: fixed;
    width: 1250px;
    height: 125px;
    text-align:center;
}

p { -ms-writing-mode: lr-tb;
-webkit-writing-mode: horizontal-tb;
-moz-writing-mode: horizontal-tb;
-ms-writing-mode: horizontal-tb;        
writing-mode: horizontal-tb; }

img
{
  height: 80%;
    width: 100%;
}


#grad{
height:200px;
width:20px;
overflow: hidden;
float:left;
background: linear-gradient(#FF1400,#d7ff00, #0022FF);
}
</style>";



echo " <script src=\"https://code.highcharts.com/highcharts.js\"></script>
<script src=\"https://code.highcharts.com/modules/exporting.js\"></script>

<div id=\"container2\" style=\"min-width: 310px; max-width: 1000px; height: 400px; margin: 0 auto\"></div>
<div id=\"container3\" style=\"min-width: 310px; max-width: 1000px; height: 400px; margin: 0 auto\"></div>
<div id=\"container\" style=\"min-width: 310px; max-width: 1000px; height: 400px; margin: 0 auto\"></div>
<div id=\"container1\" style=\"min-width: 310px; max-width: 1000px; height: 400px; margin: 0 auto\"></div>

<script>

//temp vs time zone wise

Highcharts.chart('container2', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Temperature vs Time'
    },
    subtitle: {
        text: 'Temperature vs Time data in row wise'
    },
    xAxis: {
        type: 'datetime',
        dateTimeLabelFormats: { // don't display the dummy year
          second: '%H:%M:%S',
          minute: '%H:%M',
          hour: '%H:%M',
          day: '%e. %b',
          week: '%e. %b',
          month: '%b \'%y',
          year: '%Y'

        },
        title: {
            text: 'Date'
        }
    },
    yAxis: {
    	tickPixelInterval: 25,
        title: {
            text: 'Temperature  (*C)'
        }
        
    },
    tooltip: {
        headerFormat: '<b>{series.name}</b><br>',
        pointFormat: '{point.x:%Y-%m-%e %H:%M:%S}: {point.y:.1f} C'
    },

    plotOptions: {
        spline: {
            lineWidth: 2,
            states: {
                hover: {
                    lineWidth: 4
                }
            },
            marker: {
                enabled: false
            },
        }
    },



    series: [";

// echo "] });</script>";

$db=array();

// $db[timestamp][node_id]=$temperature;
// $db["32"]=7;


// $db[timestamp][node_id]=$temperature;
// $db["32"]=7;

// $sql1 = "SELECT timestamp,node_id,temperature,humidity FROM cooling.temperature_analysis WHERE room_name=\"".$room_name_in_table."\" and timestamp>\"".$experiment_start_time."\" and timestamp<\"".$experiment_end_time."\"";


// $result1 = $conn->query($sql1);
// if ($result1->num_rows == 0) {   

//     echo "<b>Something went wrong1! Plz contact page admin.</b><br>";
// }

// else{



//   for ($x = $rows-1; $x >=0 ; $x--)
//     for ($y = 0; $y <= $cols-1; $y++) 
//         if($nodes[$x][$y]!=0 && $nodes[$x][$y]!=-1 && $nodes[$x][$y]!=-2)
//           $nodetorow[$nodes[$x][$y]]=$x;

//   $db= array();

// while($row1 = $result1->fetch_assoc()) {
// // echo $row["node_id"];
                         
//                                 // echo "<tr><td>" . $row["node_id"]. "</td><td>" . $row["temperature"]. "</td><td>" . $row["humidity"]."</td></tr>";
//                   $tempo=strtotime($row1["timestamp"])+19800;
//                   if(!isset($db[$nodetorow[$row1["node_id"]]][floor($tempo/180)]))$db[$nodetorow[$row1["node_id"]]][floor($tempo/180)]=array();
//                          array_push($db[$nodetorow[$row1["node_id"]]][floor($tempo/180)],$row1["temperature"]);
                            
//                             }
//                                 //


// // $db[1]["2017-08-12 21:10:00"]=22.3;
// // $db[1]["2017-08-12 21:11:00"]=22.4;
// // $db[1]["2017-08-12 21:12:00"]=22.5;
// // $db[2]["2017-08-12 21:10:00"]=22.6;
// // $db[2]["2017-08-12 21:11:00"]=22.7;
// // $db[2]["2017-08-12 21:12:00"]=22.8;
// // $db[3]["2017-08-12 21:10:00"]=22.9;
// // $db[3]["2017-08-12 21:11:00"]=22.0;
// // $db[3]["2017-08-12 21:12:00"]=22.1;



// // foreach(array_keys($db) as $p)
// // echo $p;
// // print_r(array_keys($db));

// foreach(array_keys($db) as $p)
// {
//   echo "{ name:'Row ".$p."',data:[";
//   foreach(array_keys($db[$p]) as $pp)
//   {
//     // echo "[Date.UTC(";
//     $tp=$pp*3;

//     $dt = new DateTime("@$tp");
//     echo $dt->format('Y').",";
//     echo $dt->format('m').",";
//     echo $dt->format('d').",";
//     echo $dt->format('H').",";
//     echo $dt->format('i').",";
//     echo $dt->format('s')."), ";
//     // foreach($db[$p][$pp] as $rf)echo $rf;
//     echo findmedian($db[$p][$pp])."],";
//     // echo 
//   }
//   echo "]},";
// }
// }


$sql1 = "SELECT timestamp,node_id,temperature,humidity FROM cooling.temperature_analysis WHERE room_name=\"".$room_name_in_table."\" and timestamp>\"".$experiment_start_time."\" and timestamp<\"".$experiment_end_time."\"";


$result1 = $conn->query($sql1);
if ($result1->num_rows == 0) {   

    echo "<b>Something went wrong1! Plz contact page admin.</b><br>";
}

else {



  for ($x = 0; $x <=$rows-1 ; $x++)
    for ($y = 0; $y <= $cols-1; $y++) 
        {if($nodes[$x][$y]!=0 && $nodes[$x][$y]!=-1 && $nodes[$x][$y]!=-2)
          
          {
              foreach($zone[1] as $z)
                  if($z==$nodes[$x][$y]) $nodetorow[$nodes[$x][$y]]=0;
              foreach($zone[2] as $z)
                  if($z==$nodes[$x][$y]) $nodetorow[$nodes[$x][$y]]=1;
              foreach($zone[3] as $z)
                  if($z==$nodes[$x][$y]) $nodetorow[$nodes[$x][$y]]=2;
              foreach($zone[4] as $z)
                  if($z==$nodes[$x][$y]) $nodetorow[$nodes[$x][$y]]=3;
              foreach($zone[5] as $z)
                  if($z==$nodes[$x][$y]) $nodetorow[$nodes[$x][$y]]=4;
              foreach($zone[6] as $z)
                  if($z==$nodes[$x][$y]) $nodetorow[$nodes[$x][$y]]=5;
          }

 // $nodetorow[$nodes[$x][$y]]=$x;


          }


while($row1 = $result1->fetch_assoc()) {
// echo $row["node_id"];
                         
                                // echo "<tr><td>" . $row["node_id"]. "</td><td>" . $row["temperature"]. "</td><td>" . $row["humidity"]."</td></tr>";
                    $tempo=strtotime($row1["timestamp"])+19800;
                  if(isset($nodetorow[$row1["node_id"]]) && !isset($db[$nodetorow[$row1["node_id"]]][floor($tempo/180)]))$db[$nodetorow[$row1["node_id"]]][floor($tempo/180)]=array();
                         if(isset($nodetorow[$row1["node_id"]]) )array_push($db[$nodetorow[$row1["node_id"]]][floor($tempo/180)],$row1["temperature"]);

                  // $tempo=strtotime($row1["timestamp"])+19800;
                  //        array_push($db[$nodetorow[$row1["node_id"]]][$tempo/3],($row1["temperature"]));
                         // $nodetohum[$row1["node_id"]]=$row1["humidity"];
                            }
                                //
}

// $db[1]["2017-08-12 21:10:00"]=22.3;
// $db[1]["2017-08-12 21:11:00"]=22.4;
// $db[1]["2017-08-12 21:12:00"]=22.5;
// $db[2]["2017-08-12 21:10:00"]=22.6;
// $db[2]["2017-08-12 21:11:00"]=22.7;
// $db[2]["2017-08-12 21:12:00"]=22.8;
// $db[3]["2017-08-12 21:10:00"]=22.9;
// $db[3]["2017-08-12 21:11:00"]=22.0;
// $db[3]["2017-08-12 21:12:00"]=22.1;



// foreach(array_keys($db) as $p)
// echo $p;
// print_r(array_keys($db));

foreach(array_keys($db) as $p)
{
  echo "{ name:'Zone ".($p+1)."',data:[";
  foreach(array_keys($db[$p]) as $pp)
  {
    echo "[Date.UTC(";
    $tp=$pp*180;

    $dt = new DateTime("@$tp");
    echo $dt->format('Y').",";
    echo $dt->format('m').",";
    echo $dt->format('d').",";
    echo $dt->format('H').",";
    echo $dt->format('i').",";
    echo $dt->format('s')."), ";
    echo findmedian($db[$p][$pp])."],";
  }
  echo "]},";
}

echo "] });

//temp vs humidity row wise

Highcharts.chart('container3', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Humidity vs Time'
    },
    subtitle: {
        text: 'Humidity vs Time data in row wise'
    },
    xAxis: {
        type: 'datetime',
        dateTimeLabelFormats: { // don't display the dummy year
          second: '%H:%M:%S',
          minute: '%H:%M',
          hour: '%H:%M',
          day: '%e. %b',
          week: '%e. %b',
          month: '%b \'%y',
          year: '%Y'

        },
        title: {
            text: 'Date'
        }
    },
    yAxis: {
    		tickPixelInterval: 10,
        title: {
            text: 'Humidity  (RH)'
        }
        
    },
    tooltip: {
        headerFormat: '<b>{series.name}</b><br>',
        pointFormat: '{point.x:%Y-%m-%e %H:%M:%S}: {point.y:.1f} RH'
    },

    plotOptions: {
        spline: {
            lineWidth: 2,
            states: {
                hover: {
                    lineWidth: 4
                }
            },
            marker: {
                enabled: false
            },
        }
    },



    series: [";

// echo "] });</script>";

$db=array();

// $db[timestamp][node_id]=$temperature;
// $db["32"]=7;


// $db[timestamp][node_id]=$temperature;
// $db["32"]=7;

// $sql1 = "SELECT timestamp,node_id,temperature,humidity FROM cooling.temperature_analysis WHERE room_name=\"".$room_name_in_table."\" and timestamp>\"".$experiment_start_time."\" and timestamp<\"".$experiment_end_time."\"";


// $result1 = $conn->query($sql1);
// if ($result1->num_rows == 0) {   

//     echo "<b>Something went wrong1! Plz contact page admin.</b><br>";
// }

// else{



//   for ($x = $rows-1; $x >=0 ; $x--)
//     for ($y = 0; $y <= $cols-1; $y++) 
//         if($nodes[$x][$y]!=0 && $nodes[$x][$y]!=-1 && $nodes[$x][$y]!=-2)
//           $nodetorow[$nodes[$x][$y]]=$x;

//   $db= array();

// while($row1 = $result1->fetch_assoc()) {
// // echo $row["node_id"];
                         
//                                 // echo "<tr><td>" . $row["node_id"]. "</td><td>" . $row["temperature"]. "</td><td>" . $row["humidity"]."</td></tr>";
//                   $tempo=strtotime($row1["timestamp"])+19800;
//                   if(!isset($db[$nodetorow[$row1["node_id"]]][floor($tempo/180)]))$db[$nodetorow[$row1["node_id"]]][floor($tempo/180)]=array();
//                          array_push($db[$nodetorow[$row1["node_id"]]][floor($tempo/180)],$row1["temperature"]);
                            
//                             }
//                                 //


// // $db[1]["2017-08-12 21:10:00"]=22.3;
// // $db[1]["2017-08-12 21:11:00"]=22.4;
// // $db[1]["2017-08-12 21:12:00"]=22.5;
// // $db[2]["2017-08-12 21:10:00"]=22.6;
// // $db[2]["2017-08-12 21:11:00"]=22.7;
// // $db[2]["2017-08-12 21:12:00"]=22.8;
// // $db[3]["2017-08-12 21:10:00"]=22.9;
// // $db[3]["2017-08-12 21:11:00"]=22.0;
// // $db[3]["2017-08-12 21:12:00"]=22.1;



// // foreach(array_keys($db) as $p)
// // echo $p;
// // print_r(array_keys($db));

// foreach(array_keys($db) as $p)
// {
//   echo "{ name:'Row ".$p."',data:[";
//   foreach(array_keys($db[$p]) as $pp)
//   {
//     // echo "[Date.UTC(";
//     $tp=$pp*3;

//     $dt = new DateTime("@$tp");
//     echo $dt->format('Y').",";
//     echo $dt->format('m').",";
//     echo $dt->format('d').",";
//     echo $dt->format('H').",";
//     echo $dt->format('i').",";
//     echo $dt->format('s')."), ";
//     // foreach($db[$p][$pp] as $rf)echo $rf;
//     echo findmedian($db[$p][$pp])."],";
//     // echo 
//   }
//   echo "]},";
// }
// }


$sql1 = "SELECT timestamp,node_id,temperature,humidity FROM cooling.temperature_analysis WHERE room_name=\"".$room_name_in_table."\" and timestamp>\"".$experiment_start_time."\" and timestamp<\"".$experiment_end_time."\"";


$result1 = $conn->query($sql1);
if ($result1->num_rows == 0) {   

    echo "<b>Something went wrong1! Plz contact page admin.</b><br>";
}

else{



  for ($x = 0; $x <=$rows-1 ; $x++)
    for ($y = 0; $y <= $cols-1; $y++) 
        if($nodes[$x][$y]!=0 && $nodes[$x][$y]!=-1 && $nodes[$x][$y]!=-2)
          $nodetorow[$nodes[$x][$y]]=$x;

while($row1 = $result1->fetch_assoc()) {
// echo $row["node_id"];
                         
                                // echo "<tr><td>" . $row["node_id"]. "</td><td>" . $row["temperature"]. "</td><td>" . $row["humidity"]."</td></tr>";
                    $tempo=strtotime($row1["timestamp"])+19800;
                  if(isset($nodetorow[$row1["node_id"]]) && !isset($db[$nodetorow[$row1["node_id"]]][floor($tempo/180)]))$db[$nodetorow[$row1["node_id"]]][floor($tempo/180)]=array();
                         if(isset($nodetorow[$row1["node_id"]]) )array_push($db[$nodetorow[$row1["node_id"]]][floor($tempo/180)],$row1["humidity"]);

                  // $tempo=strtotime($row1["timestamp"])+19800;
                  //        array_push($db[$nodetorow[$row1["node_id"]]][$tempo/3],($row1["temperature"]));
                         // $nodetohum[$row1["node_id"]]=$row1["humidity"];
                            }
                                //
}

// $db[1]["2017-08-12 21:10:00"]=22.3;
// $db[1]["2017-08-12 21:11:00"]=22.4;
// $db[1]["2017-08-12 21:12:00"]=22.5;
// $db[2]["2017-08-12 21:10:00"]=22.6;
// $db[2]["2017-08-12 21:11:00"]=22.7;
// $db[2]["2017-08-12 21:12:00"]=22.8;
// $db[3]["2017-08-12 21:10:00"]=22.9;
// $db[3]["2017-08-12 21:11:00"]=22.0;
// $db[3]["2017-08-12 21:12:00"]=22.1;



// foreach(array_keys($db) as $p)
// echo $p;
// print_r(array_keys($db));

foreach(array_keys($db) as $p)
{
  echo "{ name:'Row ".($p+1)."',data:[";
  foreach(array_keys($db[$p]) as $pp)
  {
    echo "[Date.UTC(";
    $tp=$pp*180;

    $dt = new DateTime("@$tp");
    echo $dt->format('Y').",";
    echo $dt->format('m').",";
    echo $dt->format('d').",";
    echo $dt->format('H').",";
    echo $dt->format('i').",";
    echo $dt->format('s')."), ";
    echo findmedian($db[$p][$pp])."],";
  }
  echo "]},";
}

echo "] });


// temp vs time node wise


Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Temperature vs Time'
    },
    subtitle: {
        text: 'Temperature vs Time data node wise'
    },
    xAxis: {
        type: 'datetime',
        dateTimeLabelFormats: { // don't display the dummy year
          second: '%H:%M:%S',
          minute: '%H:%M',
          hour: '%H:%M',
          day: '%e. %b',
          week: '%e. %b',
          month: '%b \'%y',
          year: '%Y'

        },
        title: {
            text: 'Date'
        }
    },
    yAxis: {
    		tickPixelInterval: 25,
        title: {
            text: 'Temperature  (*C)'
        }
        
    },
    tooltip: {
        headerFormat: '<b>{series.name}</b><br>',
        pointFormat: '{point.x:%Y-%m-%e %H:%M:%S}: {point.y:.1f} C'
    },

    plotOptions: {
        spline: {
            lineWidth: 1,
            states: {
                hover: {
                    lineWidth: 3
                }
            },
            marker: {
                enabled: false
            },
        }
    },



    series: [";

// echo "] });</script>";

$db=array();

// $db[timestamp][node_id]=$temperature;
// $db["32"]=7;

$sql1 = "SELECT timestamp,node_id,temperature,humidity FROM cooling.temperature_analysis WHERE room_name=\"".$room_name_in_table."\" and timestamp>\"".$experiment_start_time."\" and timestamp<\"".$experiment_end_time."\"";


$result1 = $conn->query($sql1);
if ($result1->num_rows == 0) {   

    echo "<b>Something went wrong1! Plz contact page admin.</b><br>";
}

else{


while($row1 = $result1->fetch_assoc()) {
// echo $row["node_id"];
                         
                                // echo "<tr><td>" . $row["node_id"]. "</td><td>" . $row["temperature"]. "</td><td>" . $row["humidity"]."</td></tr>";
                         $db[$row1["node_id"]][$row1["timestamp"]]=$row1["temperature"];
                         // $nodetohum[$row1["node_id"]]=$row1["humidity"];
                            }
                                // 
}


// $db[1]["2017-08-12 21:10:00"]=22.3;
// $db[1]["2017-08-12 21:11:00"]=22.4;
// $db[1]["2017-08-12 21:12:00"]=22.5;
// $db[2]["2017-08-12 21:10:00"]=22.6;
// $db[2]["2017-08-12 21:11:00"]=22.7;
// $db[2]["2017-08-12 21:12:00"]=22.8;
// $db[3]["2017-08-12 21:10:00"]=22.9;
// $db[3]["2017-08-12 21:11:00"]=22.0;
// $db[3]["2017-08-12 21:12:00"]=22.1;



// foreach(array_keys($db) as $p)
// echo $p;
// print_r(array_keys($db));

foreach(array_keys($db) as $p)
{
  echo "{ name:'Node ".$p."',data:[";
  foreach(array_keys($db[$p]) as $pp)
  {
    echo "[Date.UTC(";

    $epoch=strtotime($pp);
    $epoch=$epoch+19800;
    $dt = new DateTime("@$epoch");
    echo $dt->format('Y').",";
    echo $dt->format('m').",";
    echo $dt->format('d').",";
    echo $dt->format('H').",";
    echo $dt->format('i').",";
    echo $dt->format('s')."), ";
    echo $db[$p][$pp]."],";
  }
  echo "]},";
}

echo "] });

// humidity vs time node wise

Highcharts.chart('container1', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Humidity vs Time'
    },
    subtitle: {
        text: 'Humidity vs Time data in node wise'
    },
    xAxis: {
        type: 'datetime',
        dateTimeLabelFormats: { // don't display the dummy year
          second: '%H:%M:%S',
          minute: '%H:%M',
          hour: '%H:%M',
          day: '%e. %b',
          week: '%e. %b',
          month: '%b \'%y',
          year: '%Y'

        },
        title: {
            text: 'Date'
        }
    },
    yAxis: {
    		tickPixelInterval: 10,
        title: {
            text: 'Humidity  (RH)'
        }
        
    },
    tooltip: {
        headerFormat: '<b>{series.name}</b><br>',
        pointFormat: '{point.x:%Y-%m-%e %H:%M:%S}: {point.y:.1f} RH'
    },

    plotOptions: {
        spline: {
            lineWidth: 1,
            states: {
                hover: {
                    lineWidth: 3
                }
            },
            marker: {
                enabled: false
            },
        }
    },



    series: [";

// echo "] });</script>";

$db=array();

// $db[timestamp][node_id]=$temperature;
// $db["32"]=7;

$sql1 = "SELECT timestamp,node_id,temperature,humidity FROM cooling.temperature_analysis WHERE room_name=\"".$room_name_in_table."\" and timestamp>\"".$experiment_start_time."\" and timestamp<\"".$experiment_end_time."\"";


$result1 = $conn->query($sql1);
if ($result1->num_rows == 0) {   

    echo "<b>Something went wrong1! Plz contact page admin.</b><br>";
}

else{


while($row1 = $result1->fetch_assoc()) {
// echo $row["node_id"];
                         
                                // echo "<tr><td>" . $row["node_id"]. "</td><td>" . $row["temperature"]. "</td><td>" . $row["humidity"]."</td></tr>";
                         $db[$row1["node_id"]][$row1["timestamp"]]=$row1["humidity"];
                         // $nodetohum[$row1["node_id"]]=$row1["humidity"];
                            }
                                // 


}


// $db[1]["2017-08-12 21:10:00"]=22.3;
// $db[1]["2017-08-12 21:11:00"]=22.4;
// $db[1]["2017-08-12 21:12:00"]=22.5;
// $db[2]["2017-08-12 21:10:00"]=22.6;
// $db[2]["2017-08-12 21:11:00"]=22.7;
// $db[2]["2017-08-12 21:12:00"]=22.8;
// $db[3]["2017-08-12 21:10:00"]=22.9;
// $db[3]["2017-08-12 21:11:00"]=22.0;
// $db[3]["2017-08-12 21:12:00"]=22.1;



// foreach(array_keys($db) as $p)
// echo $p;
// print_r(array_keys($db));

foreach(array_keys($db) as $p)
{
  echo "{ name:'Node ".$p."',data:[";
  foreach(array_keys($db[$p]) as $pp)
  {
    echo "[Date.UTC(";

    $epoch=strtotime($pp);
    $epoch=$epoch+19800;
    $dt = new DateTime("@$epoch");
    echo $dt->format('Y').",";
    echo $dt->format('m').",";
    echo $dt->format('d').",";
    echo $dt->format('H').",";
    echo $dt->format('i').",";
    echo $dt->format('s')."),";
    echo $db[$p][$pp]."],";
  }
  echo "]},";
}

echo "] });


</script>";

// print_r(array_keys($db));

// $db=array();

// // $db[timestamp][node_id]=$temperature;

// $db[1]["2017-08-12 21:10:00"]=22.3;
// $db[1]["2017-08-12 21:11:00"]=22.4;
// $db[1]["2017-08-12 21:12:00"]=22.5;
// $db[2]["2017-08-12 21:10:00"]=22.6;
// $db[2]["2017-08-12 21:11:00"]=22.7;
// $db[2]["2017-08-12 21:12:00"]=22.8;
// $db[3]["2017-08-12 21:10:00"]=22.9;
// $db[3]["2017-08-12 21:11:00"]=22.0;
// $db[3]["2017-08-12 21:12:00"]=22.1;



//     {
//       name: 'Row 0',
//       data: [
//         [Date.UTC(2017,08,12,21,10,00), 10],
//         [Date.UTC(2017,08,12,21,12,00), 11],
//         [Date.UTC(2017,08,12,21,13,00), 12],
//         [Date.UTC(2017,08,12,21,16,00), 13],
//         [Date.UTC(2017,08,12,21,17,00), 14],
//         [Date.UTC(2017,08,12,21,19,00), 15],
//         [Date.UTC(2017,08,12,21,49,00), 18],
//       ]
//     }


// foreach(array_keys($db) as $p)
// {
//   echo "{ name:'Node ".$p."',data:[";
// foreach(array_keys($db[$p]) as $pp)
// {
// echo "[Date.UTC("

// $epoch=strtotime($pp);
// $dt = new DateTime("@$epoch");
// echo $dt->format('Y').",";
// echo $dt->format('m').",";
// echo $dt->format('d').",";
// echo $dt->format('H').",";
// echo $dt->format('i').",";
// echo $dt->format('s')."), ";
// echo $db[$p][$pp]."],";
// }
// echo "]},"

// }


//   array_keys($array, "blue")

// for ( $i=0; $i < count($db); $i++)
// {
// for ( $j=0; $i < count($db); $i++)

// }
// foreach($hotels as $row) {
//        foreach($row['rooms'] as $k) {
//              echo $k['boards']['board_id'];
//              echo $k['boards']['price'];
//        }
// }



// {
//       name: 'Row 0',
//       data: [
//         [Date.UTC(2017,08,12,21,10,00), 10],
//         [Date.UTC(2017,08,12,21,12,00), 11],
//         [Date.UTC(2017,08,12,21,13,00), 12],
//         [Date.UTC(2017,08,12,21,16,00), 13],
//         [Date.UTC(2017,08,12,21,17,00), 14],
//         [Date.UTC(2017,08,12,21,19,00), 15],
//         [Date.UTC(2017,08,12,21,49,00), 18],
//       ]
//     },
//         {
//       name: 'Row 1',
//       data: [
//         [Date.UTC(2017,08,12,21,10,00), 11],
//         [Date.UTC(2017,08,12,21,12,00), 12],
//         [Date.UTC(2017,08,12,21,13,00), 13],
//         [Date.UTC(2017,08,12,21,16,00), 14],
//         [Date.UTC(2017,08,12,21,17,00), 15],
//         [Date.UTC(2017,08,12,21,19,00), 16],
//         [Date.UTC(2017,08,12,21,33,00), 17],
//       ]
//     }

// var data={};

// // data.push()



// for(var i=0; i<4; i++)  {
//     data["node_id"].push({time: lab[i], temp: val[i]});
// }

// for (var key in data) {
//   final[name]=key;
//   final[data]=data[key];
// }


// for (var i = 0; i < dataa.length; i++) {
//   for (var j = 0; j < dataa[i].length; j++) {




    echo "<center><h2>Temperature values at time: ".$experiment_start_time1."</h2></center>";
    // echo"<table  border=\"2\"><tr><th>Node ID</th><th>Temperature</th><th>Humidity</th></tr>";




    while($row = $result->fetch_assoc()) {
// echo $row["node_id"];
                         
                                // echo "<tr><td>" . $row["node_id"]. "</td><td>" . $row["temperature"]. "</td><td>" . $row["humidity"]."</td></tr>";
                         $nodetotemp[$row["node_id"]]=$row["temperature"];
                         $nodetohum[$row["node_id"]]=$row["humidity"];
                            }
                                // echo"</table>";
// // echo"</body></html>";
                                
    echo "<table  align=\"center\" id=\"table1\" >";
        echo "<tr><td></td>";
        for ($y = 0; $y <= $cols-1; $y++) 
            echo "<td>".($y+1)."</td>";
        echo"</tr>";
    echo "</table>";

$tempvalues=array();
$humidityvalues=array();

$min1=100;
$max1=-1;
$min2=500;
$max2=-1;

echo"<table align=\"center\"  border=\"1\">";
  for ($x = 0; $x <=$rows-1 ; $x++)
{
        for ($y = 0; $y <= $cols-1; $y++) {
        		if(isset($nodetotemp[$nodes[$x][$y]]))
        		{
        			$temperature[$x][$y]=$nodetotemp[$nodes[$x][$y]];
	        		$humidity[$x][$y]=$nodetohum[$nodes[$x][$y]];
              $max1=max($max1,$temperature[$x][$y]);
              $max2=max($max2,$humidity[$x][$y]);
              $min1=min($min1,$temperature[$x][$y]);
	        	  $min2=min($min2,$humidity[$x][$y]);
              array_push($tempvalues,$temperature[$x][$y]);
              array_push($humidityvalues,$humidity[$x][$y]);
            }
	        }
	    }

$arr=$tempvalues;
    $count = count($arr); //total numbers in array
    $middleval = floor(($count-1)/2); // find the middle value, or the lowest middle value
    if($count % 2) { // odd number, middle is the median
        $median1 = $arr[$middleval];
    } else { // even number, calculate avg of 2 medians
        $low = $arr[$middleval];
        $high = $arr[$middleval+1];
        $median1 = (($low+$high)/2);
    }


    foreach ($arr as $value) {
        $total = $total + $value;
        }
    $average1 = ($total/$count); 


    $arr=$humidityvalues;
    $count = count($arr); //total numbers in array
    $middleval = floor(($count-1)/2); // find the middle value, or the lowest middle value
    if($count % 2) { // odd number, middle is the median
        $median2 = $arr[$middleval];
    } else { // even number, calculate avg of 2 medians
        $low = $arr[$middleval];
        $high = $arr[$middleval+1];
        $median2 = (($low+$high)/2);
    }


    foreach ($arr as $value) {
        $total = $total + $value;
        }
    $average2 = ($total/$count); 







$nodes_not_working = array();
  for ($x = $rows-1; $x >=0 ; $x--)

 {
        echo "<tr><td>".($x+1)."</td>";
        for ($y = 0; $y <= $cols-1; $y++) {
            if(isset($temperature[$x][$y]))
            echo "<td>".$nodes[$x][$y]." <br> ".$temperature[$x][$y]."</td>";
            else if($nodes[$x][$y]==-2)
            echo "<td> </td>";
            else if($nodes[$x][$y]==0){
                 echo "<td>X</td>";  
            }  
            else  if($nodes[$x][$y]==-1)
            echo "<td>|</td>";
            else{
            echo "<td>xx.x</td>";
            	array_push($nodes_not_working,$nodes[$x][$y]);
            }
            // echo $nodes[$x][$y];
        }
        echo"</tr>";	
   	} 

    echo "</table><br><br><br>";

  for ($x = 0; $x <=$rows-1 ; $x++)
 {
        for ($y = 0; $y <= $cols-1; $y++) {
      		if($rows_with_zero_nodes[$x+1]!=1)
      		{
      			if(!isset($temperature[$x][$y]) && $nodes[$x][$y]!=-2  && $nodes[$x][$y]!=-1 )
      			{	
      				$t1=$y-1;
      				while($t1>=0 && !isset($temperature[$x][$t1]))$t1--;
      				$t2=$y+1;
      				while($t2<$cols && !isset($temperature[$x][$t2]))$t2++;
      				if($t1!=-1 && $t2!=$cols){
                $temperature[$x][$y]=round((($t2-$y)*$temperature[$x][$t1]+($y-$t1)*$temperature[$x][$t2])/(($t2-$t1)),1);
      					$humidity[$x][$y]=round((($t2-$y)*$humidity[$x][$t1]+($y-$t1)*$humidity[$x][$t2])/(($t2-$t1)),1);
      				}
      				else if ($t2==$cols) {
                $temperature[$x][$y]=$temperature[$x][$t1];
      					$humidity[$x][$y]=$humidity[$x][$t1];
              }
      				else if ($t1==-1){
                $temperature[$x][$y]=$temperature[$x][$t2];
      					$humidity[$x][$y]=$humidity[$x][$t2];
              }
      			}
      		
      		}
        }
    }

// echo $temperature[4][18];
    $min=100;
    $max=-1;
  for ($x = 0; $x <=$rows-1 ; $x++)
{
        for ($y = 0; $y <= $cols-1; $y++) {
      		if($rows_with_zero_nodes[$x+1]==1 && $nodes[$x][$y]!=-2  && $nodes[$x][$y]!=-1 )
      		{
      				if(isset($temperature[$x-1][$y]) && isset($temperature[$x+1][$y])){
                $temperature[$x][$y]=round(($temperature[$x-1][$y]+$temperature[$x+1][$y])/2,1);
      					$humidity[$x][$y]=round(($humidity[$x-1][$y]+$humidity[$x+1][$y])/2,1);
              }
      				else if(isset($temperature[$x-1][$y])){
                $temperature[$x][$y]=$temperature[$x-1][$y];
      					$humidity[$x][$y]=$humidity[$x-1][$y];
              }
      				else if(isset($temperature[$x+1][$y])){
                $temperature[$x][$y]=$temperature[$x+1][$y];
      					$humidity[$x][$y]=$humidity[$x+1][$y];
              }
      		}

      		    if(isset($temperature[$x][$y]))
      		    {
      		    	$min=min($min,$temperature[$x][$y]);
      		    	$max=max($max,$temperature[$x][$y]);
      		    }
        }
    }



// echo "<div id=\"grad\"></div>";
// echo "<div id=\"grad\"/>".$min."</div>";

$colorindex=[];

$colorindex[0]="#FF1400";
$colorindex[1]="#FF1e00";
$colorindex[2]="#FF2800";
$colorindex[3]="#FF3200";
$colorindex[4]="#FF4600";
$colorindex[5]="#FF3c00";
$colorindex[6]="#FF5000";
$colorindex[7]="#FF5a00";
$colorindex[8]="#FF6400";
$colorindex[9]="#FF6e00";
$colorindex[10]="#FF7800";
$colorindex[11]="#FF8200";
$colorindex[12]="#FF8c00";
$colorindex[13]="#FF9600";
$colorindex[14]="#FFa000";
$colorindex[15]="#FFaa00";
$colorindex[16]="#FFb400";
$colorindex[17]="#FFbe00";
$colorindex[18]="#FFc800";
$colorindex[19]="#FFd200";
$colorindex[20]="#FFdc00";
$colorindex[21]="#FFe600";
$colorindex[22]="#FFf000";
$colorindex[23]="#FFfa00";
$colorindex[24]="#fdff00";
$colorindex[25]="#d7ff00";
$colorindex[26]="#b0ff00";
$colorindex[27]="#8aff00";
$colorindex[28]="#65ff00";
$colorindex[29]="#3eff00";
$colorindex[30]="#17ff00";
$colorindex[31]="#00ff10";
$colorindex[32]="#00ff36";
$colorindex[33]="#00ff5c";
$colorindex[34]="#00ff83";
$colorindex[35]="#00ffa8";
$colorindex[36]="#00ffd0";
$colorindex[37]="#00fff4";
$colorindex[38]="#00e4ff";
$colorindex[39]="#00d4ff";
$colorindex[40]="#00c4ff";
$colorindex[41]="#00b4ff";
$colorindex[42]="#00a4ff";
$colorindex[43]="#0094ff";
$colorindex[44]="#0084ff";
$colorindex[45]="#0074ff";
$colorindex[46]="#0064ff";
$colorindex[47]="#0054ff";
$colorindex[48]="#0044ff";
$colorindex[49]="#0032ff";
$colorindex[50]="#0022ff";

//     $colorindex = lineargradient(
//   // 244,199,66,   // rgb of the start color
//   // 66,173,244, // rgb of the end color
//    255,100,0, // rgb of the start color
//   5,200,250,  // rgb of the end color
//   101          // number of colors in your linear gradient
// );

// $min=27;
// $max=29;

// echo $min;
// echo $max;

    echo "<center><h2>Humidity values at time: ".$experiment_start_time1."</h2></center>";

        echo "<table  align=\"center\" id=\"table1\" >";
        echo "<tr><td></td>";
        for ($y = 0; $y <= $cols-1; $y++) 
            echo "<td>".($y+1)."</td>";
        echo"</tr>";
    echo "</table>";


    echo"<table  align=\"center\" border=\"1\">";
  for ($x = $rows-1; $x >=0 ; $x--)
 {
        echo "<tr><td>".($x+1)."</td>";
        for ($y = 0; $y <= $cols-1; $y++) {
            echo "<td>".$humidity[$x][$y]."</td>";
        }

        echo"</tr>";
    } 
    echo "</table><br><br><br>";
            echo "<table  align=\"center\" id=\"table1\" >";
        echo "<tr><td></td>";
        for ($y = 0; $y <= $cols-1; $y++) 
            echo "<td>".($y+1)."</td>";
        echo"</tr>";
    echo "</table>";

        echo"<table  align=\"center\" border=\"1\">";
  for ($x = $rows-1; $x >=0 ; $x--)

{
        echo "<tr><td>".($x+1)."</td>";
        for ($y = 0; $y <= $cols-1; $y++) {
            echo "<td>".round($temperature[$x][$y],1)."</td>";
        }

        echo"</tr>";
    } 
    echo "</table><br><br><br>";


// $max=30;
// $min=17;

if(isset($_POST['timee']))
    echo "<center><h2>Temperature values at time: ".$experiment_start_time1."(After ".$_POST['timee']." mins)</h2></center>";
else
    echo "<center><h2>Temperature values at time: ".$experiment_start_time1."(After 0 mins)</h2></center>";


  for ($x = $rows-1; $x >=0 ; $x--)

    for ($y = 0; $y <= $cols-1; $y++) 
        if(isset($temperature[$x][$y])) 
			$temperature1[$x][$y]= 50 - (($temperature[$x][$y]-$min)*50/($max-$min));
echo "<div id=\"grad\"></div>";
    echo "<table  align=\"center\" id=\"table1\" >";
        echo "<tr><td></td>";
        for ($y = 0; $y <= $cols-1; $y++) 
            echo "<td>".($y+1)."</td>";
        echo"</tr>";
    echo "</table>";
    echo"<table  align=\"center\" border=\"1\">";
   for ($x = $rows-1; $x >=0 ; $x--)

 {
        echo "<tr><td>".($x+1)."</td>";
        for ($y = 0; $y <= $cols-1; $y++) {
        	if(isset($temperature[$x][$y]))
            echo "<td bgcolor=\"".$colorindex[round($temperature1[$x][$y])]."\";>".round($temperature[$x][$y],1)."</td>";
        else if($nodes[$x][$y]==-1)
            echo "<td bgcolor=\"#000\";></td>";
        else
            echo "<td bgcolor=\"#FFFFFF\";></td>";
        }

        echo"</tr>";
    } 
    echo "</table><br><br><br>";

// <select> 

//

//  <option value="Andean">Andean flamingo</option> <option value="Chilean">Chilean flamingo</option> <option value="Greater">Greater flamingo</option> <option value="James's">James's flamingo</option> <option value="Lesser">Lesser flamingo</option> </select>

// Read more: http://html.com/tags/select/#ixzz4smAsCs2f
// echo strtotime($experiment_start_time);


echo "<h3>Nodes which are not working (row,col) : { &nbsp;";


for($p=0;$p<count($nodes_not_working);$p++)
{
   for ($x = 0; $x <=$rows-1 ; $x++)

    for ($y = 0; $y <= $cols-1; $y++)
        if($nodes[$x][$y]==$nodes_not_working[$p])
        {
          echo $nodes[$x][$y]."-(".($x+1).", ".($y+1).")  &nbsp;";
        }
}

  // echo $nodes_not_working[$x]." ";


echo "}<br>Maximum Temperature: ".$max1.
"<br>Minimum Temperature: ".$min1.
"<br><br>Temperature Range(Max-Min): ".($max1-$min1).
"<br>Median Temperature: ".$median1.
"<br>Average Temperature: ".round($average1,1).
"<br><br>Maximum Humidity: ".$max2.
"<br>Minimum Humidity: ".$min2.
"<br>Median Humidity: ".$median2.
"<br>Average Humidity: ".round($average2,1).
"</h3>";

$temp=(strtotime($experiment_end_time)-strtotime($experiment_start_time))/300;
$temp=$temp;
echo "<center><h3><form action=\"live.php\" method=\"post\">";
echo "Show me values after <select style=\"width:50px;\"name=\"timee\">";
for($x=1;$x<$temp;$x++)
		echo "<option value=\"".($x*5)."\">".($x*5)."</option>";

echo "
</select> minutes!  <input type=\"submit\" name=\"submit\" value=\"Submit\"> 
</form></h3></center> ";


// <form action="index.php">
// Name: <input type="text" name="name">
// <input type="submit" name="submit" value="Submit">
// </form> 

//     echo"<table align=\"center\" border=\"2\">";
// for ($x = 2; $x >=0 ; $x--) {
//         echo "<tr>";
//         for ($y = 0; $y <= 33; $y++) {
//             if(isset($nodetotemp[$nodes[$x][$y]]))
//             echo "<td bgcolor=\"".$colorindex[round($nodetotemp[$nodes[$x][$y]])]."\";></td>";
//             else if($nodes[$x][$y]==-2)
//             echo "<td bgcolor=\"#ffffff\";> </td>";
//             else if($nodes[$x][$y]==0){

//                 if($nodes[$x][$y-1]!=0 && $nodes[$x][$y-1]!=-1 && $nodes[$x][$y-1]!=-2 && $nodes[$x][$y+2]!=0 && $nodes[$x][$y+2]!=-1 && $nodes[$x][$y+2]!=-2){
//                     $val=($nodetotemp[$nodes[$x][$y-1]]*2+$nodetotemp[$nodes[$x][$y+2]]*1)/3.0;
//                     echo "<td bgcolor=\"".$colorindex[round($val)]."\";></td>";
//                 }
//                 else if($nodes[$x][$y+1]!=0 && $nodes[$x][$y+1]!=-1 && $nodes[$x][$y+1]!=-2 && $nodes[$x][$y-2]!=0 && $nodes[$x][$y-2]!=-1 && $nodes[$x][$y-2]!=-2){
//                     $val=($nodetotemp[$nodes[$x][$y+1]]*2+$nodetotemp[$nodes[$x][$y-2]]*1)/3.0;
//                     echo "<td bgcolor=\"".$colorindex[round($val)]."\";></td>";
//                 }
//                 else if($nodes[$x][$y-1]!=0 && $nodes[$x][$y-1]!=-1 && $nodes[$x][$y-1]!=-2)
//                     echo"<td bgcolor=\"".$colorindex[round($nodetotemp[$nodes[$x][$y-1]])]."\";></td>";
//                 else if($nodes[$x][$y+1]!=0 && $nodes[$x][$y+1]!=-1 && $nodes[$x][$y+1]!=-2)
//                     echo"<td bgcolor=\"".$colorindex[round($nodetotemp[$nodes[$x][$y+1]])]."\";></td>";
//                    // bgcolor=\"$colorindex[$nodetotemp[$nodes[$x][$y+1]]]\";
//             }  
//             else
//             echo "<td bgcolor=\"#000\";>|</td>";
//             // echo $nodes[$x][$y];
                
//         }

//         echo"</tr>";
//     } 
//     echo "</table>";

//     echo"<table border=\"2\">";
// for ($x = 2; $x >=0 ; $x--) {
//         echo "<tr>";
//         for ($y = 0; $y <= 33; $y++) {
//             if(isset($nodetotemp[$nodes[$x][$y]]))
//             echo "<td bgcolor=\"".$colorindex[round($nodetotemp[$nodes[$x][$y]])]."\";>".$nodetotemp[$nodes[$x][$y]]."</td>";
//             else if($nodes[$x][$y]==-2)
//             echo "<td bgcolor=\"#ffffff\";> </td>";
//             else if($nodes[$x][$y]==0){

//                 if($nodes[$x][$y-1]!=0 && $nodes[$x][$y-1]!=-1 && $nodes[$x][$y-1]!=-2 && $nodes[$x][$y+2]!=0 && $nodes[$x][$y+2]!=-1 && $nodes[$x][$y+2]!=-2){
//                     $val=($nodetotemp[$nodes[$x][$y-1]]*2+$nodetotemp[$nodes[$x][$y+2]]*1)/3.0;
//                     echo "<td bgcolor=\"".$colorindex[round($val)]."\";>".round($val,1)."</td>";
//                 }
//                 else if($nodes[$x][$y+1]!=0 && $nodes[$x][$y+1]!=-1 && $nodes[$x][$y+1]!=-2 && $nodes[$x][$y-2]!=0 && $nodes[$x][$y-2]!=-1 && $nodes[$x][$y-2]!=-2){
//                     $val=($nodetotemp[$nodes[$x][$y+1]]*2+$nodetotemp[$nodes[$x][$y-2]]*1)/3.0;
//                     echo "<td bgcolor=\"".$colorindex[round($val)]."\";>".round($val,1)."</td>";
//                 }
//                 else if($nodes[$x][$y-1]!=0 && $nodes[$x][$y-1]!=-1 && $nodes[$x][$y-1]!=-2)
//                     echo"<td bgcolor=\"".$colorindex[round($nodetotemp[$nodes[$x][$y-1]])]."\";>".$nodetotemp[$nodes[$x][$y-1]]."</td>";
//                 else if($nodes[$x][$y+1]!=0 && $nodes[$x][$y+1]!=-1 && $nodes[$x][$y+1]!=-2)
//                     echo"<td bgcolor=\"".$colorindex[round($nodetotemp[$nodes[$x][$y+1]])]."\";>".$nodetotemp[$nodes[$x][$y+1]]."</td>";
//                    // bgcolor=\"$colorindex[$nodetotemp[$nodes[$x][$y+1]]]\";
//             }  
//             else
//             echo "<td bgcolor=\"#000\";>|</td>";
//             // echo $nodes[$x][$y];
                
//         }

//         echo"</tr>";
//     } 
//     echo "</table>";


                        }

// // sql to delete a record
// $sql = "DELETE FROM event WHERE event_id='$id'";

// if ($conn->query($sql) === TRUE) {
//      echo "<b>Event ID : ".$id." deleted successfully</b><br>";
// } else {
//     echo "Error deleting record: " . $conn->error;
// }
// }
// $conn->close();
// echo "<button onclick=\"history.go(-1);\">Back </button>";
// }





// else if($an=="updateevent")
//  {
// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// $id=$_POST["eventid"];
// $d = date('Y-m-d',strtotime($_POST["date"]));
// $st=$_POST['shh'].":".$_POST['smm'].":".$_POST['sss'];
// $et=$_POST['ehh'].":".$_POST['emm'].":".$_POST['ess'];
// $st = date('H:i:s', strtotime($st));
// $et = date('H:i:s', strtotime($et));
// $de=$_POST["desc"];

// $sql = "SELECT * FROM event WHERE event_id='$id'";
//                         $result = $conn->query($sql);

//                         if ($result->num_rows == 0) {

//     echo "<b>Event ID ".$id." is not available.</b><br>";

// }
// else{
// $sql = "UPDATE event SET event_date='$d', start_time='$st', end_time='$et',description='$de' WHERE event_id='$id'";
//                         if ($conn->query($sql) === TRUE) {
//     echo "<b>Event ID : ".$id." updated successfully</b><br>";
// } else {
//     echo "Error updating record: " . $conn->error;
// }
// }

// $conn->close();
// echo "<button onclick=\"history.go(-1);\">Back </button>";
// }

// else if($an=="displayallfordate")
//  {
// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// $d=$_POST["date"];
// $sql = "SELECT * FROM event WHERE event_date='$d'";
//                         $result = $conn->query($sql);

//                         if ($result->num_rows > 0) {
//                             // output data of each row
//                             echo "<table border=\"2\">
//   <tr>
//     <th>Event ID</th>
//     <th>Event Date</th> 
//     <th>Start Time</th>
//     <th>End Time</th> 
//     <th>Description</th>
//   </tr>";

//                             while($row = $result->fetch_assoc()) {

//                                 echo "<tr><td>" . $row["event_id"]. "</td><td>" . $row["event_date"]. "</td><td>" . $row["start_time"]."</td><td>". $row["end_time"]."</td><td>".$row["description"]."</td></tr>";
//                             }
//                             echo "</table>";
//                         } else {
//                             echo "No events on date : ".$d."<br>";
//                         }

// $conn->close();
// echo "<button onclick=\"history.go(-1);\">Back </button>";
// }

// else if($an=="displayallevents") {
// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// $sql = "SELECT * FROM event";
//                         $result = $conn->query($sql);

//                         if ($result->num_rows > 0) {
//                             // output data of each row
//                             echo "<table border=\"2\">
//   <tr>
//     <th>Event ID</th>
//     <th>Event Date</th> 
//     <th>Start Time</th>
//     <th>End Time</th> 
//     <th>Description</th>
//   </tr>";

//                             while($row = $result->fetch_assoc()) {

//                                 echo "<tr><td>" . $row["event_id"]. "</td><td>" . $row["event_date"]. "</td><td>" . $row["start_time"]."</td><td>". $row["end_time"]."</td><td>".$row["description"]."</td></tr>";
//                             }
//                             echo "</table>";
//                         } else {
//                             echo "0 results";
//                         }

// $conn->close();
// echo "<button onclick=\"history.go(-1);\">Back </button>";
// }








// temp vs time


// Highcharts.chart('container', {
//     chart: {
//         type: 'spline'
//     },
//     title: {
//         text: 'Temperature vs Time'
//     },
//     subtitle: {
//         text: 'Temperature vs Time data in Highcharts JS'
//     },
//     xAxis: {
//         type: 'datetime',
//         dateTimeLabelFormats: { // don't display the dummy year
//           second: '%H:%M:%S',
//           minute: '%H:%M',
//           hour: '%H:%M',
//           day: '%e. %b',
//           week: '%e. %b',
//           month: '%b \'%y',
//           year: '%Y'

//         },
//         title: {
//             text: 'Date'
//         }
//     },
//     yAxis: {
//         title: {
//             text: 'Temperature  (*C)'
//         }
        
//     },
//     tooltip: {
//         headerFormat: '<b>{series.name}</b><br>',
//         pointFormat: '{point.x:%Y-%m-%e %H:%M:%S}: {point.y:.1f} C'
//     },

//     plotOptions: {
//         spline: {
//             lineWidth: 1,
//             states: {
//                 hover: {
//                     lineWidth: 3
//                 }
//             },
//             marker: {
//                 enabled: false
//             },
//         }
//     },



//     series: [";

// // echo "] });</script>";

// $db=array();

// // $db[timestamp][node_id]=$temperature;
// // $db["32"]=7;

// $sql1 = "SELECT timestamp,node_id,temperature,humidity FROM cooling.temperature_analysis WHERE room_name=\"".$room_name_in_table."\" and timestamp>\"".$experiment_start_time."\" and timestamp<\"".$experiment_end_time."\"";


// $result1 = $conn->query($sql1);
// if ($result1->num_rows == 0) {   

//     echo "<b>Something went wrong1! Plz contact page admin.</b><br>";
// }

// else{


// while($row1 = $result1->fetch_assoc()) {
// // echo $row["node_id"];
                         
//                                 // echo "<tr><td>" . $row["node_id"]. "</td><td>" . $row["temperature"]. "</td><td>" . $row["humidity"]."</td></tr>";
//                          $db[$row1["node_id"]][$row1["timestamp"]]=$row1["temperature"];
//                          // $nodetohum[$row1["node_id"]]=$row1["humidity"];
//                             }
//                                 // 


// }


// // $db[1]["2017-08-12 21:10:00"]=22.3;
// // $db[1]["2017-08-12 21:11:00"]=22.4;
// // $db[1]["2017-08-12 21:12:00"]=22.5;
// // $db[2]["2017-08-12 21:10:00"]=22.6;
// // $db[2]["2017-08-12 21:11:00"]=22.7;
// // $db[2]["2017-08-12 21:12:00"]=22.8;
// // $db[3]["2017-08-12 21:10:00"]=22.9;
// // $db[3]["2017-08-12 21:11:00"]=22.0;
// // $db[3]["2017-08-12 21:12:00"]=22.1;



// // foreach(array_keys($db) as $p)
// // echo $p;
// // print_r(array_keys($db));

// foreach(array_keys($db) as $p)
// {
//   echo "{ name:'Node ".$p."',data:[";
//   foreach(array_keys($db[$p]) as $pp)
//   {
//     echo "[Date.UTC(";

//     $epoch=strtotime($pp);
//     $epoch=$epoch+19800;
//     $dt = new DateTime("@$epoch");
//     echo $dt->format('Y').",";
//     echo $dt->format('m').",";
//     echo $dt->format('d').",";
//     echo $dt->format('H').",";
//     echo $dt->format('i').",";
//     echo $dt->format('s')."), ";
//     echo $db[$p][$pp]."],";
//   }
//   echo "]},";
// }

// echo "] });

echo "<center><h5>&copy; 2017 Parth Lathiya</h5></center>";

?>



