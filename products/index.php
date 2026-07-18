<?php

include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

$query = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $query);

?>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-4">

        <h2>Products</h2>

        <a href="add.php" class="btn btn-success">
            + Add Product
        </a>

    </div>

    <table class="table table-bordered table-hover">

        <thead class="table-primary">

            <tr>

                <th>ID</th>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

            <?php while ($product = mysqli_fetch_assoc($result)) { ?>

                <tr>

                    <td><?= $product['id']; ?></td>
                    <td><?= $product['product_name']; ?></td>
                    <td><?= $product['category']; ?></td>
                    <td>€ <?= $product['price']; ?></td>
                    <td>

                        <?php

                        if ($product['stock'] == 0) {

                            echo "<span class='badge bg-danger'>Out of Stock</span>";
                        } elseif ($product['stock'] < 5) {

                            echo "<span class='badge bg-warning text-dark'>Low Stock (" . $product['stock'] . ")</span>";
                        } else {

                            echo $product['stock'];
                        }

                        ?>

                    </td>

                    <td>

                        <a
                            href="edit.php?id=<?= $product['id']; ?>"
                            class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <a
                            href="delete.php?id=<?= $product['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete Product?')">

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