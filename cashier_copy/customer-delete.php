<?php 

require '../config/function.php';

$paraResultId = checkParamId('id');
if(is_numeric($paraResultId)){

    $customerId = validate($paraResultId);
    
    $customer = getById('customers', $customerId);
    if($customer['status'] == 200)
    {
        
        $response = deleteById('customers',$customerId);
        if($response)
        {
            redirect('customer-list.php', 'Customer Deleted Successfully.');
        }
        else
        {
            redirect('customer-list.php', 'Something Went Wrong.');
        }
    }
    else
    {
        redirect('customer-list.php', $customer['message']);
    }

}else{
    redirect('customer-list.php', 'Something Went Wrong.');
}

?>