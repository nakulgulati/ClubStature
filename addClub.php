<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
    $userSet = getData("users","*","uID",$_SESSION['uID']);
    $user = mysql_fetch_array($userSet);
    if(isset($_POST['addClub'])){
        $status = 0;
        $fileName = uploadFile($_FILES["file"]["name"],$_POST['clubName']);
        if(isCombinationUnique("clubs","college","clubName",$user['college'],$_POST['clubName'])){
            $query="INSERT INTO clubs(clubName,college,category,url,description,image,creator)   
            VALUES('{$_POST['clubName']}','{$user['college']}','{$_POST['category']}','{$_POST['url']}','{$_POST['description']}','{$fileName}','{$user['uID']}')";
            if(mysql_query($query)){
                $status = 1;
            }
        }
    }

?>


<div class="wrapper">
    <?php
    //Prints nav bar
      $nav = printNav(true);
      echo $nav;
    ?>
    <div class="wrapper-content">
	<div class="container">
	    <h1 class="page-header">Add a Club</h1>
            <?php
                if(isset($_POST['addClub'])){
                    if($status == 1){
                        echo "<div class=\"col-lg-6\">
                            <div class=\"alert alert-success\">
			    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                            Club created.
                            </div>
                            </div>";
                    }
                    elseif($status == 0){
                        echo "<div class=\"col-lg-6\">
                            <div class=\"alert alert-danger\">
			    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                            Club creation failed.
                            </div>
                            </div>";
                    }
                }
            ?>
	    <form name="inp" class="form-horizontal" method="post" action="addClub.php" enctype="multipart/form-data">
		<div class="form-group">
		    <label for="clubName" class="col-lg-2 control-label">Name of Club</label>
		    <div class="col-lg-6">
			<input type="text" class="form-control" id="clubName" name="clubName" placeholder="Club name" required>
		    </div>
		</div>
		<div class="form-group">
		    <label for="category" class="col-lg-2 control-label">Category</label>
		    <div class="col-lg-6">
		    <?php
			$output = "<select class=\"form-control\" name =\"category\" required>";
			//getting the list of categories
			$resultSet = getData("categoryname","category");
			while($row = mysql_fetch_array($resultSet)){
			    $output .= "<option>{$row['category']}</option>";
			}
			
			$output .= " </select>";
			echo $output;
		    ?>
		    </div>
		</div>
		
		<div class="form-group">
		    <label for="college" class="col-lg-2 control-label">College</label>
		    <div class="col-lg-6">
			<?php
			    global $connection;
			    $query = "SELECT * FROM users WHERE uID='{$_SESSION['uID']}'";
			    $resultset = mysql_query($query, $connection);
			    $row=mysql_fetch_array($resultset);
			    $output = "<input type=\"text\" class=\"form-control\" name =\"college\" value=\"{$user['college']}\" disabled>";
			    echo $output;
			?>
		    </div>
		</div>
		<div class="form-group">
		    <label for="url" class="col-lg-2 control-label">Club Url</label>
		    <div class="col-lg-6">
			<input type="text" class="form-control" id="url" name="url" placeholder="club url">
		    </div>
		</div>
		
		<div class="form-group">
		    <label for="file" class="col-lg-2 control-label">Club Logo</label>
		    <div class="col-lg-6">
			<input class="form-control" type="file" name="file" id="file">
		    </div>
		</div>
		
		<div class="form-group">
		    <label for="file" class="col-lg-2 control-label">Description</label>
		    <div class="col-lg-6">
			<textarea class="form-control" name="description" class="input-block-level" required></textarea><br>
			<button type="submit" class="btn btn-primary" value="Create Club" name="addClub">Create Club</button>
		    </div>
		</div>
	    </form>
	</div>
    </div>
</div>
    
<?php include("includes/footer.php"); ?>
