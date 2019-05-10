<?php
session_start();
  if(isset($_POST["username"]) && isset($_POST["password"])){
      $uname=$_POST["username"];
      $pass = md5($_POST["password"]);
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kbm";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                $error="connection to database fail";
            }
            else{
              if ($stmt = $conn->prepare("SELECT * FROM fffusers WHERE uname=? AND pass=?")) {
                                    $stmt->bind_param("ss", $uname,$pass);
                                    $stmt->execute();
                                    $stmt->bind_result($nid,$nuname,$npass,$nlevel);
                                    $stmt->fetch();
                                    if($nid!=NULL && $nid!=""){
                                        $_SESSION["id"]=$nid;
                                        $_SESSION["uname"]=$nuname;
                                        $_SESSION["level"]=$nlevel;
                                        if($nlevel=="admin"){
                                            header("Location: dashboard/");
                                        }
                                        if($nlevel=="heads"){
                                            header("Location: dashboard/players.php");
                                        }
                                        if($nlevel=="volunteer"){
                                            header("Location: dashboard/players.php");
                                        }
                                        if($nlevel=="display"){
                                            header("Location: dashboard/display.php");
                                        }               
                                    }
                                    else{
                                        $error="Worng username or password";
                                    }
                                    $stmt->close();
                                } 
             }
            $conn->close();
  }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Login</title>
    <style>
        .error{
            margin-bottom: 15px;
            font-size: 16px;
            color: red;
            letter-spacing: 1px;
        }
        * {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
html, body{
    margin: 0px;
    padding: 0px;
    height: 100%;
}
.body{
    height: 100%;
    width: 100%;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    margin-top: 0px;
    font-family: 'Lato', sans-serif;
    background-color: white;
}
.body .layer{
    width: 100%;
    height: 100%;
    background-color: white;
    /*  To keep login form in center of the page    */
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
}
.form{
    position: relative;
    margin: 0px;
    width: 100%;
    text-align: center;
    background: #fff;
    padding: 40px 20px;
    border-radius: 2px;
}
.form .heading{
    color: #000;
    font-size: 25px;
    margin: 0px 0 0px;
    height: 30px;
    line-height: 30px;
    text-align: center;
}
.form .signup-form{
    display: none;
}
.form .input{
    width: 100%;
    padding: 10px 20px;
    background: #f8f8f8;
    border: 1px solid rgba(0, 0, 0, 0.075);
    margin-bottom: 25px;
    color: black !important;
    font-size: 13px;
    -webkit-transition: all 0.4s;
    -moz-transition: all 0.4s;
    -o-transition: all 0.4s;
    transition: all 0.4s;
    font-size: 17px;
    letter-spacing: 2px;
}
.form .input:focus{
    color:white;
    outline:none;
    border:1px solid #8BC3A3
}
.form .submit{
    width: 100%;
    padding: 0 10px;
    line-height: 40px;
    background: #1ebbf0;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: 700;
    text-align: center;
    border: none;
    cursor: pointer;
    font-size: 17px;
}
.form .submit:hover{
    background-color: #1a9dc9;
}
.form .input-box{
    margin-top: 40px;
}
.form .togglebtn {
    color: blue;
    background-color: transparent;
    border: none;
    outline: none;
    cursor: pointer;
    font-weight: 600;
}
::-webkit-input-placeholder{
    color:black;
    font-size:17px
}
:-moz-placeholder{
    color:black;
    font-size:17px
}
::-moz-placeholder{
    color:black;
    font-size:17px
}
:-ms-input-placeholder{
    color:black;
    font-size:17px
}
    </style>
</head>
<body>
        <div class="body">
        <div class="layer">
            <div class="form">
                <div class="login-form">
                    <div class="heading">Login to your <b>Account</b></div>
                    <div class="input-box">
                       <?php
                        if(isset($error)){
                            echo "<div class='error'>".$error."</div>";
                        }
                        ?>
                        <form action="index.php" method="post">
                            <input type="text" class="input" name="username" placeholder="Your username..." required>
                            <input type="password" class="input" name="password" placeholder="Your password..." required>
                            <input type="submit" class="submit" value="login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>