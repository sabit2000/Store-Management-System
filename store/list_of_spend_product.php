<?php
session_start();

$user_first_name = $_SESSION['user_first_name'];
$user_last_name = $_SESSION['user_last_name'];

if (!empty($user_first_name) && !empty($user_last_name)) {
    require('connection.php');

    // Fetch product names directly from the product table
    $sql1 = "SELECT * FROM product";
    $query1 = $conn->query($sql1);

    ?>

    <!DOCTYPE html>
    <html>

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
                            $sql = "SELECT * FROM spend_product";
                            $query = $conn->query($sql);
                            echo "<table class='table table-bordered table-striped'>
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Entry Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            while ($data = mysqli_fetch_assoc($query)) {
                                $spend_product_id = $data['spend_product_id'];
                                $spend_product_name = $data['spend_product_name'];
                                $spend_product_quantity = $data['spend_product_quantity'];
                                $spend_product_entry_date = $data['spend_product_entry_date'];

                                echo "<tr>
                                        <td>$spend_product_name</td>
                                        <td>$spend_product_quantity</td>
                                        <td>$spend_product_entry_date</td>
                                        <td><a href='edit_spend_product.php?id=$spend_product_id' class='btn btn-success'>Edit</a></td>
                                    </tr>";
                            }
                            echo "</tbody></table>";
                            ?>
                        </div>
                    </div><!--@end of right-->
                </div><!--@end of row-->
            </div>
            <div class="container-foulid border-top border-success">
                <?php include('bottombar.php'); ?>
            </div>
        </div><!--@end of container-->
    </body>

    </html>
    <?php
} else {
    header('location:login.php');
}
?>