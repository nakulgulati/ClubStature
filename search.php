<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<script>
    function prepForm() {
    var select = document.getElementById('searchBy');
    select.onchange = function(){
      if (select.value == "colleges") {
        document.getElementById('searchCollege').style.display = 'inline';
        document.getElementById('category').style.display = 'inline';
        document.getElementById('searchClub').style.display = 'none';
      }else if (select.value == "clubs") {
        document.getElementById('searchCollege').style.display = 'none';
        document.getElementById('category').style.display = 'none';
        document.getElementById('searchClub').style.display = 'inline';
      }
    }
  }
  window.onload = function(){
    prepForm();
    document.getElementById('category').style.display = 'none'; //category dropdown hidden
        document.getElementById('searchCollege').style.display = 'none'; //searchCollege filed hidden
  }
</script>
<?php
  //generating suggestions for typeahead
  
  //list of college names
  $collegeList = "var collegeList = [";
  $resultSet = getData("colleges","name");
  
  while($row = mysql_fetch_array($resultSet)){
    $collegeList .="'{$row['name']}',";
  }
  $collegeList .="];";
  
  //list of club names
  $clubList = "var clubList = [";
  $resultSet = getData("clubs","clubName");
  
  while($row = mysql_fetch_array($resultSet)){
  $clubList .="'{$row['clubName']}',";
  }
  $clubList .="];";
?>


<?php
//Prints nav bar
  $nav = printNav(true);
  echo $nav;
?>
<?php
  //search processing
  if(isset($_GET['submit'])){
    if($_GET['searchClub']!=""){
      $clubSet = getData("clubs","*","clubName",$_GET['searchClub']);
    }
    if(($_GET['category']!="") && ($_GET['searchCollege']!="")){
      $q = "SELECT * FROM clubs WHERE category = '{$_GET['category']}' && college = '{$_GET['searchCollege']}';";
      echo $q;
      $clubSet = mysql_query($q,$connection);
      confirmQuery($clubSet);
    }
    elseif($_GET['searchCollege']!=""){
      $clubSet = getData("clubs","*","college",$_GET['searchCollege']);
    }
    
  }
?>
<div class="wrapper">
    <div class="container">
    
    <form method="get" class="form form-inline" action="search.php">
        <input type="text" class="span3" id="searchClub" name="searchClub" data-provide="typeahead" data-items="4" placeholder="Enter club name to search"/>
          <input type="text" class="span3" id="searchCollege" name="searchCollege" data-provide="typeahead" data-items="4" placeholder="Enter college name to search"/>
         <select id="searchBy" name="searchBy">
            <option value="clubs">Club</option>
         <option value="colleges">College</option>
          </select>
    <div id="category">
    (Optional)
    <?php
         $output = "<select name =\"category\">";
        $output.= "<option></option> ";
        //geting the list of categories
         $resultSet = getData("categoryname","category");
         while($row = mysql_fetch_array($resultSet)){
           $output .= "<option>{$row['category']}</option>";
         }
      
        $output .= " </select>";
         echo $output;
    ?>
    </div>
        <button type="submit" class="btn" name="submit" value="submit">Search</button>
    </form>
    
    <?php
    $output="";
    if(isset($_GET['submit'])){
      $output.="<table class=\"table table-striped\">";
      $output.="<tr><th>Club Name</th><th>College</th><th>Category</th><th>Overall Rating</th></tr>";
        while($club = mysql_fetch_array($clubSet)){
          $output.="<tr><td><a href=\"club.php?clubID={$club['id']}\">".$club['clubName']."</a></td><td>{$club['college']}</td><td>{$club['category']}</td><td>{$club['overallRating']}</td></tr>";
      }
      
      $output.="</table>";
      echo $output;
    }  
    ?>
    
    </div>
</div>

<?php include("includes/footer.php"); ?>

<script>
    <?php echo $clubList; ?>
    <?php echo $collegeList; ?>
  
    $('#searchClub').typeahead({source: clubList});
    $('#searchCollege').typeahead({source: collegeList});
</script>