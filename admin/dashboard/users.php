<?php
    session_start();
    if(isset($_SESSION["id"]) && isset($_SESSION["uname"]) && isset($_SESSION["level"])){
        if($_SESSION["level"]=="admin"){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kbm";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                $error="connection to database fail";
            }
            if(isset($_POST["uname"]) && isset($_POST["pass"])){
                $uname=$_POST["uname"];
                $pass=md5($_POST["pass"]);
                $sql = "INSERT INTO fffusers (uname, pass, level)
            VALUES ('$uname', '$pass', 'volunteer')";

                if ($conn->query($sql) === TRUE) {
                    header("Location: users.php");
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
            <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
            <link href="style.css" rel="stylesheet" type="text/css">
        </head>
        <body>
            
            <header class="cf">
			<h1><img src="logo.png" class="logo" alt="TechnoBeat"></h1>
			<a href="#" id="navicon" class="closed">&#9776;</a>

	</header>
	
	<nav id="main-nav">
			<a href="index.php"><div>Results</div></a>
			<a href="users.php" class="current"><div>Users</div></a>
			<a href="players.php"><div>Players</div></a>
			<a href="logout.php"><div>Logout</div></a>
	</nav>
	
	<div id="main-content">
        
	    	<?php
            
            if(isset($_GET["add"])){
                ?>
                <h1 style="text-align:center">Add User</h1>
                <form class="form" action="users.php" method="post">
                    <input type="text" name="uname" class="uinput" placeholder="Username...">
                    <input type="password" name="pass" class="uinput" placeholder="Password...">
                    <input type="submit" class="usubmit" value="Add">
                </form>
                <?php
            }
            else{
                echo '<a href="?add" class="add-user"><div>Add User</div></a>';
                                $sql = "SELECT * FROM fffusers";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table id='database' class='display'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>id</th>";
                                        echo "<th>Username</th>";
                                        echo "<th>Level</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['uname'] . "</td>";
                                        echo "<td>" . $row['level'] . "</td>";
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
        
        ?>      
	</div>
	
	<div class="fade"></div>
            
     <script src="../../jquery.js"></script>  
      <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
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
    }
    else{
        header("Location: ../index.php");
    }
?>