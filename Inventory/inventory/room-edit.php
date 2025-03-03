<?php include('includes/header.php'); ?>
<?php
$room_id = $_GET['room_id'];

if (isset($_POST['UpdateRoom'])) {
    $room_no = $_POST['room_no'];
    $room_availability = $_POST['room_availability'];
    $room_type = $_POST['room_type'];
    $pricing = $_POST['pricing'];
    $room_status = $_POST['room_status'];

     // Check if room number already exists in the database for another room
     $check_sql = "SELECT * FROM `roominventory` WHERE `room_no` = '$room_no' AND `room_id` != $room_id";
     $check_result = mysqli_query($conn, $check_sql);
 
     if (mysqli_num_rows($check_result) > 0) {
         // If a room with the same number already exists, display an error message
         $error_msg  = "A room with this number already exists.";
     } else {
         // Proceed with the update if room number is unique
         $sql = "UPDATE `roominventory` SET 
                 `room_no` = '$room_no',
                 `room_availability` = '$room_availability',
                 `room_type` = '$room_type',
                 `pricing` = '$pricing',
                 `room_status` = '$room_status'
                 WHERE room_id = $room_id";
         $result = mysqli_query($conn, $sql);
         if ($result) {
            $msg="Room updated successfully.";
         } else {
            $error_msg  = "Failed to update room: " . mysqli_error($conn);
         }
     }
 }
?>

<div class="container-fluid">
    <div class="row">
        <!-- Add Category (Center) -->
        <div class="col-md-12 custom-mx">
            <div class="container-fluid bg-white">
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Update Room
                            <a href="room-list.php" class="btn btn-success float-end rounded-5 px-4">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                    <?php if(isset($msg)):?> 
                <div class="alert alert-warning alert-dismissible fade show mb-1 mt-1 pt-1" style="height: 2rem;" role="alert">
                   <?php echo $msg; ?>
                    <button type="button" class="btn-close mt-0 pt-0" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
         <?php endif; ?>
        
                    <?php if (isset($error_msg)): ?>
                        <div class="alert alert-warning alert-dismissible fade show mb-1 mt-1 pt-1" style="height: 2rem;" role="alert">
                     <?php echo $error_msg; ?>
                        <button type="button" class="btn-close mt-0 pt-0" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                <?php endif; ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                        <?php
                            $sql = "SELECT * FROM `roominventory` WHERE room_id = $room_id LIMIT 1 ";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);     
                        ?>
                            <div class="row">
                            <div class="col-md-6 mb-4">
                                    <label for="room_no">Room No:</label>
                                    <input type="number" name="room_no" required placeholder="room number" required class="form-control rounded-5" required value="<?php echo $row['room_no']?>">
                            </div>
                        <div class="col-md-6 mb-4">
                                    <label for="room_availability">Room Availability:</label>
                                    <select name="room_availability" required class="form-select rounded-5">
                                    <option value="available" value="<?php echo ($row['room_status']=='available')?>">Available</option>
                                    <option value="occupied" value="<?php echo ($row['room_status']=='occupied')?>">Occupied</option>
                                    <option value="reserved" value="<?php echo ($row['room_status']=='reserved')?>">Reserved</option>
                                     </select>
                            </div>
                        <div class="col-md-6 mb-4">
                                    <label for="room_type">Room Type:</label>
                                    <input type="text" name="room_type" required placeholder="room type" required class="form-control rounded-5" required value="<?php echo $row['room_type']?>">
                            </div>
                        <div class="col-md-6 mb-3">
                                     <label for="room_status">Room Status:</label>
                                     <select  required class="form-select rounded-5" id="roomStatus" name="room_status" required>
                                     <option value="good" value="<?php echo ($row['room_status']=='good')?>">Good</option>
                                     <option value="damaged" value="<?php echo ($row['room_status']=='damaged')?>">Damaged</option>
                                     <option value="missing items" value="<?php echo ($row['room_status']=='missing items')?>">Missing Items</option>
                                     </select>
                            </div>     
                        <div class="col-md-6 mb-3">
                                    <label for="pricing">Pricing:</label>
                                    <input type="number" name="pricing" step="0.01" required placeholder="pricing" required class="form-control rounded-5"required value="<?php echo $row['pricing']?>">
                            </div>
                         <div class="col-md-6 mb-2 text-end">
                                    <button type="submit" name="UpdateRoom" class="btn btn-success rounded-5 w-25">Update Room</button>         
                            </div>
                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
