<?php
require('connection.php');

if (isset($_POST['product_name'])) {
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_code = $_POST['product_code'];
    $product_entry_date = $_POST['product_entry_date'];

    $sql = "INSERT INTO product (product_name, product_category, product_code, product_entry_date)
            VALUES ('$product_name','$product_category','$product_code','$product_entry_date')";

    if ($conn->query($sql) == TRUE) {
        $success_message = 'Product Added!';
        header("location: add_product.php?success=" . urlencode($success_message));
        exit();
    } else {
        $error_message = 'Product Not Added!';
        header("location: add_product.php?error=" . urlencode($error_message));
        exit();
    }
}
?>