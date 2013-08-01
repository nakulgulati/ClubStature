<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<script>
    function prepForm() {
    var select = document.getElementById('searchBy');
    select.onchange = function(){
      if (select.value == "colleges") {
        document.getElementById('collegeSearch').style.display = 'inline';
        document.getElementById('categorySelect').style.display = 'inline';
        document.getElementById('clubSearch').style.display = 'none';
      }else if (select.value == "clubs") {
        document.getElementById('collegeSearch').style.display = 'none';
        document.getElementById('categorySelect').style.display = 'none';
        document.getElementById('clubSearch').style.display = 'inline';
      }
    }
  }
  window.onload = function(){
    prepForm();
    document.getElementById('categorySelect').style.display = 'none'; //category dropdown hidden
        document.getElementById('collegeSearch').style.display = 'none'; //searchCollege filed hidden
  }
</script>
<?php
  //generating suggestions for typeahead
  
  //list of college names
  $collegeList = "[";
  $resultSet = getData("colleges","name");
  
  while($row = mysql_fetch_array($resultSet)){
    $collegeList .="'{$row['name']}',";
  }
  $collegeList .="]";
  
  //list of club names
  $clubList = "[";
  $resultSet = getData("clubs","clubName");
  
  while($row = mysql_fetch_array($resultSet)){
  $clubList .="'{$row['clubName']}',";
  }
  $clubList .="]";
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
    if(($_GET['category']!="(Optional)") && ($_GET['searchCollege']!="")){
      $q = "SELECT * FROM clubs WHERE category = '{$_GET['category']}' && college = '{$_GET['searchCollege']}';";
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
        
    <h1 class="page-header">Search Clubs</h1>
    <form method="get" class="form-inline" action="search.php">
      
      <div class="col-lg-3" id="clubSearch">
          <input class="form-control typeahead club" type="text" id="searchClub" name="searchClub" placeholder="Enter club name to search"/>
      </div>      
      
      <div class="col-lg-3" id="collegeSearch">
          <input class="form-control typeahead college" type="text" id="searchCollege" name="searchCollege" placeholder="Enter college name to search"/>
      </div>
      
      <button type="submit" class="btn btn-primary" name="submit" value="submit">Search</button>
      
      <div class="col-lg-2">  
      <select class="form-control" id="searchBy" name="searchBy">
            <option value="clubs">Club</option>
            <option value="colleges">College</option>
        </select>
      </div>
      
         
    <div id="categorySelect">
    <?php
         $output = "<div class=\"col-lg-3\">  
                    <select class=\"form-control\" name =\"category\">";
        $output.= "<option>(Optional)</option> ";
        //geting the list of categories
         $resultSet = getData("categoryname","category");
         while($row = mysql_fetch_array($resultSet)){
           $output .= "<option>{$row['category']}</option>";
         }
      
        $output .= " </select>
                    </div>";
         echo $output;
    ?>
    </div>
    </form>
    
    <?php
    $output="";
    if(isset($_GET['submit'])){
      if($_GET['searchClub']!=NULL || $_GET['searchCollege']!=NULL ){
        if(mysql_num_rows($clubSet)>0){
          $output.="<br><table class=\"table table-striped results\">";
          $output.="<tr><th>Club Name</th><th>College</th><th>Category</th><th>Overall Rating</th></tr>";
            while($club = mysql_fetch_array($clubSet)){
              $output.="<tr><td><a href=\"club.php?clubID={$club['id']}\">".$club['clubName']."</a></td><td>{$club['college']}</td><td>{$club['category']}</td><td>{$club['overallRating']}</td></tr>";
          }
          
          $output.="</table>";
          echo $output;
      }
      else{
        echo "No match found :(<br>
              Hint: Use the suggestions on typing to search. :)";    
      }
    }
      elseif($_GET['searchClub']==NULL && $_GET['searchCollege']==NULL){
            echo "<br><div id=\"searchError\" class=\"alert alert-warning col-lg-5\">
                Dawg you got to enter something to search!!!
                </div>";
        }
    }  
    ?>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<script>
    $('.club').typeahead({
        local: <?php echo $clubList; ?>
    });
    
    $('.college').typeahead({
        local: <?php echo $collegeList; ?>
    });
      
    
</script>