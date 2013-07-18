<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
//Prints nav bar
  $nav = printNav(true);
  echo $nav;
?>

<div class="wrapper">
  <div class="container">
    <div class="hero-unit hidden-phone">
      <h1>Welcome to Rate My Club...</h1>
      <p>Here you can rate and review your favorite clubs.&nbsp;</p>
    </div>
    
    <div class="well">
<input type="text" class="span3" id="search" data-provide="typeahead" data-items="4" />
</div>
  </div>
  
</div>

<!--requires a solution to prevent loading jQuery twice-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>

<!--requires the jQuerys to load first-->
<script>
   <?php
   
   //needs refactoring
    global $connection;
      $testQ = "SELECT  `name` FROM  `colleges`;";
      $rs = mysql_query($testQ,$connection);
      $out = "var subjects = [";
      while($r = mysql_fetch_array($rs)){
        $out .= "'{$r['name']}',";
      }
      $testQ = "SELECT  `clubName` FROM  `clubs`;";
      $rs = mysql_query($testQ,$connection);
  
      while($r = mysql_fetch_array($rs)){
        $out .= "'{$r['clubName']}',";
      }
      
      $out .= "];";
      echo $out;
    ?>
     $('#search').typeahead({source: subjects})
    
</script>
<?php include("includes/footer.php"); ?>
