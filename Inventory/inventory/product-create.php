<?php include('includes/header.php'); ?>


<div class="container-fluid">
    <div class="row">
        <!-- Add Category (Center) -->
        <div class="col-md-12 custom-mx">
            <div class="container-fluid bg-white">
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Add Product
                            <a href="product-list.php" class="btn btn-success float-end rounded-5 px-4">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php alertMessage(); ?>
                        <form action="code.php" method="POST" enctype="multipart/form-data">
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
                                                    echo '<option value="'.$categoryItem['id'].'">'.$categoryItem['name'].'</option>';
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
                                    <input type="text" name="name" required class="form-control rounded-5">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control rounded-5 h-75" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="">Price *</label>
                                    <input type="text" name="price" required class="form-control rounded-5">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Stock Level *</label>
                                    <input type="text" name="stock_level" required class="form-control rounded-5">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Image *</label>
                                    <input type="file" name="image" required class="form-control rounded-5" style="height: 37px;">
                                </div>
                                
                                <div class="col-md-6 mb-2 text-end">
                                    <button type="submit" name="saveProduct" class="btn btn-success rounded-5 w-25">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
