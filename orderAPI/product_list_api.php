<?php
    header("Access-Control-Allow-Origin: *");
    require_once("dbtools.php");
    $link = create_connect();
    $sql = "SELECT * FROM product ORDER BY ID DESC";
    $result = execute_sql($link, "myorder", $sql);
    if(mysqli_num_rows($result) > 0){
        $mydata = array();
        while($row = mysqli_fetch_assoc($result)){
            $row["Toppings"] =  explode(",", $row["Toppings"]);
            $mydata[] = $row; 
        }
        
        echo '{"state": true, "data" : '.json_encode($mydata).'}';

        mysqli_close($link);
    }else{
        echo '{"state": false, "message":"讀取失敗!'.mysqli_error($link).'"}';
    }
?>