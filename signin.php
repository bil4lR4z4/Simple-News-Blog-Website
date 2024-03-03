<?php
 include('header.php');
?>
<link rel="stylesheet" href="css/bootstrap5.css">
<div class="container">
  <div class="row d-flex justify-content-center my-5">
	  <h1 class="text-center my-2">Rigestration Form</h1>
	<div class="col-lg-6 p-5 ">
	  <form action="php.php" method="post">
		<label>Enter First Name</label>
		<input type="text" class="form-control" placeholder="First Name" name="f_name">
		  
		<label>Enter Last Name</label>
		<input type="text" class="form-control" placeholder="Last Name" name="l_name">
		  
		<label>Enter Username</label>
		<input type="text" class="form-control" placeholder="Username" name="username">
		  
		<label>Enter Email</label>
		<input type="text" class="form-control" placeholder="Email" name="email">
		  
		<label>Enter Your Password</label>
		<input type="password" class="form-control" placeholder="Password" name="pass">
		  
		<label>Confirm Password</label>
		<input type="password" class="form-control" placeholder="Confirm Password" name="cpass">
		  
		<span>I Have No Acoount?<a href="login.php">Login</a></span><br>
		<input type="submit" class="btn btn-primary my-2" value="SignIn" name="signin">
	  </form>
	</div>
  </div>
</div>

<?php
 include('footer.php');
?>


