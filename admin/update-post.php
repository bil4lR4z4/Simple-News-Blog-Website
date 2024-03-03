<?php include "header.php";

if($_SESSION['user_role'] == 0){
	$id = $_GET['post_id'];
	$sequrity = mysqli_query($conn, "SELECT author FROM `post` WHERE `post_id`= $id") or die("Security Query Feild");
	$sequrity_row = mysqli_fetch_assoc($sequrity);
	
	if($sequrity_row['author'] != $_SESSION['user_id']){
		header("Location: post.php");
	}
}
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
		<?php
		$id = $_GET['post_id'];
		$sql = mysqli_query($conn, "SELECT * FROM `post` WHERE `post_id`= {$id}");
		while($row = mysqli_fetch_assoc($sql)){ ?>
        <!-- Form for show edit-->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="id"  class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                    <?php echo $row['description']; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
					<?php
					  $cat = mysqli_query($conn, "SELECT * FROM `category`");
						if(mysqli_num_rows($cat) > 0){
							while($row1 = mysqli_fetch_assoc($cat)){
								$selected = ($row['category'] == $row1['category_id']) ? "selected" : "";
								echo "<option {$selected} value='{$row1['category_id']}'>{$row1['category_name']}</option>";
							}
						}					   
					
					?>
                </select>
				<input type="hidden" value="<?php echo $row['category'] ?>" name="old_cat">
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['post_img']; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row['post_img'];?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
		<?php } ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>

<?php
if(isset($_POST['submit'])){
	$post_id = mysqli_real_escape_string($conn, $_POST['id']);
	$post_title = mysqli_real_escape_string($conn, $_POST['post_title']);
	$desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
	$category = mysqli_real_escape_string($conn, $_POST['category']);
	$old_category = mysqli_real_escape_string($conn, $_POST['old_cat']);
	//if(empty($_POST['new-image'])){
		//$image = $_POST['old-image'];
	//}else{
		
		$image = $_FILES['new-image']['name'];
		$image_size = $_FILES['new-image']['size'];
		$tempname = $_FILES['new-image']['tmp_name'];

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
   //}
	$sql = "UPDATE `post` SET `title`='$post_title',`description`='$desc',`category`= '$category', `post_img`='$image_name' WHERE `post_id`= '$post_id';";
	
	if($_POST['old_cat'] != $_POST['category']){
		$sql .= "UPDATE `category` SET`post` = `post` - 1 WHERE `category_id` = '$old_category';";
		$sql .= "UPDATE `category` SET `post` = `post` + 1 WHERE `category_id` = '$category';";
	}
	
	if (mysqli_multi_query($conn, $sql)) {
      echo "Update";
    } else {
      echo "Not";
    }
}
?>
