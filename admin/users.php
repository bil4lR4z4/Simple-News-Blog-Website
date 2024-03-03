<?php include "header.php"; ?>
<?php include("config.php");
if($_SESSION['user_role'] == 0){
	header("location: post.php");
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
						  <?php
						      $limit = 2;
						      
						  if(isset($_GET['page'])){
							  $page = $_GET['page'];
						  }else{
							  $page = 1;
						  }
						      $offset = ($page - 1) * $limit; 
							  $sql = mysqli_query($conn, "SELECT * FROM `user` ORDER BY user_id DESC LIMIT {$offset},{$limit}");
							  if(mysqli_num_rows($sql)>0){
								  $no= $offset + 1;
								  while($row = mysqli_fetch_assoc($sql)){
									  $role = ($row['role']==1) ? "Admin" : "Normal"; 
									 echo "
										<tr>
										  <td class='id'>{$no}</td>
										  <td>{$row['first_name']} {$row['last_name']}</td>
										  <td>{$row['username']}</td>
										  <td>{$role}</td>
										  <td class='edit'><a href='update-user.php?id={$row['user_id']}'><i class='fa fa-edit'></i></a></td>
										  <td class='delete'><a href='delete_php/delete.php?user_id={$row['user_id']}'><i class='fa fa-trash-o'></i></a></td>
										</tr>
									 ";
									  $no++;
								  }
							  }else{
								  echo "<h4>Not Record Found</h4>";
							  }
						  ?>
                      </tbody>
                  </table>
				  
				  <?php
				  $pagination = mysqli_query($conn, "SELECT * FROM `user`") or die("Pagination Query Feild");
				  if(mysqli_num_rows($pagination)>0){
					  $total_records = mysqli_num_rows($pagination);
					 
					  $total_page= ceil($total_records / $limit);
					  
					  echo "<ul class='pagination admin-pagination'>";
					  if($page > 1){
						 echo '<li><a href="users.php?page='.($page - 1).'">Prev</a></li>'; 
					  }
					  
					  for($i = 1; $i <= $total_page; $i++){
						  if($i == $page){
							  $active = "active";
						  }else{
							  $active = "";
						  }
						  echo '<li class=" ' . $active . ' "><a href="users.php?page='.$i.'">'.$i.'</a></li>';
					  }
					  if($total_page > $page){
						  echo '<li><a href="users.php?page='.($page + 1).'">Next</a></li>';
					  }
					 
					  echo "</ul>";
				  }
				  ?>
                  
                    <!-- class='active'-->
                     
                  
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
