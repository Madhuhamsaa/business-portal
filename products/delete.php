<?php

include("../config/db.php");

$id = $_GET['id'];

$query = "DELETE FROM products WHERE id=$id";

if (mysqli_query($conn, $query)) {
    header("Location: index.php");
    exit();
} else {
    echo "Delete Failed";
}

?>