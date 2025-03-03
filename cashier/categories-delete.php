<?php 

require '../config/function.php';

$paraResultId = checkParamId('id');
if(is_numeric($paraResultId)){

    $categoryId = validate($paraResultId);
    
    $category = getById('categories', $categoryId);
    if($category['status'] == 200)
    {
        
        $response = deleteById('categories',$categoryId);
        if($response)
        {
            redirect('categories-list.php', 'Category Deleted Successfully.');
        }
        else
        {
            redirect('categories-list.php', 'Something Went Wrong.');
        }
    }
    else
    {
        redirect('categories-list.php', $category['message']);
    }

}else{
    redirect('categories-list.php', 'Something Went Wrong.');
}

?>