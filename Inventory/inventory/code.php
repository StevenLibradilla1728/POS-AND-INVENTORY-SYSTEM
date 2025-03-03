<?php

include('../config/function.php');

if(isset($_POST['saveCashier']))
{
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);

    if($_FILES['image']['size'] > 0)
    {
        $path = "./assets/profileImg";

        // Check if the directory exists, if not, create it
        if (!is_dir($path)) {
            mkdir($path, 0777, true); // Create directory with appropriate permissions
        }
        
        // Get the file extension
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        
        // Create a unique filename using the current timestamp
        $filename = time() . '.' . $image_ext;
        
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $filename)) {
            // If the file is successfully uploaded, set the image path
            $finalImages = $path . "/" . $filename;
        } else {
            // Handle file upload failure
            $finalImages = '';
            echo "Failed to upload the image.";
        }
    }
    else
    {
        $finalImages = '';
    }

    if($name != '' && $email != '' && $password != '')
    {

        $emailCheck = mysqli_query($conn, "SELECT * FROM cashiers WHERE email='$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                redirect('cashier-create.php', 'Email Already used by another user.');
            }
        }

        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'image' => $finalImages,
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_password,
            'phone' => $phone,
        ];
        $result = insert('cashiers', $data);
        if($result){
            redirect('cashier-list.php', 'Cashier Created Successfully!');
        }else{
            redirect('cashier-create.php', 'Something Went Wrong.');
        }

    }else{
        redirect('cashier-create.php', 'Please fill required fields.');
    }
}

if(isset($_POST['updateCashier']))
{   
    $cashierId = validate($_POST['cashierId']);

    $cashierData = getbyId('cashiers', $cashierId);
    if($cashierData['status'] != 200) {
        redirect('cashier-edit.php?id='.$cashierId, 'Please fill required fields.');
    }
    
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    
    
    if ($_FILES['image']['size'] > 0) {
        // Check if the image is uploaded correctly
        echo "<pre>";
        print_r($_FILES['image']);  // Debugging - check the contents of $_FILES
        echo "</pre>";
    
        $path = "./assets/profileImg";
    
        // Check if the directory exists, if not, create it
        if (!is_dir($path)) {
            if (mkdir($path, 0777, true)) {
                echo "Directory created successfully.";
            } else {
                echo "Failed to create directory.";
                return; // Exit if the directory can't be created
            }
        }
    
        // Get the file extension
        $image_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    
        // Allowed file extensions
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($image_ext, $allowed_extensions)) {
            echo "Invalid file type.";
            return; // Exit the function or script if file type is not allowed
        }
    
        // Create a unique filename using the current timestamp
        $filename = time() . '.' . $image_ext;
    
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $filename)) {
            // If the file is successfully uploaded, set the image path
            $finalImages = $path . "/" . $filename;
            echo "Image uploaded successfully.";
    
            // Debugging: check the final image path
            echo "Final image path: " . $finalImages;
    
            // Delete the old image if it exists
            $deleteImage = "./" . $cashierData['data']['image'];
            if (!empty($cashierData['data']['image']) && file_exists($deleteImage)) {
                echo "Deleting old image: " . $deleteImage;  // Debugging line
                if (unlink($deleteImage)) {
                    echo "Old image deleted successfully.";
                } else {
                    echo "Failed to delete old image.";
                }
            }
    
        } else {
            // Handle file upload failure
            echo "Failed to upload the image.";
            $finalImages = ''; // Retain the old image if the upload fails
        }
    } else {
        // If no new image was uploaded, retain the old image
        $finalImages = $cashierData['data']['image'];
    }
    
    /*if($_FILES['image']['size'] > 0)
    {
        $path = "./assets/profileImg";
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $filename = time().'.'.$image_ext;

        move_uploaded_file($_FILES['image']['tmp_name'], $path."/".$filename);
        $finalImages = "./assets/profileImg/".$filename;

        $deleteImage = "./".$cashierData['data']['image'];
        if(file_exists($deleteImage)){
            unlink($deleteImage);
        }
    }
    else
    {
        $finalImages = $cashierData['data']['image'];
    }*/

    if($password != ''){
        $hassedPassword = password_hash($password, PASSWORD_BCRYPT);
    }else{
        $hassedPassword = $cashierData['data']['password'];
    }

    // Check if the email is already in use by another cashier
    $emailCheck = mysqli_query($conn, "SELECT * FROM cashiers WHERE email='$email' AND id != '$cashierId'");
    if(mysqli_num_rows($emailCheck) > 0){
        redirect('cashier-edit.php?id='.$cashierId, 'Email already used by another user.');
    }

    // Only proceed if both name and email are not empty
    if($name != '' && $email != '')
    {
        $data = [
            'image' => $finalImages,
            'name' => $name,
            'email' => $email,
            'password' => $hassedPassword,
            'phone' => $phone,
        ];
        $result = update('cashiers', $cashierId, $data);
        if($result){
            redirect('cashier-list.php?id='.$cashierId, 'Cashier Updated Successfully!');
        }else{
            redirect('cashier-edit.php?id='.$cashierId, 'Something Went Wrong.');
        }

    }
    else
    {
        redirect('cashier-edit.php?id='.$cashierId, 'Please fill required fields.');
    }
}


if(isset($_POST['updateCashierProfile']))
{   
    
    $cashierId = validate($_POST['cashierId']);

    $cashierData = getbyId('cashiers', $cashierId);
    if($cashierData['status'] != 200) {
        redirect('edit-profile.php?id='.$cashierId, 'Please fill required fields.');
    }
    
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    
    
    if ($_FILES['image']['size'] > 0) {
        // Check if the image is uploaded correctly
        echo "<pre>";
        print_r($_FILES['image']);  // Debugging - check the contents of $_FILES
        echo "</pre>";
    
        $path = "./assets/profileImg";
    
        // Check if the directory exists, if not, create it
        if (!is_dir($path)) {
            if (mkdir($path, 0777, true)) {
                echo "Directory created successfully.";
            } else {
                echo "Failed to create directory.";
                return; // Exit if the directory can't be created
            }
        }
    
        // Get the file extension
        $image_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    
        // Allowed file extensions
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($image_ext, $allowed_extensions)) {
            echo "Invalid file type.";
            return; // Exit the function or script if file type is not allowed
        }
    
        // Create a unique filename using the current timestamp
        $filename = time() . '.' . $image_ext;
    
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $filename)) {
            // If the file is successfully uploaded, set the image path
            $finalImages = $path . "/" . $filename;
            echo "Image uploaded successfully.";
    
            // Debugging: check the final image path
            echo "Final image path: " . $finalImages;
    
            // Delete the old image if it exists
            $deleteImage = "./" . $userData['data']['image'];
            if (!empty($userData['data']['image']) && file_exists($deleteImage)) {
                echo "Deleting old image: " . $deleteImage;  // Debugging line
                if (unlink($deleteImage)) {
                    echo "Old image deleted successfully.";
                } else {
                    echo "Failed to delete old image.";
                }
            }
    
        } else {
            // Handle file upload failure
            echo "Failed to upload the image.";
            $finalImages = ''; // Retain the old image if the upload fails
        }
    } else {
        // If no new image was uploaded, retain the old image
        $finalImages = $userData['data']['image'];
    }
    

    if($password != ''){
        $hassedPassword = password_hash($password, PASSWORD_BCRYPT);
    }else{
        $hassedPassword = $cashierData['data']['password'];
    }

    // Check if the email is already in use by another cashier
    $emailCheck = mysqli_query($conn, "SELECT * FROM cashiers WHERE email='$email' AND id != '$cashierId'");
    if(mysqli_num_rows($emailCheck) > 0){
        redirect('cashier-edit.php?id='.$cashierId, 'Email already used by another user.');
    }

    // Only proceed if both name and email are not empty
    if($name != '' && $email != '')
    {
        $data = [
            'image' => $finalImages,
            'name' => $name,
            'email' => $email,
            'password' => $hassedPassword,
            'phone' => $phone,
        ];
        $result = update('cashiers', $cashierId, $data);
        if($result){
            redirect('edit-profile.php?id='.$cashierId, 'Profile Updated Successfully!');
        }else{
            redirect('edit-profile.php?id='.$cashierId, 'Something Went Wrong.');
        }

    }
    else
    {
        redirect('edit-profile.php?id='.$cashierId, 'Please fill required fields.');
    }
}


if(isset($_POST['saveCategory']))
{
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
  

    $data = [
        'name' => $name,
        'description' => $description,
       
    ];
    $result = insert('categories', $data);
    if($result){
        redirect('categories-list.php', 'Category Created Successfully!');
    }else{
        redirect('categories-create.php', 'Something Went Wrong.');
    }
   
}

if(isset($_POST['updateCategory']))
{

    $categoryId = validate($_POST['categoryId']);

    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
   

    $data = [
        'name' => $name,
        'description' => $description,
        
    ];

    $result = update('categories',$categoryId, $data);

    if($result){
        redirect('categories-edit.php?id='.$categoryId, 'Category Updated Successfully!');
    }else{
        redirect('categories-edit.php?id='.$categoryId, 'Something Went Wrong.');
    }
}

if(isset($_POST['saveProduct']))
{
    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);

    $price = validate($_POST['price']);
    $stock_level = validate($_POST['stock_level']);
   

    if($_FILES['image']['size'] > 0)
    {
        $path = "../assets/uploads/products";
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $filename = time().'.'.$image_ext;

        move_uploaded_file($_FILES['image']['tmp_name'], $path."/".$filename);
        $finalImage = "assets/uploads/products/".$filename;
    }
    else
    {
        $finalImage = '';
    }

    $data = [
        'category_id' => $category_id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'stock_level' => $stock_level,
        'image' => $finalImage,
        
    ];

    $result = insert('products', $data);

    if($result){
        redirect('product-list.php', 'Product Created Successfully!');
    }else{
        redirect('product-create.php', 'Something Went Wrong!');
    }
}

if(isset($_POST['updateProduct']))
{
    $product_id = validate($_POST['product_id']);

    $productData = getById('products',$product_id);
    if(!$productData){
        redirect('product-list.php', 'No such product found');
    }

    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);

    $price = validate($_POST['price']);
    $stock_level = validate($_POST['stock_level']);
   

    if($_FILES['image']['size'] > 0)
    {
        $path = "../assets/uploads/products";
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $filename = time().'.'.$image_ext;

        move_uploaded_file($_FILES['image']['tmp_name'], $path."/".$filename);
        $finalImage = "assets/uploads/products/".$filename;

        $deleteImage = "../".$productData['data']['image'];
        if(file_exists($deleteImage)){
            unlink($deleteImage);
        }
    }
    else
    {
        $finalImage = $productData['data']['image'];
    }

    $data = [
        'category_id' => $category_id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'stock_level' => $stock_level,
        'image' => $finalImage,
        
    ];

    $result = update('products', $product_id, $data);

    if($result){
        redirect('product-list.php?id='.$product_id, 'Product Updated Successfully!');
    }else{
        redirect('product-edit.php?id='.$product_id, 'Something Went Wrong!');
    }
}


if(isset($_POST['saveCustomer']))
{
    
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
  
    if($name != '')
    {
        $emailCheck = mysqli_query($conn, "SELECT * FROM customers WHERE email='$email'");
        $phoneCheck = mysqli_query($conn, "SELECT * FROM customers WHERE phone='$phone'");

        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                redirect('customer-list.php', 'Email Already used by another user');
            }
        }

        if($phoneCheck){
            if(mysqli_num_rows($phoneCheck) > 0){
                redirect('customer-list.php', 'Phone Number Already used by another user');
            }
        }

        $data = [
           'name' => $name,
           'email' => $email,
           'phone' => $phone,
          
        ];

        $result = insert('customers',$data);

        if($result)
        {
             redirect('customer-list.php', 'Customer Created Successfully');
        }
        else
        {
             redirect('customer-create.php', 'Something Went Wrong');
        }
    }
    else
    {
         redirect('customer-create.php', 'Please fill required fields');
    }
}


if(isset($_POST['updateCustomer']))
{
    $customerId = validate($_POST['customerId']);
    
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    

    if($name != '')
    {
        $emailCheck = mysqli_query($conn, "SELECT * FROM customers WHERE email='$email' AND id!='$customerId'"); 
        $phoneCheck = mysqli_query($conn, "SELECT * FROM customers WHERE phone='$phone' AND id!='$customerId'");       
        
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                redirect('customer-edit.php?id='.$customerId, 'Email Already used by another user');
            }
        }

        if($phoneCheck){
            if(mysqli_num_rows($phoneCheck) > 0){
                redirect('customer-edit.php?id='.$customerId, 'Phone Number Already used by another user');
            }
        }

        $data = [
           'name' => $name,
           'email' => $email,
           'phone' => $phone,
           
        ];

        $result = update('customers', $customerId,$data);

        if($result)
        {
            redirect('customer-list.php?id='.$customerId, 'Customer Updated Successfully!');
        }
        else
        {
             redirect('customer-edit.php?id='.$customerId, 'Something Went Wrong');
        }
    }
    else
    {
         redirect('customer-edit.php?id='.$customerId, 'Please fill required fields');
    }
}



if (isset($_POST['AddRoom'])) {
    $room_no = $_POST['room_no'];
    $room_availability = $_POST['room_availability'];
    $room_type = $_POST['room_type'];
    $pricing = $_POST['pricing'];
    $room_status = $_POST['room_status'];

    // Step 1: Check if the room number already exists in the database
    $check_query = "SELECT * FROM `roominventory` WHERE `room_no` = '$room_no'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Room already exists, redirect with an error message
        header('room-create.php' , 'Room number already exists');
        exit;
    } else {
        // Step 2: If the room number does not exist, proceed with the insertion
        $sql = "INSERT INTO `roominventory`(`room_id`, `room_no`, `room_availability`, `room_type`, `pricing`, `room_status`) 
                VALUES (NULL, '$room_no', '$room_availability', '$room_type', '$pricing', '$room_status')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            redirect ('room-list.php','New Room added successfully');
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
}
?>


