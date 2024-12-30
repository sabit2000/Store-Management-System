<?php
session_start();

$user_first_name = $_SESSION['user_first_name'];
$user_last_name = $_SESSION['user_last_name'];

if (!empty($user_first_name) && !empty($user_last_name)) {
    ?>
    <?php
    require('connection.php');

    // Check for success or error messages in the URL
    $success_message = isset($_GET['success']) ? urldecode($_GET['success']) : '';
    $error_message = isset($_GET['error']) ? urldecode($_GET['error']) : '';
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Store Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
            integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    </head>

    <body>
        <div class="container bg-light">
            <div class="container-foulid border-bottom border-success"><!--topbar-->
                <?php include('topbar.php'); ?>
            </div><!--@end topbar-->
            <div class="container-foulid">
                <div class="row">
                    <div class="col-sm-3 bg-light p-0 m-0"><!--left bar-->
                        <?php include('leftbar.php'); ?>
                    </div><!--@end of left-->
                    <div class="col-sm-9 border-start border-success"><!--right bar-->
                        <div class="row p-4">
                            <?php
                            // Display success or error message
                            if (!empty($success_message)) {
                                echo '<div class="alert alert-success" role="alert">' . $success_message . '</div>';
                            } elseif (!empty($error_message)) {
                                echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
                            }
                            ?>
                            <form action="process_add_product.php" method="POST">
                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Product:</label>
                                    <input type="text" name="product_name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="product_category" class="form-label">Product Category:</label>
                                    <select name="product_category" class="form-select" required>
                                        <?php
                                        $categoryQuery = $conn->query("SELECT * FROM category");
                                        while ($categoryData = mysqli_fetch_array($categoryQuery)) {
                                            $category_id = $categoryData['category_id'];
                                            $category_name = $categoryData['category_name'];
                                            echo "<option value='$category_id'>$category_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="product_code" class="form-label">Product Code:</label>
                                    <input type="text" name="product_code" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="product_entry_date" class="form-label">Product Entry Date:</label>
                                    <input type="date" name="product_entry_date" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-success">Add Product</button>
                            </form>
                        </div>
                    </div><!--@end of right-->
                </div><!--@end of row-->
            </div>
            <div class="container-foulid border-top border-success">
                <?php include('bottombar.php'); ?>
            </div>
        </div><!--@end of container-->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-lqAkGS5LKRYwcqsIPHpNBfcIQG1T3AAIee1ERnY5JvbOORJ9dF9JBE5GGGv2GWtN"
            crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
} else {
    header('location:login.php');
}
?>