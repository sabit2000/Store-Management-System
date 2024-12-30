<?php
require('connection.php');
session_start();

$user_first_name = $_SESSION['user_first_name'];
$user_last_name = $_SESSION['user_last_name'];

if (!empty($user_first_name) && !empty($user_last_name)) {
  ?>

  <!DOCTYPE html>
  <html>

  <head>
    <title>Report</title>
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
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
              <label for="product_name">Select Product Name:</label>
              <select name="product_name" class="form-select" required>
                <?php
                $sql = "SELECT * FROM product";
                $query = $conn->query($sql);
                while ($data = mysqli_fetch_assoc($query)) {
                  $product_id = $data['product_id'];
                  $product_name = $data['product_name'];
                  echo "<option value='$product_name'>$product_name</option>";
                }
                ?>
              </select>
              <br>
              <button type="submit" class="btn btn-success">Generate Report</button>
            </form>
<br>
            <h1>Store Product</h1>
            <?php
            // Report for store data
            if (isset($_GET['product_name'])) {
              $product_name = mysqli_real_escape_string($conn, $_GET['product_name']);

              $sql1 = "SELECT * FROM store_product WHERE store_product_name='$product_name'";
              $query1 = $conn->query($sql1);

              echo "<h2>$product_name</h2>";
              echo "<table class='table table-bordered'>
                                        <tr>
                                            <th>Store Date</th>
                                            <th>Amount</th>
                                        </tr>";
              while ($data1 = mysqli_fetch_array($query1)) {
                $store_product_quantity = $data1['store_product_quantity'];
                $store_product_entry_date = $data1['store_product_entry_date'];
                echo "<tr>
                                            <td>$store_product_entry_date</td>
                                            <td>$store_product_quantity</td>
                                        </tr>";
              }
              echo "</table>";
            }
            ?>

            <h1>Spent Product</h1>
            <?php
            // Report for spent data
            if (isset($_GET['product_name'])) {
              $product_name = mysqli_real_escape_string($conn, $_GET['product_name']);

              $sql4 = "SELECT * FROM spend_product WHERE spend_product_name='$product_name'";
              $query4 = $conn->query($sql4);

              echo "<h2>$product_name</h2>";
              echo "<table class='table table-bordered'>
                                        <tr>
                                            <th>Spend Date</th>
                                            <th>Amount</th>
                                        </tr>";
              while ($data4 = mysqli_fetch_array($query4)) {
                $spend_product_quantity = $data4['spend_product_quantity'];
                $spend_product_entry_date = $data4['spend_product_entry_date'];
                echo "<tr>
                                            <td>$spend_product_entry_date</td>
                                            <td>$spend_product_quantity</td>
                                        </tr>";
              }
              echo "</table>";
            }
            ?>
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