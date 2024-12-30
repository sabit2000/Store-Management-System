<?php
 require('connection.php');

?>

<!DOCTYPE html>
<html> 
    <head>
       <title> Edit Category </title>
    </head>

    <body>
        <?php
        if(isset( $_GET['id'])){
         $getid =$_GET['id'];
         $sql ="SELECT * FROM category WHERE category_id=$getid";
         $query=$conn->query($sql);
         $data=mysqli_fetch_assoc($query);
         $category_id       =$data['category_id'];
         $category_name     =$data['category_name'];
         $category_entrydate=$data['category_entrydate'];
            
        }
        if(isset($_GET['category_name'])){
            $new_category_name      =$_GET['category_name'];
            $new_category_entrydate =$_GET['category_entrydate'];
            $new_category_id        =$_GET['category_id'];

          $sqll= "UPDATE category SET
           category_name= '$new_category_name',
           category_entrydate='$new_category_entrydate' WHERE category_id=$new_category_id";

           if($conn->query($sqll)== TRUE){
            echo 'Update Successful!';
           }
           else{
            echo 'NOT Update';
           }

        }

        ?>

        <form action="edit_category.php" method="GET">
            Category :<br>

            <input type="text"  name="category_name" value=" <?php echo $category_name ?>"><br><br>
            <label for="category_entrydata">Category Entry Data:</label> <br>
            <input type="date"id="category_entrydata" name="category_entrydata" value=" <?php echo $category_entrydate ?>" required ><br><br>
            <input type="text"name="category_id" value=" <?php echo $category_id ?>"hidden>
            <input type="submit" value="update">
        </form>
    </body>
</html>
