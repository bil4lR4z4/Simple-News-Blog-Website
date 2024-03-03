<?php include "header.php"; ?>
<?php include("config.php");
if($_SESSION['user_role']== 0){
	header("location: post.php");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                    </thead>
                    <tbody>
						<?php
						$limit = 3 ;
						if(isset($_GET['page'])){
							$page = $_GET['page'];
						}else{
							$page = 1;
						}
						$offset = ($page-1)*$limit;
							$sql = mysqli_query($conn, "SELECT * FROM `site_user` ORDER BY id LIMIT {$offset}, {$limit}");
							if(mysqli_num_rows($sql)>0){
								$no = $offset + 1;
								while($row = mysqli_fetch_assoc($sql)){
									echo "
											<tr>
												<td class='id'>{$no}</td>
												<td>{$row['f_name']} {$row['l_name']}</td>
												<td>{$row['username']}</td>
												<td>{$row['email']}</td>
											</tr>
										 ";
									$no++;
								}
							}else{
								echo "<h3>Not Record Found</h3>";
							}
						?>
                    </tbody>
                </table>
				<?php
				$pagination = mysqli_query($conn, "SELECT * FROM `site_user`");
				if(mysqli_num_rows($pagination)){
					$total_records = mysqli_num_rows($pagination);
					$total_pages = ceil($total_records/$limit);
					
					echo "<ul class='pagination admin-pagination'>";
					if($page > 1){
						echo '<li><a href="site_user.php?page='.($page - 1).'">Prev</a></li>';
					}
					
					for($i = 1; $i <= $total_pages; $i++){
						if($i == $page){
							$active = "active";
						}else{
							$active = "";
						}
						echo '<li class=" ' . $active . ' "><a href="site_user.php?page='.$i.'">'.$i.'</a></li>';
					}
					if($total_pages > $page){
						echo '<li><a href="site_user.php?page='.($page + 1).'">Next</a></li>';
					}
					echo "</ul>";
					
				}
				?>
                
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
