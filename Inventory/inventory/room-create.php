<?php include('includes/header.php'); ?>


<div class="container-fluid">
    <div class="row">
        <!-- Add Category (Center) -->
        <div class="col-md-12 custom-mx">
            <div class="container-fluid bg-white">
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Add Room
                            <a href="room-list.php" class="btn btn-success float-end rounded-5 px-4">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php alertMessage(); ?>
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                            <div class="col-md-6 mb-4">
                                    <label for="room_no">Room No:</label>
                                    <input type="number" name="room_no" required placeholder="room number" required class="form-control rounded-5">
                            </div>
                        <div class="col-md-6 mb-4">
                                    <label for="room_availability">Room Availability:</label>
                                    <select name="room_availability" required class="form-select rounded-5">
                                        <option value="available">Available</option>
                                        <option value="occupied">Occupied</option>
                                        <option value="reserved">Reserved</option>
                                     </select>
                            </div>
                         <div class="col-md-6 mb-4">
                                    <label for="room_type">Room Type:</label>
                                    <input type="text" name="room_type" required placeholder="room type" required class="form-control rounded-5">
                            </div>
                        <div class="col-md-6 mb-3">
                                     <label for="room_status">Room Status:</label>
                                     <select  required class="form-select rounded-5" id="roomStatus" name="room_status" required>
                                         <option value="good">Good</option>
                                         <option value="damaged">Damaged</option>
                                         <option value="missing items">Missing Items</option>
                                     </select>
                            </div>     
                        <div class="col-md-6 mb-3">
                                    <label for="pricing">Pricing:</label>
                                    <input type="number" name="pricing" step="0.01" required placeholder="pricing" required class="form-control rounded-5">
                            </div>
                         <div class="col-md-6 mb-2 text-end">
                                    <button type="submit" name="AddRoom" class="btn btn-success rounded-5 w-25">Save</button>         
                            </div>
                    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
