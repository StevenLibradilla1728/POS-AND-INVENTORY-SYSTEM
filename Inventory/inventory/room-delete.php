<?php
require '../config/function.php';

$room_id = $_GET['id'];
$sql = "DELETE FROM `roominventory` WHERE room_id=$room_id";
$result = mysqli_query($conn, $sql);

if ($result) {
    redirect ('room-list.php' , 'Record deleted successfully');

}
else {
    echo "Failed: " . mysqli_error($conn);
}

?>

