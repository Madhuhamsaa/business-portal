<?php

include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

if (isset($_POST['save_product'])) {

    $product = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $query = "INSERT INTO products(product_name,category,price,stock)

VALUES

('$product','$category','$price','$stock')";

    if (mysqli_query($conn, $query)) {

        header("Location:index.php");
        exit();
    }
}

?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">

            <h3>Add Product</h3>

        </div>

        <div class="card-body">

            <form method="POST">

                <input
                    class="form-control mb-3"
                    name="product_name"
                    placeholder="Product Name"
                    required>

                <input
                    class="form-control mb-3"
                    name="category"
                    placeholder="Category">

                <input
                    class="form-control mb-3"
                    name="price"
                    placeholder="Price">

                <input
                    class="form-control mb-3"
                    name="stock"
                    placeholder="Stock">

                <button
                    class="btn btn-success"
                    name="save_product">

                    Save Product

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