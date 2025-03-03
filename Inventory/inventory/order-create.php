<?php include('includes/header.php'); ?>

<div class="modal fade mt-4" id="addCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="mb-3">
            <label for="">Enter Customer Name</label>
            <input type="text" required class="form-control" id="c_name" />
         </div>
         <div class="mb-3">
            <label for="">Enter Customer Phone No.</label>
            <input type="text" required class="form-control" id="c_phone" />
         </div>
         <div class="mb-3">
            <label for="">Enter Customer Email</label>
            <br>
            <input type="email" required class="form-control" id="c_email" />
         </div>
         <div class="mb-3">
            <label for="">Room No.</label>
            <input type="text" class="form-control" id="c_room" />
         </div>
         <div class="mb-3">
            <label for="appt">Select Delivery time</label>
            <input type="time" class="form-control" id="appt" name="appt">
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary saveCustomer">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid" style="margin-left: 0px;padding-left:0px;">
    <di class="row">
        <!-- Add Category (Center) -->
        <div class="col-md-12 custom-mx bg-white" style="margin-left: 0px;padding-left:0px;">
            <div class="container-fluid">
                <div class="card shadow-sm">
                    <!--<div class="card-header bg-white position-fixed fixed-top" style="margin-top:3.3rem;">
                        <h4 class="mb-0 pb-0" style="margin-left:15rem;">Create Order
                            <a href="#" class="btn btn-success float-end rounded-5 px-4">Back</a>
                        </h4>
                    </div>-->

                    
                    
<!---------- CATEGORIES SECTION ------------>


<div class="container-fluid mt-3 bg-white" style="margin-left: 0px;padding-left:0px;">
    <div class="row">
        <!-- Categories Section -->
        <div class="col-md-12 bg-white position-fixed fixed-top" style="margin-top:3rem;height:2.7rem;">

        <div class="d-flex align-items-center mb-2 bg-white p-1" style="margin-left: 14rem;">
                <input type="text" id="searchProductInput" class="form-control me-3 rounded-2 border-2 shadow-sm" 
                       placeholder="Search products..." style="width: 645px;" onkeyup="filterProducts()">
        </div>
        <div class="sb-topnav navbar-nav-scroll position-fixed fixed-top bg-white" style="margin-top:5.7rem;height:2.8rem;">
            <div class="d-flex flex-wrap" id="category-buttons" style="margin-left:15rem;margin-top:3px;margin-bottom:5px;">
                <div class="me-2 mb-2">
                    <button class="btn btn-success category-btn" data-category="all">All</button>
                </div>
                <?php
                $categories = getAll('categories');
                if ($categories && mysqli_num_rows($categories) > 0) {
                    foreach ($categories as $category) {
                        echo '<div class="me-2 mb-2">
                                <button class="btn btn-outline-success category-btn" data-category="' . $category['id'] . '">' . $category['name'] . '</button>
                              </div>';
                    }
                } else {
                    echo '<p>No categories available</p>';
                }
                ?>
            </div>
            </div>
        </div>
    </div>
</div>



<!---------- PRODUCTS SECTION ------------>


<div class="container-fluid mt-0 bg-white" style="margin-left: 0px;padding-left:0px;"> 
    <div class="row bg-white" style="margin-left:0px;">
        <!-- Products Section -->
        <div class="col-md-8" style="margin-top: 3.9rem;margin-bottom:3rem;margin-left:0px">
        <?php alertMessage(); ?>

<form action="orders-code.php" method="POST">
        <div class="row" style="margin-left:0px">
    <?php
    $products = getAll('products');
    if ($products && mysqli_num_rows($products) > 0) {
        foreach ($products as $prodItem) {
            $imagePath = '../assets/uploads/products/' . $prodItem['image'];
            $imageSrc = file_exists($imagePath) ? $imagePath : '../assets/uploads/products/default-placeholder.png';

            echo '<div class="col-md-4 mb-5 mt-4 product-card" style="height:15rem;" data-category="' . htmlspecialchars($prodItem['category_id']) . '">
                <form action="orders-code.php" method="POST">
                    <input type="hidden" name="product_id" value="' . htmlspecialchars($prodItem['id']) . '" />
                    <input type="hidden" name="name" value="' . htmlspecialchars($prodItem['name']) . '" />
                    <input type="hidden" name="price" value="' . htmlspecialchars($prodItem['price']) . '" />
                    <div class="card shadow-sm border rounded-2" style="margin-bottom:3rem;">
                        <img src="../' . $prodItem['image']. '" name="image" class="card-img-top" alt="' . htmlspecialchars($prodItem['name']) . '" style="height: 125px; object-fit: cover;">
                        <div class="card-body rounded-2 text-center">
                            <h5 style="font-size:15px;color:black;" name="name" class="card-title fw-semibold">' . htmlspecialchars($prodItem['name']) . '</h5>
                            <p name="price" style="font-size:15px;color:black;" class="card-text">₱' . number_format($prodItem['price'], 2) . '</p>
                            <input type="number" name="quantity" value="1" min="1" class="form-control w-50 mx-auto mb-2" />
                            <button type="submit" class="btn btn-success" name="AddProduct">Add to Cart</button>
                        </div>
                    </div>
                </form>
            </div>';
        }
    } else {
        echo '<p>No products available</p>';
    }
    ?>
</div>
</form>
        </div>




        <div class="card col-md-3 bg-white shadow-sm border border-2 bg-white rounded-1 sb-topnav navbar-expand" 
        style="height: 70vh; overflow-y: auto;position:fixed;margin-left: 57.2rem; margin-top: 9.5rem;">
       
                    <div class="cardbody" id="productArea">
                        <?php 
                        if(isset($_SESSION['productItems']))
                        {
                            $sessionProducts = $_SESSION['productItems'];
                            if(empty($sessionProducts)){
                                unset($_SESSION['productItemIds']);
                                unset($_SESSION['productItems']);
                            }
                            ?>
                            <div class="table-responsive mb-3" id="productContent">
                                <table class="table table-borderless col-md-4 border-2 fw-light bg-white">
                                    <thead>
                                        <tr>
                                           
                                            <th style="word-wrap: break-word; white-space: normal;">Name</th>
                                            <th style="word-wrap: break-word; white-space: normal;">Price</th>
                                            <th style="word-wrap: break-word; white-space: normal;">Qty</th>
                                            <th style="word-wrap: break-word; white-space: normal;">Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        $grandTotal = 0;
                                        foreach ($sessionProducts as $key => $item) :
                                            $itemTotal = $item['price'] * $item['stock_level'];// Add item's total to grand total
                                            $grandTotal += $itemTotal;
                                        ?>
                                        <tr>
                                            
                                            <td class="fw-semibold" style="font-size: 14px; color:black;"><?= $item['name'] ?></td>
                                            <td class="fw-semibold" style="font-size: 14px; color:black;">₱<?= $item['price'] ?></td>
                                            <td>
                                            <div class="input-group qtyBox">
                                                 <input type="hidden" style="width:1px;"value="<?= $item['product_id']; ?>" class="prodId" />
                                                 <input type="text" style="font-size: 14px; margin-top: 2px; padding-top: 0px;" 
                                                value="<?= $item['stock_level']; ?>" class="qty quantityInput" />
                                            </div>
                                            </td>
                                            <td class="fw-semibold" style="font-size: 14px; color:black;"><?= number_format($itemTotal, 0); ?></td>
                                            <td>
                                            <a href="order-item-delete.php?index=<?= $key; ?>">
                                              <i class="fa-solid fa-trash" style="color: red; margin: 0 3px; font-size: 16px;"></i>
                                            </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold">Grand Total:</td>
                                            <td colspan="2" class="fw-bold">₱<?= number_format($grandTotal, 0); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="mt-2 mb-5">
                                <hr style="width:19.3rem;">
                                <div class="row">
                                    <div class="col-md-7 mb-1" style="margin-left: 2rem;width: 16rem;">
                                        <label for="">Select Payment Mode</label>
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <div class="col-md-7 mb-3" style="margin-left: 2rem;width: 16rem;">
                                        <select id="payment_mode" class="form-select">
                                        <option value="" disabled>Select Payment</option>
                                            <option value="Cash Payment">Cash Payment</option>
                                            <option value="Online Payment">Online Payment</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-7 mb-2" style="margin-left: 2rem;width: 16rem;">
                                       <label for="">Enter Customer Phone No.</label>
                                       <br>
                                       <input type="number" id="cphone" class="form-control mb-1" style="height:35px;" value="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                       <button type="button" class="btn btn-success proceedToPlace" style="margin-left: 2rem;width: 14.5rem;">Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            <?php
                        }
                        else
                        {
                            echo '<h5 style="margin-left:5rem;">No Items Added</h5>';
                        }
                        ?>
                    </div>
                </div>
            
        
        
            <!--<h4>Cart</h4>
            <div id="cart-area">
                <p>Your cart is empty</p>
            </div>-->
      </di>
     </div>
   </div>
</div>

<script>


         
    // Add active state to category buttons and filter products
    document.querySelectorAll('.category-btn').forEach(button => {
        button.addEventListener('click', () => {
            // Remove active state from all buttons
            document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('btn-success', 'text-white'));
            document.querySelectorAll('.category-btn').forEach(btn => btn.classList.add('btn-outline-success'));

            // Add active state to the clicked button
            button.classList.remove('btn-outline-success');
            button.classList.add('btn-success', 'text-white');

            // Filter products
            const categoryId = button.getAttribute('data-category');
            document.querySelectorAll('.product-card').forEach(card => {
                if (categoryId === 'all' || card.getAttribute('data-category') === categoryId) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });


    // Product Search Functionality
    function filterProducts() {
        const searchInput = document.getElementById('searchProductInput').value.toLowerCase();
        const productCards = document.querySelectorAll('.product-card');

        productCards.forEach(card => {
            const productName = card.querySelector('.card-title').innerText.toLowerCase();
            card.style.display = productName.includes(searchInput) ? '' : 'none';
        });
    }


    /*
    // Add to cart functionality
    const cartArea = document.getElementById('cart-area');
    let cart = [];

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.getAttribute('data-id');
            const productName = button.getAttribute('data-name');
            const productPrice = parseFloat(button.getAttribute('data-price'));

            const existingProduct = cart.find(item => item.id === productId);

            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 });
            }

            updateCartUI();
        });
    });

    function updateCartUI() {
        if (cart.length === 0) {
            cartArea.innerHTML = '<p>Your cart is empty</p>';
            return;
        }

        let cartHTML = '<table class="table table-borderless border-2 bg-white shadow-sm card col-md-3" style="width:300px; position:fixesd;">';
        cartHTML += '<thead><tr><th class="px-2">Name</th><th class="px-3">Qty</th><th class="px-3">Total</th></tr></thead><tbody>';

        let grandTotal = 0;
        cart.forEach(item => {
            const total = item.price * item.quantity;
            grandTotal += total;

            cartHTML += `<tr>
                <td style="width:80px;">${item.name}<br>₱${item.price}</td>
                <td style="width:40px;">${item.quantity}</td>
                <td style="width:80px;">₱${total}</td>
                <td><button class="btn btn-danger rounded-5 remove-item" data-id="${item.id}"><i class="fa-solid fa-trash"></i></button></td>
            </tr>`;
        });

        cartHTML += `<tr><td colspan="2">Grand Total</td><td>₱${grandTotal.toFixed(2)}</td><td></td></tr>`;
        cartHTML += '</tbody></table>';

        cartArea.innerHTML = cartHTML;

        // Add event listeners for remove buttons
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-id');
                cart = cart.filter(item => item.id !== productId);
                updateCartUI();
            });
        });
    }*/

    // Print receipt
    document.getElementById('print-receipt').addEventListener('click', () => {
        const receiptWindow = window.open('', 'Print Receipt', 'width=600,height=400');
        receiptWindow.document.write('<html><body><h1>Receipt</h1>');
        receiptWindow.document.write(cartArea.innerHTML);
        receiptWindow.document.write('</body></html>');
        receiptWindow.document.close();
        receiptWindow.print();
    });
    
</script>


<?php include('includes/footer.php'); ?>