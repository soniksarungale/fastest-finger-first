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
    if(isset($_POST["status"]) && isset($_SESSION["name"]) && isset($_SESSION["done"]) && isset($_SESSION["id"])){
        $id=$_SESSION["id"];
        $name=$_SESSION["name"];
        $done=$_SESSION["done"];
        $correct=0;
        $time="20.00";
        $stmt3 = $conn->prepare("INSERT INTO fffans (id, name, correct, time) VALUES (?, ?, ?, ?)");
                $stmt3->bind_param("ssss", $id, $name, $correct, $time);
                    if($stmt3->execute()){
                        $stmt3->close();
                        $sql = "UPDATE fffplayers SET done=1 WHERE id='$id'";
                        if ($conn->query($sql) === TRUE) {
                            $_SESSION["done"]=1;
                            echo "done";
                        } else {
                            echo "Error updating record: " . $conn->error;
                        }
                    }
                    else{
                        echo $stmt3->error;
                        $stmt3->close();
                    }
    }
    if(isset($_POST["an1"]) && isset($_POST["an2"]) && isset($_POST["an3"]) && isset($_POST["an4"]) && isset($_POST["time"]) && isset($_SESSION["name"]) && isset($_SESSION["id"]) && isset($_SESSION["done"])){
        $ans1=$_POST["an1"];
        $ans2=$_POST["an2"];
        $ans3=$_POST["an3"];
        $ans4=$_POST["an4"];
        $time=$_POST["time"];
        $id=$_SESSION["id"];
        $name=$_SESSION["name"];
        $done=$_SESSION["done"];
        $correct = 0;
        if($ans1!="" && $ans2!="" && $ans3!="" && $ans4!="" && $time!="" && $done=="0"){
            
                if($ans1=="C" && $ans2=="B" && $ans3=="D" && $ans4=="A"){
                    $correct=1;
                }            
                $stmt3 = $conn->prepare("INSERT INTO fffans (id, name, correct, time) VALUES (?, ?, ?, ?)");
                $stmt3->bind_param("ssss", $id, $name, $correct, $time);
                    if($stmt3->execute()){
                        $stmt3->close();
                        $sql = "UPDATE fffplayers SET done=1 WHERE id=$id";
                        if ($conn->query($sql) === TRUE) {
                            $_SESSION["done"]=1;
                            echo "done";
                        } else {
                            echo "Error updating record: " . $conn->error;
                        }
                    }
                    else{
                        echo $stmt3->error;
                        $stmt3->close();
                    }
            
        }
    }
$conn->close();
?>