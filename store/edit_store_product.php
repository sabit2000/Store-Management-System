<?php
   require('connection.php');
   require('myfunction.php');
   
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Store Product</title>
    </head>
    <body>
        <?php
		
		    if(isset($_GET['id'])){
			   $getid = $_GET['id'];
			   
			   $sql = "SELECT * FROM store_product WHERE store_prdouct_id=$getid";
			   
               $query = $conn->query($sql);
			   
               $data = mysqli_fetch_assoc($query);
			   
               $store_prdouct_id        = $data['store_prdouct_id'];
               $store_product_name      = $data['store_product_name'];
			   $store_product_quentity  = $data['store_product_quentity'];
               $store_product_entry_date  = $data['store_product_entry_date'];	 
			   
		   }
		   if(isset($_GET['store_product_name'])){
			   $new_store_product_name          = $_GET['store_product_name'];
			   $new_store_product_quentity      = $_GET['store_product_quentity'];
			   $new_store_product_entry_date    = $_GET['store_product_entry_date'];
			   $new_store_prdouct_id            = $_GET['store_prdouct_id'];
			   
			   $sql1 = "UPDATE store_product SET store_product_name='$new_store_product_name',
			                 store_product_quentity='$new_store_product_quentity',
							 store_product_entry_date='$new_store_product_entry_date'
							 WHERE store_prdouct_id = $new_store_prdouct_id";
			   
			   if($conn->query($sql1) == TRUE) {
				   echo 'Update Successful!';
			   }else{
				   echo 'Not Update';
		       }
		    }
		
        ?>



        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            
            Product :<br>
            <select name="store_product_name">
                <?php
					$sql = "SELECT * FROM product";
                    $query = $conn->query($sql);
			
                    while($data = mysqli_fetch_array($query)){
                        $data_id = $data['prdouct_id'];
	                    $data_name = $data['product_name'];
				?>
                       
                    <option value='<?php echo $data_id ?>'<?php if($store_product_name == $data_id) { echo'selected';} ?>>
					    <?php echo $data_name ?>
					</option>";
                <?php}	?>
            </select><br><br>
            Product Quentity :<br>
            <input type="number" name="store_product_quentity" value="<?php echo $store_product_quentity;?>"><br><br>
            Store Entry Date :<br>
            <input type="date" name="store_product_entry_date" value="<?php echo $store_product_entry_date ?>"><br><br>
			<input type="text" name="store_prdouct_id" value="<?php echo $store_prdouct_id ?> " hidden>
            <input type="submit" value="submit">
        </form>
    </body>
</html>
