<?php

include("config/db.php");
include("includes/header.php");
include("includes/navbar.php");

// Count Customers
$customerQuery = "SELECT COUNT(*) AS total FROM customers";
$customerResult = mysqli_query($conn, $customerQuery);
$customerCount = mysqli_fetch_assoc($customerResult);

// Count Products
$productQuery = "SELECT COUNT(*) AS total FROM products";
$productResult = mysqli_query($conn, $productQuery);
$productCount = mysqli_fetch_assoc($productResult);

// Count Orders
$orderQuery = "SELECT COUNT(*) AS total FROM sales_orders";
$orderResult = mysqli_query($conn, $orderQuery);
$orderCount = mysqli_fetch_assoc($orderResult);

?>

<div class="container mt-5">

    <h2 class="mb-4">Dashboard</h2>

    <div class="row">

        <div class="col-md-4">

            <div class="card text-center shadow">

                <div class="card-body">

                    <h5>Total Customers</h5>

                    <h2><?php echo $customerCount['total']; ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card text-center shadow">

                <div class="card-body">

                    <h5>Total Products</h5>

                    <h2><?php echo $productCount['total']; ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card text-center shadow">

                <div class="card-body">

                    <h5>Total Sales Orders</h5>

                    <h2><?php echo $orderCount['total']; ?></h2>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
include("includes/footer.php");
?>