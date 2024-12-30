<?php
session_start();

$user_first_name = $_SESSION['user_first_name'];
$user_last_name = $_SESSION['user_last_name'];

// Check if a message is set in the URL parameters
$success_message = isset($_GET['success']) ? urldecode($_GET['success']) : null;
$error_message = isset($_GET['error']) ? urldecode($_GET['error']) : null;

if (!empty($user_first_name) && !empty($user_last_name)) {
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
                            <!-- Display success or error message if set -->
                            <?php if ($success_message): ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $success_message; ?>
                                </div>
                            <?php elseif ($error_message): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $error_message; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Form to add category -->
                            <form action="process_add_category.php" method="POST">
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Category:</label>
                                    <input type="text" name="category_name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="category_entrydate" class="form-label">Category Entry Date:</label>
                                    <input type="date" id="category_entrydate" name="category_entrydate"
                                        class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-success">Add Category</button>
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