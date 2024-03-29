<?php include 'header.php';
//$user_id = $_GET['user_id'];
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
					<?php
					if(isset($_GET['user_id'])){
						$user_id = $_GET['user_id'];
					}
					
					$user_name = mysqli_query($conn, "SELECT * FROM post JOIN user ON post.author=user.user_id WHERE post.author = {$user_id}");
					$user_name_fetch = mysqli_fetch_assoc($user_name);
					?>
					 <h2 class='page-heading'><?php echo $user_name_fetch['first_name'] . ' ' . $user_name_fetch['last_name']; ?></h2>

					
					
					
					
					<?php
					$limit = 4;
					if(isset($_GET['page'])){
						$page = $_GET['page'];
					}else{
						$page = 1;
					}
					$offset = ($page - 1) * $limit;
					
					$sql = mysqli_query($conn, "SELECT * FROM `post` JOIN category ON `post`.category = `category`.category_id
						       JOIN `user` ON `post`.author = `user`.user_id 
							   WHERE post.author={$user_id}
							   ORDER BY post.post_id DESC LIMIT {$offset},{$limit}");
						if(mysqli_num_rows($sql) > 0){
							while($row = mysqli_fetch_assoc($sql)){ ?>
                 
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?single_id=<?php echo $row['post_id'] ?>"><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?single_id=<?php echo $row['post_id'] ?>'><?php echo $row['title'];?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cat_id=<?php echo $row['category_id']; ?>'><?php echo $row['category_name'] ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?user_id=<?php echo $row['user_id']; ?>'><?php echo $row['first_name'].' '.$row['last_name'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date'] ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                       <?php echo substr($row['description'],0,120);?> <span style="font-weight: bold">.....</span>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?single_id=<?php echo $row['post_id'] ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
					 <?php 
						}
					  }else{
							echo "<h3>News Not Found</h3>";
					  }
					?>
					<?php
					  
					   if(mysqli_num_rows($user_name) > 0){
						   $total_records = mysqli_num_rows($user_name);
						   
						   $total_pages = ceil($total_records / $limit);
						   echo "<ul class='pagination'>";
						   if($page > 1){
							   echo '<li><a href="author.php?user_id='.$user_id.'&page='.($page - 1).'">Prev</a></li>';
						   }
						   for($i=1; $i <=$total_pages; $i++){
							   if($i == $page){
								   $active = "active";
							   }else{
								   $active = "";
							   }
							   
							   echo "<li class='{$active}'><a href='author.php?user_id={$user_id}&page={$i}'>{$i}</a></li>";
						   }
						   if($total_pages > $page){
							   echo '<li><a href="author.php?user_id='.$user_id.'&page='.($page + 1).'">Next</a></li>';
						   }
						   echo " </ul>";
					   }
					?>
                    
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
