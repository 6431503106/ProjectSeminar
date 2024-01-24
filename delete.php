<?php
include "config.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];

    $delete_query = "DELETE FROM product1 WHERE id = $product_id";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        header("Location: index.php?msg=Product deleted successfully");
        exit();
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
        exit();
    }
} else {
    echo "Invalid product ID.";
    exit();
}
?>