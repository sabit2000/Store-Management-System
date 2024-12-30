<?php
session_start();

$user_first_name = $_SESSION['user_first_name'];
$user_last_name = $_SESSION['user_last_name'];

if (!empty($user_first_name) && !empty($user_last_name)) {
    ?>
    <?php
    require('connection.php');
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
                            $sql = "select * from category";
                            $query = $conn->query($sql);
                            ?>
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Category</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($data = mysqli_fetch_assoc($query)): ?>
                                        <?php
                                        $category_id = $data['category_id'];
                                        $category_name = $data['category_name'];
                                        $category_entrydate = $data['category_entrydate'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $category_name; ?>
                                            </td>
                                            <td>
                                                <?php echo $category_entrydate; ?>
                                            </td>
                                            <td><a href='edit_category.php?id=<?php echo $category_id; ?>'
                                                    class="btn btn-success">Edit</a></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
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