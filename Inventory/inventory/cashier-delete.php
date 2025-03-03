<?php 

require '../config/function.php';

$paraResultId = checkParamId('id');
if(is_numeric($paraResultId)){

    $cashierId = validate($paraResultId);
    
    $cashier = getById('cashiers', $cashierId);
    if($cashier['status'] == 200)
    {
        
        $cashierDeleteRes = deleteById('cashiers',$cashierId);
        if($cashierDeleteRes)
        {
            redirect('cashier-list.php', 'Cashier Deleted Successfully.');
        }
        else
        {
            redirect('cashier-list.php', 'Something Went Wrong.');
        }
    }
    else
    {
        redirect('cashier-list.php', $cashier['message']);
    }

}else{
    redirect('cashier-list.php', 'Something Went Wrong.');
}

?>