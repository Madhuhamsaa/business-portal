<?php

include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

$customers = mysqli_query($conn, "SELECT * FROM customers");
$products = mysqli_query($conn, "SELECT * FROM products");

if (isset($_POST['save_order'])) {

    $customer = $_POST['customer'];
    $product = $_POST['product'];
    $qty = $_POST['quantity'];
    $status = $_POST['status'];
    $date = $_POST['order_date'];

    $query = "

INSERT INTO sales_orders

(customer_id,product_id,quantity,status,order_date)

VALUES

('$customer','$product','$qty','$status','$date')

";

    if (mysqli_query($conn, $query)) {

        header("Location:index.php");
        exit();
    }
}

?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">

            <h3>Create Sales Order</h3>

        </div>

        <div class="card-body">

            <form method="POST">

                <label>Customer</label>

                <select
                    name="customer"
                    class="form-select mb-3">

                    <?php while ($c = mysqli_fetch_assoc($customers)) { ?>

                        <option value="<?= $c['id']; ?>">

                            <?= $c['full_name']; ?>

                        </option>

                    <?php } ?>

                </select>

                <label>Product</label>

                <select
                    name="product"
                    class="form-select mb-3">

                    <?php while ($p = mysqli_fetch_assoc($products)) { ?>

                        <option value="<?= $p['id']; ?>">

                            <?= $p['product_name']; ?>

                        </option>

                    <?php } ?>

                </select>

                <input
                    name="quantity"
                    class="form-control mb-3"
                    placeholder="Quantity">

                <select
                    name="status"
                    class="form-select mb-3">

                    <option>Pending</option>

                    <option>Confirmed</option>

                    <option>Completed</option>

                    <option>Cancelled</option>

                </select>

                <input
                    type="date"
                    name="order_date"
                    class="form-control mb-3">

                <button
                    class="btn btn-success"
                    name="save_order">

                    Save Order

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