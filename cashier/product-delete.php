<?php 

require '../config/function.php';

$paraResultId = checkParamId('id');
if(is_numeric($paraResultId)){

    $productId = validate($paraResultId);
    
    $product = getById('products', $productId);
    if($product['status'] == 200)
    {
        
        $response = deleteById('products',$productId);
        if($response)
        {
            $deleteImage = "../".$product['data']['image'];
            if(file_exists($deleteImage)){
                unlink($deleteImage);
            }
            redirect('product-list.php', 'Product Deleted Successfully.');
        }
        else
        {
            redirect('product-list.php', 'Something Went Wrong.');
        }
    }
    else
    {
        redirect('product-list.php', $product['message']);
    }

}else{
    redirect('product-list.php', 'Something Went Wrong.');
}

?>