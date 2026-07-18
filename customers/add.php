<?php

include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

if (isset($_POST['save_customer'])) {

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];

    $query = "INSERT INTO customers(full_name, email, phone, city)
              VALUES('$full_name', '$email', '$phone', '$city')";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='container mt-4 alert alert-danger'>
                Failed to add customer.
              </div>";
    }
}

?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">
            <h3>Add Customer</h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input
                        type="text"
                        name="full_name"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input
                        type="text"
                        name="phone"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">City</label>
                    <input
                        type="text"
                        name="city"
                        class="form-control">
                </div>

                <button
                    type="submit"
                    name="save_customer"
                    class="btn btn-success">

                    Save Customer

                </button>

                <a href="index.php"
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