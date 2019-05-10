<?php
session_start();
$servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kbm";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                echo "connection to database fail";
            }
$sid=$_SESSION["id"];
if ($stmt = $conn->prepare("SELECT * FROM fffplayers WHERE id=?")) {
                            $stmt->bind_param("s", $sid);
                            $stmt->execute();
                            $stmt->bind_result($id,$name,$dcode,$done,$start);
                            $stmt->fetch();
                            if($id!=NULL || $id!=""){
                                
                                if($start==0){
                                    echo "Wait event is not yet started";
                                }
                                else{
                                    $_SESSION["done"]=0;
                                    header("Location: index.php");
                                }
                                
                            }
                            else{
                                echo "Error";
                            }
                            $stmt->close();
                        } 
?>