<?php
error_reporting(0);
session_start();
// if($_SESSION["email"]){
include 'connection.php';
if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($con, "DELETE FROM `cart` WHERE id = $delete_id ") or die('query failed');
   if ($delete_query) {
      header('location:cart.php');
      $message[] = 'Room has been deleted';
   } else {
      header('location:cart.php');
      $message[] = 'Room could not be deleted';
   };
};



include 'header.php';
include 'sidebar.php';
include 'navigation.php';
?>

</br>
</br>

<body style="font-family: courier new">
   <div class="col-sm-12 col-xl-12">
      <div class="bg-secondary rounded h-100 p-4">
         <h4 class="mb-4" style="text-align: center; font-family: courier new"><b><i>Room Booked</i></b></h4>
         <table class="table table-hover" style="text-align: center; font-family: courier new">
            <thead>
               <tr>
                  <th scope="col">Room Name</th>
                  <th scope="col">Price</th>
                  <th scope="col">Image</th>
                  <th scope="col">User</th>
                  <th scope="col">Total</th>
                  <th scope="col">Date</th>
                  <th colspan=2>Action</th>
                  
               </tr>
            </thead>
            <?php
            $query_select = "SELECT *from cart";
            $query_run = mysqli_query($con, $query_select);
            if (mysqli_num_rows($query_run) > 0) {
               foreach ($query_run as $row) {

            ?>
                  <tbody style="padding:left=100px;">
                     <tr style="text-align:center">
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['image']; ?></td>                      
                        <td><?php echo $row['user']; ?></td>
                        <td><?php echo $row['total']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><a href="cart.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Checkout Successfully Done.');"> <i class="fas fa-trash"></i> Check out </a></td>
                     </tr>
               <?php
               }
            }
               ?>
                  </tbody>

         </table>
         <section class="edit-form-container">
            <?php

            if (isset($_GET['edit'])) {
               $edit_id = $_GET['edit'];
               $edit_query = mysqli_query($con, "SELECT * FROM `cart` WHERE id = $edit_id");
               if (mysqli_num_rows($edit_query) > 0) {
                  while ($row = mysqli_fetch_assoc($edit_query)) {
            ?>

                     <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                        <input type="text" class="box" required name="update_full" value="<?php echo $row['name']; ?>">
                        <input type="email" min="0" class="box" required name="update_email" value="<?php echo $row['price']; ?>">
                        <input type="date" class="box" required name="update_date" value="<?php echo $row['image']; ?>">
                        <input type="time" class="box" required name="update_time" value="<?php echo $row['quantity']; ?>">
                        <input type="int" class="box" required name="update_people" value="<?php echo $row['user']; ?>">
                        <input type="int" class="box" required name="update_phone" value="<?php echo $row['total']; ?>">
                        <input type="text" class="box" required name="update_message" value="<?php echo $row['date']; ?>">
                        <input type="submit" value="Update the prodcut" name="update_product" class="btn btn-primary">
                        <input type="reset" value="cancel" id="close-edit" class="option-btn">
                     </form>

            <?php
                  };
               };
               echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
            };
            ?>

         </section>



      </div>
   </div>




   <?php
   // }  
   //     else {
   //              echo "<script>alert('Login to proceed'); window.location.href='../login.php';</script>";
   //  }
   include 'footer.php';

   include 'javascript.php';
   ?>