<?php
session_start();
include('admin/config.php');
//echo "<pre>";
//print_r($_SERVER);
//echo "</pre>";
//echo "<h2>" . basename($_SERVER['PHP_SELF']). "</h2>";

$page_basename = basename($_SERVER['PHP_SELF']);
switch($page_basename){
	case "single.php":
		if(isset($_GET['single_id'])){
			$sql_title = mysqli_query($conn, "SELECT * FROM `post` WHERE post_id={$_GET['single_id']}") or die("Page Title Query Feild");
			$row_title = mysqli_fetch_assoc($sql_title);
			$page_title = $row_title['title'] . " News";
		}else{
			$page_title = "No Post Found";
		}
		break;
	case "category.php":
		if(isset($_GET['cat_id'])){
			$sql_title = mysqli_query($conn, "SELECT * FROM `category` WHERE category_id={$_GET['cat_id']}") or die("Page Title Query Feild");
			$row_title = mysqli_fetch_assoc($sql_title);
			$page_title = $row_title['category_name'] . " News";
		}else{
			$page_title = "No Post Found";
		}
		break;
	case "author.php":
		if(isset($_GET['user_id'])){
			$sql_title = mysqli_query($conn, "SELECT * FROM `user` WHERE user_id={$_GET['user_id']}") or die("Page Title Query Feild");
			$row_title = mysqli_fetch_assoc($sql_title);
			$page_title = "News By ". $row_title['first_name']." ".$row_title['last_name'];
		}else{
			$page_title = "No Post Found";
		}
		break;
	case "search.php":
		if(isset($_GET['search'])){
			$page_title = "Search : ". $_GET['search'];
		}
		else{
			$page_title = "No Search Result Found";
		}
		
		break;
	default:
		$page_title = "NEWS Site";
		break;
		
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row d-flex justify-content-between">
            <!-- LOGO -->
            <div class="col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <div class="col-md-offset-4 col-md-4 align-self-center">
				<?php
				if(isset($_SESSION['id'])){
					echo "
					  <a href='php.php?logout'><h1 style='color:white'>Logout</h1></a>
					";
				}else{
					echo "
					       <a href='login.php'><h1 style='color:white'>LogIn/SignIn</h1></a>
					     ";
				}
				
				?>
            </div>
            <!-- /LOGO -->
        </div>
		<?php
		  if(isset($_SESSION['id'])){
			  echo "
					 <div class='row'>
		            	<div class='col-md-12 text-center'>
			              <h1 style='color:white; font-weight: bold'>{$_SESSION['first_name']} {$_SESSION['last_name']}</h1>
			            </div>
		             </div> 
				   ";
		   }
		?>
		
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
					<li><a href="index.php">Home</a></li>
					<?php
					if(isset($_GET['cat_id'])){
						$cat_id = $_GET['cat_id'];
					}
					
					
					$sql = mysqli_query($conn, "SELECT * FROM `category` WHERE post > 0");
					$active = "";
					while($row = mysqli_fetch_assoc($sql)){
						if(isset($_GET['cat_id'])){
							if($row['category_id'] == $cat_id){
								$active ="active";
							}else{
							$active = "";
						}
							
						}
						echo "
						      <li><a class='{$active}' href='category.php?cat_id={$row['category_id']}'>{$row['category_name']}</a></li>
						
						    ";
					}
					?>
                   
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
