<?php
    session_start();
    $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kbm";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                $error="connection to database fail";
            }
    function code(){
        $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789'); // and any other characters
                    shuffle($seed);
                    $random = '';
                    foreach (array_rand($seed, 4) as $k) $random .= $seed[$k];
        return $random;
    }
    if(isset($_SESSION["id"]) && isset($_SESSION["uname"]) && isset($_SESSION["level"])){
            
            if(isset($_POST["uname"])){
                $uname=$_POST["uname"];
                $code=code();
                $sql = "INSERT INTO fffplayers (name, code, done)
            VALUES ('$uname', '$code', '0')";
                if ($conn->query($sql) === TRUE) {
                    header("Location: players.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            
    ?>
        
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width">
            <title>Users</title>
            <link rel="stylesheet" href="datatables.min.css">
            <link href="style.css" rel="stylesheet" type="text/css">
            <?php
                if($_SESSION["level"]!="admin"){ 
            ?>
            <style>
                header h1{
                    width: 100%;
                    display: flex;
                    justify-content: center;
                }
            </style>
            <?php  
                }
            ?>
        </head>
        <body>
            
            <header class="cf">
			<h1><img src="logo.png" class="logo" alt="TechnoBeat"></h1>
				<?php
        if($_SESSION["level"]=="admin"){    
        ?>
			<a href="#" id="navicon" class="closed">&#9776;</a>
	    <?php 
        }            
    ?>
	</header>
	
	<?php
        if($_SESSION["level"]=="admin"){    
        ?>
	<nav id="main-nav">
			<a href="index.php"><div>Results</div></a>
			<a href="users.php"><div>Users</div></a>
			<a href="players.php" class="current"><div>Players</div></a>
			<a href="logout.php"><div>Logout</div></a>
	</nav>
	    <?php 
        }            
    ?>
	
	<div id="main-content">
        
	    	<?php
            
            if(isset($_GET["add"])){
                ?>
                <h1 style="text-align:center">Add player</h1>
                <form class="form" action="users.php" method="post">
                    <input type="text" name="uname" class="uinput" placeholder="Username...">
                    <input type="password" name="pass" class="uinput" placeholder="Password...">
                    <input type="submit" class="usubmit" value="Add">
                </form>
                <?php
            }
            else{
                if($_SESSION["level"]=="admin" || $_SESSION["level"]=="heads"){
                 
                echo '<form class="form" action="players.php" method="post">
                    <input type="text" name="uname" class="uinput" placeholder="Name..." required>
                    <input type="submit" class="usubmit" value="Add">
                </form><br><br>';
                       
                }
                    $sql = "SELECT * FROM fffplayers";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table id='database' class='display'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>id</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Code</th>";
                            if($_SESSION["level"]=="admin"){
                                echo "<th>Done</th>";
                            }
                                        
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['code'] . "</td>";
                                    if($_SESSION["level"]=="admin"){
                                        echo "<td>" . $row['done'] . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }
            }
        if($_SESSION["level"]!="admin"){
            echo '<a href="logout.php"><div class="logout">Logout</div></a>';
        }
        ?>    
          
	</div>
	
	<div class="fade"></div>
            
     <script src="../../jquery.js"></script>  
      <script src="datatables.min.js"></script>
       <script>
           
            $(document).ready(function() {
      $('.fade').hide();
	  $('#navicon').click(function() {
	  
	  if($('#navicon').hasClass('closed')) {
	  	  $('body').animate({left: "-250px"}, 600).css({"overflow":"hidden"});
		  $('#main-nav').animate({right: "0"}, 600);
		  $(this).removeClass('closed').addClass('open').html('&#x2715;');
		  $('.fade').fadeIn();
	  }
	  else if($('#navicon').hasClass('open')) {
		   $('body').animate({left: "0"}, 600).css({"overflow":"scroll"});
		  $('#main-nav').animate({right: "-250px"}, 600);
		  $(this).removeClass('open').addClass('closed').html('&#9776;');
		  $('.fade').fadeOut();
	  }
	  });
  });
           $(document).ready(function(){
    $('#database').DataTable();
});
            </script>
       
        </body>
        </html>
        
        
        <?php  
            
    }
    else{
        header("Location: ../index.php");
    }
?>