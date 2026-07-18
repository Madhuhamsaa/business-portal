<?php

include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

$id = $_GET['id'];

$query = "SELECT * FROM customers WHERE id=$id";
$result = mysqli_query($conn, $query);
$customer = mysqli_fetch_assoc($result);

if (isset($_POST['update_customer'])) {

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];

    $updateQuery = "
    UPDATE customers
    SET
        full_name='$full_name',
        email='$email',
        phone='$phone',
        city='$city'
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

            <h3>Edit Customer</h3>

        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label>Full Name</label>

                    <input
                        type="text"
                        name="full_name"
                        class="form-control"
                        value="<?= $customer['full_name']; ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?= $customer['email']; ?>">

                </div>

                <div class="mb-3">

                    <label>Phone</label>

                    <input
                        type="number"
                        name="phone"
                        class="form-control"
                        value="<?= $customer['phone']; ?>">

                </div>

                <div class="mb-3">

                    <label>City</label>

                    <input
                        type="text"
                        name="city"
                        class="form-control"
                        value="<?= $customer['city']; ?>">

                </div>

                <button
                    class="btn btn-warning"
                    name="update_customer">

                    Update Customer

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