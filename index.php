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
      
    </div>
    <form>
      <input type="text" class="span3" id="search" data-provide="typeahead" data-items="4" />
      <select name="searchBy" id="searchBy">
        <option>Club Name</option>
        <option>College</option>
      </select>
      </form>
  </div>  
</div>


<script>
  var list;
  <?php
    $list = "list = [";
  ?>
  //if selected value = club
  <?php
    $resultSet = getData("clubs","clubName");
    while($row = mysql_fetch_array($resultSet)){
    $list .="'{$row['clubName']}',";
    }
    $list .="]";
    echo $list;
  ?>
  //if selected value = college
  //make category list appear
  <?php
    $resultSet = getData("colleges","name");
    while($row = mysql_fetch_array($resultSet)){
    $list .="'{$row['name']}',";
    }
    $list .="]";
    echo $list;
  ?>
</script>
<?php include("includes/footer.php"); ?>
<script>$('#search').typeahead({source: list});</script>


