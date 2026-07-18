<?php

include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

$query = "

SELECT

sales_orders.id,

customers.full_name,

products.product_name,

sales_orders.quantity,

sales_orders.status,

sales_orders.order_date

FROM sales_orders

INNER JOIN customers
ON customers.id=sales_orders.customer_id

INNER JOIN products
ON products.id=sales_orders.product_id

ORDER BY sales_orders.id DESC

";

$result = mysqli_query($conn, $query);

?>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-4">

        <h2>Sales Orders</h2>

        <a href="add.php" class="btn btn-success">

            + New Order

        </a>

    </div>

    <table class="table table-bordered table-hover">

        <thead class="table-primary">

            <tr>

                <th>ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

            <?php while ($order = mysqli_fetch_assoc($result)) { ?>

                <tr>

                    <td><?= $order['id']; ?></td>

                    <td><?= $order['full_name']; ?></td>

                    <td><?= $order['product_name']; ?></td>

                    <td><?= $order['quantity']; ?></td>

                    <td>

                        <?php

                        switch ($order['status']) {

                            case "Pending":
                                echo '<span class="badge bg-warning text-dark">Pending</span>';
                                break;

                            case "Confirmed":
                                echo '<span class="badge bg-primary">Confirmed</span>';
                                break;

                            case "Completed":
                                echo '<span class="badge bg-success">Completed</span>';
                                break;

                            case "Cancelled":
                                echo '<span class="badge bg-danger">Cancelled</span>';
                                break;

                            default:
                                echo '<span class="badge bg-secondary">' . $order['status'] . '</span>';
                        }

                        ?>

                    </td>

                    <td><?= $order['order_date']; ?></td>

                    <td>

                        <a
                            href="edit.php?id=<?= $order['id']; ?>"
                            class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <a
                            href="delete.php?id=<?= $order['id']; ?>"
                            class="btn btn-danger btn-sm">

                            Delete

                        </a>

                    </td>

                </tr>

            <?php } ?>

        </tbody>

    </table>

</div>

<?php
include("../includes/footer.php");
?>