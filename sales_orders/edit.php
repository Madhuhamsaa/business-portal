<?php

include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

$id = $_GET['id'];

// Get current sales order
$query = "SELECT * FROM sales_orders WHERE id=$id";
$result = mysqli_query($conn, $query);
$sales_order = mysqli_fetch_assoc($result);

// Get customers and products for dropdowns
$customers = mysqli_query($conn, "SELECT * FROM customers ORDER BY full_name");
$products = mysqli_query($conn, "SELECT * FROM products ORDER BY product_name");

// Update Sales Order
if (isset($_POST['update_sales_order'])) {

    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];
    $order_date = $_POST['order_date'];

    $updateQuery = "
        UPDATE sales_orders
        SET
            customer_id='$customer_id',
            product_id='$product_id',
            quantity='$quantity',
            status='$status',
            order_date='$order_date'
        WHERE id=$id
    ";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: index.php");
        exit();
    }
}

?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">
            <h3>Edit Sales Order</h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <!-- Customer -->

                <div class="mb-3">

                    <label class="form-label">Customer</label>

                    <select
                        name="customer_id"
                        class="form-select"
                        required>

                        <?php while ($customer = mysqli_fetch_assoc($customers)) { ?>

                            <option
                                value="<?= $customer['id']; ?>"
                                <?= ($customer['id'] == $sales_order['customer_id']) ? 'selected' : ''; ?>>

                                <?= $customer['full_name']; ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

                <!-- Product -->

                <div class="mb-3">

                    <label class="form-label">Product</label>

                    <select
                        name="product_id"
                        class="form-select"
                        required>

                        <?php while ($product = mysqli_fetch_assoc($products)) { ?>

                            <option
                                value="<?= $product['id']; ?>"
                                <?= ($product['id'] == $sales_order['product_id']) ? 'selected' : ''; ?>>

                                <?= $product['product_name']; ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

                <!-- Quantity -->

                <div class="mb-3">

                    <label class="form-label">Quantity</label>

                    <input
                        type="number"
                        name="quantity"
                        class="form-control"
                        min="1"
                        value="<?= $sales_order['quantity']; ?>"
                        required>

                </div>

                <!-- Status -->

                <div class="mb-3">

                    <label class="form-label">Status</label>

                    <select
                        name="status"
                        class="form-select"
                        required>

                        <option value="Pending" <?= ($sales_order['status'] == "Pending") ? "selected" : ""; ?>>
                            Pending
                        </option>

                        <option value="Confirmed" <?= ($sales_order['status'] == "Confirmed") ? "selected" : ""; ?>>
                            Confirmed
                        </option>

                        <option value="Completed" <?= ($sales_order['status'] == "Completed") ? "selected" : ""; ?>>
                            Completed
                        </option>

                        <option value="Cancelled" <?= ($sales_order['status'] == "Cancelled") ? "selected" : ""; ?>>
                            Cancelled
                        </option>

                    </select>

                </div>

                <!-- Order Date -->

                <div class="mb-3">

                    <label class="form-label">Order Date</label>

                    <input
                        type="date"
                        name="order_date"
                        class="form-control"
                        value="<?= $sales_order['order_date']; ?>"
                        required>

                </div>

                <button
                    type="submit"
                    name="update_sales_order"
                    class="btn btn-warning">

                    Update Sales Order

                </button>

                <a
                    href="index.php"
                    class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

<?php
include("../includes/footer.php");
?>