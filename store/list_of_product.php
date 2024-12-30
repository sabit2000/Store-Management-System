<?php
session_start();

$user_first_name = $_SESSION['user_first_name'];
$user_last_name = $_SESSION['user_last_name'];

if (!empty($user_first_name) && !empty($user_last_name)) {
    ?>
    <?php
    require('connection.php');

    $sql = "SELECT * FROM product";
    $query = $conn->query($sql);

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
                            echo '<table class="table table-bordered table-striped">';
                            echo '<thead class="thead-light"><tr><th>Product Name</th><th>Category</th><th>Code</th><th>Action</th></tr></thead><tbody>';

                            while ($data = mysqli_fetch_assoc($query)) {
                                $product_id = $data['product_id'];
                                $product_name = $data['product_name'];
                                $product_category = $data['product_category'];
                                $product_code = $data['product_code'];

                                echo "<tr>
                                        <td>$product_name</td>
                                        <td>$product_category</td>
                                        <td>$product_code</td>
                                        <td><a href='edit_product.php?id=$product_id' class='btn btn-success'>Edit</a></td>
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
    </body>

    </html>
    <?php
} else {
    header('location:login.php');
}
?>