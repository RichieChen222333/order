<?php
    //input: {"name":"烏龍茶", "engname":"XXX", "price":"60", "toppings":"珍珠,芋頭", "ice":"少冰", "sugar":"無糖", "imgpath":"img/01.jpg"}
    header("Access-Control-Allow-Origin: *");
    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["ID"])){
        if($mydata["ID"] != ""){
            $p_id = $mydata["ID"];

            require_once("dbtools.php");
            $link = create_connect();
            $sql = "DELETE FROM product WHERE ID = '$p_id'";
            if(execute_sql($link, "myorder", $sql) && mysqli_affected_rows($link) == 1){
                echo '{"state": true, "message":"刪除成功!"}';
            }else{
                echo '{"state": false, "message":"刪除失敗!"'.mysqli_error($link).'}';
            }
            mysqli_close($link);
        }else{
            echo '{"state": false, "message":"欄位不得為空白!"}';
        }
    }else{
        echo '{"state": false, "message":"缺少規定欄位!"}';
    }
?>  