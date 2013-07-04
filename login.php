<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Rate My Club - Sign Up</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!--stylesheets-->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

		<style type="text/css">
			#content > .container {
				padding-top: 50px;
			}
			legend > span{
				font-size: 14px;
			}
		</style>
	</head>	
	<body>
		<!--nav-->
		 <div class="navbar navbar-fixed-top">
	      <div class="navbar-inner">
	        <div class="container">
	          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="brand" href="index.php">Rate My Club</a> 
	        </div>
	      </div>
	    </div>

	    <div id = "content">
		    <div class="container">
		    	<div class="row">
		    		<div class="span6">
		    			<!--image area-->
		    		</div>
		      		<div class="span6">
		    			<!--form area-->
						<form class="form-horizontal" method="post" action="loginProcess.php">
							<legend>
								Sign In
								<span class="pull-right">(or <a href="signup.php">create account</a>)</span>
							</legend>
						   <div class="control-group">
						    <label class="control-label" for="email">Email</label>
						    <div class="controls">
						      <input type="email" id="email" name="email" placeholder="johndoe@example.com" required>
						    </div>
						  </div>
						  <div class="control-group">
						    <label class="control-label" for="password">Password</label>
						    <div class="controls">
						      <input type="password" id="password" name="password" placeholder="******" required>
						    </div>
						  </div>
						  <!---->
						  <div class="control-group">
						    <div class="controls">
						      <button type="submit" class="btn btn-success pull-right">Login</button>
						    </div>
						  </div>
						</form>
		    		</div>
		    	</div>
		    </div>
	    </div>

		<!--jquery-->
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>