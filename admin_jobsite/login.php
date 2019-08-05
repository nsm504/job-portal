<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<link rel="stylesheet" href="../css/main.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<!------ Include the above in your HEAD tag ---------->

<body>
	<section class="admin-body">
	    <div id="login">
	        <div class="container">
	            <div id="login-row" class="row justify-content-center align-items-center">
	                <div id="login-column" class="col-md-6">
	                    <div id="login-box" class="col-md-12">
	                        <form id="adminLogin" class="form">
	                            <h3 class="text-center">Admin Login</h3>
	                            <div class="form-group">
	                                <label for="username" class="">Username:</label><br>
	                                <input type="text" name="username" id="username" class="form-control">
	                            </div>
	                            <div class="form-group">
	                                <label for="password" class="">Password:</label><br>
	                                <input type="password" name="password" id="password" class="form-control">
	                            </div>
	                            <div class="form-group">
	                                <input type="submit" name="submit" class="btn btn-success btn-md" value="Login">  
	                            </div>
	                        </form>
	                        <div class="response"></div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
</body>
</html>
 

 <script src="../js/adminLogin.js"></script>