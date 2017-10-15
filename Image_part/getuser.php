<?php 
include('includes/database.php');
?>

<!DOCTYPE html>
<html>
<head></head>
<body>

<?php
$q = $_GET["q"];
    $query3 = "SELECT Id FROM zone WHERE Zone_Name='".$q."'";
    $check3 = $mysqli->query($query3) or die($mysqli->error.__LINE__);
    
    $row3=$check3->fetch_assoc();
    $a=$row3["Id"];
    $query1 = "SELECT District_Name,Id FROM district WHERE Zone_Id=$a ORDER BY Id ASC";
    $check1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
    echo '<option value="" selected="1">District</option>';
   if($check1->num_rows >0) {
        while ($row=$check1->fetch_assoc()){
            echo '<option value='.$row["District_Name"].'>'.$row["District_Name"].'</option>';
        }
    }
?>
</body>
</html>