<?php include 'header.php'; ?>
<?php 
if(!(isset($_SESSION['id']))){
	echo "
	        <script>
		        alert('Please Login First');
			    window.location.href='login.php';
		    </script>
		 ";
}

$id = $_GET['single_id'];

$sql = mysqli_query($conn, "SELECT * FROM `post` JOIN category ON `post`.category = `category`.category_id JOIN `user` ON `post`.author = `user`.user_id WHERE post_id= {$id}");
if(mysqli_num_rows($sql) > 0){
 while($row = mysqli_fetch_assoc($sql)){ ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $row['title'];?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?cat_id=<?php echo $row['category_id']; ?>'><?php echo $row['category_name'] ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?user_id=<?php echo $row['user_id']; ?>'><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date'] ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img'];?>" alt=""/>
                            <p class="description">
                                <?php echo $row['description'];?>
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php
  }
}
?>
<?php include 'footer.php'; ?>
