<?php include('includes/header.php'); ?>


<div class="container-fluid">
    <div class="row">
        <!-- Add Category (Center) -->
        <div class="col-md-12 custom-mx">
            <div class="container-fluid bg-white">
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Product
                            <a href="product-list.php" class="btn btn-success float-end rounded-5 px-4">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php alertMessage(); ?>
                        <form action="code.php" method="POST" enctype="multipart/form-data">

                        <?php
                         $parmValue = checkParamId('id');
                         if(!is_numeric($parmValue)){
                             echo '<h5>Id is not an integer</h5>';
                             return false;
                         }
 
                         $product = getById('products',$parmValue);
                         if($product)
                         {
                            if($product['status'] == 200)
                            {
                                ?>

                                <input type="hidden" name="product_id" value="<?= $product['data']['id']; ?>" />

                                <div class="row">
                                <div class="col-md-6 mb-4">
                                        <label for="">Select Category</label>
                                        <select name="category_id" required class="form-select rounded-5" id="">
                                             <option value="" disabled selected>select category</option>
                                             <?php 
                                             $categories = getAll('categories');
                                             if($categories){
                                                if(mysqli_num_rows($categories) > 0){
                                                    foreach($categories as $categoryItem){
                                                        ?>
                                                        <option 
                                                            value="<?= $categoryItem['id']; ?>"
                                                            <?= $product['data']['category_id'] == $categoryItem['id'] ? 'selected':''; ?>
                                                        >
                                                            <?= $categoryItem['name']; ?>
                                                        </option>   
                                                        <?php
                                                    }
                                                }
                                                else
                                                {
                                                    echo '<option value="">No Category found</option>';
                                                }
                                             }
                                             else
                                             {
                                                echo '<option value="">Something Went Wrong!</option>';
                                             }
                                             ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="">Product Name *</label>
                                        <input type="text" name="name" required value="<?= $product['data']['name']; ?>" class="form-control rounded-5">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="">Description</label>
                                        <textarea name="description" class="form-control rounded-5 h-75" rows="2"><?= $product['data']['description']; ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="">Price *</label>
                                        <input type="text" name="price" required value="<?= $product['data']['price']; ?>" class="form-control rounded-5">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Stock Level *</label>
                                        <input type="text" name="stock_level" required value="<?= $product['data']['stock_level']; ?>" class="form-control rounded-5">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Image *</label>
                                        <input type="file" name="image" required class="form-control rounded-5" style="height: 37px;">
                                        <img src="../<?= $product['data']['image']; ?>" style="width: 40px;height: 40px;" alt="Img" />
                                   
                                    <div class="col-md-6 mb-2 text-end">
                                        <button type="submit" name="updateProduct" class="btn btn-success rounded-5 w-50">Update</button>
                                    </div>
                                </div>
                                <?php

                            }
                            else
                            {
                                echo '<h5>'.$product['message'].'</h5>';
                                return false;
                            }
                         }
                         else
                         {
                            echo '<h5>Something Went Wrong</h5>';
                            return false;
                         }
                        
                        ?>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
