<?php
require '../config/function.php';
require 'authentication.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <style>
        .hover-text-white:hover {
            color: white;
        }
        .hover-shadow-none:hover { 
            box-shadow: none;
            background: green;
        }
        .container-fluid {
            background: #fff;
        }
        .card {
            border-radius: 18px;
            background: #fff;
        }
        table {
            background: #fff;
        }
    </style>

    <body>
        <a href="categories-list.php" class="btn btn-success rounded-5 m-3 px-3">Back</a>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Categories</h4>
                    <div class="d-flex flex-wrap">
                        <?php
                        // Fetch categories
                        $categories = mysqli_query($conn, "SELECT * FROM categories");

                        if (mysqli_num_rows($categories) > 0) {
                            while ($category = mysqli_fetch_assoc($categories)) {
                                echo '<a href="categories-list.php?id=' . $category['id'] . '" class="btn btn-success m-1 rounded-5 px-3">' . $category['name'] . '</a>';
                            }
                        } else {
                            echo '<p>No categories found.</p>';
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-12">
                    <h4 class="mb-4">Products</h4>
                    <div class="d-flex flex-wrap">
                        <?php
                        // Fetch products
                        $products = mysqli_query($conn, "SELECT * FROM products");

                        if ($products && mysqli_num_rows($products) > 0) {
                            while ($product = mysqli_fetch_assoc($products)) {
                                echo '<a href="product-list.php?id=' . $product['id'] . '" class="btn btn-success m-1 rounded-5 px-3">' . ($product['image']) . ' ' . ($product['name']) . '</a>';
                            }
                        } else {
                            echo '<p>No products found.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/datatables-simple-demo.js"></script>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this cashier?");
            }
        </script>
    </body>
</html>
