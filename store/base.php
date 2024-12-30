<?php
session_start();

$user_first_name = $_SESSION['user_first_name'];
$user_last_name = $_SESSION['user_last_name'];

if (!empty($user_first_name) && !empty($user_last_name)) {
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
                            <form action="add_category.php" method="GET">
                                Category:<br>
                                <input type="text" name="category_name" required><br>
                                <label for="category_entrydate">Category Entry Date:</label><br>
                                <input type="date" id="category_entrydate" name="category_entrydate" required><br><br>
                                <input type="submit" value="Add Category">
                            </form>
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