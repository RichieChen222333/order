<?php
    //input: {"name":"烏龍茶", "engname":"XXX", "price":"60", "toppings":"珍珠,芋頭", "ice":"少冰", "sugar":"無糖", "imgpath":"img/01.jpg"}
    header("Access-Control-Allow-Origin: *");
    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["ID"]) && isset($mydata["Name"]) && isset($mydata["EngName"]) && isset($mydata["Price"]) && isset($mydata["Toppings"]) && isset($mydata["Ice"]) && isset($mydata["Sugar"]) && isset($mydata["Img_path"])){
        if($mydata["ID"] != "" && $mydata["Name"] != "" && $mydata["EngName"] != "" && $mydata["Price"] != "" && $mydata["Toppings"] != "" && $mydata["Ice"] != "" && $mydata["Sugar"] != "" && $mydata["Img_path"] != ""){
            $p_id = $mydata["ID"];
            $p_pname = $mydata["Name"];
            $p_engname = $mydata["EngName"];
            $p_price = $mydata["Price"];
            $p_toppings = $mydata["Toppings"];
            $p_ice = $mydata["Ice"];
            $p_sugar = $mydata["Sugar"];
            $p_imgpath = $mydata["Img_path"];

            require_once("dbtools.php");
            $link = create_connect();
            $sql = "UPDATE product SET Name = '$p_pname', EngName = '$p_engname', Price = '$p_price', Toppings = '$p_toppings', Ice = '$p_ice', Sugar = '$p_sugar', Img_path = '$p_imgpath' WHERE ID = '$p_id'";
            if(execute_sql($link, "myorder", $sql)){
                echo '{"state": true, "message":"新增更新成功!"}';
            }else{
                echo '{"state": false, "message":"新增更新失敗!"'.mysqli_error($link).'}';
            }
            mysqli_close($link);
        }else{
            echo '{"state": false, "message":"欄位不得為空白!"}';
        }
    }else{
        echo '{"state": false, "message":"缺少規定欄位!"}';
    }
?>  