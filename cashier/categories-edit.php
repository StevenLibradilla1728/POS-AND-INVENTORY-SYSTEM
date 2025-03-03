<?php include('includes/header.php'); ?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 custom-mx">
            <div class="container-fluid bg-white">
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Category 
                            <a href="categories-list.php" class="btn btn-success float-end rounded-5 px-4">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php alertMessage(); ?>
                        <form action="code.php" method="POST">

                        <?php
                        $parmValue = checkParamId('id');
                        if(!is_numeric($parmValue)){
                            echo '<h5>'.$parmValue.'</h5>';
                            return false;
                        }

                        $category = getById('categories',$parmValue);
                        if($category['status'] == 200)
                        { 
                        ?>
                        <input type="hidden" name="categoryId" value="<?= $category['data']['id']; ?>">

                           
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="">Name *</label>
                                <input type="text" name="name" value="<?= $category['data']['name']; ?>" required class="form-control rounded-5">
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control rounded-5 h-75" rows="3"><?= $category['data']['description']; ?></textarea>
                            </div>
                            
                            <div class="col-md-6 mb-2 text-end">
                                <button type="submit" name="updateCategory" class="btn btn-success rounded-5 w-50 px-2">Update</button>
                            </div>
                        </div>
                        <?php
                        } else {
                           echo '<h5>'.$category['message'].'</h5>';
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

