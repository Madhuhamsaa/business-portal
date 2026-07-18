<?php

include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $query = "
        SELECT *
        FROM customers
        WHERE full_name LIKE '%$search%'
        OR email LIKE '%$search%'
        OR phone LIKE '%$search%'
        OR city LIKE '%$search%'
        ORDER BY id DESC
    ";
} else {

    $query = "SELECT * FROM customers ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);

?>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Customers</h2>

        <a href="add.php" class="btn btn-success">
            + Add Customer
        </a>

    </div>

    <form method="GET" class="mb-4">

        <div class="input-group">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search by name, email, phone or city..."
                value="<?php echo htmlspecialchars($search); ?>">

            <button
                class="btn btn-primary"
                type="submit">

                Search

            </button>

        </div>

    </form>

    <table class="table table-bordered table-hover">

        <thead class="table-primary">

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>Actions</th>
            </tr>

        </thead>

        <tbody>

            <?php while ($customer = mysqli_fetch_assoc($result)) { ?>

                <tr>

                    <td><?= $customer['id']; ?></td>

                    <td><?= $customer['full_name']; ?></td>

                    <td><?= $customer['email']; ?></td>

                    <td><?= $customer['phone']; ?></td>

                    <td><?= $customer['city']; ?></td>

                    <td>

                        <a href="edit.php?id=<?= $customer['id']; ?>"
                            class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a href="delete.php?id=<?= $customer['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this customer?');">
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