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
                            $sql = "SELECT * FROM store_product";
                            $query = $conn->query($sql);
                            echo '<table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Entry Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                            while ($data = mysqli_fetch_assoc($query)) {
                                $store_product_id = $data['store_product_id'];
                                $store_product_name = $data['store_product_name'];
                                $store_product_quantity = $data['store_product_quantity'];
                                $store_product_entry_date = $data['store_product_entry_date'];

                                echo "<tr>
                                        <td>$store_product_name</td>
                                        <td>$store_product_quantity</td>
                                        <td>$store_product_entry_date</td>
                                        <td><a href='edit_store_product.php?id=$store_product_id' class='btn btn-success'>Edit</a></td>
                                    </tr>";
                            }
                            echo '</tbody></table>';
                            ?>
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