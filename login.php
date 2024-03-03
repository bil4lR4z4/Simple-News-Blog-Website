<?php
 include('header.php');
?>
<link rel="stylesheet" href="css/bootstrap5.css">
<div class="container">
  <div class="row d-flex justify-content-center my-5">
	  <h1 class="text-center my-2">Login Form</h1>
	<div class="col-lg-6 p-5">
	  <form action="php.php" method="post">
		<label>Enter Email/Username</label>
		<input type="text" class="form-control" placeholder="Email/Username" name="useremail">
		<label>Enter Your Password</label>
		<input type="password" class="form-control" placeholder="Password" name="password">
		  <span>I Have No Acoount?<a href="signin.php">SignIn</a></span><br>
		  <input type="submit" class="btn btn-primary my-2" value="Login" name="login">
	  </form>
	</div>
  </div>
</div>




