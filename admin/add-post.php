<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
							  <?php
							    $cat = mysqli_query($conn, "SELECT * FROM `category`");
							    if(mysqli_num_rows($cat)>0){
									echo "<option disabled selected> </option>";
									while($row = mysqli_fetch_assoc($cat)){
										echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
									}
								}
							  ?>
                              
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required accept=".gif, .JPG, .png, .PNG, .jpg, .jpeg, .jfif">
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>

<?php
if(isset($_POST['submit'])){
	$title =  mysqli_real_escape_string($conn, $_POST['post_title']);
	$desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
	$category = mysqli_real_escape_string($conn, $_POST['category']);
	$date = date("d M,Y");
	$author = $_SESSION['user_id'];
	
	$image = $_FILES['fileToUpload']['name'];
	$image_size = $_FILES['fileToUpload']['size'];
	$tempname = $_FILES['fileToUpload']['tmp_name'];
	
	$error = [];
	
	if($image_size > 5242880){
		$error[]= "File Size Must Be 5mb Or Low";
	}
	
	$new_name = time()."_".basename($image);
	$target = "upload/" . $new_name;
	$image_name = $new_name;
	
	if(empty($error) == true){
	    move_uploaded_file($tempname, $target);
	}
	
	
	$sql = "INSERT INTO `post`(`title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES ('$title','$desc','$category','$date','$author','$image_name');";
	$sql .= "UPDATE `category` SET `post`= post + 1 WHERE category_id = '{$category}';";
	
	if(mysqli_multi_query($conn, $sql)){
		header("Location: post.php");
	}
	
}
?>
