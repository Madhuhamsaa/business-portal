<?php

include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

$id = $_GET['id'];

$query = "SELECT * FROM products WHERE id=$id";
$result = mysqli_query($conn, $query);
$products = mysqli_fetch_assoc($result);

if (isset($_POST['update_products'])) {

    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $updateQuery = "
    UPDATE products
    SET
        product_name='$product_name',
        category='$category',
        price='$price',
        stock='$stock'
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

            <h3>Edit Product</h3>

        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label>Product Name</label>

                    <input
                        type="text"
                        name="product_name"
                        class="form-control"
                        value="<?= $products['product_name']; ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label>Category</label>

                    <input
                        type="text"
                        name="category"
                        class="form-control"
                        value="<?= $products['category']; ?>">

                </div>

                <div class="mb-3">

                    <label>Price</label>

                    <input
                        type="number"
                        step="0.01"
                        name="price"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label>Stock</label>

                    <input
                        type="number"
                        name="stock"
                        class="form-control"
                        value="<?= $products['stock']; ?>">

                </div>

                <button
                    class="btn btn-warning"
                    name="update_products">

                    Update Product

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