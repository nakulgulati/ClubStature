
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

      <?php
        //function to determine if club name is unique
        function is($tableName,$field,$value)
        {
            global $connection;
            
                $query="SELECT * FROM {$tableName} WHERE {$field} = '{$value}'";
                $result=mysql_query($query,$connection);
                $var= mysql_num_rows($result);
                if($var>=1){
                    return false;
                }
                else{
                    return true;
                }
        }

        //function to determine if club name is unique in given college
        function isClubUniqueInCollege($college,$clubname)
        {
            global $connection;
            $query="SELECT * FROM clubs WHERE clubname = '{$clubname}' and college = '{$college}'";
            $result=mysql_query($query,$connection);
            $var= mysql_num_rows($result);
            if($var>=1)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
?>
