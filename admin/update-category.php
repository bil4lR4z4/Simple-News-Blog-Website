<?php include "header.php"; ?>
<?php include("config.php"); 
if($_SESSION['user_role']== 0){
	header("location: post.php");
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
				   <?php
				  $id = $_GET['id'];
				  $sql = mysqli_query($conn, "SELECT * FROM `category` WHERE `category_id`={$id}");
				  while($row = mysqli_fetch_assoc($sql)){ ?>
                  <form action="" method ="post">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id']; ?>">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="Enter Catagory" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
				  <?php } ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>


<?php
if(isset($_POST['submit'])){
	$cid = $_POST['cat_id'];
	$cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);
	
	$update = mysqli_query($conn, "UPDATE `category` SET `category_name`='$cat_name' WHERE category_id= {$cid} ");
	if($update){
		echo "Update";
		header ("location: category.php");
	}else{
		echo "Not Update";
	}
}
?>