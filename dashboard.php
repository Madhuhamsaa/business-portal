<?php

include("config/db.php");
include("includes/header.php");
include("includes/navbar.php");

/* -----------------------------
   Dashboard Statistics
------------------------------*/

// Total Customers
$customerQuery = "SELECT COUNT(*) AS total FROM customers";
$customerResult = mysqli_query($conn, $customerQuery);
$customerCount = mysqli_fetch_assoc($customerResult);

// Total Products
$productQuery = "SELECT COUNT(*) AS total FROM products";
$productResult = mysqli_query($conn, $productQuery);
$productCount = mysqli_fetch_assoc($productResult);

// Total Sales Orders
$orderQuery = "SELECT COUNT(*) AS total FROM sales_orders";
$orderResult = mysqli_query($conn, $orderQuery);
$orderCount = mysqli_fetch_assoc($orderResult);

// Pending Orders
$pendingQuery = "SELECT COUNT(*) AS total FROM sales_orders WHERE status='Pending'";
$pendingResult = mysqli_query($conn, $pendingQuery);
$pendingCount = mysqli_fetch_assoc($pendingResult);

// Completed Orders
$completedQuery = "SELECT COUNT(*) AS total FROM sales_orders WHERE status='Completed'";
$completedResult = mysqli_query($conn, $completedQuery);
$completedCount = mysqli_fetch_assoc($completedResult);

// Inventory Value
$inventoryQuery = "SELECT SUM(price * stock) AS total FROM products";
$inventoryResult = mysqli_query($conn, $inventoryQuery);
$inventoryValue = mysqli_fetch_assoc($inventoryResult);

/* -----------------------------
   Recent Sales Orders
------------------------------*/

$recentOrders = mysqli_query($conn, "
SELECT
    customers.full_name,
    products.product_name,
    sales_orders.status
FROM sales_orders

INNER JOIN customers
    ON customers.id = sales_orders.customer_id

INNER JOIN products
    ON products.id = sales_orders.product_id

ORDER BY sales_orders.id DESC

LIMIT 5
");

?>

<div class="container mt-5">

    <h2 class="mb-4">Dashboard</h2>

    <div class="row g-4">

        <!-- Customers -->
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body text-center">
                    <h6>Total Customers</h6>
                    <h2><?= $customerCount['total']; ?></h2>
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body text-center">
                    <h6>Total Products</h6>
                    <h2><?= $productCount['total']; ?></h2>
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body text-center">
                    <h6>Total Sales Orders</h6>
                    <h2><?= $orderCount['total']; ?></h2>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="col-md-4">
            <div class="card shadow border-0 bg-warning-subtle">
                <div class="card-body text-center">
                    <h6>Pending Orders</h6>
                    <h2><?= $pendingCount['total']; ?></h2>
                </div>
            </div>
        </div>

        <!-- Completed -->
        <div class="col-md-4">
            <div class="card shadow border-0 bg-success-subtle">
                <div class="card-body text-center">
                    <h6>Completed Orders</h6>
                    <h2><?= $completedCount['total']; ?></h2>
                </div>
            </div>
        </div>

        <!-- Inventory -->
        <div class="col-md-4">
            <div class="card shadow border-0 bg-info-subtle">
                <div class="card-body text-center">
                    <h6>Inventory Value</h6>
                    <h2>€<?= number_format($inventoryValue['total'], 2); ?></h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Orders -->

    <div class="card shadow mt-4">

        <div class="card-header">
            <h4 class="mb-0">Recent Sales Orders</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-light">
                    <tr>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <?php while ($row = mysqli_fetch_assoc($recentOrders)) { ?>

                        <tr>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td>

                                <?php

                                switch ($row['status']) {

                                    case "Pending":

                                        echo '<span class="badge bg-warning text-dark">Pending</span>';

                                        break;

                                    case "Completed":

                                        echo '<span class="badge bg-success">Completed</span>';

                                        break;

                                    case "Cancelled":

                                        echo '<span class="badge bg-danger">Cancelled</span>';

                                        break;

                                    default:

                                        echo '<span class="badge bg-primary">' . $row['status'] . '</span>';
                                }

                                ?>

                            </td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php
include("includes/footer.php");
?>