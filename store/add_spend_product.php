<?php
session_start();

$user_first_name = $_SESSION['user_first_name'];
$user_last_name = $_SESSION['user_last_name'];

if (!empty($user_first_name) && !empty($user_last_name)) {
    require('connection.php');
    require('myfunction.php');
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
            <div class="container-foulid border-bottom border-success">
                <!--topbar-->
                <?php include('topbar.php'); ?>
            </div><!--@end topbar-->
            <div class="container-foulid">
                <div class="row">
                    <div class="col-sm-3 bg-light p-0 m-0">
                        <!--left bar-->
                        <?php include('leftbar.php'); ?>
                    </div><!--@end of left-->
                    <div class="col-sm-9 border-start border-success">
                        <!--right bar-->
                        <div class="row p-4">
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $spend_product_name = $_POST['spend_product_name'];
                                $spend_product_quantity = $_POST['spend_product_quantity'];
                                $spend_product_entry_date = $_POST['spend_product_entry_date'];

                                $sql = "INSERT INTO spend_product (spend_product_name, spend_product_quantity, spend_product_entry_date)
                                    VALUES ('$spend_product_name','$spend_product_quantity','$spend_product_entry_date')";

                                if ($conn->query($sql) == TRUE) {
                                    echo 'Data Inserted!';
                                } else {
                                    echo 'Data not Inserted!';
                                }
                            }
                            ?>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="mt-3">
                                <div class="mb-3">
                                    <label for="spend_product_name" class="form-label">Product:</label>
                                    <select name="spend_product_name" class="form-select">
                                        <?php
                                        $productQuery = $conn->query("SELECT * FROM product");
                                        while ($productData = mysqli_fetch_array($productQuery)) {
                                            $product_id = $productData['product_id'];
                                            $product_name = $productData['product_name'];
                                            echo "<option value='$product_name'>$product_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="spend_product_quantity" class="form-label">Product Quantity:</label>
                                    <input type="text" name="spend_product_quantity" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="spend_product_entry_date" class="form-label">Spend Entry Date:</label>
                                    <input type="date" name="spend_product_entry_date" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
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