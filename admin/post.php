<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
						  <?php
						  $limit = 8;
						  if(isset($_GET['page'])){
							 $page = $_GET['page'];
						  }else{
							  $page = 1;
						  }
						  $offset = ($page - 1) * $limit;
						  if($_SESSION['user_role'] == 1){
							  $query = "SELECT * FROM `post` JOIN category ON post.category=category.category_id JOIN user ON post.author=user.user_id ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
						  }elseif($_SESSION['user_role'] == 0){
							  $query = "SELECT * FROM `post` JOIN category ON post.category=category.category_id JOIN user ON post.author=user.user_id
							  WHERE post.author = {$_SESSION['user_id']}
							  ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
						  }
						  $sql = mysqli_query($conn, $query);
						  if(mysqli_num_rows($sql) > 0){
							  $sr = $offset + 1;
							  while($row = mysqli_fetch_assoc($sql)){
								  if($row)
								  echo "
									   <tr>
										  <td class='id'>{$sr}</td>
										  <td>{$row['title']}</td>
										  <td>{$row['category_name']}</td>
										  <td>{$row['post_date']}</td>
										  <td>{$row['first_name']} {$row['last_name']}</td>
										  <td class='edit'><a href='update-post.php?post_id={$row['post_id']}'><i class='fa fa-edit'></i></a></td>
										  <td class='delete'><a href='delete_php/delete.php?post_id={$row['post_id']}&catid={$row['category']}'><i class='fa fa-trash-o'></i></a></td>
									   </tr>
								  
								       ";
								  $sr++;
							  }
						  }else{
							  echo "<h3>Post Not Found</h3>";
						  }
						  ?>
                      </tbody>
                  </table>
				  <?php
				  $pagination = mysqli_query($conn, "SELECT * FROM `post`");
				  if(mysqli_num_rows($pagination) > 0){
					  $total_records = mysqli_num_rows($pagination);
					  $total_pages = ceil($total_records / $limit);
					  
					  echo "<ul class='pagination admin-pagination'>";
					  if($page > 1){
						   echo '<li><a href="post.php?page='.($page - 1).'">Prev</a></li>'; 
					  }
					  for($i=1; $i <= $total_pages; $i++){
						  if($i == $page){
							  $active = "active";
						  }else{
							  $active = "";
						  }
						  echo '<li class=" ' . $active . ' "><a href="post.php?page='.$i.'">'.$i.'</a></li>';
					  }
					   if($total_pages > $page){
						  echo '<li><a href="post.php?page='.($page + 1).'">Next</a></li>';
					   }
					  echo "</ul>";
				  }
				  ?>
                  
                      
                  
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
