<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fastest finger first</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .next{
            padding: 5px 10px;
        }
        .exit-msg div{
            text-align: center;
        }
    </style>
</head>
<body id="body">
    <?php
    $track = 0;
        if(!isset($_SESSION["id"]) || !isset($_SESSION["name"])){
               $track=1; 
            
            ?>
            <div class="code">
                <div class="code-grid">
                   <div class="code-msg"></div>
                    <input type="text" id="usercode" placeholder="Enter your code">
                    <button onclick="details()">Play</button>
                </div>
            </div>
            <?php
            
        }
    ?>
    <div class="form" style="<?php if($track == 0 ){if($_SESSION['done']=='0'){echo 'display:block;';}}?>">
       <div class="question">Starting from the northernmost, arrange these capital cities in clockwise direction</div>
       <div class="cover">
            <button class="start" onclick="start()">Start</button>         
        </div>
        <div class="opt-holder">
            <form action="index.php" class="options-menu" method="post">
           <div class="options" id="1q">
               <input type="hidden" value="A">A) Mumbai
           </div>
            <div class="options" id="2q">
                <input type="hidden" value="B">B) Kolkatta
            </div>
            <div class="options" id="3q">
                <input type="hidden" value="C">C) Delhi
            </div>
            <div class="options" id="4q">
                <input type="hidden" value="D">D) Chennai
            </div>
            <div id="timer"></div>
        <div class="yourans">
            <div class="ans" id="one"></div>
            <div class="ans" id="two"></div>
            <div class="ans" id="three"></div>
            <div class="ans" id="four"></div>
        </div>
        </form>      
        </div>     
    </div>
    <div class="exit" style="<?php if($track == 0 ){if($_SESSION['done']=='1'){echo 'display:block;';}}?>">
        <div class="exit-msg"><div>Thanks <?php if(isset($_SESSION["name"])){echo $_SESSION["name"];}?> for playing
        <br><br><!--button class="start next" onclick="next()">Next around</button--> 
        <br><br>
        <div class="exit-error-msg"></div>
        </div> 
        </div>
    </div>
    <script src="jquery.js"></script>
    <script>
        var ans1,ans2,ans3,ans4,state,interval,elapsedTime,time;
        state=1;
        function next(){
            $.post('next.php', {next: "2"})
                .done(function(msg){ 
                    
                        $(".exit-error-msg").html(msg);
                    
                    
                })
                .fail(function(xhr, status, error) {
                    alert("Ajax Error: "+error)
            });
        }
        function details(){
            var code = $("#usercode").val();
            if(code!=null && code!="" && code.length==4){
                $.post('codechecker.php', {code: code})
                .done(function(msg){ 
                    if(msg=="start"){
                        $(".code").css("display","none");
                        $(".form").fadeIn();
                    }
                    else{
                        $(".code-msg").html(msg);
                    }
                    
                })
                .fail(function(xhr, status, error) {
                    alert("Ajax Error: "+error)
                });
            }
        }
        
        $(".options").click(function(){
                if((state!=5) && (!$(this).hasClass("clicked"))){
                $(this).removeClass("unclicked");
                $(this).addClass("clicked");
                if(state==1){
                    ans1=$(this).find("input").val();
                    $("#one").addClass("clicked");
                    $("#one").html(ans1);
                }
                else if(state==2){
                    ans2=$(this).find("input").val();   
                    $("#two").addClass("clicked");
                    $("#two").html(ans2);
                }
                else if(state==3){
                    ans3=$(this).find("input").val();    
                    $("#three").addClass("clicked");
                    $("#three").html(ans3);
                }
                else if(state==4){
                    clearInterval(interval);
                    ans4=$(this).find("input").val();
                    sendans();
                    $("#four").addClass("clicked");
                    $("#four").html(ans4);
                }
                else{
                    console.log("Error "+state);
                }
                state++;
            }
        });
        function start(){
            $(".cover").css("display","none");  
            $("#1q").fadeIn("slow");
            $("#2q").delay(500).fadeIn("slow");
            $("#3q").delay(1000).fadeIn("slow");
            $("#4q").delay(1500).fadeIn("slow");
                    setTimeout(
                    function() {
                        timer();
                    }, 2000);    
        }
        function timer(){
            var startTime = Date.now();
                            interval = setInterval(function() {
                            elapsedTime = Date.now() - startTime;
                            if(elapsedTime<10000){
                                document.getElementById("timer").innerHTML = (elapsedTime / 1000).toFixed(3);
                            }
                            else{
                                clearInterval(interval);
                                sendans();
                                $(".options").off("click");
                                document.getElementById("timer").innerHTML = "Time Over";
                                $.post('ans.php', {status:"timeout"})
                                .done(function(msg){ 
                                    if(msg=="done"){
                                        $(".form").css("display","none");
                                        $(".exit").fadeIn("slow");
                                    }
                                    else{
                                        alert(msg);
                                    }                   
                                })
                                .fail(function(xhr, status, error) {
                                    alert("Answer sending Error: "+error)
                                });   
                            }
                        }, 10);
        }
        function sendans(){
            time = (elapsedTime/ 1000).toFixed(3);
            $.post('ans.php', {an1: ans1,an2: ans2,an3: ans3,an4: ans4,time: time})
                .done(function(msg){ 
                    if(msg=="done"){
                        $(".form").css("display","none");
                        $(".exit").fadeIn("slow");
                    }
                    else{
                        alert(msg);
                    }                   
                })
                .fail(function(xhr, status, error) {
                    alert("Answer sending Error: "+error)
                });   
        }
    </script>
</body>
</html>