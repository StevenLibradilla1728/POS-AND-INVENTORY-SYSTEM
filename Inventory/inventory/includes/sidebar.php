
<style>
    .sb-sidenav-menu-heading {
        color: black;

    }

    .sb-nav-link-icon:hover {
        color: white;
        margin: 2px;
        border-radius: 10px;
        transform: translateX(20px);
        transition: transform 1s ease;
        margin-left: calc(0.5rem - 2px);
    }

    .nav-link {
        color: black;
        font-size: 16px;
        margin-left: 8px;
    }

    .nav-link:hover {
        background: #00BD79;
        color: white;
        margin: 2px;
        border-radius: 10px;
        transform: translateX(20px);
        transition: transform 1s ease;
        margin-left: calc(0.5rem - 2px);
    }

    .nav-link.active {
    background: #00BD79; /* Replace with your preferred color */
    color: white;
    margin: 2px;
    border-radius: 10px;
    transform: translateX(20px);
    transition: transform 1s ease;
    margin-left: calc(0.5rem - 2px); /* Ensures text is visible */
    }
    
    .nav-link.active .sb-nav-link-icon {
    color: white; /* Ensures icons match */
    border-radius: 10px;
    transform: translateX(2px);
    transition: transform 1s ease;
    margin-left: calc(0px - 2px);
    }

    

</style>


/*

<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
*/

<div id="layoutSidenav_nav" class="" style="width: 12.3rem; margin-right: 0;">
    <nav class="sb-sidenav accordion shadow-lg" style="width: 12.3rem; margin-right: 0;" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"></div>

                <a class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <!--<a class="nav-link <?php echo $current_page == 'order-create.php' ? 'active' : ''; ?>" href="order-create.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                    Create Order
                </a>-->

                <a class="nav-link <?php echo $current_page == 'orders.php' ? 'active' : ''; ?>" href="orders.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Orders
                </a>

                <a class="nav-link <?php echo $current_page == 'reports.php' ? 'active' : ''; ?>" href="reports.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Sales Report
                </a>

                <!--<a class="nav-link <?php echo $current_page == 'charts.html' ? 'active' : ''; ?>" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Stocks
                </a>

                <a class="nav-link <?php echo $current_page == 'tables.html' ? 'active' : ''; ?>" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Reports
                </a>-->

                <a class="nav-link <?php echo $current_page == 'categories-create.php' ? 'active' : ''; ?>" href="categories-create.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Add Category
                </a>

                <a class="nav-link <?php echo $current_page == 'categories-list.php' ? 'active' : ''; ?>" href="categories-list.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    View Category
                </a>

                <a class="nav-link <?php echo $current_page == 'product-create.php' ? 'active' : ''; ?>" href="product-create.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Add Product
                </a>

                <a class="nav-link <?php echo $current_page == 'product-list.php' ? 'active' : ''; ?>" href="product-list.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    View Products
                </a>

                <!--<a class="nav-link <?php echo $current_page == 'customer-create.php' ? 'active' : ''; ?>" href="customer-create.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Add Customer
                </a>-->

                <a class="nav-link <?php echo $current_page == 'customer-list.php' ? 'active' : ''; ?>" href="customer-list.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    View Customers
                </a>

                <a class="nav-link <?php echo $current_page == 'cashier-create.php' ? 'active' : ''; ?>" href="cashier-create.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Add Cashier
                </a>
                
                <a class="nav-link <?php echo $current_page == 'cashier-list.php' ? 'active' : ''; ?>" href="cashier-list.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    View Cashiers
                </a>

                <!--<a class="nav-link <?php echo $current_page == 'room-create.php' ? 'active' : ''; ?>" href="room-create.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Add Room
                </a>

                <a class="nav-link <?php echo $current_page == 'room-list.php' ? 'active' : ''; ?>" href="room-list.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    View Rooms
                </a>-->
        
            </div>
        </div>
    </nav>
</div>

<!--
<div id="layoutSidenav_nav" class="shadow-lg" style="width: 12.3rem;margin-right:0px;">
                <nav class="sb-sidenav accordion" style="width: 12.3rem;margin-right:0px;" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>

                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link" href="order-create.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                               Create Order
                            </a>

                            <a class="nav-link" href="orders.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Orders
                            </a>

<!--
                            <div class="sb-sidenav-menu-heading">Manage Products</div>
                            <a class="nav-link collapsed" href="#" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapseCategory" 
                            aria-expanded="false" aria-controls="collapseCategory">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Categories
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="categories-create.php">Add Category</a>
                                    <a class="nav-link" href="categories-list.php">View Category</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapseProduct" 
                            aria-expanded="false" aria-controls="collapseProduct">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="product-create.php">Add Product</a>
                                    <a class="nav-link" href="product-list.php">View Products</a>
                                </nav>
                            </div>
                           

                            <div class="sb-sidenav-menu-heading">Manage Users</div>

                            <a class="nav-link collapsed" href="#" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapseCustomers" 
                            aria-expanded="false" aria-controls="collapseCustomers">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Customers
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCustomers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="customer-create.php">Add Customer</a>
                                    <a class="nav-link" href="customer-list.php">View Customers</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapseCashiers" 
                            aria-expanded="false" aria-controls="collapseCashiers">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Cashiers
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCashiers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="cashier-create.php">Add Cashier</a>
                                    <a class="nav-link" href="cashier-list.php">View Cashiers</a>
                                </nav>
                            </div>-->

<!--
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Stocks
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Reports
                            </a>
                        </div>
                    </div>-->
                    <!--
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                       Admin
                    </div>
                    -->
                <!--</nav>
</div>-->

