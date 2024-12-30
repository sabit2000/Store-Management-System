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

              if (isset($_GET['user_first_name'])) {
                $user_first_name = $_GET['user_first_name'];
                $user_last_name = $_GET['user_last_name'];
                $user_email = $_GET['user_email'];
                $user_password = $_GET['user_password'];

                $sqll = "INSERT INTO users (user_first_name, user_last_name, user_email, user_password)
                                  VALUES ('$user_first_name', '$user_last_name','$user_email','$user_password')";

                if ($conn->query($sqll) == TRUE) {
                  echo 'Data Inserted';
                } else {
                  echo ' Data NOT Inserted';
                }

              }
              ?>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="mt-3">
                <div class="mb-3">
                  <label for="user_first_name" class="form-label">User's First Name:</label>
                  <input type="text" name="user_first_name" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="user_last_name" class="form-label">User's Last Name:</label>
                  <input type="text" name="user_last_name" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="user_email" class="form-label">User's Email:</label>
                  <input type="text" name="user_email" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="user_password" class="form-label">User's Password:</label>
                  <input type="password" name="user_password" class="form-control">
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
  </body>

  </html>
  <?php
} else {
  header('location:login.php');
}
?>