<?php
session_start();
    if(isset($_POST["code"])){
        $code = strtoupper($_POST["code"]);
        if($code!=NULL && $code!=""){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kbm";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                echo "connection to database fail";
            }
            else{
                if ($stmt = $conn->prepare("SELECT * FROM fffplayers WHERE code=?")) {
                            $stmt->bind_param("s", $code);
                            $stmt->execute();
                            $stmt->bind_result($id,$name,$dcode,$done,$start);
                            $stmt->fetch();
                            if($id!=NULL || $id!=""){
                                if($done==1){
                                    echo "This player already played";
                                }
                                elseif($start==0){
                                    echo "Wait event is not yet started";
                                }
                                else{
                                    $_SESSION["name"] = $name;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["done"] = $done;
                                    echo "start";
                                }
                            }
                            else{
                                echo "Code is incorrect";
                            }
                            $stmt->close();
                        } 
            }
              $conn->close();        
        }
    }
?>