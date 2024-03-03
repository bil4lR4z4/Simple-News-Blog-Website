<?php
session_start();
include('admin/config.php');

if(isset($_POST['signin'])){
	  $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
	  $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
	  $username = mysqli_real_escape_string($conn, $_POST['username']);
	  $email = mysqli_real_escape_string($conn, $_POST['email']);
	  $login_pass = mysqli_real_escape_string($conn, $_POST['pass']);
	  $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);
	  
	  if($login_pass == $cpass){
	  $sql = mysqli_query($conn, "SELECT * FROM `site_user` WHERE `email`='$email' OR `username`='$username'");
	 
		 if(mysqli_num_rows($sql)>0){
			 $row = mysqli_fetch_assoc($sql);
			 if($row['email'] == $email){
				 echo "
				        <script>
                          alert('Email Already Exist');
                          window.location.href='signin.php';
                        </script>
					  ";
			 }else{
				 echo "
				       <script>
                         alert('Username Already Exist');
                         window.location.href='signin.php';
                       </script>
					  ";
			 }
		 }else{
			 $login_password = password_hash($login_pass, PASSWORD_BCRYPT);
			 $insert = mysqli_query($conn, "INSERT INTO `site_user`(`f_name`, `l_name`, `username`, `email`, `password`) VALUES ('$fname','$lname', '$username','$email','$login_password')");
			 if($insert){
				 echo "
				       <script>
                         alert('Registration Successfull');
                         window.location.href='login.php';
                       </script>
					  ";
			 }
			 
		 }
	
      }else{
		  echo "
		         <script>
                   alert('Password And Confirm Password Not Match');
                   window.location.href='signin.php';
                 </script>
		       ";
	  }
  }


if(isset($_POST['login'])){
	$name = mysqli_real_escape_string($conn, $_POST['useremail']);
	$pass = mysqli_real_escape_string($conn, $_POST['password']);
	
	$select = mysqli_query($conn, "SELECT * FROM `site_user` WHERE `email`='$name' OR `username`='$name' ");
	
	if(mysqli_num_rows($select)==1){
		$result = mysqli_fetch_assoc($select);
		if(password_verify($pass, $result['password'])){
			$_SESSION['first_name'] = $result['f_name'];
			$_SESSION['last_name'] = $result['l_name'];
			$_SESSION['id'] = $result['id'];
			echo "<script>
		            alert('Login Successfully');
				    window.location.href='index.php';
		          </script>
				 ";
		}else{
			echo "<script>
		       alert('Password Not Match');
			   window.location.href='login.php';
		      </script>";
		}
	}else{
		echo "<script>
		       alert('Not Found Account');
			   window.location.href='login.php';
		      </script>
			 ";
	}
	
	
}
 
if(isset($_GET['logout'])){
	session_unset();
	session_destroy();
	header("Location: index.php");
}
?>