<?php

include('../config/function.php');

if(!isset($_SESSION['productItems']))
{
    $_SESSION['productItems'] = [];
}

if(!isset($_SESSION['productItemIds']))
{
    $_SESSION['productItemIds'] = [];
}

/*
if(isset($_POST['addItem']))
{
    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);

    $checkProduct = mysqli_query($conn, "SELECT * FROM products WHERE id='$productId' LIMIT 1");
    if($checkProduct){
        if(mysqli_num_rows($checkProduct) > 0){
            $row = mysqli_fetch_assoc($checkProduct);
            if($row['stock_level'] < $quantity){
                redirect('order-create.php', 'Only '.$row['stock_level']. ' stock available!');
            }

            $productData = [
                'product_id' => $row['id'],
                'name' => $row['name'],
                'image' => $row['image'],
                'price' => $row['price'],
                'stock_level' => $quantity,
            ];

            if(!in_array($row['id'],$_SESSION['productItemIds'])){

                array_push($_SESSION['productItemIds'], $row['id']);
                array_push($_SESSION['productItems'],$productData);
            }
            else
            {
                foreach($_SESSION['productItems'] as $key => $prodSessionItem){
                    if($prodSessionItem['product_id'] == $row['id']){

                        $newQuantity = $prodSessionItem['stock_level'] + $quantity;

                        $productData = [
                            'product_id' => $row['id'],
                            'name' => $row['name'],
                            'image' => $row['image'],
                            'price' => $row['price'],
                            'stock_level' => $newQuantity,
                        ];
                        $_SESSION['productItems'][$key] = $productData;
                    }
                }
            }

            redirect('order-create.php', 'Item Added'.$row['name']);

        }else{
            redirect('order-create.php', 'No such product found');
        }

    }else{
        redirect('order-create.php', 'Something Went Wrong!');
    }
}*/



if (isset($_POST['AddProduct'])) {
    $productId = validate($_POST['product_id']);
    $name = validate($_POST['name']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);

    $checkProduct = mysqli_query($conn, "SELECT * FROM products WHERE id='$productId' LIMIT 1");
    if ($checkProduct) {
        if ($checkProduct->num_rows > 0) {
            $row = $checkProduct->fetch_assoc();

            if ($row['stock_level'] < $quantity) {
                redirect('order-create.php', 'Only '.$row['stock_level'].' stock available!');
            }

            $productData = [
                'product_id' => $row['id'],
                'name' => $row['name'],
                'image' => $row['image'],
                'price' => $row['price'],
                'stock_level' => $quantity,
            ];

            if (!in_array($row['id'], $_SESSION['productItemIds'])) {
                $_SESSION['productItemIds'][] = $row['id'];
                $_SESSION['productItems'][] = $productData;
            } else {
                foreach ($_SESSION['productItems'] as $key => $prodSessionItem) {
                    if ($prodSessionItem['product_id'] == $row['id']) {
                        $newQuantity = min($prodSessionItem['stock_level'] + $quantity, $row['stock_level']);
                        $_SESSION['productItems'][$key]['stock_level'] = $newQuantity;
                        break;
                    }
                }
            }

            redirect('order-create.php', 'Item Added: '.$row['name']);
        } else {
            redirect('order-create.php', 'No such product found');
        }
    } else {
        redirect('order-create.php', 'Something went wrong!');
    }
}


/*
function validate($input) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($input));
}

function redirect($url, $message = '') {
    if (!empty($message)) {
        $_SESSION['message'] = $message;
    }
    header("Location: $url");
    exit();
}
?>*/


/*
if(isset($_POST['addProduct']))
{
    $productId = validate($_POST['product_id']);
    $name = validate($_POST['name']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);

    $checkProduct = mysqli_query($conn, "SELECT * FROM products WHERE id='$productId' LIMIT 1");
    if($checkProduct){
        if(mysqli_num_rows($checkProduct) > 0){
            $row = mysqli_fetch_assoc($checkProduct);
            if($row['stock_level'] < $quantity){
                redirect('order-create.php', 'Only '.$row['stock_level']. ' stock available!');
            }

            $productData = [
                'product_id' => $row['id'],
                'name' => $row['name'],
                'image' => $row['image'],
                'price' => $row['price'],
                'stock_level' => $quantity,
            ];

            if(!in_array($row['id'],$_SESSION['productItemIds'])){

                array_push($_SESSION['productItemIds'], $row['id']);
                array_push($_SESSION['productItems'],$productData);
            }
            else
            {
                foreach($_SESSION['productItems'] as $key => $prodSessionItem){
                    if($prodSessionItem['product_id'] == $row['id']){

                        $newQuantity = $prodSessionItem['stock_level'] + $quantity;

                        $productData = [
                            'product_id' => $row['id'],
                            'name' => $row['name'],
                            'image' => $row['image'],
                            'price' => $row['price'],
                            'stock_level' => $newQuantity,
                        ];
                        $_SESSION['productItems'][$key] = $productData;
                    }
                }
            }

            redirect('order-create.php', 'Item Added'.$row['name']);

        }else{
            redirect('order-create.php', 'No such product found');
        }

    }else{
        redirect('order-create.php', 'Something Went Wrong!');
    }
}*/


if(isset($_POST['productIncDec']))
{
    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['stock_level']);
    
    $flag = false;
    foreach($_SESSION['productItems'] as $key => $item){
        if($item['product_id'] == $productId){
            
            $flag = true;
            $_SESSION['productItems'][$key]['stock_level'] = $quantity;

        }
    }

    if($flag){

       jsonResponse(200, 'success', 'Quantity Updated');
    }
    else
    {
        jsonResponse(500, 'error', 'Something Went Wrong. Refresh the page'); 
    }
}


if(isset($_POST['proceedToPlace']))
{
    $phone = validate($_POST['cphone']);
    $payment_mode = validate($_POST['payment_mode']);

    //Checking for customer
    $checkCustomer = mysqli_query($conn, "SELECT * FROM customer  WHERE phone='$phone' LIMIT 1");
    if($checkCustomer){
        if(mysqli_num_rows($checkCustomer) > 0)
        {
           $_SESSION['invoice_no'] = "INV-".rand(111111,999999);
           $_SESSION['cphone'] = $phone;
           $_SESSION['payment_mode'] = $payment_mode;

           jsonResponse(200, 'success', 'Customer Found');
        }
        else
        {
            $_SESSION['cphone'] = $phone;
            jsonResponse(404, 'warning', 'Customer Not Found');
        }
    }
    else
    {
        jsonResponse(500, 'error', 'Something Went Wrong');
    }
}



if(isset($_POST['saveCustomer']))
{
    $name = validate($_POST['fullname']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);

    if($name != '' && $phone != '')
    {
       $data = [
        'fullname' => $name,
        'phone' => $phone,
        'email' => $email,
       ];

       $result = insert('customer',$data);
       if($result){
           jsonResponse(200, 'success', 'Customer Created Successfully');
       }else{
           jsonResponse(500, 'error', 'Something Went Wrong');
       }
    }
    else
    {
        jsonResponse(422, 'warning', 'Please fill the required fields');
    }
}

if (isset($_POST['saveOrder'])) {
    $phone = validate($_SESSION['cphone']);
    $invoiceNo = validate($_SESSION['invoice_no']);
    $payment_mode = validate($_SESSION['payment_mode']);
    $order_placed_by_id = $_SESSION['loggedInUser']['user_id'];

    $checkCustomer = mysqli_query($conn, "SELECT * FROM customer WHERE phone='$phone' LIMIT 1");
    if (!$checkCustomer) {
        jsonResponse(500, 'error', 'Something Went Wrong');
    }

    if (mysqli_num_rows($checkCustomer) > 0) {
        $customerData = mysqli_fetch_assoc($checkCustomer);

        if (!isset($_SESSION['productItems'])) {
            jsonResponse(404, 'warning', 'No Items to place order');
        }

        $sessionProducts = $_SESSION['productItems'];

        // Calculate total amount
        $totalAmount = 0;
        foreach ($sessionProducts as $amtItem) {
            $totalAmount += $amtItem['price'] * $amtItem['stock_level'];
        }

        // Insert order data
        $data = [
            'customer_id' => $customerData['cid'],
            'tracking_no' => rand(111111, 999999),
            'invoice_no' => $invoiceNo,
            'total_amount' => $totalAmount,
            'order_date' => date('Y-m-d'),
            'order_status' => 'Confirm',
            'payment_mode' => $payment_mode,
            'order_placed_by_id' => $order_placed_by_id
        ];
        $result = insert('orders', $data);
        $lastOrderId = mysqli_insert_id($conn);

        foreach ($sessionProducts as $prodItem) {
            $productId = $prodItem['product_id'];
            $price = $prodItem['price'];
            $quantity = $prodItem['stock_level'];

            // Insert order item data
            $dataOrderItem = [
                'order_id' => $lastOrderId,
                'product_id' => $productId,
                'price' => $price,
                'quantity' => $quantity,
            ];
            $orderItemQuery = insert('order_items', $dataOrderItem);

            // Check current product quantity and update stock level
            $checkProductQuantityQuery = mysqli_query($conn, "SELECT * FROM products WHERE id='$productId'");
            $productQtyData = mysqli_fetch_assoc($checkProductQuantityQuery);
            
            // Ensure we have enough stock before processing
            if ($productQtyData['stock_level'] >= $quantity) {
                $updatedQuantity = $productQtyData['stock_level'] - $quantity;
                $dataUpdate = ['stock_level' => $updatedQuantity];
                $updateProductQty = update('products', $productId, $dataUpdate);
            } else {
                jsonResponse(400, 'error', 'Insufficient stock for product ID: ' . $productId);
            }
        }

        // Clear session variables after successful order placement
        unset($_SESSION['productItems']);
        unset($_SESSION['cphone']);
        unset($_SESSION['payment_mode']);
        unset($_SESSION['invoice_no']);

        jsonResponse(200, 'success', 'Order Placed Successfully');
    } else {
        jsonResponse(404, 'warning', 'No Customer Found');
    }
}

    

?>