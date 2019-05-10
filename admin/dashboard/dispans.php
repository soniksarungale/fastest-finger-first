<?php
    session_start();
    if(isset($_SESSION["id"]) && isset($_SESSION["uname"]) && isset($_SESSION["level"])){
        if($_SESSION["level"]=="display"){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kbm";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                $error="connection to database fail";
            }
            
    ?>
        
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width">
            <title>Display</title>
            <link href="display.css" rel="stylesheet" type="text/css">
        </head>
        <body>
           <div class="l3">
               <div class="kbm-logo">
                   <div class="kbm-img">
                       <img src="kbm.png" alt="KBM IMAGE">
                   </div>
               </div>
               <div class="kdm">
                   <div class="container">
                       <div class="correct">
                          <?php
                           $sql = "SELECT * FROM fffans ORDER BY time";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $correct=0;
    while($row = $result->fetch_assoc()) {
        if($row["correct"]==1){
            $correct++;
        }
    ?>
     
      <div class="player <?php if($row['correct']==1){echo 'correct-player';if($correct==1){echo ' blink';}} ?>"><div class="name"><?php echo $row["name"];?></div><div class="time"><?php echo $row["time"];?></div></div>
       <?php
    }
} else {
    echo "0 results";
}
                           
                           ?>
                           
                       </div>
                   </div>
               </div>
               <button class="next-btn">Next</button> 
           </div>
        </body>
        </html>
        
        
        <?php  
            }
    }
    else{
        header("Location: ../index.php");
    }
?>