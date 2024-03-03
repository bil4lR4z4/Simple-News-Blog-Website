<?php
include("../config.php");
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['user_id'])){                                                                                        //
	$user_id = $_GET['user_id'];                                                                                    //
	$sql = mysqli_query($conn, "DELETE FROM `user` WHERE `user_id`={$user_id}") or die("User Cannot delete");       //
	header("location: ../users.php");                                                                               //
}                                                                                                                   //
                                                                                                                    //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['cat_id'])){                                                                                          //
	$cat_id = $_GET['cat_id'];                                                                                       //
	$sql = mysqli_query($conn, "DELETE FROM `category` WHERE `category_id`={$cat_id}") or die("User Cannot delete"); //
	header("location: ../category.php");                                                                             //
}                                                                                                                    //
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['post_id']) || isset($_GET['catid'])){                                                                //                 
	$post_id = $_GET['post_id'];                                                                                     //
	$cat_id = $_GET['catid'];                                                                                        //
	                                                                                                                 //
	                                                                                                                 //
////////////////////////////////////////////////////////////////////////////////////////                             //
	//Delete image  from folder                                                       //                             //
	$query = mysqli_query($conn,"SELECT * FROM `post` WHERE `post_id`={$post_id}");   //                             //
	$row = mysqli_fetch_assoc($query);                                                //                             //
	unlink("upload/".$row['post_img']);                                               //                             //
///////////////////////////////////////////////////////////////////////////////////////                              //
	                                                                                                                 //
	$sql = "DELETE FROM `post` WHERE `post_id`={$post_id};";                                                         //
	$sql .= "UPDATE category SET post= post -1 WHERE category_id = {$cat_id};";                                      //
	                                                                                                                 //
	if(mysqli_multi_query($conn, $sql)){                                                                             //
	  header("location: ../post.php");                                                                               //
	}else{                                                                                                           //
		echo "Post Cannot Delete";                                                                                   //
	}                                                                                                                //
                                                                                                                     //
}                                                                                                                    //
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>