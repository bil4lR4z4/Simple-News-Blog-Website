<?php include "header.php"; 
if($_SESSION['user_role']== 0){
	header("location: post.php");
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>

<?php
include("config.php");
if(isset($_POST['save'])){
	$cat = mysqli_real_escape_string($conn, $_POST['cat']);
	
	$sql = "SELECT category_name FROM `category` WHERE `category_name`= '{$cat}'";
	$run = mysqli_query($conn, $sql);
	if(mysqli_num_rows($run) > 0){
		echo "<p>category_name Alredy Exist</p>";
	}else{
		$insert = mysqli_query($conn,"INSERT INTO `category`(`category_name`) VALUES ('$cat')");
		if($insert){
			echo "
			      <script>
				  alert('category Insert');
				  </script>";
			header("location: category.php");
		}else{
			echo "
			      <script>
				  alert('category Insert');
				  </script>
				 ";
		}
	}
	
}

?>