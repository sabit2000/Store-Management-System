<?php
require('connection.php');

if (isset($_POST['category_name'])) {
    $category_name = $_POST['category_name'];
    $category_entrydate = $_POST['category_entrydate'];

    $sql = "INSERT INTO category (category_name, category_entrydate)
            VALUES ('$category_name', '$category_entrydate')";

    if ($conn->query($sql) === TRUE) {
        $success_message = 'Category Added!';
        header("location: add_category.php?success=" . urlencode($success_message));
        exit();
    } else {
        $error_message = 'Category Not Added!';
        header("location: add_category.php?error=" . urlencode($error_message));
        exit();
    }
}
?>