<?php
// All functions go here

    function confirmQuery($resultSet){
        if(!$resultSet){
            die("Database query failed: " . mysql_error());
        }
    }
    
    function redirect_to( $location = NULL ) {
        if ($location != NULL) {
                header("Location: {$location}");
                exit;
        }
    }
    
    function getNavItems() {
        global $connection;
        
        $query = "SELECT * FROM menu;";
                        $menu_set = mysql_query($query, $connection);
        confirmQuery($menu_set);
        return $menu_set;
    }
    
    function printNav($public = true){
        $output = "";
        $output .= "<div class=\"navbar navbar-inverse navbar-fixed-top\">
                    <div class=\"navbar-inner\">
                    <div class=\"container\">
                    <a class=\"brand\" href=\"index.php\">Rate My Club</a>";
        if($public == true){
            $output .= "<div class=\"navbar-content\">
                                <ul class=\"nav\">";
     
            $menuSet = getNavItems();
            
            while($menuItem = mysql_fetch_array($menuSet)){
                $output .= "<li><a href = \"{$menuItem['slug']}\">{$menuItem['menu_name']}</a></li>";
              }
              
            $output .= "</ul>
                        <div class = \"pull-right\">
                        <a href = \"login.php\" class = \"btn btn-success\">Login</a>
                        <a href = \"signup.php\" class = \"btn btn-info\">Sign Up</a>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>";
            return $output;
        }
        else{
            $output .= "</div>
                        </div>
                        </div>";
                        
            return $output;
        }
        
    }
    
?>
